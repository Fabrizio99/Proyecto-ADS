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
                    <div class="row mx-4">
                        <div class="col-7">
                            <div class="card col-12">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                        <div class="form-group col-8">
                                            <label for="inputNombre" class="label">Nombre del producto</label>
                                            <input type="text" class="form-control " id="inputNombre">
                                        </div>
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                        <div class="form-group col-8">
                                            <label for="InputMarca" class="label">Marca</label>
                                            <input type="text" class="form-control " id="inputMarca">
                                        </div>
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                        <div class="form-group col-8">
                                            <label for="InputPrecio" class="label">Precio</label>
                                            <input type="text" class="form-control" id="inputPrecio">
                                        </div>
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                        <div class="form-group col-8">
                                            <label for="InputStock" class="label">Stock</label>
                                            <input type="text" class="form-control" id="inputStock">
                                        </div>
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="card col-12 ">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-2">
                                            <label></label>
                                        </div>
                                        <div class="form-group col-6 img">
                                            <img src="images/GestionProductos/leche.jpg"  width="275" height="275">
                                        </div>
                                        <div class="col-1">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-3">
                                            <label></label>
                                        </div>
                                        <div class="form-group col-6">
                                            <h5>Seleccione otra foto</h5>
                                            <input type="button" class="btn btn-primary btn-block mt-4 btnexaminar" value="EXAMINAR"/>
                                        </div>
                                        <div class="col-3">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-1">
                                            <label></label>
                                        </div>
                                        <div class="form-group col-10">
                                            <button type="button" class="btn btn-info my-1 form-group col-12 btnguarda-registro" @click="formComprobacionCrear">Registrar</button>
                                        </div>
                                        <div class="col-1">
                                            <label></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
</template>
<script>
import Appbar from '../../../components/AppBar'
import AppBar from '../../../components/AppBar.vue';
import Navigation from '../../../components/NavigationComponent';

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    },
    methods : {
        formListaProducto(){
            this.$router.push({name:"gproductos"});
        },
        formComprobacionCrear(){
            this.$swal({
            title: '¿Desea insertar producto?',
            showDenyButton: true,
            confirmButtonText: `Aceptar`,
            confirmButtonColor: '#0AB70A',
            denyButtonText: `Cancelar`,
            
          }).then((result) => {
  
          if (result.isConfirmed) {
          this.$swal('PRODUCTO REGISTRADO EXITOSAMENTE', '', 'success')
          }
          });
        },
        msjError(){
            this.$swal({
            icon: 'error',
            title: 'Complete todos los campos',
            confirmButtonColor: 'red',
            confirmButtonText: 'Cerrar'
          });
        }
    }
}
</script>