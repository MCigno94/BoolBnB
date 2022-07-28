<template>
  <section>

    <div class="d-flex justify-content-center gap-4">
      <router-link to="/" class="btn btn-primary text-white">HOME</router-link>
      <router-link to="/search" class="btn btn-primary text-white">Go to Search</router-link>
    </div>
    <router-view></router-view>

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