/*<script>
function calcularCondicion() {
    // Aquí puedes iterar sobre las filas de la tabla y calcular condiciones, por ejemplo:
    let rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => {
        let parcial1 = row.querySelector("input[name*='[parcial1]']").value || 0;
        let parcial2 = row.querySelector("input[name*='[parcial2]']").value || 0;
        let final = row.querySelector("input[name*='[final]']").value || 0;
        
        let promedio = (parseFloat(parcial1) + parseFloat(parcial2) + parseFloat(final)) / 3;
        let condicion = promedio >= 6 ? "Aprobado" : "Desaprobado";
        
        alert(`Alumno: ${row.cells[0].innerText}\nCondición: ${condicion}`);
    });
}
</script>*/
