function Usuario(){}
Usuario.prototype.getData = function(){
    return JSON.parse(localStorage.getItem('user'));
}
Usuario.prototype.setData = function(data) {
    localStorage.setItem('user',JSON.stringify(data));
}
let usuario = new Usuario();
export default usuario;