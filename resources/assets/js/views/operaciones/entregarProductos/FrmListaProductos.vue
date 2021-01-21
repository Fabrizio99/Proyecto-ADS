<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px">
            <navigation/>
            <div style="height : calc(100vh - 80px);overflow-y : scroll;" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Lista de Productos de la Boleta del Cliente
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="card col bg-light">
                        <div class="card-body">
                            <div class="form-row justify-content-center">
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Cliente</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Estado de Boleta</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4" value="MODIFICAR" @click="Modificar" data-toggle="modal" data-target="#Modal"/>
                                    <input type="button" class="btn btn-danger btn-block mt-4" value="REGRESAR" @click="Regresar"/>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4 mt-4">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Foto</th>
                          <th scope="col">Código</th>
                          <th scope="col">Nombre del Producto</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg" @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">imagen</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-info"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-check-circle fa-lg"  @click="Listo"></i> 
                              </div>
                          </div>
                          </td>
                        </tr>     


                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cambiar estado de boleta</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <div class="form-group ">
                                    <label for="exampleInputPassword1">Esto es combobox..NO OLVIDAR XD</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="CambiarEstado">Cambiar</button>
                            </div>
                            </div>
                        </div>
                        </div>

                                                                                  
                      </tbody>
                    </table>
                </div>
            </div>
         </div>
     </div>
</template>


<script>
import Appbar from '../../../components/AppBar'
import AppBar from '../../../components/AppBar.vue';
import Navigation from '../../../components/NavigationComponent';
export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    methods:{
       Buscar(){ this.$swal({
        icon: 'error',
        title: 'Error',
        text: 'No hay resultados',
        });},

        Regresar(){
             this.$router.push({name:"formBolProd"});
        },

        CambiarEstado(){ this.$swal({
        icon: 'success',
        title: 'Éxito',
        text: 'Modificación exitosa',
        });},

        Listo(){
           
        }
       
    }
}
</script>