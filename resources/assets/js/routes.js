import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginComponent from './components/LoginComponent'
import LogoutComponent from './components/LogoutComponent'
import VueSweetalert2 from 'vue-sweetalert2';
import usuario from "./user";

Vue.use(VueSweetalert2);

Vue.use(VueRouter)

const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err)
};

const routes = [
    {
        path: '/',
        redirect: { name: 'login' }
    },
    {
        path: '/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/logout',
        name: 'logout',
        component: LogoutComponent
    },
    {
        path: '/inicio',
        name: 'main',
        component: require('../js/views/inicio/InicioApp.vue')
    },
    {
        path: '/usuarios',
        name: 'user',
        component: require('../js/views/mantenimiento/usuarios/UsuariosApp.vue'),
        meta : {
            module : 'usuario'
        }
    },
    {
        path: '/formulario-usuario/:accion',
        name: 'formUser',
        component: require('../js/views/mantenimiento/usuarios/FormUsuario'),
        props: true,
        meta : {
            module : 'usuario'
        }
    },
    {
        path: '/gestion-productos',
        name: 'gproductos',
        component: require('../js/views/mantenimiento/productos/ProductoApp.vue'),
        meta : {
            module : 'producto'
        }
    },
    {
        path: '/formulario-productos/:accion',
        name: 'crearproductos',
        component: require('../js/views/mantenimiento/productos/formCrearProducto.vue'),
        props: true,
        //meta: { requiresAuth: true }
    },
    {
        path: '/form-modificar-productos',
        name: 'modificarproductos',
        component: require('../js/views/mantenimiento/productos/formModificarProducto.vue'),
        meta : {
            module : 'producto'
        }
    },
    {    
        path: '/formulario-boletas-productos',
        name: 'formBolProd',
        component: require('../js/views/operaciones/entregarProductos/FrmBoletaProductos.vue'),
        meta : {
            module : 'entregar producto'
        }
    },
    {
        path: '/formulario-lista-productos',
        name: 'formProductos',
        component: require('../js/views/operaciones/entregarProductos/FrmListaProductos.vue'),
        meta : {
            module : 'entregar producto'
        }
    },
    {
        path: '/formulario-notaVenta-boletas',
        name: 'formNVB',
        component: require('../js/views/operaciones/emitirBoletaVenta/FrmNotaVentaBoleta.vue'),
        meta : {
            module : 'emitir boleta de venta'
        }
    },
    {
        path: '/formulario-detalle-notaVenta',
        name: 'formDetalleNV',
        component: require('../js/views/operaciones/emitirBoletaVenta/FrmDetalleNV.vue'),
        meta : {
            module : 'emitir nota de venta'
        }
    },
    {
        path: '/nota-venta',
        name: 'notaVenta',
        component: require('../js/views/operaciones/emitirNotaVenta/EmitirNotaVenta'),
        meta : {
            module : 'emitir nota de venta'
        }
    },
    {
        path: '/formulario-inventario',
        name: 'inventario',
        component: require('../js/views/reportes/InventariosApp.vue'),
        meta : {
            module : 'inventario'
        }
    },
    {
        path: '/formulario-ventafinal',
        name: 'VF',
        component: require('../js/views/reportes/ventafinal/VentasFinales.vue'),
        meta : {
            module : 'venta finales del dia'
        }
    },
    
    {
        path: '/reclamos',
        name: 'reclamos',
        component: require('../js/views/reclamos/ReclamosApp.vue'),
        meta : {
            module : 'registrar reclamo'
        }
    },
    {
        path : '/error',
        name : 'error',
        component : require('../js/components/ErrorPage'),
    },
    {
        path : '*',
        name : '404',
        component : require('../js/components/404page'),
    }

]


const router = new VueRouter({
    routes
})
  
router.beforeEach((to, from, next) => {
    next();
    /*if(!usuario.getData()){
        if(to.name != 'login'){
            next({ name: 'login' });
        }else{
            next();
        }
    }else{
        if(to.name == 'login'){
            next(false);
        }else if(to.name == 'main' || to.name == 'error'){
            next();
        }else{
            let {permisos} = usuario.getData();
            if(permisos && permisos.includes(to.meta.module)){
                next();
            }else{
                next({ name: 'error' });
            }
        }
    }*/
})

export default router