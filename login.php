<?php
session_start();

// Ejemplo de conexión y verificación del login
$conexion = new mysqli("localhost", "root", "", "db_participo", 3306);

if (isset($_POST['usuario'], $_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Verificar si el usuario existe y las credenciales son correctas en la tabla usuarios
    $sql = "SELECT idProfesor FROM usuarios WHERE usuario = ? AND contraseña = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ss', $usuario, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['idProfesor'] = $row['idProfesor']; // Almacena el idProfesor en la sesión

        // Obtener el nombre del profesor desde la tabla profesores
        $sqlProfesor = "SELECT nombre FROM profesores WHERE idProfesor = ?";
        $stmtProfesor = $conexion->prepare($sqlProfesor);
        $stmtProfesor->bind_param('i', $row['idProfesor']);
        $stmtProfesor->execute();
        $resultProfesor = $stmtProfesor->get_result();

        if ($resultProfesor->num_rows === 1) {
            $profesor = $resultProfesor->fetch_assoc();
            $_SESSION['nombreProfesor'] = $profesor['nombre']; // Guarda el nombre del profesor en la sesión
        }

        header("Location: inicio.php"); // Redirige al inicio
        exit();
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARTICIPO - Iniciar Sesión</title>
    <link rel="stylesheet" href="styles/login.css">
    <link rel="shortcut icon" href="IMG/logo.png" />
</head>
<body>
    <header>
        <img src="IMG/logo.png" alt="Logo" class="logo-header">
        <div id="logo1"><h1>PARTICIPO</h1></div>
        <div id="logo2"><h2>Sistema de Asistencias</h2></div>
    </header>

    <div class="login-content">
        <form method="POST" action="">
            <img src="IMG/logo.png" alt="Logo" class="logo">
            <h2 class="title">Bienvenido</h2>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="divUs">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Usuario</h5>
                    <input id="usuario" type="text" class="input" name="usuario" required>
                </div>
            </div>

            <div class="divPass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Contraseña</h5>
                    <input id="password" type="password" class="input" name="password" required>
                </div>
            </div>

            <div class="view">
                <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>

            <div class="text-center">
                <a class="font-italic" href="#">Olvidé mi contraseña</a>    
            </div>

            <input name="btningresar" class="btn" type="submit" value="INICIAR SESIÓN">
        </form>
    </div>
</body>
</html>
