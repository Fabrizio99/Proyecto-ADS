<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px">
            <navigation/>
            <div style="height : calc(100vh - 80px);overflow-y : scroll;" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Detalle de Nota de Venta
                    </h3>
                </div>
                <div class="row mx-4 mt-4">
                    <h5 class="col">
                        Información Personal del Cliente
                    </h5>
                </div>
                <div class="row mx-4">
                  <input type="text" class="form-control" id="exampleInputPassword1" :value="'NV-'+nota_venta.codigo" disabled>
                </div>
                <div class="row mx-4 mt-2">
                    <div class="card col bg-light">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label >Vendedor</label>
                                    <input type="text" class="form-control" v-model="nota_venta.nom_vendedor" disabled>
                                </div>
                                <div class="form-group col-6">
                                    <label >Fecha de Emisión</label>
                                    <input type="text" class="form-control"  v-model="nota_venta.fecha" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-4 mt-2">
                    <div class="card col bg-light">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label >Cliente</label>
                                    <input type="text" class="form-control"  v-model="nota_venta.nombre_cliente" :disabled="tipo == 'ver'">
                                </div>
                                <div class="form-group col-3">
                                    <label>Tipo documento</label>
                                    <select name="select"  class="form-control" v-model="nota_venta.tipoDocumento" :disabled="tipo=='ver'">
                                       <option v-for="documento in documentos" :key="documento.id" :value="documento.id_documentos">{{documento.nombre}}</option>
                                    </select>
                                
                                </div>
                                <div class="form-group col-3">
                                    <label >N° Documento</label>
                                    <input type="text" class="form-control" v-model="nota_venta.num_documento" :disabled="tipo == 'ver'">
                                </div>
                                <div class="form-group col-3">
                                    <label >Celular</label>
                                    <input type="text" class="form-control" v-model="nota_venta.telefono" :disabled="tipo == 'ver'">
                                </div>
                            </div>
                            <div class="form-row">
                               
                                <div class="form-group col-12">
                                    <label >Dirección</label>
                                    <input type="text" class="form-control" v-model="nota_venta.direccion" :disabled="tipo == 'ver'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-4 mt-4">
                    <h5 class="col">
                        Información de Productos
                    </h5>
                </div>
                <div class="mx-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Producto</th>
                          <th scope="col">Precio Unitario</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Total</th>
                          <th scope="col" v-if="tipo != 'ver'">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="usuario in listaProducto" :key="usuario.nomProducto">
                          <td scope="row">{{usuario.producto}}</td>
                          <td>S/.{{usuario.precio.toFixed(2)}}</td>
                          <td v-if="tipo == 'ver'">{{usuario.cantidad}}</td>
                          <td v-else>sandfjdsbfksds</td>
                          <td>S/.{{usuario.PrecioTotal.toFixed(2)}}</td>
                        <td scope="col" v-if="tipo != 'ver'">
                            <div class="btn btn-danger"  id="dropdownMenuButton" @click="deleteProduct(usuario.id_producto)">
                                <i class="fas fa-trash"></i>
                            </div>
                        </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>

                    <div class="row mx-4 mt-2">
                    <div class="card col bg-light pt-4"  style="width: 18rem;">
                        <div class="card-body">
                            <div class="form-row justify-content-end">
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">TOTAL</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" :value="'S/.'+nota_venta.monto_total.toFixed(2)" disabled>
                                </div>        
                          </div>
                          <div class="form-row justify-content-end">
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-info btn-block mt-4 my-1 form-group col-12 btnguarda-registro" value="Guardar cambios" data-toggle="modal" data-target="#Modal" v-if="tipo != 'ver'"/>
                                </div>
                          </div>       
                        </div>
                    </div>
                </div>         

                <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" v-if="tipo == 'ver'">Realizar pago</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <div class="form-group ">
                                    <label for="exampleInputPassword1">Esto es combobox(Efectivo / Yape)..NO OLVIDAR XD</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                                </div>
                                <div class="form-group">
                                <div class="form-group col-6">
                                    <label>Tipo de pago</label>
                                    <select name="select" class="form-control" v-model="nota_venta.num_documento">
                                        <option v-for="documento in documentos" :key="documento.id" :value="documento.id_documentos">{{documento.nombre}}</option>-->
                                    </select>
                                </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEfectivo">Efectivo</button>
                                <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#ModalYape">Yape</button>
                            </div>
                            </div> 
                        </div>
                </div>   

                <div class="modal fade" id="ModalEfectivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Realizar pago EFECTIVO</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-row">

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tipo de Pago</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" value="Efectivo" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-4">
                                        <label for="exampleInputPassword1">Monto a pagar</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" value="s/14.00" disabled>
                                    
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputPassword1">Monto recibido</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" value="s/20.00">
                                    
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputPassword1">Vuelto</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" value="s/6.00" disabled>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info my-1 btnguarda-registro" @click="RegistrarEfectivo">Registrar</button>
                            </div>
                            </div>
                        </div>
                </div>            
                      
                <div class="modal fade" id="ModalYape" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Realizar pago YAPE</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-row">

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tipo de Pago</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" value="Yape" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-4">
                                        <label for="exampleInputPassword1">Monto a pagar</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" value="s/14.00" disabled>
                                    
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputPassword1">N° Cuenta</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" value="132-1547-869">
                                    
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputPassword1">Fecha</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                                    
                                    </div>
                                </div>
                                <div class="form-row">
                                    
                                        <button type="button" class="btn btn-primary btn-block" >Adjuntar Imagen</button>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info my-1 btnguarda-registro" @click="RegistrarYape">Registrar</button>
                            </div>
                            </div>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="confirmDelete">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>

     </div>
