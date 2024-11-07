<?php
require ("FUNCIONES\menu.php");
include("conexionBD.php"); // Archivo de conexión a la base de datos
session_start();

// Consulta para obtener todas las materias
$query_materias = "SELECT numeroMateria, materia FROM materias";
$resultado_materias = $conexion->query($query_materias);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Alumnos por Materia</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #00796b;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-edit {
            padding: 5px 10px;
            background-color: #00796b;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="container">
<h2>Seleccionar Materia para Listar Alumnos</h2>

<div class="form-group">
<form action="" method="GET">
    <label for="numeroMateria">Materia:</label>
    <select name="numeroMateria" id="numeroMateria" required>
        <option value="">Seleccione una materia</option>
        <?php while ($materia = $resultado_materias->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($materia['numeroMateria']) ?>">
                <?= htmlspecialchars($materia['materia']) ?>
            </option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Ver Alumnos</button>
</form>
        </div>
        </div>

<?php
// Mostrar el listado de alumnos solo si se ha seleccionado una materia
if (isset($_GET['numeroMateria'])):
    $numeroMateria = $_GET['numeroMateria'];

    // Consulta para obtener los alumnos inscritos en la materia seleccionada
    $query_alumnos = "
        SELECT a.idAlumno, a.nombre, a.apellido, a.email, a.fechaNacimiento, a.dni
        FROM alumnos a
        JOIN alumno_materia am ON a.idAlumno = am.idAlumno
        WHERE am.numeroMateria = ?
    ";
    $stmt = $conexion->prepare($query_alumnos);
    $stmt->bind_param("i", $numeroMateria);
    $stmt->execute();
    $resultado_alumnos = $stmt->get_result();
?>

<h2>Listado de Alumnos para la Materia Seleccionada</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Fecha de Nacimiento</th>
            <th>DNI</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($alumno = $resultado_alumnos->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($alumno['idAlumno']) ?></td>
                <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                <td><?= htmlspecialchars($alumno['apellido']) ?></td>
                <td><?= htmlspecialchars($alumno['email'] ?? 'No registrado') ?></td>
                <td><?= htmlspecialchars($alumno['fechaNacimiento'] ?? 'No registrado') ?></td>
                <td><?= htmlspecialchars($alumno['dni'] ?? 'No registrado') ?></td>
                <td>
                    <!-- Botón para editar datos del alumno -->
                    <a href="editar_alumno.php?id=<?= $alumno['idAlumno'] ?>" class="btn-edit">Editar Alumno</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php endif; ?>

</body>
</html>
