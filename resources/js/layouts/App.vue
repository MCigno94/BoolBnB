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
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 my-5 gy-3">
        <div class="col d-flex justify-content-center" v-for="apartment in apartments" :key="apartment.id">
          <div class="my-card pt-3">
            <div class="img">
                <img
                :src="`storage/${apartment.img}`"
                class="my-card-img"
                alt=""
              />
            </div>
            <div class="my-card-body d-flex flex-column">
              <p class="title fw-bold pb-1">{{ apartment.title }}</p>
              <p class="address text-secondary">{{ apartment.address }}</p>
              <div class="d-flex gap-3 text-secondary pt-2">
                <p class="rooms">Rooms: {{ apartment.rooms_number }}</p>
                <p class="beds">Beds: {{ apartment.beds_number }}</p>
              </div>
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
  background-image: url("https://a0.muscache.com/im/pictures/1871687b-fc5b-47eb-a70b-99011f46593d.jpg?im_w=1440");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
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
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
}

/* CARD */
.col{
  border-radius: 15px;
  transition: all .3s ease-in-out;
  &:hover {background-color: rgba(207, 207, 207, 0.308);}
  &:hover img{transform: scale(1.05);}
  cursor: pointer;
  .my-card{
    transition: all .4s ease-in-out;
    position: relative;
    p{padding: 0; margin: 0;}
    .img{
      overflow: hidden;
      border-radius: 15px;
      img{
        transition: all .3s ease-in-out;
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
      }
    }
    .my-card-body{
      height: 150px;
      padding: 10px;
    }
  }
}
</style>