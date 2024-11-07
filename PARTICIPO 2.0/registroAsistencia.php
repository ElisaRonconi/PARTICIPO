<?php
require("FUNCIONES/menu.php");
require("FUNCIONES/consultas.php");

if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();
}

$idProfesor = $_SESSION['idProfesor'];

// Consulta para obtener las materias del profesor
$query_materias = $conexion->prepare("
    SELECT m.numeroMateria, m.materia 
    FROM materias m
    JOIN materia_instituto mi ON m.numeroMateria = mi.numeroMateria
    JOIN profesor_instituto pi ON mi.idInstituto = pi.idInstituto
    WHERE pi.idProfesor = ?
");
$query_materias->bind_param("i", $idProfesor);
$query_materias->execute();
$resultado_materias = $query_materias->get_result();

// Al guardar o actualizar la asistencia
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_asistencia'])) {
    $numeroMateria = $_POST['materia'];
    $fecha = $_POST['fecha'];
    $asistencias = $_POST['asistencia']; // Array con los IDs de los alumnos que estuvieron presentes

    foreach ($asistencias as $idAlumno => $presente) {
        $presente = $presente ? 1 : 0;

        // Verificar si ya existe un registro de asistencia para este alumno, materia y fecha
        $query_verificar = $conexion->prepare("
            SELECT * FROM asistencias 
            WHERE idAlumno = ? AND idMateria = ? AND fecha = ?
        ");
        $query_verificar->bind_param("iis", $idAlumno, $numeroMateria, $fecha);
        $query_verificar->execute();
        $resultado_verificar = $query_verificar->get_result();

        if ($resultado_verificar->num_rows > 0) {
            // Si existe, actualizar la asistencia
            $query_update = $conexion->prepare("
                UPDATE asistencias SET presente = ? 
                WHERE idAlumno = ? AND idMateria = ? AND fecha = ?
            ");
            $query_update->bind_param("iiis", $presente, $idAlumno, $numeroMateria, $fecha);
            $query_update->execute();
        } else {
            // Si no existe, insertar un nuevo registro de asistencia
            $query_insert = $conexion->prepare("
                INSERT INTO asistencias (idAlumno, idMateria, fecha, presente) 
                VALUES (?, ?, ?, ?)
            ");
            $query_insert->bind_param("iisi", $idAlumno, $numeroMateria, $fecha, $presente);
            $query_insert->execute();
        }
    }

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Asistencia guardada con éxito',
            showConfirmButton: false,
            timer: 1500
        });
    </script>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<div class="registro-asistencia-container">
    <form class="form-box" method="post" action="registroAsistencias.php">
        <h3>Registrar Asistencia</h3>

        <select name="materia" required>
            <option value="">Seleccione una materia</option>
            <?php while ($fila = $resultado_materias->fetch_assoc()): ?>
                <option value="<?= $fila['numeroMateria']; ?>">
                    <?= $fila['materia']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="date" name="fecha" required>
        
        <table border="1">
            <tr>
                <th>Alumno</th>
                <th>Asistencia</th>
            </tr>
            <?php
            // Aquí debes cargar la lista de alumnos de la materia seleccionada
            $query_alumnos = $conexion->prepare("
                SELECT a.idAlumno, a.nombre, a.apellido 
                FROM alumnos a
                JOIN alumno_materia am ON a.idAlumno = am.idAlumno
                WHERE am.numeroMateria = ?
            ");
            $query_alumnos->bind_param("i", $_POST['materia']);
            $query_alumnos->execute();
            $resultado_alumnos = $query_alumnos->get_result();

            while ($alumno = $resultado_alumnos->fetch_assoc()):
            ?>
                <tr>
                    <td><?= htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?></td>
                    <td>
                        <input type="checkbox" name="asistencia[<?= $alumno['idAlumno']; ?>]" value="1">
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        
        <button type="submit" name="guardar_asistencia">Guardar Asistencia</button>
    </form>
</div>

</body>
</html>
