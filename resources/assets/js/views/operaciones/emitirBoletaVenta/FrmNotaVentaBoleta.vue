<template>
  <div>
    <app-bar />
    <div style="margin-top: 80px">
      <navigation />
      <div style="height: calc(100vh - 80px); overflow-y: scroll" class="pt-4">
        <div class="row mx-4">
          <h3 class="col">Notas de Ventas</h3>
        </div>
        <div class="row mx-4">
          <div class="card col bg-light">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-9">
                  <label for="exampleInputPassword1">Código</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputPassword1"
                    v-model="inputcodenventa"
                  />
                </div>
                <div class="form-group col-3 mt-2 row">
                  <div class="col-10">
                    <input
                      type="button"
                      class="btn btn-primary btn-block mt-4 btnbuscar"
                      value="BUSCAR"
                      @click="buscarNotaVenta"
                    />
                  </div>
                  <div class="col-2">
                    <input
                      type="button"
                      class="btn btn-danger btn-block mt-4 btnbuscar"
                      value="X"
                      @click="getNotasVenta"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mx-4 mt-4">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">N°</th>
                <th scope="col">Código</th>
                <th scope="col">Nombre del Cliente</th>
                <th scope="col">Estado</th>
                <th scope="col">Monto</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(notaventa, index) in listanotaventas"
                :key="notaventa.Codigo"
              >
                <td scope="row">{{ index + 1 }}</td>
                <td>{{ notaventa.Codigo }}</td>
                <td>{{ notaventa.Cliente }}</td>
                <td>{{ notaventa.estado }}</td>
                <td>S/.{{ Number(notaventa.MontoTotal).toFixed(2) }}</td>
                <td class="option text-center">
                  <div class="dropdown">
                    <div
                      class="btn btn-danger"
                      id="dropdownMenuButton"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="fas fa-ellipsis-v"></i>
                    </div>
                    <div
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuButton"
                    >
                      <a
                        class="dropdown-item"
                        @click="detallenVenta(notaventa, 'ver')"
                        v-if="
                          notaventa.estado == 'ATENDIDO' ||
                          notaventa.estado == 'ELIMINADO'
                        "
                        >Ver detalles</a
                      >
                      <!--<a
                        class="dropdown-item"
                        v-if="notaventa.estado == 'POR ATENDER'"
                        @click="detallenVenta(notaventa, 'editar')"
                        >Editar</a
                      >-
                      <a
                        class="dropdown-item"
                        v-if="notaventa.estado == 'POR ATENDER'"
                        @click="openDeleteModal(notaventa.Codigo)"
                        >Anular</a
                      >-->
                      <a
                        class="dropdown-item"
                        v-if="notaventa.estado == 'POR ATENDER'"
                        @click="registrarPago(notaventa)"
                        >Registrar Pago</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="deleteModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ¿Desea anular nota de venta NV-{{ idNotaEliminar }}?
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
              @click="confirmDeleteNotaVenta"
            >
              Aceptar
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="PagoModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Realizar pago</h5>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-group col-6">
                <label>Tipo de pago</label>
                <select name="select" class="form-control" v-model="tipoPago">
                  <option value="1">Efectivo</option>
                  <option value="2">YAPE</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              @click="openRegistrarPago"
            >
              Seleccionar
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="efectivoModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar Pago</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group col-12">
                <label for="exampleInputPassword1">Tipo de Pago</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputPassword1"
                  value="Efectivo"
                  disabled
                />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-4">
                <label for="exampleInputPassword1">Monto a pagar (S/.)</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputPassword1"
                  :value="
                    Number(
                      notaSeleccionada ? notaSeleccionada.MontoTotal : 0
                    ).toFixed(2)
                  "
                  disabled
                />
              </div>
              <div class="form-group col-4">
                <label for="exampleInputPassword1">Monto recibido (S/.)</label>
                <input
                  type="number"
                  class="form-control"
                  id="exampleInputPassword1"
                  v-model="monto"
                />
              </div>
              <div class="form-group col-4">
                <label for="exampleInputPassword1">Vuelto (S/.)</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputPassword1"
                  :value="vuelto"
                  disabled
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="saveEfectivo">
              Registrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="yapeModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar Pago</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group col-12">
                <label for="exampleInputPassword1">Tipo de Pago</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputPassword1"
                  value="YAPE"
                  disabled
                />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-4">
                <label for="exampleInputPassword1">Monto a pagar (S/.)</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputPassword1"
                  :value="
                    Number(
                      notaSeleccionada ? notaSeleccionada.MontoTotal : 0
                    ).toFixed(2)
                  "
                  disabled
                />
              </div>
              <div class="form-group col-8">
                <label for="exampleInputPassword1">Nro de teléfono</label>
                <input
                  type="number"
                  class="form-control"
                  id="exampleInputPassword1"
                  v-model="telefono"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="saveYape">
              Registrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import Appbar from "../../../components/AppBar";
