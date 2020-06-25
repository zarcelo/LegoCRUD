<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12" v-for="(item, index) in legos" :key="index">
        <div class="row">
          <div class="col col-12">
            <div class="card text-black border-primary mb-3">
              <div class="card-header">
                {{ item.name }}
                <span
                  class="badge badge-primary float-right"
                >{{ since(item.updated_at) }}</span>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <img :src="item.url" class="img-rounded" alt width="100px" />
                  </div>
                  <div class="col-sm-8">
                    <h5 class="card-title">{{ item.description }}</h5>
                    <p class="card-text">{{ item.type }}</p>
                    <p class="card-text">
                      <button class="btn btn-warning btn-sm" @click="editForm(item, index)">Editar</button>
                      <button
                        class="btn btn-danger btn-sm"
                        @click="handleDelete(item, index)"
                      >Eliminar</button>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="allerrors!=[]" :class="['alert alert-danger']" role="alert">
      <ul>
        <li v-for="(error, index) in allerrors" :key="index">{{ error[0] }}</li>
      </ul>
    </div>

    <div v-if="success" :class="['alert alert-success']" role="alert">Se ha guardado correctamente!</div>

    <form @submit.prevent="handleEdit(lego)" v-if="modoEdit">
      <div class="card border-warning mb-3">
        <div class="card-header">Editar lego</div>
        <div class="card-body">
          <input type="text" class="form-control mb-2" placeholder="Name" v-model="lego.name" />
          <input
            type="text"
            class="form-control mb-2"
            placeholder="Description"
            v-model="lego.description"
          />
          <select v-model="lego.type" class="form-control mb-2">
            <option selected disabled value="0">Seleccionar...</option>
            <option v-for="type in types" v-bind:key="type.value">{{ type.text }}</option>
          </select>
          <input type="text" class="form-control mb-2" placeholder="URL" v-model="lego.url" />
          <button class="btn btn-warning" type="submit">Actualizar</button>
          <button class="btn btn-danger" type="submit" @click="cancelForm">Cancelar</button>
        </div>
      </div>
    </form>

    <form @submit.prevent="handleCreate()" v-else>
      <div class="card border-primary mb-3">
        <div class="card-header">Agregar lego</div>
        <div class="card-body">
          <input type="text" class="form-control mb-2" placeholder="Name" v-model="lego.name" />
          <input
            type="text"
            class="form-control mb-2"
            placeholder="Description"
            v-model="lego.description"
          />
          <select v-model="lego.type" class="form-control mb-2">
            <option selected disabled value="0">Seleccionar...</option>
            <option v-for="type in types" v-bind:key="type.value">{{ type.text }}</option>
          </select>
          <input type="text" class="form-control mb-2" placeholder="URL" v-model="lego.url" />
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </div>
    </form>
    <hr />
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import toastr from "toastr";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import { BModal, VBModal } from "bootstrap-vue";

export default {
  data() {
    return {
      legos: [],
      lego: { name: "", description: "", url: "", type: "" },
      modoEdit: false,
      allerrors: "",
      success: false,
      types: [
        { value: "Villain", text: "Villain" },
        { value: "Hero", text: "Hero" }
      ]
    };
  },
  created() {
    this.getLegos();
  },

  methods: {
    async getLegos() {
      try {
        await axios.get("/api/legos").then(res => {
          this.legos = res.data;
        });
      } catch (error) {
        console.log(error);
        toastr.error("Error");
      }
    },
    clearForm() {
      this.lego = { name: "", description: "", url: "", type: "" };
    },
    editForm(item) {
      this.lego.name = item.name;
      this.lego.description = item.description;
      this.lego.url = item.url;
      this.lego.type = item.type;
      this.lego.id = item.id;
      this.modoEdit = true;
    },
    cancelForm(item) {
      this.modoEdit = false;
      this.clearForm();
    },
    async handleEdit(lego) {
      const params = {
        name: lego.name,
        description: lego.description,
        url: lego.url,
        type: lego.type
      };
      try {
        await axios.put(`/api/legos/${lego.id}`, params).then(res => {
          this.modoEdit = false;

          const index = this.legos.findIndex(item => item.id === lego.id);
          this.getLegos();
        });
        this.clearForm();
      } catch (error) {
        console.log(error);
        toastr.error("Error");
      }
    },
    async handleCreate() {
      const newLego = this.lego;
      this.clearForm();
      try {
        await axios
          .post("/api/legos", newLego)
          .then(res => {
            const legoServidor = res.data;
            this.legos.push(legoServidor);
            this.clearForm();
            this.success = true;
            this.allerrors = "";
          })
          .catch(error => {
            this.allerrors = error.response.data.errors;
            this.success = false;
          });
      } catch (error) {
        console.log(error);
        toastr.error("Error");
      }
    },
    async handleDelete(lego, index) {
      try {
        await axios.delete(`api/legos/${lego.id}`).then(() => {
          this.legos.splice(index, 1);
        });
      } catch (error) {
        console.log(error);
        toastr.error("Error");
      }
    },
    since: function(d) {
      return moment(d)
        .locale("es")
        .fromNow();
    }
  }
};
</script>
