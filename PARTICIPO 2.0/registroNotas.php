<?php
require("FUNCIONES\menu.php");
include("conexionBD.php");

// Obtener la lista de materias
$materias = $conexion->query("SELECT * FROM materias");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numeroMateria'])) {
    $numeroMateria = $_GET['numeroMateria'];

    // Obtener los alumnos y notas de la materia seleccionada
    $query = "
        SELECT a.idAlumno, a.nombre, a.apellido, n.parcial1, n.parcial2, n.trabajoFinal
        FROM alumnos a
        LEFT JOIN notas n ON a.idAlumno = n.idAlumno AND n.idMateria = ?
        JOIN alumno_materia am ON a.idAlumno = am.idAlumno
        WHERE am.numeroMateria = ?
    ";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $numeroMateria, $numeroMateria);
    $stmt->execute();
    $resultado_alumnos = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro de Notas</title>
    <style>
        /* Estilos de la tabla */
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
    <h2>Filtrar por Materia para Ver y Editar Notas</h2>

    <!-- Selección de materia -->
    <form action="" method="GET">
        <label for="numeroMateria">Materia:</label>
        <select name="numeroMateria" id="numeroMateria" required>
            <option value="">Seleccione una materia</option>
            <?php while ($materia = $materias->fetch_assoc()): ?>
                <option value="<?= htmlspecialchars($materia['numeroMateria']) ?>"
                    <?= isset($numeroMateria) && $numeroMateria == $materia['numeroMateria'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($materia['materia']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Filtrar</button>
    </form>
</div>

<?php if (isset($resultado_alumnos) && $resultado_alumnos->num_rows > 0): ?>
    <form method="POST" action="guardar_notas.php">
        <input type="hidden" name="numeroMateria" value="<?= htmlspecialchars($numeroMateria) ?>">
        
        <table>
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Parcial 1</th>
                    <th>Parcial 2</th>
                    <th>Trabajo Final</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($alumno = $resultado_alumnos->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']) ?></td>
                        <td><input type="number" name="notas[<?= $alumno['idAlumno'] ?>][parcial1]" min="0" max="10" value="<?= htmlspecialchars($alumno['parcial1'] ?? '') ?>"></td>
                        <td><input type="number" name="notas[<?= $alumno['idAlumno'] ?>][parcial2]" min="0" max="10" value="<?= htmlspecialchars($alumno['parcial2'] ?? '') ?>"></td>
                        <td><input type="number" name="notas[<?= $alumno['idAlumno'] ?>][trabajoFinal]" min="0" max="10" value="<?= htmlspecialchars($alumno['trabajoFinal'] ?? '') ?>"></td>
                        <td><button type="submit" class="btn-edit">Guardar Cambios</button></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </form>
<?php else: ?>
    <p>Seleccione una materia para ver los alumnos.</p>
<?php endif; ?>
</body>
</html>
