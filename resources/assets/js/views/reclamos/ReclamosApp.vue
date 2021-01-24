<template>
    <div>
        <app-bar/>
        <div style="margin-top: 80px">
            <navigation/>
            <div style=" height : calc(100vh - 80px); overflow-y : scroll" class="pt-4">
                <div class="row mx-4 mb-1">
                    <h3 class="col">
                        Buscar Boleta
                    </h3>
                </div>
                <div class="row mx-4">
                    <div class="card col">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-1">
                                    <label for="exampleInputPassword1">Código</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-3">
                                    <label for="exampleInputPassword1">Cliente</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <multiselect
                                    placeholder="Seleccione"
                                    :colSize="2"
                                    label = "Tipo de Documento"
                                    :optionList = "[
                                        {
                                            id   : 1,
                                            name : 'DNI'
                                        },
                                        {
                                            id   : 2,
                                            name : 'CARNET DE EXTRANJERIA'
                                        },
                                    ]"
                                />
                                <div class="form-group col-2">
                                    <label for="exampleInputPassword1">Documento</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" maxlength="7">
                                </div>
                                <div class="form-group col-2">
                                    <label for="exampleInputPassword1">Fecha de compra</label>
                                    <input type="date" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-2 mt-2">
                                    <input type="button" class="btn btn-primary btn-block mt-4 btnbuscar" data-toggle="modal" data-target="#boletasModal" value="BUSCAR"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4 mt-4">
                  <div class="card col">
                        <div class="card-body">
                            <div class="form-row">
                              <h5 class="col">
                                  Boleta: 000243
                              </h5>
                            </div>
                            <div class="form-row">
                                <div class="card col-12">
                                  <div class="card-header">
                                    Datos del consumidor
                                  </div>
                                  <div class="card-body">
                                    <div class="form-row">
                                      <div class="form-group col-4">
                                          <label for="exampleInputPassword1">Cliente</label>
                                          <input type="text" class="form-control" id="exampleInputPassword1" value="Fabrizio Condori" disabled>
                                      </div>
                                      <div class="form-group col-4">
                                          <label for="exampleInputPassword1">Tipo de documento</label>
                                          <input type="text" class="form-control" id="exampleInputPassword1" value="DNI" disabled>
                                      </div>
                                      <div class="form-group col-4">
                                          <label for="exampleInputPassword1">N° Documento</label>
                                          <input type="number" class="form-control" id="exampleInputPassword1" disabled value="12312312">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="card col-12 mt-4">
                                  <div class="card-header">
                                    Datos del reclamo
                                  </div>
                                  <div class="card-body">
                                    <div class="form-row">
                                      <div class="col-6 row">
                                        <div class="form-group col-12">
                                          <label for="exampleInputPassword1">Fecha del reclamo</label>
                                          <input type="date" class="form-control" id="exampleInputPassword1" value="">
                                        </div>
                                        <div class="form-group col-12">
                                          <label for="exampleInputPassword1">Descripción</label>
                                          <input type="text" class="form-control" id="exampleInputPassword1">
                                        </div>
                                      </div>
                                      <div class="col-6 row">
                                        <div class="form-group col-12">
                                          <label for="exampleInputPassword1">Observación</label>
                                          <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-around">
                              <div class="col mt-3">
                                <button class="btn btn-primary btnexaminar" @click="saveComplain">Registrar</button>
                                <button class="btn btn-primary btnexaminar ml-2" data-toggle="modal" data-target="#comprobanteModal" >Comprobante de reclamo</button>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <div class="modal fade" id="comprobanteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog details-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comprobante de reclamo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-12">
                      <label for="exampleInputPassword1">Descripción del reclamo</label>
                      <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                  <div class="form-group col-6">
                      <label for="exampleInputPassword1">Pedido concreto del reclamante</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" value="" disabled>
                  </div>
                  <div class="form-group col-6">
                      <label for="exampleInputPassword1">Encargado</label>
                      <input type="number" class="form-control" id="exampleInputPassword1" disabled value="Ricardo">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Imprimir</button>
              </div>
            </div>
          </div>
        </div>
         <div class="modal fade" id="boletasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog details-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="mx-4 mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">N°</th>
                          <th scope="col">CÓDIGO</th>
                          <th scope="col">CLIENTE</th>
                          <th scope="col">FECHA</th>
                          <th scope="col" style="width : 130px">OPCIONES</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td space="row">1</td>
                          <td>00054</td>
                          <td>Fabrizio Raul Condori Guzman</td>
                          <td>01-12-2020</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-toggle="modal" data-target="#detallesModal">Ver Detalles</a>
                                <a class="dropdown-item" @click="selectBoleta">Seleccionar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td space="row">1</td>
                          <td>00054</td>
                          <td>Fabrizio Raul Condori Guzman</td>
                          <td>01-12-2020</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item">Ver Detalles</a>
                                <a class="dropdown-item">Seleccionar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td space="row">1</td>
                          <td>00054</td>
                          <td>Fabrizio Raul Condori Guzman</td>
                          <td>01-12-2020</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item">Ver Detalles</a>
                                <a class="dropdown-item">Seleccionar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td space="row">1</td>
                          <td>00054</td>
                          <td>Fabrizio Raul Condori Guzman</td>
                          <td>01-12-2020</td>
                          <td class = "option text-center">
                            <div class="dropdown">
                              <div class="btn btn-danger"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </div>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item">Ver Detalles</a>
                                <a class="dropdown-item" @click="selectBoleta">Seleccionar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog details-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Boleta 12345</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                    <div class="card col-12">
                      <div class="card-body">
                        <div class="form-row">
                          <div class="form-group col-6">
                              <label for="exampleInputPassword1">Código</label>
                              <input type="text" class="form-control" id="exampleInputPassword1" value="01234" disabled>
                          </div>
                          <div class="form-group col-6">
                              <label for="exampleInputPassword1">Fecha</label>
                              <input type="date" class="form-control" id="exampleInputPassword1" disabled value="2020-01-24">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="exampleInputPassword1">Cliente</label>
                              <input type="text" class="form-control" id="exampleInputPassword1" disabled value="Fabrizio Raúl Condori Guzman">
                          </div>
                        </div>
                        <div class="form-row">
                          <multiselect
                                    :disabled="true"
                                    :colSize="6"
                                    label = "Tipo de Documento"
                                    :optionList = "[
                                        {
                                            id   : 1,
                                            name : 'DNI'
                                        },
                                        {
                                            id   : 2,
                                            name : 'CARNET DE EXTRANJERIA'
                                        },
                                    ]"

                                />
                          <div class="form-group col-6">
                              <label for="exampleInputPassword1">N° Documento</label>
                              <input type="text" class="form-control" id="exampleInputPassword1" disabled value="70170839">
                          </div>
                        </div>
                      </div>
                    </div>
                    <table class="table col-12">
                      <thead>
                        <tr>
                          <th scope="col">PRODUCTO</th>
                          <th scope="col">CANTIDAD</th>
                          <th scope="col">P. UNITARIO</th>
                          <th scope="col">IMPORTE</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td space="row">Harina</td>
                          <td>3</td>
                          <td>S/2.00</td>
                          <td>S/6.00</td>
                        </tr>
                        <tr>
                          <td space="row">Azúcar</td>
                          <td>1</td>
                          <td>S/3.00</td>
                          <td>S/3.00</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>
<script>
import Appbar from '../../components/AppBar'
import Navigation from '../../components/NavigationComponent';
import Multiselect from '../../components/Multiselect';


export default {
    components : {
        'app-bar'    : Appbar,
        'navigation' : Navigation,
        'multiselect' : Multiselect
    },
    methods : {
        openFormUser(){
          this.$router.push({name:"formUser"});
        },
        saveComplain(){
          this.$swal('Registrado correctamente!','','success');
        },
        selectBoleta(){
          console.log('dfdfd');
          console.log($('#boletasModal'));
          $('#boletasModal').modal('hide');
          $( "body" ).removeClass( "modal-open" );
          $('.modal-backdrop').remove();
          $( "#boletasModal" ).removeClass( "show" ).removeClass("in");
          $( "#boletasModal" ).removeAttr('aria-modal');
          $( "#boletasModal" ).removeAttr('role');
          $( "#boletasModal" ).attr("aria-hidden",true);
          $( "#boletasModal" ).css("display","none");
        }
    },
    mounted(){

    }
}
</script>
<style scoped>
.details-dialog{
  max-width: 70vw !important;
}
</style>