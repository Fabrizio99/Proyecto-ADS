<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px">
            <navigation/>
            <div style="height : calc(100vh - 80px);overflow-y : scroll;" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Notas de Ventas
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="card col bg-light">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Código</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="inputcodenventa">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="exampleInputPassword1" v-model="inputfinicio">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Fecha Final</label>
                                    <input type="date" class="form-control" id="exampleInputPassword1" v-model="inputffin">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" value="BUSCAR" @click="buscarNotaVenta"/>
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
                          <th scope="col">Estado</th>
                          <th scope="col">Monto</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(notaventa,index) in listanotaventas" :key="notaventa.codigo">
                          <td scope="row">{{index+1}}</td>
                          <td>{{notaventa.codigo}}</td>
                          <td>{{notaventa.cliente}}</td>
                          <td>{{notaventa.estado}}</td>
                          <td>{{notaventa.monto}}</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v" ></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="detallenVenta(notaventa)">"Ver detalles</a>
                                <a class="dropdown-item" @click="anularNV">Anular Nota de Venta</a>
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
import AppBar from '../../../components/AppBar.vue';
import Navigation from '../../../components/NavigationComponent';
import data from '../../../data';
//import Notaventa from '../../../notaventa';
import usuario from '../../../user';
export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    data(){
      return{
        listanotaventas : [],
        inputcodenventa : '',
        inputfinicio : '',
        inputffin : ''
      }
    },
    methods:{

       async buscarNotaVenta(){
        if(this.inputcodenventa.trim() != '' && this.inputfinicio != '' && this.inputffin != ''){
          let response = await axios.get('api/buscaNotaVByFechas?notaVid='+this.inputcodenventa.trim()+'&fechaInicio='+this.inputfinicio+'&fechaFin='+this.inputffin+'&token='+usuario.getData().token);
          console.log(response);
          this.inputcodenventa = '';
          
          if(response.data.status == "0"){
            this.listanotaventas = Array.isArray(response.data.data)?response.data.data:[response.data.data];
            if(this.listanotaventas.length == 0){
              alert('Error: No se encuentra la nota de venta');
            }
          }else{
            this.listanotaventas = [];
            alert('Error: '+response.data.msj);
          }
        }
      },

      detallenVenta(nota_venta){
        data.setSelectedNV(nota_venta);
        this.$router.push({path:'/formulario-detalle-notaVenta'});
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
            this.$swal('Nota de Venta Anulada', '', 'success')
          }
        });},

        /*VerDetalle(){
             this.$router.push({name:"formDetalleNV"});
        },*/

        async getNotasVenta(){
        this.Inputcodigo = '';
        let response = await axios.get('api/listaNotaV?token='+usuario.getData().token);
        console.log('respuesta ',response);
        if(response.data.status == "0"){
          //todo bien
          this.listanotaventas= response.data.data;
        }else{
          alert('Error: '+response.data.msj);
        }
      }
    },

    mounted(){
      this.getNotasVenta();
    }
       
    }

</script>