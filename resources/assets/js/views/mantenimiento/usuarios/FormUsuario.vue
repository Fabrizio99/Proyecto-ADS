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
                <div class="px-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Nombre</label>
                                    <input type="text" class="form-control" v-model="user.nombre">
                                </div>
                                <div class="form-group col-6">
                                    <label>Tipo documento</label>
                                    <select name="select" v-model="user.tipoDocumento" class="form-control">
                                        <option v-for="documento in documentos" :key="documento.id" :value="documento.id_documentos">{{documento.nombre}}</option>
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
                                    <label for="exampleInputPassword1">Teléfono</label>
                                    <input type="number" class="form-control" v-model="user.telefono">
                                </div>
                                <div class="form-group col-6">
                                    <label>Roles</label>
                                    <select name="select" v-model="user.rol" class="form-control">
                                        <option v-for="rol in roles" :key="rol.id_rol" :value="rol.id_rol">{{rol.nombre}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div :class="'form-group col-'+(accion=='editar'?'12':'6')">
                                    <label for="exampleInputPassword1">Dirección</label>
                                    <input type="text" class="form-control" v-model="user.direccion">
                                </div>
                                <div class="form-group col-6" v-if="accion != 'editar'">
                                    <label for="exampleInputPassword1">Clave</label>
                                    <input type="password" class="form-control" v-model="user.clave">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="card">
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
                    </div>-->
                </div>
                <div class="px-4 mt-3">
                    <button type="button" class="btn btn-info btnguarda-registro profile-button" @click="userAction">{{this.accion == 'crear'?'Registrar':'Guardar Cambios'}}</button>
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
        'app-bar'     : Appbar,
        'navigation'  : Navigation,
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
        isUncomplete(){
            let campos = Object.keys(this.user);
            const _this = this;
            return campos.some(function (input) {
                return (!_this.user[input] && input != 'clave');
            });
        },
        async createUser(){
            if(!this.isUncomplete()){
                const body = {
                    numDoc : this.user.documento,
                    rol    : this.user.rol,
                    contrasenia : this.user.clave,
                    nombres : this.user.nombre,
                    apellidos : this.user.apellidos,
                    tipoDoc : this.user.tipoDocumento,
                    direccion : this.user.direccion,
                    telefono : this.user.telefono,
                    clave : this.user.clave,
                    token : usuario.getData().token
                }
                let response = await axios.post('api/crearUsuario',body);
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
        async editUser(){
            if(!this.isUncomplete()){
                const body = {
                    tipoDoc : this.user.tipoDocumento,
                    nombres : this.user.nombre,
                    apellidos : this.user.apellidos,
                    direccion : this.user.direccion,
                    telefono : this.user.telefono,
                    rol : this.user.rol,
                    numDoc : this.user.documento,
                    contrasenia : this.user.clave,
                    token : usuario.getData().token
                }
                let response = await axios.post('api/modificarUsuario',body);
                if(response.data.status == "0"){
                    alert('Mensaje: Usuario modificado exitosamente');
                    this.$router.push({name : 'user'});
                }else{
                    alert('Error: '+response.data.msj);
                }
            }else{
                alert('Error: Completar todos los campos')
            }
        },
        async getTipoDocumentos(){
            let response = await axios.get('api/cmbTipoDoc?token='+usuario.getData().token);
            if(response.data.status == "0"){
                this.documentos = response.data.data;
            }else{
                alert('Error: ',response.data.msj);
            }
        },
        async getRoles(){
            let response = await axios.get('api/cmbRol?token='+usuario.getData().token);
            console.log('roles ',response);
            if(typeof response.data == 'string'){
                alert('Mensaje: '+response.data);
            }else if(response.data.status != '0'){
                alert('Error: ',response.data.msj);
            }else{
                this.roles = response.data.data;
            }
        }
    },
    data(){
        return{
            user : {
                nombre : '',
                tipoDocumento : '',
                apellidos : '',
                documento : '',
                direccion : '',
                telefono : '',
                rol : '',
                clave : ''
            },
            documentos : [],
            roles : [],
        }
    },
    mounted(){
        this.getTipoDocumentos();
        this.getRoles();

        if(this.accion == 'editar'){
            console.log(data.getSelectedUser());
            let usuario = data.getSelectedUser();
            this.user.nombre = usuario.nombres;
            this.user.apellidos = usuario.apellidos;
            this.user.documento = usuario.num_documento;
            this.user.tipoDocumento = usuario.tipo_doc;
            this.user.direccion = usuario.direccion;
            this.user.telefono  = usuario.telefono;
            this.user.rol = usuario.id_rol;
        }
    }
}
</script>
<style 
        Multiselectscoped>
.user-form-container{
    display: flex;
    justify-content: space-between;
}
.image-profile{
    max-width: 83%;
    margin: 10px auto 0;
}
.profile-button{
    height: min-content;
}

</style>