import Navigation from "../../../components/NavigationComponent";
import data from "../../../data";
import usuario from "../../../user";
import fechaActual from '../../../fecha';
import { jsPDF } from "jspdf";

export default {
  components: {
    "app-bar": Appbar,
    navigation: Navigation,
  },
  data() {
    return {
      listanotaventas: [],
      inputcodenventa: "",
      idNotaEliminar: undefined,
      tipoPago: undefined,
      notaSeleccionada: undefined,
      monto: 0,
      telefono : '',
      fecha : fechaActual
    };
  },
  computed: {
    vuelto() {
      if (
        Number(this.monto) <=
        Number(
          this.notaSeleccionada ? this.notaSeleccionada.MontoTotal : 0
        ).toFixed(2)
      ) {
        return "-";
      } else {
        return Number(
          this.monto -
            Number(
              this.notaSeleccionada ? this.notaSeleccionada.MontoTotal : 0
            ).toFixed(2)
        ).toFixed(2);
      }
    },
  },
  methods: {
    pdf(tipoPago,boleta=0){
      let row = 0;
      const doc = new jsPDF({
        orientation: "portrait",
        unit: "cm",
        format: [10, 20]
      });
      doc.setFontSize(12);
      doc.text("DULCEKAT", 4, ++row);
      doc.text("Plaza Villa Sur, puesto A-29", 2.3, ++row);
      doc.setFontSize(10);
      doc.text("Boleta de Venta BV-"+boleta, 3.3, ++row);
      doc.text("",1,++row);
      doc.text("Fecha y hora : "+this.fecha,1,++row);
      doc.text('Pago: '+tipoPago,1,++row);
      if(this.telefono){
        doc.text('Nro. Teléfono: '+this.telefono,1,++row);
      }
      doc.text("Cliente :      "+this.notaSeleccionada.Cliente,1,++row);
      doc.text("Producto            | P.U. | Cantidad | Total",1,++row);
      let productos = JSON.parse(this.notaSeleccionada.Productos);
      productos.forEach(p => {
        doc.text(p.producto.padEnd(20)+'| '+p.precio+' | S/. '+p.cantidad+' | S/.'+p.PrecioTotal,1,++row);
      });
      doc.text('Total: S/.'+Number(this.notaSeleccionada.MontoTotal).toFixed(2),1,++row);
      doc.text('Monto recibido: '+(!this.monto?Number(this.notaSeleccionada.MontoTotal).toFixed(2):Number(this.monto).toFixed(2)),1,++row);
      doc.text('Vuelto: S/.'+Number((!this.monto?Number(this.notaSeleccionada.MontoTotal).toFixed(2):Number(this.monto).toFixed(2)) - Number(this.notaSeleccionada.MontoTotal).toFixed(2)).toFixed(2),1,++row);
      doc.save("boleta.pdf",);
    },
    async saveYape(){
      if(!this.telefono){
        alert('Error: Ingrese el número de teléfono');
      }else{
        const body = {
          montoPagar   : this.notaSeleccionada.MontoTotal,
          notaIdBv     : this.notaSeleccionada.Codigo,
          tipopago     : this.tipoPago,
          listProduct  : this.notaSeleccionada.Productos,
          telefonoYape : this.telefono,
          token : usuario.getData().token
        }

        const response = await axios.post('api/registrarPago',body);
        console.log({response});
        if(typeof response.data == 'string'){
          alert('Mensaje: '+response.data);
        }else if(response.data.status == "0"){
          let idBoleta = JSON.parse(response.data.id_boleta);
          this.pdf('Yape',idBoleta.data.N);
          $("#yapeModal").modal("hide");
          alert('Mensaje: '+response.data.msj);
          this.getNotasVenta();
          this.tipoPago = undefined;
          this.telefono = '';
        }else{
            alert('Error: '+response.data.msj);
        }
      }
    },
    async saveEfectivo() {
      if (!this.monto || this.monto.trim() == "") {
        alert("Error: Ingrese el monto recibido");
      } else if (isNaN(this.monto)) {
        alert("Error: Ingrese un monto válido");
      } else {
        const body = {
          montoPagar   : this.notaSeleccionada.MontoTotal,
          notaIdBv     : this.notaSeleccionada.Codigo,
          tipopago     : this.tipoPago,
          listProduct  : this.notaSeleccionada.Productos,
          token : usuario.getData().token
        }
        console.log('objeto ',body);
        const response = await axios.post('api/registrarPago',body);
        console.log('respuesta ',response);
        if(typeof response.data == 'string'){
          alert('Mensaje: '+response.data);
        }else if(response.data.status == "0"){
          let idBoleta = JSON.parse(response.data.id_boleta);
          this.pdf('Efectivo',idBoleta.data.N);
          $("#efectivoModal").modal("hide");
          alert('Mensaje: '+response.data.msj);
          this.getNotasVenta();
          this.tipoPago = undefined;
          this.monto = '';
        }else{
            alert('Error: '+response.data.msj);
        }
        
      }
    },
    openRegistrarPago() {
      if (!this.tipoPago) {
        alert("Error: Debe seleccionar un tipo de pago");
        return;
      }
      $("#PagoModal").modal("hide");
      if (this.tipoPago == "1") {
        $("#efectivoModal").modal("show");
      } else {
        $("#yapeModal").modal("show");
      }
    },
    async confirmDeleteNotaVenta() {
      const body = {
        notaIdBv: this.idNotaEliminar,
        token: usuario.getData().token,
      };
      let response = await axios.post("api/eliminarNV", body);
      if (typeof response.data == "string") {
        alert("Error: " + response.data);
      }
      if (response.data.status == "0") {
        alert("Mensaje: Anulado correctamente");
        this.getNotasVenta();
      } else {
        alert("Error: " + response.data.msj);
      }
    },
    openDeleteModal(id) {
      this.idNotaEliminar = id;
      $("#deleteModal").modal("show");
    },
    async buscarNotaVenta() {
      if (this.inputcodenventa.trim() != "") {
        let response = await axios.get(
          "api/buscaNotaVByFechas?notaVid=" +
            this.inputcodenventa.trim() +
            "&token=" +
            usuario.getData().token
        );
        console.log("respuesta nota de ventas ", response);
        this.inputcodenventa = "";
        if (response.data.status == "0") {
          this.listanotaventas = Array.isArray(response.data.data)
            ? response.data.data
            : [response.data.data];
          if (this.listanotaventas.length == 0) {
            alert("Error: No se encuentra la nota de venta");
          }
        } else {
          this.listanotaventas = [];
          alert("Error: " + response.data.msj);
        }
      }
    },

    detallenVenta(nota_venta, tipo) {
      data.setSelectedNV({ tipo, nota_venta });
      this.$router.push({ path: "/formulario-detalle-notaVenta" });
    },

    Buscar() {
      this.$swal({
        icon: "error",
        title: "Error",
        text: "No hay resultados",
      });
    },

    registrarPago(nota) {
      this.notaSeleccionada = nota;
      $("#PagoModal").modal("show");
    },

    /*VerDetalle(){
             this.$router.push({name:"formDetalleNV"});
        },*/

    async getNotasVenta() {
      this.Inputcodigo = "";
      let response = await axios.get(
        "api/listaNotaV?token=" + usuario.getData().token
      );
      console.log("respuesta ", response);
      if (response.data.status == "0") {
        //todo bien
        this.listanotaventas = Array.isArray(response.data.data)?response.data.data:[response.data.data];
      } else {
        alert("Error: " + response.data.msj);
      }
    },
  },

  mounted() {
    this.getNotasVenta();
  },
};
</script>