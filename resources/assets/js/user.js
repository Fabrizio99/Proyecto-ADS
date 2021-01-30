function Usuario(){}
Usuario.prototype.getData = function(){
    var result = decodeURIComponent(document.cookie);
    console.log(result);
    let results = result.split(';').filter(data=>data.includes('user'));
    return JSON.parse(results[0].split('=')[1]);
}
Usuario.prototype.setData = function(data) {
    var cookie = ['user', '=', JSON.stringify(data)].join('');
    document.cookie = cookie;
}
let usuario = new Usuario();
export default usuario;