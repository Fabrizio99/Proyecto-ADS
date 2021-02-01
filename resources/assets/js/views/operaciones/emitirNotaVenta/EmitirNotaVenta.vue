<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px">
            <navigation/>
            <div style="height : calc(100vh - 80px);overflow-y : scroll;" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Generar Nota de Venta
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="col-10 pl-0">
                      <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Cód. Vendedor</label>
                                    <input type="text" class="form-control" disabled :value="usuario.codigo">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Vendedor</label>
                                    <input type="text" class="form-control" disabled :value="usuario.nombre">
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Cliente</label>
                                    <input type="text" class="form-control" v-model="cliente.nombre">
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Tipo de documento</label>
                                    <select name="select" class="form-control" v-model="cliente.tipoDocumento">
                                        <option v-for="documento in documentos" :key="documento.id" :value="documento.id_documentos">{{documento.nombre}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">N°Documento</label>
                                    <input type="number" class="form-control" v-model="usuario.documento" maxlength="8">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Dirección</label>
                                    <input type="text" class="form-control" v-model="cliente.direccion">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Celular</label>
                                    <input type="number" class="form-control" v-model="cliente.celular" maxlength="9">
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card col-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col">
                                  <label for="exampleInputPassword1">N° NOTA VENTA</label>
                                    <input type="text" class="form-control" disabled value="N° XXXXX">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="exampleInputPassword1">FECHA DE EMMISIÓN</label>
                                    <input type="date" class="form-control" :value="fecha" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-4 my-3">
                  <div class="card col bg-light">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-9">
                                    <label for="exampleInputPassword1">Búsqueda de Productos</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="productoInput">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <!--<input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" data-toggle="modal" data-target="#productosModal" value="BUSCAR"/>-->
                                    <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" value="BUSCAR" @click="buscarProductos"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4">
                  <h5>Productos Solicitados</h5>
                </div>
                <div class="mx-4 mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Producto</th>
                          <th scope="col">P. Unitario</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Total</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody  v-if="listaProductos.length>0">
                        <tr v-for="(producto,index) in listaProductos" :key="index">
                          <td>{{producto.nombre}} {{producto.marca}}</td>
                          <td>S/.{{producto.precio}}</td>
                          <td>{{producto.cantidad}}</td>
                          <td>S/.{{producto.precio*producto.cantidad}}</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="deleteProduct">Eliminar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="5" style="text-align : center">No hay productos en la lista</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <div class="mx-4 mt-4">
                  
                </div>
            </div>
         </div>
         <div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog products-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resultados de Búsqueda: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body container mx-0">
                <div class="row justify-content-start" v-if="busquedaProductos.length>0">
                  <div class="col-3" v-for="(producto,index) in busquedaProductos" :key="index">
                    <div class="card">
                      <img src="https://wongfood.vteximg.com.br/arquivos/ids/290634-1000-1000/3269-1.jpg?v=636921693341270000" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{producto.nombre+' '+producto.marca+' - S/.'+producto.precio}}</h5>
                      <div class="row mx-1">
                        <!--<button class="btn btn-primary col btnexaminar"  data-toggle="modal" data-target="#detallesModal" :disabled="Number(producto.stock)==0">Detalles</button>-->
                        <button class="btn btn-primary col btnexaminar" :disabled="Number(producto.stock)==0" @click="openDetailsModal(producto)">Detalles</button>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog details-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="mx-4 mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">PRODUCTO</th>
                          <th scope="col">MARCA</th>
                          <th scope="col">CATEGORÍA</th>
                          <th scope="col">P. UNITARIO</th>
                          <th scope="col" style="width : 100px">CANTIDAD</th>
                          <th scope="col" style="width : 130px">TOTAL</th>
                        </tr>
                      </thead>
                      <tbody v-if="productoSeleccionado">
                        <tr>
                          <td>{{productoSeleccionado.nombre}}</td>
                          <td>{{productoSeleccionado.marca}}</td>
                          <td>{{productoSeleccionado.categoria}}</td>
                          <td>S/.{{productoSeleccionado.precio}}</td>
                          <td>
                            <input type="number" name="" id="" class="form-control" v-model="cantidadProductoSeleccionado" min="1" :max="productoSeleccionado.stock">
                          </td>
                          <td class = "option text-center">
                            <input type="text" name="" id="" class="form-control" :value="productoSeleccionado.precio*cantidadProductoSeleccionado" disabled>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary btnguarda-registro" @click="modalAddProduct">Agregar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ¿Desea agregar el producto?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="saveProduct">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ¿Desea eliminar el producto?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="saveProduct">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
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
        fecha      : fecha,
        documentos : [],
        cliente    : {
          nombre        : '',
          tipoDocumento : '',
          documento     : '',
          direccion     : '',
          celular       : ''
        },
        productoInput : '',
        busquedaProductos : [],
        productoSeleccionado : undefined,
        cantidadProductoSeleccionado : 1,
        listaProductos  : [],
        usuario    : {
          nombre : '',
          codigo : ''
        }
      }
    },
    methods : {
      saveProduct(){
        if(this.cantidadProductoSeleccionado<=0 || this.cantidadProductoSeleccionado>this.productoSeleccionado.stock){
          alert('Error: Seleccione una cantidad válida');
        }else{
          $('#detallesModal').modal('hide');
          $('#productosModal').modal('hide');
          this.productoSeleccionado.cantidad = this.cantidadProductoSeleccionado;
          this.listaProductos.push(this.productoSeleccionado)
        }
      },
      openDetailsModal(producto){
        this.productoSeleccionado = producto;
        $('#detallesModal').modal();
      },
      async buscarProductos(){
        let response = await axios.get('api/ProductosL?nombreP='+this.productoInput+'&token='+usuario.getData().token);
        console.log('respuesta productos ',response)
        if(typeof response.data == 'string'){
          alert('Mensaje: '+response.data)
        }else if(response.data.status != "0"){
          alert('Error: '+response.data.msj)
        }else{
          this.busquedaProductos = response.data.data;
          $('#productosModal').modal('show');
        }
      },
      async deleteProduct(){
        $('#eliminarModal').modal('show');
      },
      async modalAddProduct(){
        $('#confirmModal').modal('show');
      },
      async getTipoDocumentos(){
          let response = await axios.get('api/cmbTipoDoc?token='+usuario.getData().token);
          if(typeof response.data == 'string'){
            alert('Error: '+response.data);
          }else if(response.data.status == "0"){
            this.documentos = response.data.data;
          }else{
            alert('Error: '+response.data.msj);
          }
      }
    },
    mounted(){
      this.getTipoDocumentos();
      this.usuario.nombre = usuario.getData().nombres+' '+usuario.getData().apellidos;
      this.usuario.codigo = usuario.getData().num_documento;
    }
}
</script>
<style scoped>
.products-dialog{
  max-width: 90vw !important;
}
.details-dialog{
  max-width: 70vw !important;
}
</style>