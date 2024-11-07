<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];

    try {
        // Preparar la consulta para insertar el instituto
        $query = $conexion->prepare("INSERT INTO institutos (nombre, direccion) VALUES (?, ?)");
        $query->bind_param("ss", $nombre, $direccion);
        
        // Ejecutar la consulta
        if ($query->execute()) {
            // Incluir la biblioteca de SweetAlert
            
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Instituto creado con éxito",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "listado_institutos.php";
                });
                </script>';
        } else {
            echo "Error al dar de alta el instituto: " . $query->error;
        }

    } catch (Exception $e) {
        echo "Error al dar de alta el instituto: " . $e->getMessage();
    }
}
?>
