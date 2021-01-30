<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px">
            <navigation/>
            <div style="height : calc(100vh - 80px);overflow-y : scroll;" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Boletas Emitidas
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="col-6">
                        <div class="card col bg-light">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Fecha de emisión</label>
                                        <input type="date" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group col-6 mt-2">
                                        <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" value="FILTRAR" @click="Filtrar"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card col bg-light">
                            <div class="card-body">
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-5">
                                        <label for="exampleInputPassword1">Emitir Balance de caja</label>
                                         <input type="button" class="btn btn-primary btn-block btnbuscar" value="EMITIR" data-toggle="modal" data-target="#Modal1"/>
                                    </div>

                                    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Emisión de Incidencia</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group ">
                                                        <label for="exampleInputPassword1">Emisor</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="exampleInputPassword1">Receptor</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="exampleInputPassword1">Incidencia</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" @click="Exito">GUARDAR</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  


                                    <div class="col-1">
                                                <label></label>
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="exampleInputPassword1">Generar una nota</label>
                                        <input type="button" class="btn btn-primary btn-block btnbuscar" value="GENERAR" data-toggle="modal" data-target="#Modal2"/>
                                    </div>

                                    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Balance de caja</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">Pagos en Efectivo</h4>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col">Código</th>
                                                                                    <th scope="col">Monto</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>     
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card mt-2">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col">Cantidad</th>
                                                                                    <th scope="col">Monto Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>     
                                                                                    <tr>
                                                                                    <td>4</td>
                                                                                    <td>s/. 40.0</td>
                                                                                    </tr> 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">Pagos por Yape</h4>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col">Código</th>
                                                                                    <th scope="col">Monto</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>     
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card mt-2">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col">Cantidad</th>
                                                                                    <th scope="col">Monto Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>     
                                                                                    <tr>
                                                                                    <td>4</td>
                                                                                    <td>s/. 40.0</td>
                                                                                    </tr> 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">Pagos Totales</h4>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col">Código</th>
                                                                                    <th scope="col">Monto</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>     
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                    <td>BV-001</td>
                                                                                    <td>s/. 15.0</td>
                                                                                    </tr> 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card mt-2">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col">Cantidad</th>
                                                                                    <th scope="col">Monto Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>     
                                                                                    <tr>
                                                                                    <td>4</td>
                                                                                    <td>s/. 40.0</td>
                                                                                    </tr> 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" >COMPARAR</button>
                                                </div>
                                            </div>
                                        </div>
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
                          <th scope="col">N°</th>
                          <th scope="col">Código</th>
                          <th scope="col">Nombre del Cliente</th>
                          <th scope="col">Productos</th>
                          <th scope="col">Monto</th>
                          <th scope="col">Tipo de Pago</th>
                        </tr>
                      </thead>
                      <tbody>     
                        <tr>
                          <td scope="row">1</td>
                          <td>BV-001</td>
                          <td>Alvaro De La Cruz Quispe</td>
                          <td>Harina, Chocolate</td>
                          <td>s/. 15.0</td>
                          <td>Yape</td>
                        </tr> 
                        <tr>
                          <td scope="row">1</td>
                          <td>BV-001</td>
                          <td>Alvaro De La Cruz Quispe</td>
                          <td>Harina, Chocolate</td>
                          <td>s/. 15.0</td>
                          <td>Yape</td>
                        </tr>  
                        <tr>
                          <td scope="row">1</td>
                          <td>BV-001</td>
                          <td>Alvaro De La Cruz Quispe</td>
                          <td>Harina, Chocolate</td>
                          <td>s/. 15.0</td>
                          <td>Yape</td>
                        </tr>  
                        <tr>
                          <td scope="row">1</td>
                          <td>BV-001</td>
                          <td>Alvaro De La Cruz Quispe</td>
                          <td>Harina, Chocolate</td>
                          <td>s/. 15.0</td>
                          <td>Efectivo</td>
                        </tr>
                        <tr>
                          <td scope="row">1</td>
                          <td>BV-001</td>
                          <td>Alvaro De La Cruz Quispe</td>
                          <td>Harina, Chocolate</td>
                          <td>s/. 15.0</td>
                          <td>Yape</td>
                        </tr>  
                        <tr>
                          <td scope="row">1</td>
                          <td>BV-001</td>
                          <td>Alvaro De La Cruz Quispe</td>
                          <td>Harina, Chocolate</td>
                          <td>s/. 15.0</td>
                          <td>Efectivo</td>
                        </tr> 
                        <tr>
                          <td scope="row">1</td>
                          <td>BV-001</td>
                          <td>Alvaro De La Cruz Quispe</td>
                          <td>Harina, Chocolate</td>
                          <td>s/. 15.0</td>
                          <td>Yape</td>
                        </tr>  
                        <tr>
                          <td scope="row">1</td>
                          <td>BV-001</td>
                          <td>Alvaro De La Cruz Quispe</td>
                          <td>Harina, Chocolate</td>
                          <td>s/. 15.0</td>
                          <td>Efectivo</td>
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
        Filtrar(){ this.$swal({
        icon: 'error',
        title: 'Error',
        text: 'Ingrese una fecha valida',
        });},

        Exito(){ this.$swal({
        icon: 'success',
        title: 'Registro de incidencia con éxito',
        });},
    }
}
</script>