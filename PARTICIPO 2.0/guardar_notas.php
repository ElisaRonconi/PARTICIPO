<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    
<?php
// Conexión a la base de datos
include("conexionBD.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['materia']) && isset($_POST['notas'])) {
    $idMateria = $_POST['materia'];  
    $notas = $_POST['notas'];

    // Preparar la consulta para insertar o actualizar las notas
    $stmt = $conexion->prepare("INSERT INTO notas (calificacion, idAlumno, idMateria) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE calificacion = VALUES(calificacion)");

    foreach ($notas as $idAlumno => $notasAlumno) {
        foreach ($notasAlumno as $tipoExamen => $calificacion) {
            if ($calificacion !== '') { // Solo guardamos si hay una nota
                $stmt->bind_param("dii", $calificacion, $idAlumno, $idMateria);
                $stmt->execute();
            }
        }
    }

    $stmt->close();
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Notas guardadas con éxito',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'registroNotas.php';
            }
        });
    });
</script>";
    
} else {
    echo "Datos incompletos o inválidos.";
}

// Cerrar la conexión
$conexion->close();
?>
</body>
</html>