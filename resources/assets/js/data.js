function Data(){
    this.user       = undefined;
    this.nota_venta = undefined;
    this.producto   = undefined;
    this.boleta     = undefined;
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

Data.prototype.getSelectedProducto = function() {
    return this.producto;
}
Data.prototype.setSelectedProducto = function(producto) {
    this.producto = producto;
}

Data.prototype.getSelectedBV = function() {
    return this.boleta;
}
Data.prototype.setSelectedBV = function(boleta) {
    this.boleta = boleta;
}

let data = new Data();
export default data;

