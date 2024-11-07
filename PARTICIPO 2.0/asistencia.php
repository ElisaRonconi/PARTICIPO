<?php
require("FUNCIONES/menu.php");
require("FUNCIONES/consultas.php");

// Verifica si el profesor ha iniciado sesión
if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();
}

$idProfesor = $_SESSION['idProfesor'];

// Consulta para obtener los institutos relacionados al profesor
$query_institutos = $conexion->prepare("
    SELECT i.idInstituto, i.nombre 
    FROM institutos i
    JOIN profesor_instituto pi ON i.idInstituto = pi.idInstituto
    WHERE pi.idProfesor = ?
");
$query_institutos->bind_param("i", $idProfesor);
$query_institutos->execute();
$resultado_institutos = $query_institutos->get_result();

// Consulta para obtener todas las materias
$query_materias = $conexion->prepare("
    SELECT m.numeroMateria, m.materia 
    FROM materias m
    JOIN materia_instituto mi ON m.numeroMateria = mi.numeroMateria
");
$query_materias->execute();
$resultado_materias = $query_materias->get_result();

// Verifica si se ha enviado el formulario
$resultado_alumnos = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['instituto'], $_POST['materia'], $_POST['fecha'])) {
    $idInstituto = $_POST['instituto'];
    $numeroMateria = $_POST['materia'];
    $fecha = $_POST['fecha'];

    // Consulta para obtener los alumnos de la materia seleccionada en el instituto seleccionado
    $query_alumnos = $conexion->prepare("
        SELECT a.idAlumno, a.nombre, a.apellido 
        FROM alumnos a
        JOIN alumno_materia am ON a.idAlumno = am.idAlumno
        JOIN materia_instituto mi ON am.numeroMateria = mi.numeroMateria
        WHERE mi.idInstituto = ? AND mi.numeroMateria = ?
    ");
    $query_alumnos->bind_param("ii", $idInstituto, $numeroMateria);
    $query_alumnos->execute();
    $resultado_alumnos = $query_alumnos->get_result();
}

// Procesar la asistencia al hacer clic en "Guardar Asistencia"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_asistencia'])) {
    $fecha = $_POST['fecha'];
    $numeroMateria = $_POST['materia'];

    // Verificar si ya existe asistencia para la misma fecha y materia
    $query_verificar = $conexion->prepare("
        SELECT * FROM asistencias WHERE fecha = ? AND idMateria = ?
    ");
    $query_verificar->bind_param("si", $fecha, $numeroMateria);
    $query_verificar->execute();
    $resultado_verificar = $query_verificar->get_result();

    if ($resultado_verificar->num_rows > 0) {
        // Mostrar SweetAlert si ya existe asistencia para la fecha y materia
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Asistencia ya registrada',
                    text: 'Ya existe un registro de asistencia para esta fecha. Por favor, elija otra fecha.',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'asistencia.php';
                    }
                });
            });
        </script>";
    } else {
        // Si no existe, guardar la asistencia
        foreach ($_POST['asistencia'] as $idAlumno => $asistio) {
            $query_asistencia = $conexion->prepare("
                INSERT INTO asistencias (fecha, idMateria, idAlumno) VALUES (?, ?, ?)
            ");
            $query_asistencia->bind_param("sii", $fecha, $numeroMateria, $idAlumno);
            $query_asistencia->execute();
        }

        // Mostrar mensaje de éxito y redirigir
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Asistencia guardada con éxito',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'registroAsistencia.php';
                    }
                });
            });
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<div class="asistencia-container">
    <form class="form-box" method="post" action="asistencia.php">
        <select name="instituto" required>
            <option value="">Seleccione un instituto</option>
            <?php while ($fila = $resultado_institutos->fetch_assoc()): ?>
                <option value="<?= $fila['idInstituto']; ?>">
                    <?= $fila['nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <select name="materia" required>
            <option value="">Seleccione una materia</option>
            <?php while ($fila = $resultado_materias->fetch_assoc()): ?>
                <option value="<?= $fila['numeroMateria']; ?>">
                    <?= $fila['materia']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="date" name="fecha" required>
        <button type="submit">Obtener lista de alumnos</button>
    </form>
</div>

<?php if ($resultado_alumnos && $resultado_alumnos->num_rows > 0): ?>
    <form method="post" action="asistencia.php">
        <input type="hidden" name="fecha" value="<?= htmlspecialchars($fecha); ?>">
        <input type="hidden" name="materia" value="<?= htmlspecialchars($numeroMateria); ?>">
        <h3>Lista de Alumnos</h3>
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Asistencia</th>
            </tr>
            <?php while ($alumno = $resultado_alumnos->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($alumno['nombre']); ?></td>
                    <td><?= htmlspecialchars($alumno['apellido']); ?></td>
                    <td>
                        <input type="checkbox" name="asistencia[<?= $alumno['idAlumno']; ?>]" value="1">
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <button type="submit" name="guardar_asistencia">Guardar Asistencia</button>
    </form>
<?php else: ?>
    <p>No se encontraron alumnos para la materia seleccionada.</p>
<?php endif; ?>

</body>
</html>


