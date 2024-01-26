 
function convertirAFormatoISO(fechaEnFormatoEstandar) {
    // Crear un objeto de fecha a partir de la cadena proporcionada
    var fechaObjeto = new Date(fechaEnFormatoEstandar);

    // Verificar si la fecha es válida
    if (isNaN(fechaObjeto.getTime())) {
        console.error('Fecha no válida:', fechaEnFormatoEstandar);
        return null;
    }

    // Obtener la fecha en formato ISO 8601
    var fechaISO = fechaObjeto.toISOString();

    return fechaISO;
}

// Ejemplo de uso
//var fechaEstandar = "Sun Jan 14 2024 16:00:00 GMT-0800 (hora estándar del Pacífico)";
//var fechaISO = convertirAFormatoISO(fechaEstandar);
//console.log('Fecha en formato ISO:', fechaISO);
//Fecha en formato ISO: 2024-01-15T00:00:00.000Z
 