</template>


<script>
import Appbar from '../../../components/AppBar'
import AppBar from '../../../components/AppBar.vue';
import Navigation from '../../../components/NavigationComponent';
//import Multiselect from '../../../components/Multiselect';
import data from '../../../data';
import usuario from '../../../user';


export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation,
        //'multiselect' : Multiselect
    },
    methods:{
        confirmDelete(){
            console.log(this.productoEliminar);
        this.listaProducto = this.listaProducto.filter(p=>p.id_producto!=this.productoEliminar);
        this.productoEliminar = undefined;
      },
        deleteProduct(index){
            console.log({index});
        $('#eliminarModal').modal('show');
        this.productoEliminar = index;
      },
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
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
          }
        });},

        RegistrarEfectivo(){ this.$swal({
        icon: 'error',
        title: 'Error',
        text: 'Ingrese el monto recibido',
        });},

        RegistrarYape(){ this.$swal({
        icon: 'error',
        title: 'Error',
        text: 'Complete todos los datos',
        });},

        VerDetalle(){
             this.$router.push({name:"formDetalleNV"});
        },

        async getTipoDocumentos(){
            let response = await axios.get('api/cmbTipoDoc?token='+usuario.getData().token);
            console.log('documentos',response);
            if(response.data.status == "0"){
                this.documentos = response.data.data;
            }else{
                alert('Error: ',response.data.msj);
            }
        }
       
    },
    
    data(){
        return{
            nota_venta : {
                nom_vendedor: '',
                fecha : '',
                nombre_cliente : '',
                num_documento : '',
                tipoDocumento : '',
                telefono : '',
                direccion : '',
                telefono : '',
                monto_total : 0
            },
            tipo : '',
            documentos : [],
            listaProducto :[],
            productoEliminar : undefined
        }
    },
    mounted(){
        this.getTipoDocumentos();
        console.log(data.getSelectedNV());
        let usuario = data.getSelectedNV().nota_venta;
        this.nota_venta.codigo = usuario.Codigo;
        this.nota_venta.fecha = usuario.FechaEmision;
        this.nota_venta.num_documento = usuario.N_Documento;
        this.nota_venta.nombre_cliente = usuario.Cliente;
        this.nota_venta.tipoDocumento = usuario.tipoDocumento;
        this.nota_venta.direccion = usuario.Direccion;
        this.nota_venta.telefono  = usuario.Celular;
        this.nota_venta.nom_vendedor = usuario.Vendedor;
        this.nota_venta.monto_total = Number(usuario.MontoTotal);
        this.listaProducto = JSON.parse(usuario.Productos);
        this.tipo = data.getSelectedNV().tipo;
    }
}
</script>
<style scoped>
.user-form-container{
    display: flex;
    justify-content: space-between;
}
.user-form-container .card:first-child{
    width: 65vw;
}
.user-form-container .card:last-child{
    width: 30vw;
}
.image-profile{
    max-width: 83%;
    margin: 10px auto 0;
}
.profile-button{
    height: min-content;
}

</style>