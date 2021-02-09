<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">
                <div class="row mx-4 mb-1">
                    <h3 class="col">
                        Buscar Boleta
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="card col">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-1">
                                    <label for="exampleInputPassword1">Código</label>
                                    <input type="text" class="form-control" v-model="busqueda.codigo">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Cliente</label>
                                    <input type="text" class="form-control" v-model="busqueda.cliente">
                                </div>
                                <div class="form-group col-2">
                                    <label for="exampleInputPassword1">Documento</label>
                                    <input type="number" class="form-control" maxlength="8" v-model="busqueda.documento">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Fecha de compra</label>
                                    <input type="date" class="form-control" v-model="busqueda.fecha">
                                </div>
                                <div class="form-group col-3 mt-2 row">
                                  <div class="col-10">
                                    <input
                                      type="button"
                                      class="btn btn-primary btn-block mt-4 btnbuscar"
                                      value="BUSCAR"
                                      @click="searchBoleta"
                                    />
                                  </div>
                                  <div class="col-2">
                                    <input
                                      type="button"
                                      class="btn btn-danger btn-block mt-4 btnbuscar"
                                      value="X"
                                      @click="clearSearch"
                                    />
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4 mt-4" v-if="boletaSeleccionada">
                  <div class="card col">
                        <div class="card-body">
                            <div class="form-row">
                              <h5 class="col">
                                  Boleta: {{boletaSeleccionada.CODIGOB}}
                              </h5>
                            </div>
                            <div class="form-row">
                                <div class="card col-12">
                                  <div class="card-header">
                                    Datos del consumidor
                                  </div>
                                  <div class="card-body">
                                    <div class="form-row">
                                      <div class="form-group col-4">
                                          <label for="exampleInputPassword1">Cliente</label>
                                          <input type="text" class="form-control" id="exampleInputPassword1" :value="boletaSeleccionada.nombre_cliente" disabled>
                                      </div>
                                      <div class="form-group col-4">
                                          <label for="exampleInputPassword1">Tipo de documento</label>
                                          <input type="text" class="form-control" id="exampleInputPassword1" :value="boletaSeleccionada.nombre" disabled>
                                      </div>
                                      <div class="form-group col-4">
                                          <label for="exampleInputPassword1">N° Documento</label>
                                          <input type="number" class="form-control" id="exampleInputPassword1" disabled :value="boletaSeleccionada.numdocumento_cliente">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="card col-12 mt-4">
                                  <div class="card-header">
                                    Datos del reclamo
                                  </div>
                                  <div class="card-body">
                                    <div class="form-row">
                                      <div class="col-6 row">
                                        <div class="form-group col-12">
                                          <label for="exampleInputPassword1">Fecha del reclamo</label>
                                          <input type="date" class="form-control" id="exampleInputPassword1" :value="fecha" disabled>
                                        </div>
                                        <div class="form-group col-12">
                                          <label for="exampleInputPassword1">Descripción</label>
                                          <input type="text" class="form-control" id="exampleInputPassword1" v-model="reclamo.descripcion">
                                        </div>
                                      </div>
                                      <div class="col-6 row">
                                        <div class="form-group col-12">
                                          <label for="exampleInputPassword1">Solución</label>
                                          <textarea name="" id="" cols="30" rows="5" class="form-control" v-model="reclamo.observacion"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-around">
                              <div class="col mt-3">
                                <button class="btn btn-primary btnexaminar" @click="saveComplain">Registrar</button>
                                <button class="btn btn-primary btnexaminar ml-2" data-toggle="modal" data-target="#comprobanteModal" >Comprobante de reclamo</button>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <div class="modal fade" id="comprobanteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog details-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comprobante de reclamo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-12">
                      <label for="exampleInputPassword1">Descripción del reclamo</label>
                      <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                  <div class="form-group col-6">
                      <label for="exampleInputPassword1">Pedido concreto del reclamante</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" value="" disabled>
                  </div>
                  <div class="form-group col-6">
                      <label for="exampleInputPassword1">Encargado</label>
                      <input type="number" class="form-control" id="exampleInputPassword1" disabled value="Ricardo">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Imprimir</button>
              </div>
            </div>
          </div>
        </div>
         <div class="modal fade" id="boletasModal" tabindex="-1" aria-labelledby="a" aria-hidden="true">
          <div class="modal-dialog details-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="a">Detalles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="mx-4 mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">N°</th>
                          <th scope="col">CÓDIGO</th>
                          <th scope="col">CLIENTE</th>
                          <th scope="col">FECHA</th>
                          <th scope="col" style="width : 130px">OPCIONES</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(boleta,index) in listaBoletas" :key="index">
                          <td space="row">{{index+1}}</td>
                          <td>{{boleta.CODIGOB}}</td>
                          <td>{{boleta.nombre_cliente}}</td>
                          <td>{{boleta.fecha}}</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="verDetalles(boleta)">Ver Detalles</a>
                                <a class="dropdown-item" @click="selectBoleta(boleta)">Seleccionar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog details-dialog">
            <div class="modal-content" v-if="verBoleta">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Boleta {{verBoleta.CODIGOB}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                    <div class="card col-12">
                      <div class="card-body">
                        <div class="form-row">
                          <div class="form-group col-6">
                              <label for="exampleInputPassword1">Código</label>
                              <input type="text" class="form-control" id="exampleInputPassword1" :value="verBoleta.CODIGOB" disabled>
                          </div>
                          <div class="form-group col-6">
                              <label for="exampleInputPassword1">Fecha</label>
                              <input type="date" class="form-control" id="exampleInputPassword1" disabled :value="verBoleta.fecha">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="exampleInputPassword1">Cliente</label>
                              <input type="text" class="form-control" id="exampleInputPassword1" disabled :value="verBoleta.nombre_cliente">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-6">
                              <label for="exampleInputPassword1">Tipo Documento</label>
                              <input type="text" class="form-control" id="exampleInputPassword1" disabled :value="verBoleta.nombre">
                          </div>
                          <div class="form-group col-6">
                              <label for="exampleInputPassword1">N° Documento</label>
                              <input type="text" class="form-control" id="exampleInputPassword1" disabled :value="verBoleta.numdocumento_cliente">
                          </div>
                        </div>
                      </div>
                    </div>
                    <table class="table col-12">
                      <thead>
                        <tr>
                          <th scope="col">PRODUCTO</th>
                          <th scope="col">P. UNITARIO</th>
                          <th scope="col">CANTIDAD</th>
                          <th scope="col">IMPORTE</th>
                        </tr>
                      </thead>
                      <tbody v-for="(p,i) in verBoleta.Productos" :key="i">
                        <tr v-for="(p,i) in verBoleta.Productos" :key="i">
                          <td space="row">{{p.producto}}</td>
                          <td>S/{{Number(p.precio).toFixed(2)}}</td>
                          <td>{{p.cantidad}}</td>
                          <td>S/{{Number(Number(p.precio)*(p.cantidad)).toFixed(2)}}</td>
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
import Navigation from '../../components/NavigationComponent';
import Multiselect from '../../components/Multiselect';
import usuario from "../../user";
import fechaActual from '../../fecha';


export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation,
        'multiselect' : Multiselect
    },
    data(){
      return{
        busqueda : {
          codigo : '',
          cliente : '',
          documento : '',
          fecha : ''
        },
        listaBoletas : [],
        boletaSeleccionada : undefined,
        verBoleta : undefined,
        reclamo : {
          descripcion : '',
          observacion : ''
        },
        fecha : fechaActual
      }
    },
    methods : {
        openBoletas(){
          $('#boletasModal').modal('show');
        },
        verDetalles(boleta){
          console.log({boleta});
          $('#boletasModal').modal('hide');
          this.verBoleta = boleta;
          $('#detallesModal').modal('show');
        },
        async searchBoleta(){
          const fields = [
            `codBoleta=${this.busqueda.codigo}`,
            `nombre=${this.busqueda.cliente}`,
            `documento=${this.busqueda.documento}`,
            `fecha=${this.busqueda.fecha}`,
            `token=${usuario.getData().token}`
          ];
          const url = 'api/getReclamos?'+fields.join('&');
          const response = await axios.get(url);
          console.log('respt bus ',response);
          if(typeof response.data == 'string'){
            alert('Mensaje: '+response.data);
          }else if(response.data.status == "0"){
            const {data} = response.data;
            this.listaBoletas = Array.isArray(data)?data:[data];
            this.listaBoletas.forEach((e,i) => {
              this.listaBoletas[i].Productos = JSON.parse(this.listaBoletas[i].Productos);
            });
            $('#boletasModal').modal('show');
          }else{
              alert('Error: '+response.data.msj);
          }
        },
        openFormUser(){
          this.$router.push({name:"formUser"});
        },
        async saveComplain(){
          if(!this.reclamo.descripcion || !this.reclamo.observacion){
            alert('Error: Complete todos los campos');
            return;
          }
          const body = {
            descripcion : this.reclamo.descripcion,
            id_boleta   : this.boletaSeleccionada.idB_boleta,
            fecha       : this.fecha,
            solucion    : this.reclamo.observacion,
            token       : usuario.getData().token
          }
          const response = await axios.post('api/postRegistrar',body);
          if(typeof response.data == 'string'){
            alert('Mensaje: '+response.data);
          }else if(response.data.status == "0"){
            alert('Mensaje: '+response.data.msj);
            this.verBoleta = undefined,
            this.boletaSeleccionada = undefined;
            this.reclamo.observacion = '';
            this.reclamo.descripcion = '';
          }else{
              alert('Error: '+response.data.msj);
          }
          //this.$swal('Registrado correctamente!','','success');
        },
        selectBoleta(boleta){
          this.boletaSeleccionada = boleta;
          $('#boletasModal').modal('hide');
        },
        clearSearch(){
          const inputs = Object.keys(this.busqueda);
          inputs.forEach(i => this.busqueda[i] = '');
          this.listaBoletas = [];
        }
    },
    mounted(){
      $('#detallesModal').on('hidden.bs.modal', function () {
          $('#boletasModal').modal('show');
      });
    }
}
</script>
<style scoped>
.details-dialog{
  max-width: 70vw !important;
}
</style>