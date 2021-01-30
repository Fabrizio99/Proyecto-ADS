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
                                    <input type="text" class="form-control" v-model="user.nombre">
                                </div>
                                <!--<multiselect
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
                                    v-model="user.tipoDocumento"
                                />-->
                                <div class="form-group col-6">
                                    <label>Tipo documento</label>
                                    <select name="select" v-model="user.tipoDocumento" class="form-control">
                                        <option value="value1">Value 1</option>
                                        <option value="value2">Value 2</option>
                                        <option value="value3">Value 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Apellidos</label>
                                    <input type="text" class="form-control" v-model="user.apellidos">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Documento</label>
                                    <input type="number" class="form-control" v-model="user.documento">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Dirección</label>
                                    <input type="text" class="form-control" v-model="user.direccion">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Clave</label>
                                    <input type="password" class="form-control" v-model="user.clave">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Teléfono</label>
                                    <input type="number" class="form-control" v-model="user.telefono">
                                </div>
                                <multiselect
                                    :colSize="6"
                                    label = "Roles"
                                    :optionList = "[
                                        {
                                            id   : 1,
                                            name : 'Vendedor'
                                        },
                                        {
                                            id   : 2,
                                            name : 'Cajero'
                                        },
                                    ]"
                                    v-model="user.rol"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <img src="https://avatars3.githubusercontent.com/u/499550?s=460&u=de41ec9325e8a92e281b96a1514a0fd1cd81ad4a&v=4" class="card-img-top image-profile" alt="img-profile">
                        <div class="card-body container">
                            <div class="row justify-content-md-center mb-2">
                                <div class="form-group">
                                    <label>EXAMINAR</label>
                                    <input type="file" class="form-control-file file-input-garantia">
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-info btnguarda-registro profile-button" @click="userAction">{{this.accion == 'crear'?'Registrar':'Guardar Cambios'}}</button>
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
import data from '../../../data';

export default {
    components : {
        'app-bar'     : Appbar,
        'navigation'  : Navigation,
        'multiselect' : Multiselect
    },
    props : ['accion'],
    methods : {
        userAction(){
            if(this.accion == 'crear'){
                this.createUser();
            }else{
                this.editUser();
            }
        },
        validarCampos(){
            let validador = true;
            let campos = Object.keys(this.user);
            for (let index = 0; index < campos.length; index++) {
                if(this.user[campos[index]] == null || this.user[campos[index]] == undefined || this.user[campos[index]] == ''){
                    validador = false;
                    break;
                }
            }
            return validador;
        },
        async createUser(){
            if(this.validarCampos()){
                const body = {
                    numDoc : this.user.documento,
                    rol    : this.user.rol.id,
                    contrasenia : this.user.clave,
                    nombres : this.user.nombre,
                    apellido : this.user.apellidos,
                    tipoDoc : this.user.tipoDocumento.id,
                    direccion : this.user.direccion,
                    telefono : this.user.telefono,
                    fechaInicio : moment().format('yyyy-MM-DD')
                }

                let response = await axios.post('api/crearUsuario',body);
                console.log(response.data.status);
                console.log(response.data.msj);
                if(response.data.status == "0"){
                    alert('Correcto: Usuario registrado exitosamente');
                    this.$router.push({name : 'user'});
                }else{
                    alert('Error: '+response.data.msj);
                }
            }else{
                alert('Error: Complete los campos faltantes o incorrectos');
            }
        },
        editUser(){

        }
    },
    data(){
        return{
            user : {
                nombre : '',
                tipoDocumento : 'value2',
                apellidos : '',
                documento : '',
                direccion : '',
                clave : '',
                telefono : '',
                rol : '' 
            }
        }
    },
    mounted(){
        console.log(data.getSelectedUser())
    }
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