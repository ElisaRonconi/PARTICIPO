<?php
session_start();

// Verificar si el profesor ha iniciado sesión
if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "db_participo", 3306);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los valores del formulario
$idMateria = $_POST['idMateria'];
$idInstituto = $_POST['idInstituto'];
$asistencias = $_POST['asistencia']; // array con los ids de alumnos que marcaron asistencia

// Establecer la fecha actual
$fecha_actual = date('Y-m-d');

// Insertar asistencia para cada alumno marcado
foreach ($asistencias as $idAlumno => $valor) {
    // Preparar la consulta SQL para insertar la asistencia
    $sql_asistencia = "INSERT INTO asistencias (fecha, idMateria, idAlumno) VALUES (?, ?, ?)";
    $stmt_asistencia = $conexion->prepare($sql_asistencia);
    $stmt_asistencia->bind_param("sii", $fecha_actual, $idMateria, $idAlumno);
    
    // Ejecutar la consulta
    if ($stmt_asistencia->execute()) {
        echo "Asistencia registrada correctamente para el alumno con ID: " . $idAlumno . "<br>";
    } else {
        echo "Error al registrar la asistencia para el alumno con ID: " . $idAlumno . ". " . $stmt_asistencia->error . "<br>";
    }

    // Cerrar el statement
    $stmt_asistencia->close();
}

// Cerrar la conexión
$conexion->close();

// Redirigir a la página de inicio o mostrar un mensaje de éxito
header("Location: obtener_lista_alumnos.php");
exit();

?>
