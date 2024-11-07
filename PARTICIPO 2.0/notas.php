<?php
// Conexión a la base de datos
include("conexionBD.php");
require("FUNCIONES\menu.php");

// Obtener la lista de materias
$materias = $conexion->query("SELECT * FROM materias");

$alumnos = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['materia'])) {
    $numeroMateria = $_POST['materia'];

    // Asegúrate de que estás obteniendo los alumnos que están inscritos en esta materia
    $consultaAlumnos = "SELECT a.* 
                        FROM alumnos AS a
                        JOIN alumno_materia AS am ON a.idAlumno = am.idAlumno
                        WHERE am.numeroMateria = ?";
    $stmt = $conexion->prepare($consultaAlumnos);
    $stmt->bind_param("i", $numeroMateria);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Guardar el resultado en la variable $alumnos solo si la consulta fue exitosa
    if ($resultado) {
        $alumnos = $resultado;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
</head>
<body>

<div class="container-group">
    <h2>Ingreso de Notas</h2>

    <!-- Seleccionar materia -->
    <form method="POST" action="notas.php">
        <label for="materia">Seleccione una materia:</label>
        <select name="materia" onchange="this.form.submit()">
            <option value="">--Seleccionar--</option>
            <?php while ($materia = $materias->fetch_assoc()): ?>
                <option value="<?= $materia['numeroMateria'] ?>" <?= isset($numeroMateria) && $numeroMateria == $materia['numeroMateria'] ? 'selected' : '' ?>>
                    <?= $materia['materia'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php if (isset($alumnos) && $alumnos->num_rows > 0): ?>
        <form method="POST" action="guardar_notas.php">
            <input type="hidden" name="materia" value="<?= $numeroMateria ?>">

            <table>
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Parcial 1</th>
                        <th>Parcial 2</th>
                        <th>Trabajo Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($alumno = $alumnos->fetch_assoc()): ?>
                        <tr>
                            <td><?= $alumno['nombre'] . ' ' . $alumno['apellido'] ?></td>
                            <td><input type="number" name="notas[<?= $alumno['idAlumno'] ?>][parcial1]" min="0" max="10" placeholder="Nota"></td>
                            <td><input type="number" name="notas[<?= $alumno['idAlumno'] ?>][parcial2]" min="0" max="10" placeholder="Nota"></td>
                            <td><input type="number" name="notas[<?= $alumno['idAlumno'] ?>][final]" min="0" max="10" placeholder="Nota"></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <button type="submit" name="guardar">Guardar notas</button>
            <button type="button" onclick="calcularCondicion()">Calcular Condición</button>
        </form>
    <?php else: ?>
        <p>No hay alumnos registrados para esta materia o no se ha seleccionado ninguna materia.</p>
    <?php endif; ?>
</div>
</body>
</html>
