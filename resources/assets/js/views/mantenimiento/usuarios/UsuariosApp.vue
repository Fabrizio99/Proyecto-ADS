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
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" value="BUSCAR"/>
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
                        <tr>
                          <td scope="row">1</td>
                          <td>Ricardo</td>
                          <td>Chavez Vilcapoma</td>
                          <td>Cajero</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="openFormUser">Editar</a>
                                <a class="dropdown-item" @click="deleteUser">Eliminar</a>
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
    methods : {
        openFormUser(){
          this.$router.push({name:"formUser"});
        },
        async deleteUser(){
          const {isConfirmed} = await this.$swal({
            title: 'Advertencia',
            text: "¿Está seguro de eliminar al usuario?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
          });
          
          if(isConfirmed){
            this.$swal('Eliminado!','','success');
          }
        }
    }
}
</script>