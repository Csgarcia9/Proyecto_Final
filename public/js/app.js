const botonLimpiar = document.getElementById("limpiar");
const contenido = document.getElementById("contenido");
const botonUsuarios = document.getElementById("usuarios");
const botonPruductos = document.getElementById("productos");

const urlUsers = "http://localhost/PROYECTO_FINAL/Api/userJson";
const urlProducts = "http://localhost/PROYECTO_FINAL/Api/productosJson";

botonLimpiar.addEventListener("click", function () {
    if (contenido.hasChildNodes()) {
      // Si el contenedor tiene elementos hijos, los elimina todos
      while (contenido.firstChild) {
        contenido.removeChild(contenido.firstChild);
      }
    } else {
      // Si el contenedor está vacío, muestra una alerta
      alert("Campo limpio");
    }
  });



  botonUsuarios.addEventListener("click", function () {
    fetch(urlUsers)
      .then((response) => response.json())
      .then((data) => {
        
        const table = document.createElement("table");
        table.className = "table table-striped table-bordered user-table table-hover";
  
        const thead = document.createElement("thead");
        thead.className = "table-dark";
        const headerRow = document.createElement("tr");
        headerRow.innerHTML = `
          <th>User ID</th>
          <th>Email</th>
          <th>Username</th>
          <th>Creado en</th>
          <th>Rol</th>
          <th>Último Login</th>
          <th>Activo</th>
        `;
        thead.appendChild(headerRow);
        table.appendChild(thead);
  
        const tbody = document.createElement("tbody");
  
        // Iterar sobre los usuarios y agregar las filas al tbody
        data.forEach((user) => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${user.user_id}</td>
            <td>${user.email}</td>
            <td>${user.username}</td>
            <td>${user.created_at}</td>
            <td>${user.role}</td>
            <td>${user.last_login}</td>
            <td>${user.is_active}</td>
          `;
          tbody.appendChild(row);
        });
  
        table.appendChild(tbody);
  
        // Limpiar el contenido anterior del div y agregar la tabla COMPLETA
        contenido.innerHTML = "";
        contenido.appendChild(table);
      })
      .catch((error) => console.error("Error:", error));
  });


botonPruductos.addEventListener("click", function () {
    contenido.innerHTML = ""; 

    const tarjetasContainer = document.createElement("div");
    tarjetasContainer.className = "tarjetas-container";

    fetch(urlProducts)
    .then((response) => response.json())
    .then((data) => {
      data.forEach(producto => {
        const stockLabel = producto.stock > 0
          ? `<span class="stock-label">${producto.stock} en stock</span>`
          : `<span class="stock-label out-of-stock">Sin stock</span>`;

        const col = document.createElement("div");
        col.className = "col";
        const card = document.createElement("div");
        card.className = "card";
        card.innerHTML = `
          ${stockLabel}
          <img src="${producto.imageURL}" class="card-img-top" alt="${producto.nombreProducto}">
          <div class="card-body">
            <h5 class="card-title">${producto.nombreProducto}</h5>
            <p class="card-text">${producto.productoDescripcion}</p>
            <p class="card-text">$${producto.precio}</p>
            <a href="#" class="btn btn-primary">Añadir al carrito</a>
          </div>
        `;
        col.appendChild(card);
        tarjetasContainer.appendChild(col);
      });

      contenido.appendChild(tarjetasContainer);
    })
    .catch((error) => console.error("Error:", error));

});