<?php
// Validar si el email ya existe en la tabla usuarios
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



// alta_alumno.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    include('conexionBD.php');

    // Capturar datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Encriptar la contraseña
    $institucion_id = $_POST['institucion'];
    $materia_id = $_POST['materia'];
    $rol = 'alumno';  // Definimos el rol como "alumno"

    // Comenzamos una transacción para garantizar la integridad de los datos
    $conn->begin_transaction();

    try {
        // 1. Insertar el usuario en la tabla "usuarios"
        $sql_usuario = "INSERT INTO usuarios (nombre, email, password, rol, fecha_creacion) VALUES (?, ?, ?, ?, NOW())";
        $stmt_usuario = $conn->prepare($sql_usuario);
        $stmt_usuario->bind_param("ssss", $nombre, $email, $password, $rol);

        if ($stmt_usuario->execute()) {
            // Obtener el ID del usuario recién insertado
            $usuario_id = $stmt_usuario->insert_id;

            // 2. Insertar el alumno en la tabla "alumnos" usando el ID del usuario
            $sql_alumno = "INSERT INTO alumnos (usuario_id, institucion_id, materia_id) VALUES (?, ?, ?)";
            $stmt_alumno = $conn->prepare($sql_alumno);
            $stmt_alumno->bind_param("iii", $usuario_id, $institucion_id, $materia_id);

            if ($stmt_alumno->execute()) {
                // Si todo va bien, confirmamos la transacción
                $conn->commit();
                echo "Alumno registrado con éxito.";
            } else {
                // Si falla la inserción en "alumnos", deshacer transacción
                $conn->rollback();
                echo "Error al registrar al alumno: " . $conn->error;
            }
        } else {
            // Si falla la inserción en "usuarios", deshacer transacción
            $conn->rollback();
            echo "Error al registrar el usuario: " . $conn->error;
        }

        // Cerrar las declaraciones
        $stmt_usuario->close();
        $stmt_alumno->close();

    } catch (Exception $e) {
        // Manejar cualquier error durante la transacción
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn->close();
}
?>
