<template>
<div class="navigation-component">
    <img src="images/logo.png" id="logo">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header navigation-header" id="heading1">
                <div class="text-left w-100 dropdown-toggle" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                    <i class="fa fa-house-user fa-lg navigation-icon"></i><span class="navigation-title">Mantenimiento</span>
                </div>
            </div>
            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordionExample">
                <div class="navigation-item">Gestión de Usuarios</div>
                <div class="navigation-item">Gestión de Productos</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header navigation-header" id="heading2">
                <div class="text-left w-100 dropdown-toggle" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                    <i class="fas fa-user-cog fa-lg"></i><span class="navigation-title">Operaciones</span>
                </div>
            </div>
            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
                <div class="navigation-item">Emitir Nota de Venta</div>
                <div class="navigation-item">Emitir Boleta de Venta</div>
                <div class="navigation-item">Entregar Productos</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header navigation-header" id="heading3">
                <div class="text-left w-100 dropdown-toggle" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
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
                <div class="text-left w-100 dropdown-toggle" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    <i class="fas fa-exclamation-triangle fa-lg"></i><span class="navigation-title">Reclamos</span>
                </div>
            </div>
            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
                <div class="navigation-item">Registrar Reclamos</div>
            </div>
        </div>
    </div>
    <!--<p @click="changeView">opciones</p>
        <p @click="openUser">Usuarios</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>
        <p>opciones</p>-->
  </div>
</template>
<script>
export default {
  methods: {
    changeView() {
      this.$router.push({ name: "alternate" });
    },
    openUser() {
      this.$router.push({ name: "user" });
    },
  },
};
</script>
<style scoped>
.navigation-header{
    display: flex;
    align-items: center;
}
.navigation-header div{
    cursor: pointer;
}
.navigation-icon{
    font-size: 20px;
}
.navigation-title{
    font-size: 18px;
    margin-left: 9px;
}
.navigation-item{
    padding: 10px 0 10px 50px;
    border-bottom: 1px solid rgba(0,0,0,0.08);
    font-size: 15px;
    color: rgba(0,0,0,0.8);
    cursor: pointer;
}
.collapse .navigation-item:last-child{
    border-bottom: 0;
}
</style>