<template>
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 my-5 gy-3">
            <div class="col d-flex justify-content-center" v-for="apartment in apartments" :key="apartment.id">
                <router-link :to="{name: 'apartment', params: {id: apartment.id}}" class="my-card pt-3">

                    <!-- <h5 v-if="apartment.distance"> {{ (apartment.distance/1000).toFixed(1) }} Km</h5> -->

                    <div class="container">
                        <div class="img">
                        <img :src="((apartment.img === 'Case-moderne.jpg') ? '../../img/Case-moderne.jpg' : `storage/${apartment.img}`)"
                            class="my-card-img" alt="" />
                    </div>

                    <div class="my-card-body d-flex flex-column">
                        <p class="title fw-bold pb-1">{{ apartment.title }}</p>
                        <p class="address text-secondary">{{ apartment.address }}</p>
                        <div class="d-flex gap-4 text-secondary pt-2">
                            <p class="rooms  d-flex gap-2 align-items-center">
                                <font-awesome-icon class="icon" icon="fa-solid fa-door-closed" />
                                {{ apartment.rooms_number }}
                            </p>
                            <p class="beds d-flex gap-2 align-items-center">
                                <font-awesome-icon class="icon" icon="fa-solid fa-bed" />
                                {{ apartment.beds_number }}
                            </p>
                        </div>
                    </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Cards',
    props: ['apartments', 'getMap']
}
</script>

<style lang="scss" scoped>
*{text-decoration: none !important;}
</style>