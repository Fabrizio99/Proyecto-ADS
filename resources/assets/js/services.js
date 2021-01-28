function Services(){

}
Services.prototype.get = async function(url){
    let response = await fetch(url);
    console.log(response);
    let json = await response.json();
    console.log(json);
    return json;
}


let service = new Services();
export default service;