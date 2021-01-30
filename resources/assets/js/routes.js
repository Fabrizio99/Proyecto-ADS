import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginComponent from './components/LoginComponent'
import LogoutComponent from './components/LogoutComponent'
import store from './store'
import VueSweetalert2 from 'vue-sweetalert2';

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
    /*{
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardComponent,
        meta: { requiresAuth: true }
    },*/
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
        //meta: { requiresAuth: true }
    },
    {
        path: '/formulario-usuario/:accion',
        name: 'formUser',
        component: require('../js/views/mantenimiento/usuarios/FormUsuario'),
        props: true,
        //meta: { requiresAuth: true }
    },
    {
        path: '/gestion-productos',
        name: 'gproductos',
        component: require('../js/views/mantenimiento/productos/ProductoApp.vue'),
        //meta: { requiresAuth: true }
    },
    {
        path: '/form-crear-productos',
        name: 'crearproductos',
        component: require('../js/views/mantenimiento/productos/formCrearProducto.vue'),
        //meta: { requiresAuth: true }
    },
    {
        path: '/form-modificar-productos',
        name: 'modificarproductos',
        component: require('../js/views/mantenimiento/productos/formModificarProducto.vue'),
        //meta: { requiresAuth: true }
    },
    {    
        path: '/formulario-boletas-productos',
        name: 'formBolProd',
        component: require('../js/views/operaciones/entregarProductos/FrmBoletaProductos.vue'),
        //meta: { requiresAuth: true }
    },
    {
        path: '/formulario-lista-productos',
        name: 'formProductos',
        component: require('../js/views/operaciones/entregarProductos/FrmListaProductos.vue'),
        //meta: { requiresAuth: true }
    },
    {
        path: '/formulario-notaVenta-boletas',
        name: 'formNVB',
        component: require('../js/views/operaciones/emitirBoletaVenta/FrmNotaVentaBoleta.vue'),
        //meta: { requiresAuth: true }
    },
    {
        path: '/formulario-detalle-notaVenta',
        name: 'formDetalleNV',
        component: require('../js/views/operaciones/emitirBoletaVenta/FrmDetalleNV.vue'),
        //meta: { requiresAuth: true }
    },
    {
        path: '/nota-venta',
        name: 'notaVenta',
        component: require('../js/views/operaciones/emitirNotaVenta/EmitirNotaVenta'),
        //meta: { requiresAuth: true }
    },
    {
        path: '/formulario-inventario',
        name: 'inventario',
        component: require('../js/views/reportes/InventariosApp.vue'),
        //meta: { requiresAuth: true }
    },
    {
        path: '/formulario-ventafinal',
        name: 'VF',
        component: require('../js/views/reportes/ventafinal/VentasFinales.vue'),
        //meta: { requiresAuth: true }
    },
    
    {
        path: '/reclamos',
        name: 'reclamos',
        component: require('../js/views/reclamos/ReclamosApp.vue'),
        //meta: { requiresAuth: true }
    },
    {
        path : '*',
        name : '404',
        component : require('../js/components/404page'),
        //meta: { requiresAuth: true }
    }
]


const router = new VueRouter({
    routes
})
  
router.beforeEach((to, from, next) => {
    //random comment to check if clone branch works
    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' })
        return
    }

    // if logged in redirect to dashboard
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'dashboard' })
        return
    }

    if(to.path == from.path)    return;

    next()
})

export default router