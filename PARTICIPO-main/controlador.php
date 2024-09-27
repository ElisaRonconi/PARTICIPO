<?php
// Verifica si se ha enviado el formulario
if (isset($_POST["btningresar"])) {
    // Verifica si los campos están vacíos
    if (empty($_POST["usuario"]) || empty($_POST["password"])) {
        echo "<p style='color: #005866;'>Hay campos vacíos</p>";
    } else {
        // Si los campos no están vacíos, recoge los valores
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["password"];
        
        // Realiza la consulta SQL
        $sql = $conexion->query("SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'");

        // Si la consulta encuentra al usuario, redirige a la página de inicio
        if ($datos = $sql->fetch_object()) {
            header("Location: inicio.php");
        } else {
            // Si las credenciales son incorrectas, muestra un mensaje de error
            echo "<p style='color: #005866;'>Contraseña o Usuario incorrectos</p>";
        }
    }
}
?>
