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
                    <button type="button" class="btn btn-info my-1 col-1 btncrear" @click="openCreateUser">Crear</button>
                </div>
                <div class="row mx-4">
                    <div class="card col">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-9">
                                    <label for="exampleInputPassword1">Nombre del usuario</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="userInput">
                                </div>
                                <div class="form-group col-3 mt-2 row">
                                    <div class="col-10">
                                      <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" value="BUSCAR" @click="searchUser"/>
                                    </div>
                                    <div class="col-2">
                                      <input type="button" class="btn btn-danger btn-block mt-4 btnbuscar" value="X" @click="getUsers"/>
                                    </div>
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
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(usuario,index) in listaUsuarios" :key="usuario.num_documento">
                          <td scope="row">{{index+1}}</td>
                          <td>{{usuario.nombres}}</td>
                          <td>{{usuario.apellidos}}</td>
                          <td>{{usuario.num_documento}}</td>
                          <td>{{usuario.Cargo}}</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="openEditUser(usuario)">Editar</a>
                                <a class="dropdown-item" @click="openDeleteModal(usuario.num_documento)">Eliminar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
         </div>

        <!--modal para eliminar usuario-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ¿Desea eliminar usuario?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="deleteUser">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal eliminar-->
    </div>
</template>
<script>
import Appbar from '../../../components/AppBar'
import Navigation from '../../../components/NavigationComponent';
import data from '../../../data';
import usuario from '../../../user';


export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    data(){
      return{
        listaUsuarios : [],
        userInput     : '',
        userSelected  : ''
      }
    },
    methods : {
      async searchUser(){
        if(this.userInput.trim() != ''){
          let response = await axios.get('api/getBuscarUsuario?cmpbusqueda='+this.userInput.trim()+'&token='+usuario.getData().token);
          this.userInput = '';
          if(response.data.status == "0"){
            this.listaUsuarios = Array.isArray(response.data.data)?response.data.data:[response.data.data];
            if(this.listaUsuarios.length == 0){
              alert('Error: No se encuentra el usuario');
            }
          }else{
            this.listaUsuarios = [];
            alert('Error: '+response.data.msj);
          }
        }
      },
      openCreateUser(){
        this.$router.push({path:'formulario-usuario/crear'});
      },
      openEditUser(user){
        data.setSelectedUser(user);
        this.$router.push({path:'formulario-usuario/editar'});
      },
      openDeleteModal(documento){
        this.userSelected = documento;
        $('#deleteModal').modal('show');
      },
      async deleteUser(){
        const body = {
          numDoc : this.userSelected,
          token : usuario.getData().token
        }
        let response = await axios.post('api/deleteUsuario',body);
        console.log(response);
        if(response.data.status == "0"){
          alert('Mensaje: '+'Usuario eliminado exitosamente');
          this.getUsers();
        }else{
          alert('Error: '+response.data.msj);
        }
      },
      async getUsers(){
        this.userInput = '';
        let response = await axios.get('api/listaUsuario?token='+usuario.getData().token);
        if(response.data.status == "0"){
          //todo bien
          this.listaUsuarios = response.data.data;
        }else{
          alert('Error: '+response.data.msj);
        }
      }
    },
    mounted(){
      this.getUsers();
    }
}
</script>