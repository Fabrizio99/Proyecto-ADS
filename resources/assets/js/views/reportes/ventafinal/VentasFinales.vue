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
                                         <input type="button" class="btn btn-primary btn-block btnbuscar" value="EMITIR"/>
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
    methods:{
        async generatePDF(){
            /*let response = await axios.get('api/getEmitirRI?token='+usuario.getData().token);
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
            doc.save('ReporteInventario.pdf');*/
            console.log('llego acaaaaaaaaaaaaa');
            const doc = new jsPDF();
            doc.setFontSize(12);
            doc.text("DULCEKAT", 90, 9);
            doc.text("REPORTE DE VENTAS", 80, 18);
            doc.text("PAGOS EN EFECTIVO", 80, 27);
            doc.autoTable({
                startY : 40,
                head   : [['Código', 'Monto']],
                body   : [['1','15.00'],['2','15.00'],['3','15.00']],
            })
            doc.text("PAGOS EN EFECTIVO", 80, );
            doc.autoTable({
                startY : 90,
                head   : [['Código', 'Monto']],
                body   : [['4','15.00'],['5','15.00'],['3','15.00']],
            });
            doc.save('ReporteInventario.pdf');
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
                alert('Error: '+response.data.msj);
            } 
            //$('#Modal2').modal('show');
        },
    },
    mounted(){
        this.emitirBalance();
    }
}
</script>