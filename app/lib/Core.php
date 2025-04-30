<?php

class Core {
    protected $currentController = 'Views';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct($url = null) {
        require_once '../app/config/db.php'; // Requerir la conexión

        // Obtener la URL
        $url = $this->getUrl($url);


        /*API*/
        if (isset($url[0]) && strtolower($url[0]) === 'api') {
            if (isset($url[1]) && file_exists('../app/controllers/Api.php')) {
                require_once '../app/controllers/Api.php';
                $this->currentController = new Api($conexion); // Pasar la conexión
                unset($url[0]); // Eliminar 'api' del array de URL
                if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                } else {
                    // Método de la API no encontrado
                    http_response_code(404);
                    echo json_encode(['error' => 'Endpoint de API no encontrado.']);
                    return;
                }
                $this->params = $url ? array_values($url) : [];
                call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
                return;
            } else {
                // Controlador de API no encontrado
                http_response_code(404);
                echo json_encode(['error' => 'Controlador de API no encontrado.']);
                return;
            }
        }
    

        ///
        // Verificar si el primer segmento es un controlador válido
        if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        } else {
            // Si no es un controlador, asumimos que es un método de Views
            require_once '../app/controllers/Views.php';
            $this->currentController = new Views;

            if (isset($url[0]) && method_exists($this->currentController, $url[0])) {
                $this->currentMethod = $url[0];
                unset($url[0]);
            } elseif (!isset($url[0]) || $url[0] === '') {
                // Caso raíz: http://localhost/
                $this->currentMethod = 'index';
            } else {
                // Si el método no existe, mostramos 404
                require_once '../app/views/pages/404.php';
                return;
            }

            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            return;
        }

        // Si se encontró un controlador diferente a Views
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Verificar si el controlador requiere la conexión
        if ($this->currentController === 'Auth') {
            $this->currentController = new $this->currentController($conexion); // Pasar $conexion a Auth
        } else {
            $this->currentController = new $this->currentController($conexion); // Controladores sin $conexion
        }

        // Método
        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
        }

        // Parámetros
        $this->params = $url ? array_values($url) : [];

        // Ejecutar
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        // Pasar la conexión a las vistas si es necesario
       
    }

    public function getUrl($url = null) {
        if ($url === null && isset($_GET['url'])) {
            $url = $_GET['url'];
        }
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
}
