<template>
  <section>
    <div
      class="
        jumbotron
        d-flex
        flex-column
        justify-content-center
        align-items-center
      "
    >
      <div class="cta">
        <h1 class="display-3 text-light text-center">Trova la tua destinazione da sogno</h1>
      </div>
      <div class="searchbox w-100 d-flex justify-content-center gap-2">
        <input type="text" name="" id="" />
        <button class="btn btn-danger text-white">Search</button>
      </div>
      <router-link class="advancedSearch text-danger">
        Advanced Search
      </router-link>
    </div>
    <div class="container my-5 px-4">
      <div class="row my-5 gy-3">
        <div class="col" v-for="apartment in apartments" :key="apartment.id">
          <div class="card" style="width: 18rem">
            <img
              :src="`storage/${apartment.img}`"
              class="card-img-top"
              alt=""
            />
            <div class="card-body">
              <h5 class="card-title">{{ apartment.title }}</h5>
              <p class="card-text">{{ apartment.address }}</p>
              <p>{{ apartment.rooms_number }}</p>
              <font-awesome-icon icon="fa-solid fa-bed" />
              <p>{{ apartment.beds_number }}</p>
              <a href="#" class="btn btn-danger">View</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";

export default {
  name: "App",
  data() {
    return {
      apartments: [],
    };
  },
  methods: {
    callAPI() {
      axios.get("api/apartments").then((res) => {
        let apart = res.data.data;
        this.apartments = apart;
        console.log(this.apartments);
      });
    },
  },
  mounted() {
    this.callAPI();
  },
};
</script>

<style lang="scss" scoped>
.jumbotron {
  height: 500px;
  background-image: url("https://www.dailynautica.com/wp-content/uploads/2018/01/zakynthos__imperialspavilla_09.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.35);
  input {
    width: 30%;
    border-radius: 10px;
    border: none;
  }
  h1 {
    text-shadow: 3px 3px black;
  }
  .advancedSearch{
    text-shadow: 1px 1px black;
  }
}

.container {
  background-color: white;
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.35);
}

</style>