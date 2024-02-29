<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Votación</title>
</head>
<body>
    <h2>Formulario de Votación</h2>
    <form id="votingForm" action="PHP/procesar.php" method="post" onsubmit="return validarFormulario()">
        <label for="nombreApellido">Nombre y Apellido:</label>
        <input type="text" id="nombreApellido" name="nombreApellido" required><br><br>

        <label for="alias">Alias (mayor a 5 caracteres, letras y números):</label>
        <input type="text" id="alias" name="alias" pattern="[A-Za-z0-9]{6,}" required><br><br>

        <label for="rut">RUT:</label>
        <input type="text" id="rut" name="rut" pattern="\d{1,2}\.\d{3}\.\d{3}-[0-9kK]{1}" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <?php
        // Aquí se coloca el código PHP para generar el combo box de la región y las comunas relacionadas

        $servername = "localhost"; // Cambia esto por la dirección de tu servidor MySQL
        $username = "root"; // Cambia esto por tu nombre de usuario de MySQL
        $password = ""; // Cambia esto por tu contraseña de MySQL
        $database = "votacion_db"; // Cambia esto por el nombre de tu base de datos

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            echo "Error de conexión: " . $conn->connect_error;
            die();
        } 

        // Obtener regiones
        $sql = "SELECT * FROM regiones";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<label for="region">Región:</label>';
            echo '<select  id="region" name="region" onchange="cargarComunas()">'; // Agrega el atributo name="region"

            echo '<option value="">Seleccionar Región</option>'; // Agregamos una opción por defecto

            while($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
            }
            echo '</select>';
        } else {
            echo "No se encontraron regiones.";
        }

        // Espacio para mostrar las comunas después de seleccionar una región
        echo"<br>";
        echo '<br><label for="comuna">Comuna:</label>';
        echo '<select   id="comuna" name="comuna" disable>'; // Agrega el atributo name="comuna"
        echo '<option value="">Seleccionar Comuna</option>';
        echo '</select>';

        ?>
        <br><br>

        <label for="candidato">Candidato:</label><br>
        <?php
        // Consulta para obtener los candidatos
        $sql_candidatos = "SELECT * FROM candidatos";
        $result_candidatos = $conn->query($sql_candidatos);
        if ($result_candidatos->num_rows > 0) {
            while($row_candidato = $result_candidatos->fetch_assoc()) {
                echo '<input type="radio" id="candidato" name="candidato" value="' . $row_candidato["id"] . '">';
                echo '<label for="candidato">' . $row_candidato["nombre"] . '</label><br>';
            }
        } else {
            echo "No se encontraron candidatos.";
        }
        $conn->close();
        ?>

        <br><br>

        <label for="como_se_entero">¿Cómo se enteró de nosotros?</label><br>
        <select id="como_se_entero" name="como_se_entero">
            <option value="Redes Sociales">Redes Sociales</option>
            <option value="Amigos">Amigos</option>
            <option value="Prensa">Prensa</option>
            <option value="Otros">Otros</option>
        </select><br><br>

        <input type="submit" value="Enviar Voto">

    </form>
    <script src="JS/validaciones.js"></script>
</body>
</html>
