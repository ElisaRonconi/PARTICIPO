<?php
// Obtener instituciones
$sql_instituciones = "SELECT idInstituto, nombre FROM institutos";
$result_instituciones = $conn->query($sql_instituciones);

while ($row = $result_instituciones->fetch_assoc()) {
    echo "<option value='{$row['idInstituto']}'>{$row['nombre']}</option>";
}

// Obtener materias
$sql_materias = "SELECT numeroMateria, materia FROM materias";
$result_materias = $conn->query($sql_materias);

while ($row = $result_materias->fetch_assoc()) {
    echo "<option value='{$row['numeroMateria']}'>{$row['materia']}</option>";
}
?>
