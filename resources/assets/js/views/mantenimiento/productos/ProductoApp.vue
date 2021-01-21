<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">
                <div class="row mx-4">
                    <h3 class="form-group col-3">
                        Lista de productos
                    </h3>
                    <button type="button" class="btn btn-info my-1 form-group col-3 btncrear" @click="formCrearProducto">Crear producto</button>
                    <h3 class="form-group col-6"></h3>
                </div>
                <div class="row mx-4">
                    <div class="card col cardbuscador">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-9">
                                    <label for="exampleInputPassword1">Nombre del producto</label>
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
                    <table class="table table-hover">
                      <thead class="headtable">
                        <tr>
                          <th scope="col">Foto</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Marca</th>
                          <th scope="col">Precio</th>
                          <th scope="col">Stock</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td scope="row"><img src="images/GestionProductos/azucar.jpg"  width="40" height="40"></td>
                          <td>Azucar rubia</td>
                          <td>Bell's</td>
                          <td>S/.14.30</td>
                          <td>15</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="formModificarProducto">Modificar</a>
                                <a class="dropdown-item" @click="formComprobacionEliminar">Eliminar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td scope="row"><img src="images/GestionProductos/leche.jpg"  width="40" height="40"></td>
                          <td>Leche</td>
                          <td>Gloria</td>
                          <td>S/.3.50</td>
                          <td>30</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="formModificarProducto">Modificar</a>
                                <a class="dropdown-item" @click="formComprobacionEliminar">Eliminar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td scope="row"><img src="images/GestionProductos/harina.jpg"  width="40" height="40"></td>
                          <td>Harina</td>
                          <td>Blanca Flor</td>
                          <td>S/.4.90</td>
                          <td>20</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="formModificarProducto">Modificar</a>
                                <a class="dropdown-item" @click="formComprobacionEliminar">Eliminar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td scope="row"><img src="images/GestionProductos/mantequilla.jpg"  width="40" height="40"></td>
                          <td>Mantequilla</td>
                          <td>Gloria</td>
                          <td>S/.13.00</td>
                          <td>18</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="formModificarProducto">Modificar</a>
                                <a class="dropdown-item" @click="formComprobacionEliminar">Eliminar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <div class="form-group col-6 mt-3">
                    <button type="button" class="btn btn-info my-1 btnatras" @click="openMain">Atrás</button>
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
    methods : {
        openMain(){
            this.$router.push({name:"main"});
        },
        formCrearProducto(){
            this.$router.push({name:"crearproductos"});
        },
        formModificarProducto(){
            this.$router.push({name:"modificarproductos"});
        },
        formComprobacionEliminar(){
            this.$swal({
            title: '¿Desea eliminar producto?',
            showDenyButton: true,
            confirmButtonText: `Aceptar`,
            confirmButtonColor: '#0AB70A',
            denyButtonText: `Cancelar`,
            
          }).then((result) => {
  
          if (result.isConfirmed) {
          this.$swal('PRODUCTO ELIMINADO EXITOSAMENTE', '', 'success')
          }
          });
        },
        msjError(){
            this.$swal({
            icon: 'error',
            title: 'Se ha detectado un acceso incorrecto',
            confirmButtonColor: 'red',
            confirmButtonText: 'Cerrar'
          });
        }
  }
}
</script>