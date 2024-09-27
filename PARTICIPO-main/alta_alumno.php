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