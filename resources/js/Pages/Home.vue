<template>
    <section>

        <div class="jumbotron  d-flex flex-column align-items-center justify-content-center">
            <div class="jumbo-img"></div>
            <div class="jumbo-text d-flex flex-column align-items-center mx-4 gap-5">
                <div class="cta">
                    <h1 class="display-3 text-light text-center">Search your favourite location</h1>
                </div>
                <div class="mx-4 text-white">
                    <!-- FILTER SEARCH -->
                    <div id="searchBox"></div>
                    <button class="btn btn-primary text-white" id="btnSearch" @click="positionSearch();">search</button>

                    <div v-if="search_value !== ''">
                        <div>
                            <label for="searchRooms">Stanze</label>
                            <input @keyup="inputFilterRooms()" @click="inputFilterRooms()" type="number"
                                name="searchRooms" id="searchRooms">
                        </div>

                        <div>
                            <label for="searchBeds">Letti</label>
                            <input @keyup="inputFilterBeds()" type="number" name="searchBeds" id="searchBeds">
                        </div>
                        <div class="d-flex">
                            <div v-for="service in allServices" :key="service.id">
                                <input @click="checkboxName = service.name; selectCheckbox() " type="checkbox"
                                    :name="service.name" :id="service.name">
                                <label :for="service.name"> {{ service.name }} </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <div class="container my-5" :class="(showApartment === '') ? 'd-block' : 'd-none'">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 my-5 gy-3">
                <div class="col d-flex justify-content-center" v-for="apartment in apartments" :key="apartment.id">
                    <div class="my-card pt-3">

                        <h5 v-if="apartment.distance"> {{ apartment.distance }} </h5>

                        <div class="img">
                            <img :src="((apartment.img === 'Case-moderne.jpg') ? '../../img/Case-moderne.jpg' : `storage/${apartment.img}`)"
                                class="my-card-img" alt="" />
                        </div>

                        <button type="submit" @click="id = apartment.id; getMap()"> show </button>

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
                </div>
            </div>
        </div>



        <!-- SHOW APARTMENT -->
        <div class="container " :class="(showApartment !== '') ? 'd-block' : 'd-none'">
            <h1> {{ showApartment.title }} </h1>

            <img v-if="showApartment !== ''"
                :src="((showApartment.img === 'Case-moderne.jpg') ? '../../img/Case-moderne.jpg' : `storage/${showApartment.img}`)"
                class="my-card-img" alt="" />
            <div v-for="service in showApartment.service" :key="service.id">
                <span>
                    <i :class="service.icon" class="ps-1 pe-3" style="width: 8px;"></i>
                    {{ service.name }}
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
                    <textarea type="text" cols="60" rows="10" class="form-control mt-3" name="" id=""
                        aria-describedby="helpId" placeholder=""></textarea>
                    <button class="btn btn-danger mt-3">Send</button>
                </form>
            </div>

        </div>


    </section>
</template>

<script>

import tt from '@tomtom-international/web-sdk-maps';

