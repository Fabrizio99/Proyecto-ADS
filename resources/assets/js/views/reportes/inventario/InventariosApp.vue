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
                        <div class="col-10">
                            <label>Tipo de Stock:</label>
                            <select name="tipoStock"  class="form-control" @change="ListSearchStatus" v-model="selectedStatus">
                                <option value="1">Bajo</option>
                                <option value="0">Alto</option>
                            </select>
                        </div>
                        <div class="col-2 row mt-1">
                            <div class="col-12 row mt-4">
                                <input type="button" class="btn btn-danger mt-1 btnbuscar" value="X" @click="ListProdInv"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-4">
                        <div class="col-6">
                            <label></label>
                        </div>
                        <div class="col-3">
                            <!--<button type="button" class="btn btn-info my-1 form-group col-12" data-bs-toggle="modal" data-bs-target="#b">Balance</button>-->
                            <!-- Modal -->
                            <!--<div class="modal fade" id="b" tabindex="-1" aria-labelledby="bl" aria-hidden="true">
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
                            </div>-->
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-info my-1 form-group col-12" @click="generatePDF">Emitir reporte</button>
                        </div> 
                    </div>
                    <div class="row mx-4">
                        <div class="col-12">
                            <div class="mx-4 mt-4">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Descripción del producto</th>
                                        <th scope="col">Precio de venta</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(producto,index) in listaProductos" :key="producto.id_producto">
                                        <td scope="row">{{index+1}}</td>
                                        <td>{{producto.id_producto}}</td>
                                        <td>{{producto.nombre}}</td>
                                        <td>S/.{{Number(producto.precio).toFixed(2)}}</td>
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
import Appbar from '../../../components/AppBar'
import Navigation from '../../../components/NavigationComponent';
import moment from 'moment';
import usuario from '../../../user';
import jsPDF from 'jspdf';
import 'jspdf-autotable';

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    data(){
        return {
            selectedDate : moment().format('yyy-MM-DD'),
            listaProductos: [],
            resultSum: '',
            selectedStatus: ''
        }
    },
    methods : {
        async generatePDF(){
            let response = await axios.get('api/getEmitirRI?token='+usuario.getData().token);
            let {data} = response.data;
            data = Array.isArray(data)?data:[data];
            console.log(data);
            let rows = data.map((p,i)=>[i+1,p.id_producto,p.nombre,`S/.${Number(p.precio).toFixed(2)}`,p.stock,p.estado]);
            const doc = new jsPDF()
            doc.setFontSize(12);
            doc.text("DULCEKAT", 90, 9);
            doc.text("REPORTE DE INVENTARIO", 80, 18);
            doc.autoTable({
                startY : 30,
                head: [['N°','Código', 'Nombre', 'Precio','Cantidad','Estado']],
                body: rows,
            })
            doc.save('ReporteInventario.pdf');
        },
        msjerrorfecha(){
            this.$swal({
            title: 'Colocar la fecha actual',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            });
        },
        async ListSearchStatus(){
          console.log(this.selectedStatus);
          let response = await axios.get('api/getEmitirRI?tipoStock='+this.selectedStatus+'&token='+usuario.getData().token);
            if(response.data.status == "0"){
                this.listaProductos = Array.isArray(response.data.data)?response.data.data:[response.data.data]
            }else{
                alert('Error: '+response.data.msj);
            }
        },
        async ListProdInv(){
            this.selectedStatus = '';
           let response = await axios.get('api/getEmitirRI?token='+usuario.getData().token);
            if(response.data.status == "0"){
                this.listaProductos = response.data.data;
            }else{
                alert('Error: '+response.data.msj);
            }
        },
        async totalProductCosto(){
          
          let response = await axios.get('api/totalProdCosto?token='+usuario.getData().token);
          console.log('resultSum  '+response);
          if(response.data.status == "0"){
                this.resultSum = response.data.data;
            }else{
                alert('Error: '+response.data.msj);
            }
          
        },
    },
    mounted(){
      console.log('mounted!!!');
      this.ListProdInv();
      this.totalProductCosto();
    }
}
</script>