function limitMonday() {
    var inputFecha = document.getElementById('f_inicial');
    var fechaSeleccionada = new Date(inputFecha.value);
    console.log(fechaSeleccionada);
    // Verificar si la fecha seleccionada es un domingo (día de la semana 0)
    if (fechaSeleccionada.getDay() !== 5) {
        alert('Por favor, selecciona un Lunes.');
        // Puedes restablecer la fecha a la última fecha de domingo disponible
        var ultimoLunes = new Date(fechaSeleccionada);
        ultimoLunes.setDate(fechaSeleccionada.getDate() - fechaSeleccionada.getDay());
        inputFecha.value = ultimoLunes.toISOString().split('T')[0];
    }
}
