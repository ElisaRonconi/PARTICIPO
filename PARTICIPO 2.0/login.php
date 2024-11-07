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

        header("Location: index.php"); // Redirige al inicio
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="CSS/login.css">
    
</head>
<body>
   <div class="welcome-text" style="
    background-image: url('IMG/classroom.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 95vh;
     object-fit: cover; /* Ajusta la imagen sin distorsionarla */
    width: 100%;
    margin-top: 10px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);"> 
    <main>
        <article>
            <section>
            
                <form action="" method="POST">
                <img src="IMG/participoL.png" alt="Logo" class="logo-header">
                    <h1>Inicio de Sesion</h1>
            
                    <input id="usuario" type="text" class="input" name="usuario" required placeholder="Usuario"><br/>
                    <input type="password" name="password" placeholder="Contrase&ntilde;a"><br/>
                    <button type="submit">Iniciar</button>
                    

                    <p>Aun no tienes cuenta ?</p>
                    <p>
                        <a href="altaProfesor.php">Registrate</a>
                    </p>
                </form>
            </section>
        </article>
    </main>
    
</body>
</html>