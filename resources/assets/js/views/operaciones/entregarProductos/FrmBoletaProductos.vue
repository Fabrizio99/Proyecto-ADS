<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px">
            <navigation/>
            <div style="height : calc(100vh - 80px);overflow-y : scroll;" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Lista de Boletas
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="card col bg-light">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-9">
                                    <label for="exampleInputPassword1">Código</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="busqueda.codigo">
                                </div>
                                <!--<div class="form-group col-3">
                                    <label for="exampleInputPassword1">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="exampleInputPassword1" v-model="busqueda.fechaInicio">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Fecha Final</label>
                                    <input type="date" class="form-control" id="exampleInputPassword1" v-model="busqueda.fechaFin">
                                </div>-->
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
                <div class="mx-4 mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">N°</th>
                          <th scope="col">Código</th>
                          <th scope="col">Nombre del Cliente</th>
                          <th scope="col">Fecha de Emisión</th>
                          <!--<th scope="col">Estado</th>-->
                          <th scope="col">VER</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(boleta,index) in listaBoletas" :key="boleta.id_boletaventa">
                          <td scope="row">{{index+1}}</td>
                          <td>{{boleta.codigo_boleta}}</td>
                          <td>{{boleta.nombre_cliente}}</td>
                          <td>{{boleta.fecha}}</td>
                          <!--<td>{{boleta.estado}}</td>-->
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger" @click="openBoleta(boleta)">
                                <i class="fas fa-eye fa-lg"></i>
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
</template>


<script>
import Appbar from '../../../components/AppBar'
import Navigation from '../../../components/NavigationComponent';
import usuario from "../../../user";
import data from '../../../data';

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    data(){
        return {
          busqueda     : {
            codigo      : '',
          },
          listaBoletas : [],
        }
    },
    methods:{
      openBoleta(boleta){
        boleta.productos = JSON.parse(boleta.productos);
        data.setSelectedBV(boleta);
        this.$router.push({ name: "formProductos" });
      },
      async getBoletaList(){
        const response = await axios.get('api/listaB?token='+usuario.getData().token);
        console.log('respt ',response);
        if(typeof response.data == 'string'){
          alert('Mensaje: '+response.data);
        }else if(response.data.status == "0"){
          const {data} = response.data;
          this.listaBoletas = Array.isArray(data)?data:[data];
        }else{
            alert('Error: '+response.data.msj);
        }
      },
      async searchBoleta(){
        //validar campos busqueda
        const inputs = Object.keys(this.busqueda);
        if(inputs.some(i=>!this.busqueda[i])){
          alert('Verifique campos');
          return;
        }
        const fields = [
          `cod_boleta=${this.busqueda.codigo}`,
          `token=${usuario.getData().token}`
        ];
        const url = 'api/buscarBoletaF?'+fields.join('&');
        const response = await axios.get(url);
        console.log('respt bus ',response);
        if(typeof response.data == 'string'){
          alert('Mensaje: '+response.data);
        }else if(response.data.status == "0"){
          const {data} = response.data;
          this.listaBoletas = Array.isArray(data)?data:[data];
        }else{
            alert('Error: '+response.data.msj);
        }
      },
      clearSearch(){
        const inputs = Object.keys(this.busqueda);
        inputs.forEach(i => this.busqueda[i] = '');
        this.getBoletaList();
      }
    },
    mounted(){
      this.getBoletaList();
    }
}
</script>