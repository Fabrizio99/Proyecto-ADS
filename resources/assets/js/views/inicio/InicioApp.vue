<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px;">
             <navigation/>
         </div>
     </div>
</template>

<script>
import Appbar from '../../components/AppBar'
import Navigation from '../../components/NavigationComponent';

export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation
    }
}
</script>