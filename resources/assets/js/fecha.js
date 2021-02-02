function getDiaActual() {
    let fecha = new Date();
    let mes  = (fecha.getMonth() + 1).toString();
    let dia  = fecha.getDate().toString();
    let anio = fecha.getFullYear().toString();

    (mes.length<2) && (mes = '0' + mes);
    (dia.length<2) && (dia = '0' + dia);

    return [anio,mes,dia].join('-');
}

let fechaActual = getDiaActual();
export default fechaActual;