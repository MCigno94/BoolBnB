<template>
    <section>

        <div class="jumbotron  d-flex flex-column align-items-center justify-content-center">
            <div class="jumbo-img"></div>
            <div class="jumbo-text d-flex flex-column align-items-center mx-4 gap-5">
                <div class="cta">
                    <h1 class="display-3 text-light text-center">Search your favourite location</h1>
                </div>
                <!-- <div class="search">
                    <div class="searchbox w-100 d-flex justify-content-center gap-2 mb-2">
                        <input @keyup="search" type="text" name="search" id="search" v-model="value"/>
                        <button class="btn btn-danger text-white">Search</button>
                    </div>
                   
                </div> -->
            </div>
        </div>
         
         
        <div class="container my-5" v-if="showApartment === ''" >
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 my-5 gy-3">
                <div class="col d-flex justify-content-center" v-for="apartment in apartments" :key="apartment.id">
                    <div class="my-card pt-3">
                        <div class="img">
                            <img :src="`storage/${apartment.img}`" class="my-card-img" alt=""/>
                        </div>



                        <button type="submit" @click="id = apartment.id"> show </button>
                        
                        <div class="my-card-body d-flex flex-column">
                            <p class="title fw-bold pb-1">{{ apartment.title }}</p>
                            <p class="address text-secondary">{{ apartment.address }}</p>
                            <div class="d-flex gap-4 text-secondary pt-2">
                                <p class="rooms  d-flex gap-2 align-items-center">
                                    <font-awesome-icon class="icon" icon="fa-solid fa-door-closed" /> 
                                    {{ apartment.rooms_number }}</p>
                                <p class="beds d-flex gap-2 align-items-center">
                                    <font-awesome-icon class="icon" icon="fa-solid fa-bed" /> 
                                    {{ apartment.beds_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h1>ciao</h1>
            <h1>{{showApartment.title}}</h1>
        </div>
    </section>
</template>

<script>
//import AdvancedSearch from './AdvancedSearch.vue';


export default {
 // components: { AdvancedSearch },
    name: "Home",
    props: ['apartments'],
    data(){
        return{
            value: '',
            showApartment: {},
            id: '2'
        }
    },
    methods: {
        /* getApartment() {
        axios
            .get("/api/apartment/" + this.$route.params.id, {
            params: {
                lat: 44.78993000,
                lon: 11.57065000,
                radius: 20000
            },
            })
            .then((response) => {
            console.log(response);
            if (response.data.status_code === 404) {
                this.loading = false;
                this.$router.push({ name: "not-found" });
            } else {
                this.apartment = response.data;
                this.loading = false;
            }
            })
            .catch((e) => {
            console.error(e);
            });
        }, */
        
        apartment() {
            //console.log('funziona');
            axios.get(`api/apartments/${this.id}`)
            .then((res) => {
                //console.log(res.data);
                this.showApartment = res.data;
                console.log(this.showApartment);
            });
        }

    },
    mounted(){
        if(this.id !== ''){
            this.apartment();
            console.log(this.showApartment);
        }
    },
};
</script>

<style lang="scss" scoped>
.jumbotron {
    position: relative;
    height: 600px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    .jumbo-img{
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: -1;
        background-image: url("https://img5.goodfon.com/wallpaper/nbig/c/da/devushka-eda-gory-shary-podushki-stol-frukty.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        filter: brightness(70%);
    }
    .search{
        width: 60%;
    }
    input {
        width: 100%;
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
/* CARD */
.col{
    border-radius: 15px;
    transition: all .3s ease-in-out;
    &:hover {background-color: rgba(207, 207, 207, 0.308);}
    &:hover img{transform: scale(1.05);}
    .icon, .rooms, .beds{transition: all .3s ease-in-out;}
    &:hover .icon{color: rgb(0, 140, 255);}
    &:hover .rooms, 
    &:hover .beds{color: black;}
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