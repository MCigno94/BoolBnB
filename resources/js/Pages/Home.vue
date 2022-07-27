<template>
    <section>

        <div class="jumbotron  d-flex flex-column align-items-center justify-content-center">
            <div class="jumbo-img"></div>
            <div class="jumbo-text d-flex flex-column align-items-center mx-4 gap-5">
                <div class="cta">
                    <h1 class="display-3 text-light text-center">Search your favourite location</h1>
                </div>


                <div class="search">
                    <div class="searchbox w-100 d-flex justify-content-center gap-2 mb-2">
                        <input @click="search()"  type="text" name="search" id="search" v-model="value"/>
                        <button class="btn btn-danger text-white">Search</button>
                    </div>
                </div> 


            </div>
        </div>

        <div id="searchBox"></div>
        <button id="btnSearch" @click="position()">search</button>
         
         
        <div class="container my-5" :class="(showApartment === '') ? 'd-block' : 'd-none'">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 my-5 gy-3">
                <div class="col d-flex justify-content-center" v-for="apartment in apartments" :key="apartment.id">
                    <div class="my-card pt-3">
                        <div class="img">
                            <img :src="`storage/${apartment.img}`" class="my-card-img" alt=""/>
                        </div>



                        <button type="submit" @click="id = apartment.id; getMap()"> show </button>
                        
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
        
        <!-- SHOW APARTMENT -->
        <div class="container " :class="(showApartment !== '') ? 'd-block' : 'd-none'">
            <h1> {{showApartment.title}} </h1>
            <img :src="((showApartment.img === 'Case-moderne.jpg') ? 'img/Case-moderne.jpg' : `storage/${showApartment.img}`)" class="my-card-img" alt=""/>
            <div v-for="service in showApartment.service" :key="service.id"> 
                <span>
                    <i :class="service.icon" class="ps-1 pe-3" style="width: 8px;"></i>
                    {{service.name}}
                </span>                   
            </div>

            <!-- <div class="address">
                {{showApartment.address}}
            </div> -->

            <div class="maps">
                <h2>Map</h2>
                
                <div id="map" style="width: 500px; height: 300px;"></div>
            </div>
            <div class="messages">
                <h3>Send a message</h3>

                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <textarea type="text" cols="60" rows="10" class="form-control mt-3" name="" id="" aria-describedby="helpId" placeholder=""></textarea>
                    <button class="btn btn-danger mt-3">Send</button>
                </form>
            </div>
        
        </div>

        
    </section>
</template>

<script>

import tt from '@tomtom-international/web-sdk-maps';
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';


export default {
    name: "Home",
    props: ['apartments'],
    data(){
        return{
            value: '',
            showApartment: '',
            id: '',
            addressPosition: [],
            lon: '',
            lat: ''
        }
    },
    methods: {
        getMap() {
            axios
            .get(`api/apartments/${this.id}`)
            .then((res) => {
                this.showApartment = res.data[0];
                //console.log(this.showApartment);
                let latitude = this.showApartment.latitude;
                let longitude = this.showApartment.longitude;;

                let apartmentSelectd = [longitude, latitude];

                const map = tt.map({
                    container: 'map',
                    key: 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV',
                    center: apartmentSelectd,
                    zoom: 15
                });

                let marker = new tt.Marker().setLngLat(apartmentSelectd).addTo(map);
                console.log(latitude, longitude);
            });
        },
        search() {
            let options =
            {
                idleTimePress: 500,
                minNumberOfCharacters: 0,
                searchOptions: {
                    key: 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV',
                    language: 'it-IT'
                },
                /* autocompleteOptions: {
                    key: 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV',
                    language: 'it-IT'
                }, */
                noResultsMessage: 'No results found.'
            }
            const ttSearchBox = new SearchBox(services, options);
            const searchBoxHTML = ttSearchBox.getSearchBoxHTML();
            document.getElementById('searchBox').append(searchBoxHTML);
            console.log(searchBoxHTML);
        },
        position(){
            window.axios.defaults.headers.common = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            };
            const keyAPI = 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV'
            const street = document.querySelector('#searchBox input').value
            //console.log(street);
            axios
            .get(`https://api.tomtom.com/search/2/geocode/${street}.json?key=${keyAPI}&countrySet=IT&limit=1`)
            .then(response => {
                const data = response.data.results[0].position;
                //console.log(data);
                this.lat = data.lat;
                this.lon = data.lon;
                //console.log(this.lat, this.lon);
            })
        },

    },
        
    mounted(){
       
    }
 
    
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