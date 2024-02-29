<?php
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron todos los datos del formulario
    if (
        isset($_POST['rut']) &&
        isset($_POST['email']) &&
        isset($_POST['candidato']) &&
        isset($_POST['nombreApellido']) &&
        isset($_POST['alias']) &&  
        isset($_POST['como_se_entero'])
    ) {
        // Obtener los datos del formulario
        $rut = $_POST['rut'];
        $email = $_POST['email'];
        $candidato = $_POST['candidato'];
        $nombreApellido = $_POST['nombreApellido'];
        $alias = $_POST['alias'];
        $como_se_entero = $_POST['como_se_entero'];

        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "votacion_db";

        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO votos (rut, email, candidato_id, nombre_apellido, alias, como_se_entero, fecha_hora) VALUES ('$rut', '$email', '$candidato', '$nombreApellido', '$alias', '$como_se_entero', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "Voto registrado exitosamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        // Identificar qué campos faltan en el formulario
        $campos_faltantes = array();
        if (!isset($_POST['rut'])) {
            $campos_faltantes[] = "RUT";
        }
        if (!isset($_POST['email'])) {
            $campos_faltantes[] = "Correo Electrónico";
        }
        if (!isset($_POST['candidato'])) {
            $campos_faltantes[] = "Candidato";
        }
        if (!isset($_POST['nombreApellido'])) {
            $campos_faltantes[] = "Nombre y Apellido";
        }
        if (!isset($_POST['alias'])) {
            $campos_faltantes[] = "Alias";
        }
        if (!isset($_POST['region'])) {
            $campos_faltantes[] = "Región";
        }
        if (!isset($_POST['comuna'])) {
            $campos_faltantes[] = "Comuna";
        }
        if (!isset($_POST['como_se_entero'])) {
            $campos_faltantes[] = "Cómo se enteró de nosotros";
        }

        // Imprimir mensaje de error con los campos faltantes
        echo "Error: Faltan los siguientes campos en el formulario: " . implode(", ", $campos_faltantes);
    }
} else {
    echo "Error: Método de solicitud incorrecto.";
}
?>
