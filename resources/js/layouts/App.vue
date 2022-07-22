<template>
  <section class="container">
    <div class="row py-4 gy-5">
      <div 
      class="col"
      v-for="apartment in apartments"
      :key="apartment.id"
      >
        <div class="card" style="width: 18rem;">
          <img :src="`storage/${apartment.img}`" class="card-img-top" alt="">
          <div class="card-body">
            <h5 class="card-title">{{apartment.title}}</h5>
            <p class="card-text">{{apartment.address}}</p>
            <p>{{apartment.rooms_number}}</p>
            <font-awesome-icon icon="fa-solid fa-bed" />
            <p>{{apartment.beds_number}}</p>
            <a href="#" class="btn btn-danger">INFO</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios'

export default {
  name: 'App',
  data(){
    return{
      apartments: [],
    }
  },
  methods:{
    callAPI(){
      axios
      .get('api/apartments')
      .then((res) =>{
        let apart = res.data.data
        this.apartments = apart;
        console.log(this.apartments);

      })
    }
  },
  mounted(){
    this.callAPI()
  }
}
</script>

<style lang="scss" scoped>

</style>