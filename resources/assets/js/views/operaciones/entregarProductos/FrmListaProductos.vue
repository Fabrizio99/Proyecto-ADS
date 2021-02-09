<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px">
            <navigation/>
            <div class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Lista de Productos de la Boleta del Cliente
                    </h3>
                </div>
                <div class="row mx-4">
                  <div class="col-3">
                    <div class="card col bg-light">
                          <div class="card-body">
                            <div class="form-row justify-content-center">
                              <div class="form-group">
                                <label></label>
                              </div>
                            </div>
                            <div class="form-row justify-content-center">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Cliente</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" disabled :value="boleta.nombre_cliente">
                              </div>
                            </div>
                            <div class="form-row justify-content-center">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Código de Boleta</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" disabled :value="boleta.codigo_boleta">
                              </div>
                            </div>
                            <div class="form-row justify-content-center">
                              <div class="form-group">
                                <input type="button" class="btn btn-info my-1 form-group col-12 btnguarda-registro" value="Entregar Producto" @click="entregar"/>
                              </div>
                            </div>  
                            <div class="form-row justify-content-center">
                              <div class="form-group">                                
                              </div>
                            </div>
                          </div>
                    </div>
                  </div>
                  <div class="col-9">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">N°</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Precio</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Precio total</th>
                        </tr>
                      </thead>
                      <tbody v-if="boleta.productos">                         
                        <tr v-for="(producto,index) in boleta.productos" :key="producto.codigoP">
                          <td scope="row">{{index+1}}</td>
                          <td>{{producto.nom_prod}}</td>
                          <td>S/.{{Number(producto.precio).toFixed(2)}}</td>
                          <td>{{producto.cantidad}}</td>
                          <td>S/.{{Number(producto.precio).toFixed(2)*(producto.cantidad)}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div> 
                </div>
            </div>
         </div>
     </div>
</template>


<script>
import Appbar from '../../../components/AppBar'
import Navigation from '../../../components/NavigationComponent';
import data from '../../../data';
import usuario from "../../../user";

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation,
    },
    data(){
      return{
        boleta : {}
      }
    },
    methods:{
      async entregar(){
        const body = {
          id_bv : this.boleta.idB_boleta,
          token : usuario.getData().token
        }
        const response = await axios.post('api/modificarEb',body);
        console.log('respuesta entrega ',response);
        if (typeof response.data == "string") {
          alert("Error: " + response.data);
        }else if (response.data.status == "0") {
          alert("Mensaje: Anulado correctamente");
          this.$router.push({name : 'formBolProd'});
        } else {
          alert("Error: " + response.data.msj);
        }
      }
    },
    mounted(){
      this.boleta = data.getSelectedBV();
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
