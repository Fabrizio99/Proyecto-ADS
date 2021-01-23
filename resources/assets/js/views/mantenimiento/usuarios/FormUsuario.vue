<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Formulario Usuario
                    </h3>
                </div>
                <div class="px-4 user-form-container">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Nombre</label>
                                    <input type="text" class="form-control">
                                </div>
                                <multiselect
                                    :colSize="6"
                                    label = "Tipo de Documento"
                                    :optionList = "[
                                        {
                                            id   : 1,
                                            name : 'DNI'
                                        },
                                        {
                                            id   : 2,
                                            name : 'CARNET DE EXTRANJERIA'
                                        },
                                    ]"
                                />
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Apellidos</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Documento</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Dirección</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Clave</label>
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Teléfono</label>
                                    <input type="tel" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Rol</label>
                                    <input type="tel" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <img src="https://avatars3.githubusercontent.com/u/499550?s=460&u=de41ec9325e8a92e281b96a1514a0fd1cd81ad4a&v=4" class="card-img-top image-profile" alt="img-profile">
                        <div class="card-body container">
                            <div class="row justify-content-md-center mb-2">
                                <button type="button" class="btn btn-primary mt-4 btnexaminar">Examinar</button>
                            </div>
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-info btnguarda-registro profile-button">Guardar Cambios</button>
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
import Navigation from '../../../components/NavigationComponent';
import Multiselect from '../../../components/Multiselect';

export default {
    components : {
        'app-bar'     : Appbar,
        'navigation'  : Navigation,
        'multiselect' : Multiselect
    },
}
</script>
<style 
        Multiselectscoped>
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