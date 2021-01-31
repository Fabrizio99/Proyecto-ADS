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
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Marca</th>
                          <th scope="col">Precio</th>
                          <th scope="col">Stock</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(producto,index) in listaProductos" :key="producto.id_producto">
                          <td scope="row">{{index+1}}</td>
                          <td>{{producto.nombre}}</td>
                          <td>{{producto.marka}}</td>
                          <td>S/. {{producto.precio}}</td>
                          <td>{{producto.stock}}</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <button class="btn btn-danger dropdown-toggle dropdown-toggle-split " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="formModificarProducto">Modificar</a>
                                <a class="dropdown-item" @click="openDeleteModal(producto.id_producto)">Eliminar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--modal para eliminar producto-->
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
                ¿Desea eliminar producto?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="deleteProduct">Aceptar</button>
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
import usuario from '../../../user';

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    data(){
      return{
        listaProductos : [],
        productSelected  : ''
      }
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
        openDeleteModal(documento){
          this.productSelected = documento;
          $('#deleteModal').modal('show');
        },
        msjError(){
            this.$swal({
            icon: 'error',
            title: 'Se ha detectado un acceso incorrecto',
            confirmButtonColor: 'red',
            confirmButtonText: 'Cerrar'
          });
        },
        async getProductos(){
          let response = await axios.get('api/listProduct?token='+usuario.getData().token);
          console.log(response);
          if(response.data.status == "0"){
              this.listaProductos = response.data.data;
          }else{
              alert('Error: '+response.data.msj);
          }
        },
        async deleteProduct(){
          const body = {
            idP : this.productSelected,
            token : usuario.getData().token
          }
          let response = await axios.post('api/deleteP',body);
          console.log(response);
          if(response.data.status == "0"){
            alert('Mensaje: '+'Producto eliminado exitosamente');
            this.getProductos();
          }else{
            alert('Error: '+response.data.msj);
          }
        }
    },
    mounted(){
      console.log('mounted!!!');
      this.getProductos();
    }
}
</script>