<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('conexionBD.php');
    include('alta.php');

    
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contraseña =$_POST['clave'];  
    //$password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Encriptar la contraseña


    try {
        // Insertar el usuario en la tabla "usuarios"
        $sql_usuario = "INSERT INTO usuarios (idUsuario, usuario , email, contraseña) VALUES (null, usuario, email, contraseña)";
        $stmt_usuario = $conexion->prepare($sql_usuario);
        $stmt_usuario->bind_param( $usuario, $email, $contraseña);

        if ($stmt_usuario->execute()) {
            // Obtener el ID del usuario recién insertado
            $idUsuario = $stmt_usuario->insert_id;
        
            $conexion->rollback();
            echo "Error al registrar el usuario: " . $conexion->error;
        }


        $stmt_usuario->close();
       

    } catch (Exception $e) {
        $conexion->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conexion->close();
}

/*Validar si el email ya existe en la tabla usuarios
$sql_check = "SELECT * FROM usuarios WHERE email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "El email ya está registrado.";
    $stmt_check->close();
    $conn->close();
    exit();
}
$stmt_check->close();
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta</title>
    <link rel="stylesheet" href="styles/alta.css">
    <link rel="shortcut icon" href="IMG/logo.png" />
</head>
<body>
<header>
    <img src="IMG/logo.png" alt="Logo" class="logo-header">
    <div id="logo1"><h1>PARTICIPO</h1></div>
    <div id="logo2"><h2>Sistema de Asistencias</h2></div>
</header>

<nav class="navMenu">
    <a href="inicio.php">Inicio</a>
    <a href="alta.php">Altas</a>
    <a href="listado.php">Asistencias</a>
    <a href="resistro_alumno.php">Registros</a>
    <a href="#">Calendario</a>
    <div class="animation start-home"></div>
</nav>

    
<div class="login-content"> 
        <h2>Alta de Alumno</h2>
        <form action="alta_alumno.php" method="POST">
<div class="formulario">

  <label for="Usuario">Usuario:</label>
  <input type="usuario" id="usuario" name="usuario" required><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br>

  <label for="clave">Contraseña:</label>
  <input type="password" id="clave" name="clave" required><br>

  <label for="institucion">Institución:</label>
  <select id="institucion" name="institucion">
    <!-- Opciones de instituciones desde la base de datos -->
  </select><br>

  <label for="materia">Materia:</label>
  <select id="materia" name="materia">
    <!-- Opciones de materias desde la base de datos -->
  </select><br>

  <input type="submit" value="Registrar Alumno">
</form>

</body>
</html>