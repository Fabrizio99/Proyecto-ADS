<template>
    <div class="appbar-container">
        <div class="left-appbar-container">
            <i class="fas fa-bars appbar-menu"  @click="openNavigation"></i>
            <p class="appbar-title">Sistema de Ventas Dulcekat</p>
        </div>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Fabrizio Condori
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" @click="logout">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</template>
<script>
import { TimelineLite } from 'gsap'
export default {
    methods : {
        logout(){
            this.$router.push({name:"login"});
        },
        openNavigation(){
            //esta función es para mostrar la barra de navegacion, por favor NO TOCAR XD
            const timeline = new TimelineLite()
            timeline.fromTo(".navigation-component",
                {
                    opacity : 0,
                    display : 'none'
                }, {
                    opacity : 1,
                    display : 'block',
                    duration : 0.1
                }
            ); 
            timeline.fromTo(".navigation-menu",{
                    x :  0,
                    opacity : 0
                }, {
                    x : 300,
                    opacity : 1,
                    duration : 0.3
                })
        }
    },
}
</script>