export default {
    name: "Home",
    data() {
        return {
            apartments: '',
            search_value: '',
            showApartment: '',
            id: '',
            addressPosition: [],
            lon: '1',
            lat: '1',
            allServices: [],
            queryServices: [],
            checkboxName: '',
            property: '',
            roomsNumber: '',
            bedsNumber: ''
        }
    },
    methods: {
        getMap() {
            axios
                .get(`api/apartment/${this.id}`)
                .then((res) => {
                    this.showApartment = res.data[0];
                    //console.log(this.showApartment);
                    let latitude = this.showApartment.latitude;
                    let longitude = this.showApartment.longitude;

                    let apartmentSelectd = [longitude, latitude];

                    const map = tt.map({
                        container: 'map',
                        key: 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV',
                        center: apartmentSelectd,
                        zoom: 15
                    });

                    let marker = new tt.Marker().setLngLat(apartmentSelectd).addTo(map);
                    //console.log(latitude, longitude);
                });
        },
        positionSearch() {
            window.axios.defaults.headers.common = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            };
            const keyAPI = 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV'
            const street = document.querySelector('#searchBox input').value
            this.search_value = street
            if (street !== '') {
                axios
                    .get(`https://api.tomtom.com/search/2/geocode/${street}.json?key=${keyAPI}&countrySet=IT&limit=1`)
                    .then(response => {
                        const data = response.data.results[0].position;


                        let lat_inizio = data.lat;
                        let lon_inizio = data.lon;

                        axios
                            .get(`api/apartments/all`)
                            .then((res) => {
                                let apartments = res.data;

                                let newArrayPosition = apartments.filter((apartment, index) => {
                                    let latitude = apartment.latitude;
                                    let longitude = apartment.longitude;

                                    let m_distance = this.km_20_Apartments(latitude, longitude, lat_inizio, lon_inizio);
                                    let distance = (m_distance  / 1000).toFixed(1)
                                    
                                    apartment.distance = distance
                                    //console.log(apartment.service);

                                    let lunghezza = this.queryServices.length
                                    let counter = 0;
                                    for (const service of apartment.service) {
                                        if (this.queryServices.includes(service.name)) {
                                            counter++
                                        }
                                    }

                                    let veritaServizio = lunghezza === counter

                                    return (distance < 20) && this.stanze(apartment) && this.letti(apartment) && veritaServizio;
                                })
                                //console.log(newArrayPosition);
                                this.apartments = newArrayPosition;

                                let biggest = 0
                                let ordered_array = [];
                                let single_apartment = {}
                            
                                while(newArrayPosition.length !== 0){
                                        let j;
                                    for (const apartment of newArrayPosition) {
                                        if(apartment.distance > biggest && apartment !== ''){
                                            biggest = apartment.distance
                                            single_apartment = apartment
                                            j = newArrayPosition.indexOf(apartment)
                                        }
                                    }
                                    ordered_array.unshift(single_apartment)
                                    newArrayPosition.splice(j,1)
                                    biggest = 0
                                }
                                this.apartments = ordered_array;
                            })


                    })
            } else {
                this.callAPI();
            }
        },
        // filterAllApi() {
        //     if (this.lat !== '' && this.lon !== '') {

        //     } else {
        //         this.callAPI();
        //     }
        // },
        stanze(apartment) {
            let stanze;
            if (this.roomsNumber !== '') {
                stanze = this.roomsNumber <= apartment.rooms_number
                console.log(typeof stanze);
                //console.log(this.roomsNumber + ' - ' + apartment.rooms_number );
            } else {
                stanze = true;
                //console.log(stanze + ' else');
            }
            return stanze;
        },
        letti(apartment) {
            let letti;
            if (this.bedsNumber !== '') {
                letti = this.bedsNumber <= apartment.beds_number
                //console.log(letti + ' if');
                //console.log(this.bedsNumber + ' - ' + apartment.rooms_number );
            } else {
                letti = true;
                //console.log(stanze + ' else');
            }
            return letti;
        },
        km_20_Apartments(latitude, longitude, lat_inizio, lon_inizio) {

            const lat1 = lat_inizio;
            const lon1 = lon_inizio;

            const lat2 = latitude;
            const lon2 = longitude;

            const R = 6371e3; // metres
            const φ1 = lat1 * Math.PI / 180; // φ, λ in radians
            const φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180;
            const Δλ = (lon2 - lon1) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            const d = R * c; // in metres
            console.log(d);
            return d;
        },
        callAPI() {
            axios.get("api/apartments/partial").then((res) => {
                let apart = res.data.data;
                this.apartments = apart;
                //console.log(this.apartments);
            });
        },
        inputFilterRooms() {
            const inputRooms = document.querySelector('#searchRooms').value
            this.roomsNumber = inputRooms;
            console.log(this.roomsNumber + ' ' + 'stanze');
        },
        inputFilterBeds() {
            const inputbeds = document.querySelector('#searchBeds').value
            this.bedsNumber = inputbeds;
            console.log(this.bedsNumber + ' ' + 'letti');
        },
        servicesCallAPI() {
            axios.get("api/services").then((res) => {
                this.allServices = res.data
                //console.log(res.data);
            });
        },
        selectCheckbox() {
            let checkbox = document.getElementById(this.checkboxName)
            checkbox.classList.toggle('active')
            if (checkbox.classList.contains('active')) {
                console.log('funziona');
                this.queryServices.push(this.checkboxName)
            } else {
                let index = this.queryServices.indexOf(this.checkboxName)
                this.queryServices.splice(index, 1)
                console.log('non funziona');
            }
            console.log(this.queryServices);
        }
    },
    mounted() {
        //this.filterAllApi()
        //this.km_20_Apartments(88,-8)
        //this.filterApartment()
        this.callAPI()
        this.servicesCallAPI()
    }
};
</script>

<style lang="scss" scoped>
.jumbotron {
    position: relative;
    height: 600px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);

    .jumbo-img {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: -1;
        background-image: url("https://img5.goodfon.com/wallpaper/nbig/c/da/devushka-eda-gory-shary-podushki-stol-frukty.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        filter: brightness(20%);
    }

    .search {
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

    .advancedSearch {
        text-shadow: 1px 1px black;
    }
}

/* CARD */
.col {
    border-radius: 15px;
    transition: all .3s ease-in-out;

    &:hover {
        background-color: rgba(207, 207, 207, 0.308);
    }

    &:hover img {
        transform: scale(1.05);
    }

    .icon,
    .rooms,
    .beds {
        transition: all .3s ease-in-out;
    }

    &:hover .icon {
        color: rgb(0, 140, 255);
    }

    &:hover .rooms,
    &:hover .beds {
        color: black;
    }

    cursor: pointer;

    .my-card {
        transition: all .4s ease-in-out;
        position: relative;

        p {
            padding: 0;
            margin: 0;
        }

        .img {
            overflow: hidden;
            border-radius: 15px;

            img {
                transition: all .3s ease-in-out;
                width: 100%;
                aspect-ratio: 1/1;
                object-fit: cover;
            }
        }

        .my-card-body {
            height: 150px;
            padding: 10px;
        }
    }
}
</style>