// Función para validar el formulario antes de enviarlo
function validarFormulario() {
  var nombreApellido = document.getElementById('nombreApellido').value;
  var alias = document.getElementById('alias').value;
  var rut = document.getElementById('rut').value;
  var email = document.getElementById('email').value;
  var region = parseInt(document.getElementById('region').value); // Convertir a número entero
  var comuna = parseInt(document.getElementById('comuna').value); // Convertir a número entero
  var candidato = document.getElementById('candidato').value;
  var redesSociales = document.getElementById('redesSociales').checked;
  var amigos = document.getElementById('amigos').checked;
  var prensa = document.getElementById('prensa').checked;
  var otros = document.getElementById('otros').checked;

  // Validar que el nombre y apellido no estén en blanco
  if (nombreApellido.trim() === '') {
      alert('Por favor ingresa tu nombre y apellido.');
      return false;
  }

  // Validar alias (mayor a 5 caracteres, letras y números)
  if (alias.length < 6 || !/^[a-zA-Z0-9]+$/.test(alias)) {
      alert('El alias debe tener al menos 6 caracteres y contener solo letras y números.');
      return false;
  }

  // Validar formato de RUT
  if (!/^\d{1,2}\.\d{3}\.\d{3}-[0-9kK]{1}$/.test(rut)) {
      alert('Por favor ingresa un RUT válido.');
      return false;
  }

  // Validar formato de correo electrónico
  if (!/^\S+@\S+\.\S+$/.test(email)) {
      alert('Por favor ingresa un correo electrónico válido.');
      return false;
  }

  // Validar que se seleccione una región y comuna
  if (region === '' || comuna === '') {
      alert('Por favor selecciona una región y una comuna.');
      return false;
  }

  // Validar que se seleccione un candidato
  if (candidato === '') {
      alert('Por favor selecciona un candidato.');
      return false;
  }

  // Validar que se seleccionen al menos dos opciones en "Cómo se enteró de nosotros"
  if (!(redesSociales || amigos || prensa || otros)) {
      alert('Por favor selecciona al menos dos opciones en "Cómo se enteró de nosotros".');
      return false;
  }

  return true; // Si todas las validaciones pasan, el formulario se puede enviar
}

function cargarRegiones() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "obtener_regiones.php", true);
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          var regionSelect = document.getElementById("region");
          regionSelect.innerHTML = ""; // Limpiar opciones existentes
          var regiones = JSON.parse(xhr.responseText);
          for (var i = 0; i < regiones.length; i++) {
              var option = document.createElement("option");
              option.value = regiones[i].id;
              option.text = regiones[i].nombre;
              regionSelect.appendChild(option);
          }
      }
  };
  xhr.send();
}
function cargarComunas() {
    var regionSeleccionada = document.getElementById("region").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "PHP/obtener_comunas.php?region_id=" + regionSeleccionada, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var selectComuna = document.getElementById("comuna");
            selectComuna.innerHTML = ""; // Limpiar el select de comuna
            var comunas = JSON.parse(xhr.responseText);
            for (var i = 0; i < comunas.length; i++) {
                var option = document.createElement("option");
                option.text = comunas[i].nombre;
                option.value = comunas[i].id;
                selectComuna.appendChild(option);
            }
        }
    };
    xhr.send();
}

