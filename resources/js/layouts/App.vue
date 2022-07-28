<template>
  <section>

    <div class="d-flex justify-content-center gap-4">
      <router-link to="/" class="btn btn-primary text-white">HOME</router-link>
      <router-link to="/advanced-search" class="btn btn-primary text-white">ADVANCED SEARCH</router-link>
    </div>
    <router-view></router-view>

  </section>
</template>

<script>

export default {
  name: "App",
};
</script>

<style lang="scss" scoped>

</style>