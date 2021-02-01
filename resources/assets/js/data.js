function Data(){
    this.user = undefined;
    this.nota_venta = undefined;
}
Data.prototype.getSelectedUser = function() {
    return this.user;
}
Data.prototype.setSelectedUser = function(user) {
    this.user = user;
}

Data.prototype.getSelectedNV = function() {
    return this.nota_venta;
}
Data.prototype.setSelectedNV = function(nota_venta) {
    this.nota_venta = nota_venta;
}

let data = new Data();
export default data;

