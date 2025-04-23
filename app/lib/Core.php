<?php

class Core {
    protected $currentController = 'Views';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct($url = null) {
        $url = $this->getUrl($url);

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
        $this->currentController = new $this->currentController;

        // Método
        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
        }

        // Parámetros
        $this->params = $url ? array_values($url) : [];

        // Ejecutar
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
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
