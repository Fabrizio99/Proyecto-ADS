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
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Recordar</label>
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
import store from "../store";
export default {
  data() {
    return {
      user       : '',
      password   : '',
      loginError : false,
    };
  },
  methods: {
    async submitLogin() {
      let {status,data} = await axios.get(`api/getLogin?user=${this.user}&password=${this.password}`);

      if(status != 200){
        Alert.showErrorMessage(this);
        return;
      }
      if(data.status == "1" || data.status == "2"){
        Alert.showErrorMessage(this,data.msj);
        return;
      }

      //Alert.showSuccessMessage(this,'Ingreso correcto');
      this.$router.push({ name: 'main' });
    },
  },
};
</script>