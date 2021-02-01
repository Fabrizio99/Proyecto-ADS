<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">     
                    <div class="row mx-4">
                        <h3 class="col">
                            Crear producto
                        </h3>
                    </div>
                    <div class="px-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Nombre del producto</label>
                                        <input type="text" class="form-control" v-model="productos.nombres" >
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Marca</label>
                                        <input type="text" class="form-control" v-model="productos.marca">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Precio</label>
                                        <input type="number" class="form-control" v-model="productos.precio">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Stock</label>
                                        <input type="number" class="form-control" v-model="productos.stock">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="px-4 mt-3">
                    <button type="button" class="btn btn-info btnguarda-registro profile-button" @click="productAction">{{this.accion == 'crear'?'Registrar':'Guardar Cambios'}}</button>
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
import usuario from '../../../user';

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    props : ['accion'],
    methods : {
        msjError(){
            this.$swal({
            icon: 'error',
            title: 'Complete todos los campos',
            confirmButtonColor: 'red',
            confirmButtonText: 'Cerrar'
          });
        },
        productAction(){
            if(this.accion == 'crear'){
                this.createProduct();
            }else{
                
            }
        },
        validarCampos(){
            let validador = true;
            let campos = Object.keys(this.productos);
            for (let index = 0; index < campos.length; index++) {
                if((this.productos[campos[index]] == null ) || (this.user[campos[index]] == undefined ) || (this.user[campos[index]] == '' )){
                    validador = false;
                    break;
                }
            }
            return validador;
        },
        async createProduct(){
            if(this.validarCampos()){
                const body = {
                    nombre : this.productos.nombres,
                    marka   : this.productos.marca,
                    precio : this.productos.precio,
                    stock : this.productos.stock,
                    token : usuario.getData().token
                }
                let response = await axios.post('api/registrarP',body);
                console.log('RESPONSE ',response);
                if(response.data.status == "0"){
                    alert('Correcto: Producto registrado exitosamente');
                    this.$router.push({name : 'gproductos'});
                }else{
                    alert('Error: '+response.data.msj);
                }
            }else{
                alert('Error: Complete los campos faltantes o incorrectos');
            }
        }
        
    }, 
    data(){
        return{
            productos: {
                nombre: '',
                marca: '',
                precio: '',
                stock: ''
            }
        }
    },
    mounted(){
       
    }
}
</script>