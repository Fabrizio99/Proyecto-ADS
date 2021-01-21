<template>
<div class="navigation-component">
    <div style="width: 100%;
    height: 100%;"  @click="closeNavigation"></div>
    <div class="navigation-menu">
        <img src="images/logo.png" id="logo">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header navigation-header" id="heading1">
                <div class="text-left w-100" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                    <i class="fa fa-house-user fa-lg navigation-icon"></i><span class="navigation-title">Mantenimiento</span>
                </div>
            </div>
            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordionExample">
                <div class="navigation-item" @click="changeView1">Gestión de Usuarios</div>
                <div class="navigation-item">Gestión de Productos</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header navigation-header" id="heading2">
                <div class="text-left w-100" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                    <i class="fas fa-user-cog fa-lg"></i><span class="navigation-title">Operaciones</span>
                </div>
            </div>
            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
                <div class="navigation-item">Emitir Nota de Venta</div>
                <div class="navigation-item" @click="changeView3">Emitir Boleta de Venta</div>
                <div class="navigation-item" @click="changeView2">Entregar Productos</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header navigation-header" id="heading3">
                <div class="text-left w-100" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    <i class="fa fa-chart-line fa-lg"></i><span class="navigation-title">Reportes</span>
                </div>
            </div>
            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
                <div class="navigation-item">Ventas Finales del Día</div>
                <div class="navigation-item">Inventario</div>
                <div class="navigation-item">Balance de Ventas</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header navigation-header" id="heading4">
                <div class="text-left w-100" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    <i class="fas fa-exclamation-triangle fa-lg"></i><span class="navigation-title">Reclamos</span>
                </div>
            </div>
            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
                <div class="navigation-item">Registrar Reclamos</div>
            </div>
        </div>
    </div>    
</div>
  </div>
</template>
<script>
import { TimelineLite } from 'gsap'
export default {
  methods: {
    changeView1() {
      this.closeNavigation();
      this.$router.push({ name: "user" });
    },
    changeView2() {
      this.closeNavigation();
      this.$router.push({ name: "formBolProd" }); 
    },
    changeView3() {
      this.closeNavigation();
      this.$router.push({ name: "formNVB" }); 
    },
    closeNavigation(){
        //esta función es para ocultar la barra de navegacion, por favor NO TOCAR XD
        const timeline = new TimelineLite()
        timeline.fromTo(".navigation-component",
            {
                opacity : 1,
                display : 'block'
            }, {
                opacity : 0,
                display : 'none',
                duration : 0.1
            }
        ); 
        timeline.fromTo(".navigation-menu",{
                x :  300,
                opacity : 1
            }, {
                x : 0,
                opacity : 0,
                duration : 0.3
            }
        );
    }
  },
};
</script>