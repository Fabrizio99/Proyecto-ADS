<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px">
            <navigation/>
            <div style="height : calc(100vh - 80px);overflow-y : scroll;" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Notas de Ventas
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="card col bg-light">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Código</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Fecha Inicio</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Fecha Final</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" value="BUSCAR" @click="Buscar"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4 mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">N°</th>
                          <th scope="col">Código</th>
                          <th scope="col">Nombre del Cliente</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Monto</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>     
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
                              </div>
                          </div>
                          </td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>s/soles</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="VerDetalle">Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
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
        
        anularNV(){this.$swal({

          title: 'Estás seguro?',
          text: "No serás capaz de revertirlo!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, Anular!',
          cancelButtonText: 'No, Cancelar!',
          reverseButtons: true
          }).then((result) => {
          if (result.isConfirmed) {
            this.$swal('Nota de Venta Anulada', '', 'success')
          }
        });},

        VerDetalle(){
             this.$router.push({name:"formDetalleNV"});
        }
       
    }
}
</script>