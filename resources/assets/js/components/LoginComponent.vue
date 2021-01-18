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
                                <label for="exampleInputEmail1" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="exampleInputPassword1"/>
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
      email: "",
      password: "",
      loginError: false,
    };
  },
  methods: {
    submitLogin() {
        this.$router.push({name:"main"});
        /*Ejemplo de un modal*/
        /*this.$swal({
  icon: 'error',
  title: 'Error',
  text: 'No se registro el usuario',
});*/


      /*this.loginError = false;
      axios
        .post("/api/auth/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          // login user, store the token and redirect to dashboard
          store.commit("loginUser");
          localStorage.setItem("token", response.data.access_token);
          this.$router.push({ name: "dashboard" });
        })
        .catch((error) => {
          this.loginError = true;
        });*/
    },
  },
};
</script>