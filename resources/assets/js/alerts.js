/*PLANTILLA DE ALERTAS*/

export const showErrorMessage = (_this,message)=> {
    return _this.$swal({
        icon: 'error',
        title: 'Error',
        text: message || 'Ocurrió un error',
    });
};
export const showSuccessMessage = (_this,message)=> {
    return _this.$swal({
        icon: 'success',
        title: 'Aviso',
        text: message,
    });
};
export const showCreateMessage = (_this,message)=> {
    return _this.$swal({
        icon: 'success',
        title: 'Aviso',
        text: message || 'Creado correctamente',
    });
};
export const showEditMessage = (_this,message)=> {
    return _this.$swal({
        icon: 'success',
        title: 'Aviso',
        text: message || 'Editado correctamente',
    });
};

export const showQuestionAlert = (_this,message,confirmButton)=>{
    return _this.$swal({
        title: 'Advertencia',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText : 'Cancelar',
        confirmButtonText: confirmButton
      });
}