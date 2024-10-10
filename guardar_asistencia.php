<?php
// Conectar a la base de datos
$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'db_participo');

// Recibir los datos del formulario (marcados como presentes)
$asistencias = $_POST['asistencia'];
$idMateria = $_POST['materia'];
$fecha = date('Y-m-d');  // Fecha actual

// Insertar la asistencia en la base de datos
foreach ($asistencias as $idAlumno => $presente) {
    $sql = "INSERT INTO asistencias (idAlumno, idMateria, fecha, presente) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $presente = 1; // 1 si el checkbox estaba marcado
    $stmt->bind_param('iisi', $idAlumno, $idMateria, $fecha, $presente);
    $stmt->execute();
}

echo "Asistencia guardada exitosamente.";

$stmt->close();
$conexion->close();
?>
