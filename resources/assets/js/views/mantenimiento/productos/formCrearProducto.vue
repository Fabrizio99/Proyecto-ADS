<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">     
                    <div class="row mx-4">
                        <h3 class="col">
                            {{accion == 'editar'?'Editar':'Crear'}} producto
                        </h3>
                    </div>
                    <div class="px-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Nombre del producto</label>
                                        <input type="text" class="form-control" v-model="producto.nombre" >
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Marca</label>
                                        <input type="text" class="form-control" v-model="producto.marca">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Precio</label>
                                        <input type="number" class="form-control" v-model="producto.precio">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Stock</label>
                                        <input type="number" class="form-control" v-model="producto.stock">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Categoría</label>
                                        <select name="select" v-model="producto.categoria" class="form-control">
                                            <option v-for="categoria in categorias" :key="categoria.id_categoria" :value="categoria.id_categoria">{{categoria.nombre}}</option>
                                        </select>
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
        productAction(){
            if(this.accion == 'crear'){
                this.createProduct();
            }else{
                this.editProduct();
            }
        },
        isUncomplete(){
            let campos = Object.keys(this.producto);
            return campos.some(input=>!this.producto[input]);
        },
        async editProduct(){
            if(!this.isUncomplete()){
                const body = {
                    idP          : this.producto.id,
                    nombre       : this.producto.nombre,
                    marka        : this.producto.marca,
                    precio       : this.producto.precio,
                    id_categoria : this.producto.categoria,
                    stock        : this.producto.stock,
                    token        : usuario.getData().token
                }
                let response = await axios.post('api/updateP',body);

                if(response.data.status == "0"){
                    alert('Mensaje: Producto modificado exitosamente');
                    this.$router.push({name : 'gproductos'});
                }else{
                    alert('Error: '+response.data.msj);
                }
            }else{
                alert('Error: Complete los campos faltantes o incorrectos');
            }
        },
        async createProduct(){
            if(this.isUncomplete()){
                const body = {
                    nombre       : this.producto.nombre,
                    marka        : this.producto.marca,
                    precio       : this.producto.precio,
                    id_categoria : this.producto.categoria,
                    stock        : this.producto.stock,
                    token        : usuario.getData().token
                }
                let response = await axios.post('api/registrarP',body);
                if(response.data.status == "0"){
                    alert('Mensaje: Producto registrado exitosamente');
                    this.$router.push({name : 'gproductos'});
                }else{
                    alert('Error: '+response.data.msj);
                }
            }else{
                alert('Error: Complete los campos faltantes o incorrectos');
            }
        },
        
        async getCategoria(){
            let response = await axios.get('api/cmbCategoria?token='+usuario.getData().token);
            if(typeof response.data == 'string'){
                alert('Mensaje: '+response.data);
            }else if(response.data.status != '0'){
                alert('Error: ',response.data.msj);
            }else{
                this.categorias = response.data.data;
            }
        }
    }, 
    data(){
        return{
            producto : {
                nombre    : '',
                marca     : '',
                precio    : '',
                stock     : '',
                categoria : '',
                id        : ''
            },
            categorias : []
        }
    },
    mounted(){
        this.getCategoria();
        if(this.accion == 'editar'){
            let producto = data.getSelectedProducto();
            this.producto.id = producto.id_producto;
            this.producto.nombre = producto.nom_prod;
            this.producto.marca = producto.marka;
            this.producto.precio = producto.precio;
            this.producto.stock = producto.stock;
            this.producto.categoria = producto.id_categoria;
        }
    }
}
</script>