
<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto por la dirección de tu servidor MySQL
$username = "usuario"; // Cambia esto por tu nombre de usuario de MySQL
$password = "contraseña"; // Cambia esto por tu contraseña de MySQL
$database = "votacion_db"; // Cambia esto por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombreApellido = $_POST['nombreApellido'];
$alias = $_POST['alias'];
$rut = $_POST['rut'];
$email = $_POST['email'];
$region = $_POST['region'];
$comuna = $_POST['comuna'];
$candidato = $_POST['candidato'];
$redesSociales = isset($_POST['redesSociales']) ? $_POST['redesSociales'] : '';
$amigos = isset($_POST['amigos']) ? $_POST['amigos'] : '';
$prensa = isset($_POST['prensa']) ? $_POST['prensa'] : '';
$otros = isset($_POST['otros']) ? $_POST['otros'] : '';

// Insertar datos en la tabla de votantes
$sql = "INSERT INTO votantes (nombre_apellido, alias, rut, email, region_id, comuna_id, candidato_id) VALUES ('$nombreApellido', '$alias', '$rut', '$email', $region, $comuna, $candidato)";

if ($conn->query($sql) === TRUE) {
    echo "¡Voto registrado con éxito!";
} else {
    echo "Error al registrar el voto: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
