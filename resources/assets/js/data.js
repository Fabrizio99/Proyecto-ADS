function Data(){
    this.user = undefined;
}
Data.prototype.getSelectedUser = function() {
    return this.user;
}
Data.prototype.setSelectedUser = function(user) {
    this.user = user;
}

let data = new Data();
export default data;