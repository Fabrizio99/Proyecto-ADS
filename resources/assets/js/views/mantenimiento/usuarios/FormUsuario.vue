<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px" class="main-container">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Formulario Usuario
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="card col-8">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Nombre</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Tipo de documento</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Nombre</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Tipo de documento</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Nombre</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Tipo de documento</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-4">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-9">
                                    <label for="exampleInputPassword1">Nombre del usuario</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4" value="BUSCAR"/>
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
    }
}
</script>