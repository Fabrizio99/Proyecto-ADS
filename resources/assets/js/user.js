function Usuario(){}
Usuario.prototype.getData = function(){
    var result = decodeURIComponent(document.cookie);
    let results = result.split(';').filter(data=>data.includes('user'));
    if(results.length == 0){
        return undefined;
    }
    let data = results[0].split('=')[1];
    return data == ''?undefined:JSON.parse(results[0].split('=')[1]);
}
Usuario.prototype.setData = function(data) {
    var cookie = ['user', '=', JSON.stringify(data)].join('');
    document.cookie = cookie;
}
let usuario = new Usuario();
export default usuario;