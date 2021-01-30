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
                                    <input type="text" class="form-control" disabled value="1234">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Vendedor</label>
                                    <input type="text" class="form-control" disabled value="Fabrizio Condori">
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Cliente</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Tipo de documento</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">N°Documento</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Distrito</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Dirección</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Celular</label>
                                    <input type="tel" class="form-control">
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
                                    <input type="text" class="form-control" disabled value="N° 1234">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="exampleInputPassword1">FECHA DE EMMISIÓN</label>
                                    <input type="date" class="form-control" value="01/21/2021" disabled>
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
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" data-toggle="modal" data-target="#productosModal" value="BUSCAR"/>
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
                      <tbody>
                        <tr>
                          <td>Harina Blanca Flor</td>
                          <td>S/.2.50</td>
                          <td>1</td>
                          <td>S/2.50</td>
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
                <h5 class="modal-title" id="exampleModalLabel">Resultados de Búsqueda: Harina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body container">
                <div class="row">
                  <div class="col-3">
                    <div class="card">
                      <img src="https://wongfood.vteximg.com.br/arquivos/ids/290634-1000-1000/3269-1.jpg?v=636921693341270000" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Harina Blanca Flor 1KG - S/20.0</h5>
                      <div class="row mx-1">
                        <button class="btn btn-primary col btnexaminar"  data-toggle="modal" data-target="#detallesModal">Detalles</button>
                      </div>
                    </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="card">
                      <img src="https://wongfood.vteximg.com.br/arquivos/ids/290634-1000-1000/3269-1.jpg?v=636921693341270000" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Harina Blanca Flor 1KG - S/20.0</h5>
                      <div class="row mx-1">
                        <button class="btn btn-primary col btnexaminar"  data-toggle="modal" data-target="#detallesModal">Detalles</button>
                      </div>
                    </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="card">
                      <img src="https://wongfood.vteximg.com.br/arquivos/ids/290634-1000-1000/3269-1.jpg?v=636921693341270000" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Harina Blanca Flor 1KG - S/20.0</h5>
                      <div class="row mx-1">
                        <button class="btn btn-primary col btnexaminar"  data-toggle="modal" data-target="#detallesModal">Detalles</button>
                      </div>
                    </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="card">
                      <img src="https://wongfood.vteximg.com.br/arquivos/ids/290634-1000-1000/3269-1.jpg?v=636921693341270000" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Harina Blanca Flor 1KG - S/20.0</h5>
                      <div class="row mx-1">
                        <button class="btn btn-primary col btnexaminar"  data-toggle="modal" data-target="#detallesModal">Detalles</button>
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
                      <tbody>
                        <tr>
                          <td>Harina preparada Blanca Flor</td>
                          <td>Blanca Flor</td>
                          <td>Ingredientes, reposteria</td>
                          <td>S/. 7.00</td>
                          <td>
                            <input type="number" name="" id="" class="form-control" value="1" min="0">
                          </td>
                          <td class = "option text-center">
                            <input type="text" name="" id="" class="form-control" value="S/. 7.00" disabled>
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
      async deleteProduct(){
        const {isConfirmed} = await this.$swal({
            title: 'Advertencia',
            text: "¿Está seguro de eliminar el producto de la lista?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
          });
          
          if(isConfirmed){
            this.$swal('Eliminado!','','success');
          }
      },
      async modalAddProduct(){
        const {isConfirmed} = await this.$swal({
            title: 'Advertencia',
            text: "¿Desea agregar este producto?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Agregar'
          });
          
          if(isConfirmed){
            this.$swal({
              title : 'Agregado!',
              icon : 'success',
              allowOutsideClick : false,
              allowEscapeKey : false
            });
          }
      }
    },
    mounted(){
        $('[data-toggle="popover"]').popover()
        $('.row.mx-1').popover({
    container: 'body'
  })
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