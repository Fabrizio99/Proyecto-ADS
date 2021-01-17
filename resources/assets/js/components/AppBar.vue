<template>
    <div class="appbar-container">
        <p class="appbar-title">Sistema de Ventas Dulcekat</p>
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Fabrizio Condori
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" style="cursor:pointer" @click="logout">Cerrar Sesión</a>
            </div>
        </div>
    </div>    
</template>
<script>
    export default {
        methods : {
            logout(){
                this.$router.push({name:"login"});
            }
        }
    }
</script>