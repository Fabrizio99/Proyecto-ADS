<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">
                <div class="row mx-4 mb-1">
                    <h3 class="col">
                        Gestión de Usuarios
                    </h3>
                    <button type="button" class="btn btn-info my-1 col-1 btncrear" @click="openFormUser">Crear</button>
                </div>
                <div class="row mx-4">
                    <div class="card col">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-9">
                                    <label for="exampleInputPassword1">Nombre del usuario</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="userInput">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" value="BUSCAR" @click="searchUser"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4 mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombres</th>
                          <th scope="col">Apellidos</th>
                          <th scope="col">Documento</th>
                          <th scope="col">Rol</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(usuario,index) in listaUsuarios" :key="usuario.num_documento">
                          <td scope="row">{{index+1}}</td>
                          <td>{{usuario.nombres}}</td>
                          <td>{{usuario.apellido}}</td>
                          <td>{{usuario.nombre}}</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="openFormUser">Editar</a>
                                <a class="dropdown-item" @click="deleteUser(usuario.num_documento)">Eliminar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
         </div>
    </div>
</template>
<script>
import Appbar from '../../../components/AppBar'
import Navigation from '../../../components/NavigationComponent';


export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    data(){
      return{
        listaUsuarios : [],
        userInput     : ''
      }
    },
    methods : {
      async searchUser(){
        if(this.userInput.trim() != ''){
          let response = await axios.get('api/getBuscarUsuario?nombre='+this.userInput.trim());
          this.userInput = '';
          if(response.data.status == "0"){
            if(response.data.data.length == 0){
              Alert.showErrorMessage(this,'No se encuentra el usuario');
            }else{
              this.listaUsuarios = response.data.data;
            }
          }else{
            Alert.showErrorMessage(this,response.data.msj);
          }
        }
      },
      openFormUser(){
        this.$router.push({name:"formUser"});
      },
      async deleteUser(documento){
        const alertaResponse = await Alert.showQuestionAlert(this,'¿Desea eliminar usuario?','Aceptar');
        if(alertaResponse.isConfirmed){
          const body = {
            numDoc : documento
          }
          let response = await axios.post('api/deleteUsuario',body);

          if(response.data.status == "0"){
            console.log('llego aquiiiii');
            Alert.showSuccessMessage(this,'Usuario eliminado exitosamente');
            this.getUsers();
          }else{
            Alert.showErrorMessage(this,response.data.msj);
          }
        }
        
        /*if(isConfirmed){
          this.$swal('Eliminado!','','success');
        }*/
      },
      async getUsers(){
        console.log('se hizo peticion de usuarios/');
        let response = await axios.get('api/listaUsuario');
        if(response.data.status == "0"){
          //todo bien
          this.listaUsuarios = response.data.data;
        }else{
          Alerts.showErrorMessage(this,response.data.msj)
        }
      }
    },
    mounted(){
      console.log('mounted!!!');
      this.getUsers();
    }
}
</script>