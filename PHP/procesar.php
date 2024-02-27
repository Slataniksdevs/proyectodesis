<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombreApellido = $_POST['nombreApellido'];
    $alias = $_POST['alias'];
    $rut = $_POST['rut'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $comuna = $_POST['comuna'];
    $candidato = $_POST['candidato'];
    $comoSeEntero = isset($_POST['redesSociales']) + isset($_POST['amigos']) + isset($_POST['prensa']) + isset($_POST['otros']);

    // Validar que el nombre y apellido no estén en blanco
    if (empty($nombreApellido)) {
        echo "Por favor ingresa tu nombre y apellido.";
        return;
    }

    // Validar alias (mayor a 5 caracteres, letras y números)
    if (strlen($alias) < 6 || !preg_match("/^[a-zA-Z0-9]+$/", $alias)) {
        echo "El alias debe tener al menos 6 caracteres y contener solo letras y números.";
        return;
    }

    // Validar formato de RUT
    if (!preg_match("/^\d{1,2}\.\d{3}\.\d{3}-[0-9kK]{1}$/", $rut)) {
        echo "Por favor ingresa un RUT válido.";
        return;
    }

    // Validar formato de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor ingresa un correo electrónico válido.";
        return;
    }

    // Validar que se seleccione una región y comuna
    if (empty($region) || empty($comuna)) {
        echo "Por favor selecciona una región y una comuna.";
        return;
    }

    // Validar que se seleccione un candidato
    if (empty($candidato)) {
        echo "Por favor selecciona un candidato.";
        return;
    }

    // Validar que se seleccionen al menos dos opciones en "Cómo se enteró de nosotros"
    if ($comoSeEntero < 2) {
        echo "Por favor selecciona al menos dos opciones en 'Cómo se enteró de nosotros'.";
        return;
    }

    // Si todas las validaciones pasan, procesar los datos
    // Aquí puedes realizar las consultas a la base de datos para guardar los datos del formulario
    // y cualquier otra lógica necesaria
    echo "¡Datos del formulario procesados con éxito!";
} else {
    // Si no se reciben datos por POST, redireccionar al formulario
    header("Location: formulario.html");
    exit;
}
