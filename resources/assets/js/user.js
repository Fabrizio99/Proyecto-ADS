function Usuario(){}
Usuario.prototype.getData = function(){
    var result = decodeURIComponent(document.cookie);
    let results = result.split(';').filter(data=>data.includes('user'));
    return JSON.parse(results[0].split('=')[1]);
    //return JSON.parse(localStorage.getItem('user'));
}
Usuario.prototype.setData = function(data) {
    var cookie = ['user', '=', JSON.stringify(data)].join('');
    console.log(cookie)
    document.cookie = cookie;
    //localStorage.setItem('user',JSON.stringify(data));
}
let usuario = new Usuario();
export default usuario;