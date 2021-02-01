<template>
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center login-container">
            <div class="col-lg-4 col-sm-8 align-middle">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">DulceKat</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitLogin">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                                <input type="text" class="form-control" v-model="user"/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" v-model="password"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import usuario from "../user.js";
export default {
  data() {
    return {
      user       : '',
      password   : '',
      loginError : false,
      errorMessage : ''
    };
  },
  methods: {
    async submitLogin() {
      let response = await axios.get('api/getLogin?user='+this.user+'&password='+this.password);
      if(typeof response.data == 'string'){
        alert('Mensaje: '+response.data);
      }else if(response.data.status == "1" || response.data.status == "2"){
        this.errorMessage = response.data.msj;
        alert('Error: '+response.data.msj);
      }else{
        response.data.data.token = response.data.token;
        usuario.setData(response.data.data);
        this.$router.push({ name: 'main'});
      }
    },
  }
};
</script>