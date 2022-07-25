<template>
  <section>
    <Home :apartments="apartments"/>
  </section>
</template>

<script>
import Home from '../Pages/Home.vue';
export default {
  components: {Home},
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
        //console.log(this.apartments);
      });
    },
  },
  mounted() {
    this.callAPI();
  },
};
</script>

<style lang="scss" scoped>

</style>