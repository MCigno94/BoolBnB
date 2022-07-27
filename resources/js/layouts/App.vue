<template>
  <section>
    <Home/>
  </section>
</template>

<script>
import Home from '../Pages/Home.vue';
export default {
  components: {
    Home
    },
  name: "App",
  data() {
    return {
      apartments: [],
    };
  },
  methods: {

  },
  mounted() {
    /* this.callAPI(); */
  },
};
</script>

<style lang="scss" scoped>

</style>