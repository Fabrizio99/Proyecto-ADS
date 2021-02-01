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
                  <input type="text" class="form-control" id="exampleInputPassword1" value="NV-004" disabled>
                </div>
                <div class="row mx-4 mt-2">
                    <div class="card col bg-light">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Vendedor</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="nota_venta.nom_vendedor" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">Fecha de Emisión</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"  v-model="nota_venta.fecha" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleInputPassword1">IMAGEN RUC</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" value="imagen RUC NOTA DE VENTA" disabled/>
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
                                    <label for="exampleInputPassword1">Cliente</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"  v-model="nota_venta.nombre_cliente" disabled>
                                </div>
                                <div class="form-group col-3">
                                    <!--<label>Tipo documento</label>
                                    <select name="select" v-model="user.tipoDocumento" class="form-control">
                                        <option v-for="documento in documentos" :key="documento.id" :value="documento.id_documentos">{{documento.nombre}}</option>
                                    </select>-->
                                
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">N° Documento</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="nota_venta.num_documento" disabled>
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Celular</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="nota_venta.telefono" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                               <div class="form-group col-3">
                                <multiselect
                                    :colSize="13"
                                    label = "Distrito"
                                    :optionList = "[
                                        {
                                            id   : 1,
                                            name : 'MIRAFLORES'
                                        },
                                        {
                                            id   : 2,
                                            name : 'SAN ISIDRO'
                                        },
                                    ]"
                                />
                                </div>
                                <div class="form-group col-9">
                                    <label for="exampleInputPassword1">Dirección</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="nota_venta.direccion" disabled>
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
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
                        </tr>     
                       <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
                        </tr>   
                        <tr>
                          <td scope="row">1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>s/soles</td>
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
                                    <input type="text" class="form-control" id="exampleInputPassword1" value="S/.14.00" disabled>
                                </div>
                                      
                          </div>    
                          <div class="form-row justify-content-end">
                                          
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-info btn-block mt-4 my-1 form-group col-12 btnguarda-registro" value="Registrar Pago" data-toggle="modal" data-target="#Modal"/>
                                </div>                       
                          </div>       
                        </div>
                    </div>
                </div>         

                <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Realizar pago</h5>

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
                                <multiselect
                                    :colSize="13"
                                    label = "Tipo de Pago"
                                    :optionList = "[
                                        {
                                            id   : 1,
                                            name : 'EFECTIVO'
                                        },
                                        {
                                            id   : 2,
                                            name : 'YAPE'
                                        },
                                    ]"
                                />
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
                telefono : ''    
            },
            documentos : []
        }
    },
    mounted(){
        this.getTipoDocumentos();
        console.log(data.getSelectedNV());
        let usuario = data.getSelectedNV();
        this.nota_venta.fecha = usuario.fecha;
        this.nota_venta.num_documento = usuario.numdocumento_cliente;
        this.nota_venta.nombre_cliente = usuario.nombre_cliente;
        this.nota_venta.tipoDocumento = usuario.id_documentos;
        this.nota_venta.direccion = usuario.direccion_cliente;
        this.nota_venta.telefono  = usuario.telefono_cliente;
        this.nota_venta.nom_vendedor = usuario.id_rol;

        
    }
}
</script>
<style 
        Multiselectscoped>
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