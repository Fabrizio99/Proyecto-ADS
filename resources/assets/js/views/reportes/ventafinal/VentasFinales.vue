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
                                        <input type="date" class="form-control" id="exampleInputPassword1" v-model="fecha">
                                    </div>
                                    <div class="form-group col-6 mt-2">
                                        <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" value="FILTRAR" @click="emitirBalance"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card col bg-light">
                            <div class="card-body">
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-12">
                                        <label for="exampleInputPassword1">Emitir Balance de caja</label>
                                         <input type="button" class="btn btn-primary btn-block btnbuscar" value="EMITIR" @click="openModal"/>
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
                                                                                    <tr v-for="boleta in listaEfectivo" :key="boleta.Codigo">
                                                                                    <td>{{boleta.Codigo}}</td>
                                                                                    <td>s/.{{Number(boleta.Monto).toFixed(2)}}</td>
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
                                                                                    <td>{{listaEfectivo.length}}</td>
                                                                                    <td>s/.{{totalEfectivo}}</td>
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
                                                                                    <tr v-for="boleta in listaYape" :key="boleta.Codigo">
                                                                                    <td>{{boleta.Codigo}}</td>
                                                                                    <td>s/.{{Number(boleta.Monto).toFixed(2)}}</td>
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
                                                                                    <td>{{listaYape.length}}</td>
                                                                                    <td>s/.{{totalYape}}</td>
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
                                                                                    <tr v-for="boleta in listaTotal" :key="boleta.Codigo">
                                                                                    <td>{{boleta.Codigo}}</td>
                                                                                    <td>s/.{{Number(boleta.Monto).toFixed(2)}}</td>
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
                                                                                    <td>{{listaTotal.length}}</td>
                                                                                    <td>s/.{{totalTodo}}</td>
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
                                                    <button type="button" class="btn btn-primary" @click="generatePDF">IMPRIMIR</button>
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
                          <th scope="col">Monto</th>
                          <th scope="col">Tipo de Pago</th>
                        </tr>
                      </thead>
                      <tbody>     
                        <tr v-for="(boleta,index) in listaTotal" :key="boleta.Codigo">
                          <td scope="row">{{index+1}}</td>
                          <td>{{boleta.Codigo}}</td>
                          <td>{{boleta.NombreCliente}}</td>
                          <td>s/.{{boleta.Monto}}</td>
                          <td>{{boleta.TipodePago}}</td>
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
import Navigation from '../../../components/NavigationComponent';
import usuario from '../../../user';
import fechaActual from '../../../fecha';
import jsPDF from 'jspdf';
import 'jspdf-autotable';

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    data(){
        return{
            fecha : fechaActual,
            listaYape : [],
            listaEfectivo : [],
            listaTotal : []
        }
    },
    computed : {
        totalEfectivo(){
            if(this.listaEfectivo.length == 0)  return 0;
            let monto = 0;
            this.listaEfectivo.forEach(e=>monto+=Number(e.Monto));
            return Number(monto).toFixed(2);
        },
        totalYape(){
            if(this.listaYape.length == 0)  return 0;
            let monto = 0;
            this.listaYape.forEach(e=>monto+=Number(e.Monto));
            return Number(monto).toFixed(2);
        },
        totalTodo(){
            if(this.listaTotal.length == 0)  return 0;
            let monto = 0;
            this.listaTotal.forEach(e=>monto+=Number(e.Monto));
            return Number(monto).toFixed(2);
        }
    },
    methods:{
        async generatePDF(){
            const response = await axios.get('api/emitirRBVbyFecha?token='+usuario.getData().token);
            const lista = Array.isArray(response.data.data)?response.data.data:[response.data.data];
            const listaEfectivo = lista.filter(a=>a.TipodePago == 'EFECTIVO');
            const listaYape = lista.filter(a=>a.TipodePago == 'YAPE');
            
            const doc = new jsPDF();
            doc.setFontSize(12);
            doc.text("DULCEKAT", 90, 9);
            doc.text("REPORTE DE VENTAS", 80, 18);
            doc.text("PAGOS EN EFECTIVO", 80, 27);
            doc.autoTable({
                startY : 40,
                head   : [['Código', 'Monto']],
                body   : [[],[],[]],
            });

            doc.text("PAGOS EN EFECTIVO", 80, );
            doc.autoTable({
                startY : 90,
                head   : [['Código', 'Monto']],
                body   : [['4','15.00'],['5','15.00'],['3','15.00']],
            });
            doc.save('ReporteVentas.pdf');
        },
        async emitirBalance(){
            const response = await axios.get('api/emitirRBVbyFecha?token='+usuario.getData().token+'&fecha='+(this.fecha || ''));
            if(typeof response.data == 'string'){
                alert('Mensaje: '+response.data);
            }else if(response.data.status == "0"){
                const lista = Array.isArray(response.data.data)?response.data.data:[response.data.data];
                this.listaEfectivo = lista.filter(a=>a.TipodePago == 'EFECTIVO');
                this.listaYape = lista.filter(a=>a.TipodePago == 'YAPE');
                this.listaTotal = lista;
            }else{
                if(response.data.msj == 'Sin resultados.'){
                    this.listaEfectivo = [];
                    this.listaYape = [];
                    this.listaTotal = [];
                }
                alert('Error: '+response.data.msj);
            } 
        },
        openModal(){
            if(this.fecha != fechaActual){
                alert('Mensaje: Solo se genera reporte de la fecha actual');
                return;
            }
            $('#Modal2').modal('show');
        }
    },
    mounted(){
        this.emitirBalance();
    }
}
</script>