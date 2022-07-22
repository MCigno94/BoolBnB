<template>
  <h1>ciao</h1>
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
        let apart = res.data
        this.apartments = apart
        console.log(apart);
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