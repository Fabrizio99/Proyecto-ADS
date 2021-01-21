import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginComponent from './components/LoginComponent'
import LogoutComponent from './components/LogoutComponent'
import store from './store'
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);

Vue.use(VueRouter)

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
        path: '/otravista',
        name: 'alternate',
        component: require('../js/views/mantenimiento/MantenimientoApp.vue')
    },
    {
        path: '/usuarios',
        name: 'user',
        component: require('../js/views/mantenimiento/usuarios/UsuariosApp.vue')
    },
    {
        path: '/formulario-usuario',
        name: 'formUser',
        component: require('../js/views/mantenimiento/usuarios/FormUsuario')
    },
    {
        path: '/gestion-productos',
        name: 'gproductos',
        component: require('../js/views/mantenimiento/productos/ProductoApp.vue')
    },
    {
        path: '/form-crear-productos',
        name: 'crearproductos',
        component: require('../js/views/mantenimiento/productos/formCrearProducto.vue')
    },
    {
        path: '/form-modificar-productos',
        name: 'modificarproductos',
        component: require('../js/views/mantenimiento/productos/formModificarProducto.vue')
    }
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
    console.log('LLEGO ACA????');
    //random comment to check if clone branch works
    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        Vue.swal('Hello Vue world!!!');
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