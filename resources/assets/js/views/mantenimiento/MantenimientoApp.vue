<template>
     <div>
         <app-bar/>
         <div style="margin-top: 80px" class="main-container">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">
                <div class="row mx-4">
                    <h3 class="col">
                        Otra vistaaaaaaaaaa
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="card col">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Campo 2</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Campo 2</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Campo 2</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4" value="BUSCAR"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4 mt-4">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">kdfbksdf</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
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
<style scoped>
.main-container{
    display: grid;
    grid-template-columns : 300px auto;
}
</style>