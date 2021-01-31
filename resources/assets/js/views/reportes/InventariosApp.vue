<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">     
                    <div class="row mx-4">
                        <h3 class="col">
                            Emitir reporte de inventario
                        </h3>
                    </div>
                    <div class="row mx-4">
                        <div class="col-6">
                            <label></label>
                        </div>
                    </div>
                    <div class="row mx-4">
                        <div class="col-5">
                            <label for="fechainventario">Del día:</label>
                            <input type="date" class="form-control" id="fechainventario" v-model="selectedDate" @change="ListSearchDate(selectedDate)">
                            
                        </div>
                        <div class="col-1">
                            <label></label>
                        </div>
                        <div class="col-6">
                            <div class="card col-12">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-1">
                                                <label></label>
                                            </div>
                                            <div class="col-5">
                                                <label>Costo de inventario</label>
                                            </div>
                                            <div class="col-1">
                                                <label></label>
                                            </div>
                                            <div class="col-5">
                                                <label>Cantidad de productos</label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-1">
                                                <label @change="totalProductCosto"></label>
                                            </div>
                                            <div class="col-5" >
                                                <label></label>
                                            </div>
                                            <div class="col-1">
                                                <label></label>
                                            </div>
                                            <div class="col-5">
                                                <label>1.506</label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-4">
                        <div class="col-6">
                            <label></label>
                        </div>
                    </div>
                    <div class="row mx-4">
                        <div class="col-6">
                            <label></label>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-info my-1 form-group col-12" data-bs-toggle="modal" data-bs-target="#b">Balance</button>
                            <!-- Modal -->
                            <div class="modal fade" id="b" tabindex="-1" aria-labelledby="bl" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bl">Gráfico de Barras de los Productos Vendidos Día</h5>
                                        <img src="images/GestionProductos/cerrar.jpg" data-bs-dismiss="modal" width="40" height="40">
                                    </div>
                                    <div class="modal-body">
                                        <div class="mx-4 mt-4">
                                            <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col">Cantidad consumida</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td>1</td>
                                                <td>Azucar rubia</td>
                                                <td><img src="images/GestionProductos/azucar.jpg"  width="40" height="40"></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>20</td>
                                                </tr>
                                                <tr>
                                                <td>2</td>
                                                <td>Harina</td>
                                                <td><img src="images/GestionProductos/harina.jpg"  width="40" height="40"></td>
                                                 <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>15</td>
                                                </tr>
                                                <tr>
                                                <td>3</td>
                                                <td>Mantequilla</td>
                                                <td><img src="images/GestionProductos/mantequilla.jpg"  width="40" height="40"></td>
                                                 <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>30</td>
                                                </tr>
                                                <tr>
                                                <td>4</td>
                                                <td>Leche Gloria</td>
                                                <td><img src="images/GestionProductos/leche.jpg"  width="40" height="40"></td>
                                                 <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>12</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>


                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-info my-1 form-group col-12" >Emitir reporte</button>
                        </div> 
                    </div>
                    <div class="row mx-4">
                        <div class="col-12">
                            <div class="mx-4 mt-4">
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Descripción del producto</th>
                                    <th scope="col">Precio de venta</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(producto) in listaProductos" :key="producto.id_producto">
                                        <td scope="row">{{producto.id_producto}}</td>
                                        <td>{{producto.nombre}}</td>
                                        <td>{{producto.precio}}</td>
                                        <td>{{producto.stock}}</td>
                                        <td>{{producto.estado}}</td>
                                    </tr>
                                   
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
            </div>
        </div>
    </div>
</template>
<script>
import Appbar from '../../components/AppBar'
import AppBar from '../../components/AppBar.vue';
import Navigation from '../../components/NavigationComponent';
import moment from 'moment';
import usuario from '../../user';

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    data(){
        return {
            selectedDate : moment().format('yyy-MM-DD'),
            listaProductos: [],
            costInv: [],
            cantProd: '',
        }
    },
    methods : {
        msjerrorfecha(){
            this.$swal({
            title: 'Colocar la fecha actual',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            });
        },
        async ListSearchDate(fechaInv){
          this.selectedDate = fechaInv;
          let response = await axios.get('api/getEmitirRI?fecha='+this.selectedDate+'&token='+usuario.getData().token);
          console.log(response);
            if(response.data.status == "0"){
                this.listaProductos = response.data.data;
            }else{
                alert('Error: '+response.data.msj);
            }
        },
        async totalProductCosto(){
          
          let response = await axios.get('api/totalProdCosto?token='+usuario.getData().token);
          console.log('respuesta ',response);
          
        },
    },
    mounted(){
      console.log('mounted!!!');
      this.ListSearchDate(this.selectedDate);
    }
}
</script>