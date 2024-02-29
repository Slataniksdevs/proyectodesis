<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia esto por la dirección de tu servidor MySQL
$username = "root"; // Cambia esto por tu nombre de usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$database = "votacion_db"; // Cambia esto por el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha recibido el parámetro region_id en la solicitud GET
if(isset($_GET['region_id'])) {
    $region_id = $_GET['region_id'];

    // Consulta para obtener las comunas de la región seleccionada
    $sql = "SELECT * FROM comunas WHERE region_id = $region_id";
    $result = $conn->query($sql);

    $comunas = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $comuna = array(
                'id' => $row['id'],
                'nombre' => $row['nombre']
            );
            $comunas[] = $comuna;
        }
        // Devolver las comunas en formato JSON
        echo json_encode($comunas);
    } else {
        // Si no hay comunas, devolver un arreglo vacío
        echo json_encode([]);
    }
} else {
    // Si no se proporciona el parámetro region_id, devolver un mensaje de error
    echo "Error: No se proporcionó el parámetro region_id.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
