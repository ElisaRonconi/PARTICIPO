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

// Obtener la información enviada desde el formulario
$idMateria = $_POST['idMateria'];
$idInstituto = $_POST['idInstituto'];
$asistencias = isset($_POST['asistencia']) ? $_POST['asistencia'] : [];

// Procesar la asistencia para cada alumno
foreach ($asistencias as $idAlumno => $asistio) {
    // Insertar la asistencia en la base de datos
    $sql_asistencia = "INSERT INTO asistencias (idAlumno, idMateria, fecha, asistio) VALUES (?, ?, NOW(), ?)";
    $stmt_asistencia = $conexion->prepare($sql_asistencia);
    $stmt_asistencia->bind_param("iii", $idAlumno, $idMateria, $asistio);
    $stmt_asistencia->execute();
}

// Redirigir al profesor a la página de inicio o mostrar un mensaje de éxito
header("Location: inicio.php?mensaje=Asistencia%20guardada%20correctamente");
exit();

// Cerrar la conexión
$stmt_asistencia->close();
$conexion->close();
?>