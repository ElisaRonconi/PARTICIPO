<?php
require("FUNCIONES/menu.php");
require("FUNCIONES/consultas.php");

if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();
}

$idProfesor = $_SESSION['idProfesor'];

// Función para calcular el promedio de asistencia
function calcularPromedioAsistencia($idAlumno, $idMateria, $conexion) {
    // Contar el total de fechas en que hubo clases de esta materia
    $query_total_fechas = $conexion->prepare("
        SELECT COUNT(DISTINCT fecha) AS totalFechas 
        FROM asistencias 
        WHERE idMateria = ?
    ");
    $query_total_fechas->bind_param("i", $idMateria);
    $query_total_fechas->execute();
    $resultado_total_fechas = $query_total_fechas->get_result();
    $totalFechas = $resultado_total_fechas->fetch_assoc()['totalFechas'];

    // Contar las fechas en que el alumno estuvo presente
    $query_asistencias = $conexion->prepare("
        SELECT COUNT(*) AS clasesAsistidas 
        FROM asistencias 
        WHERE idAlumno = ? AND idMateria = ? AND presente = 1
    ");
    $query_asistencias->bind_param("ii", $idAlumno, $idMateria);
    $query_asistencias->execute();
    $resultado_asistencias = $query_asistencias->get_result();
    $clasesAsistidas = $resultado_asistencias->fetch_assoc()['clasesAsistidas'];

    // Calcular el promedio
    return ($totalFechas > 0) ? ($clasesAsistidas / $totalFechas) * 100 : 0;
}

// Código para obtener y mostrar el promedio, así como modificar asistencia

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<!-- Aquí iría el código de HTML y PHP para mostrar el promedio y permitir editar asistencia -->

</body>
</html>
