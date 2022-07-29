<template>
    <section>
        <div class="jumbotron d-flex flex-column align-items-center justify-content-center">
            <div class="jumbo-img"></div>
            <div class="jumbo-text d-flex flex-column align-items-center mx-4 ">
                <div class="cta py-4">
                    <h1 class="display-3 text-light text-center">Search your favourite location</h1>
                </div>
                <div class="searchbox d-flex flex-column">
                <div class="d-flex d-flex justify gap-2 align-items-center">
                    <div @keyup="positionSearch()" id="searchBox"></div>
                    <button id="btnSearch" class="btn btn-danger text-white" @click="positionSearch()">Search</button>
                </div>
                </div>
                <div class="text-white">
                    <!-- FILTER SEARCH -->

                    <div class="filters">
                        <div class="d-flex  justify-content-center">
                            <div class="d-flex">
                                <div class="rooms d-flex flex-column align-items-center">
                                    <label for="searchRooms">Rooms</label>
                                    <input min="1" @keyup="inputFilterRooms()" type="number" name="searchRooms" id="searchRooms" class="w-50 ps-2">
                                </div>

                                <div class="beds d-flex flex-column align-items-center">
                                    <label for="searchBeds">Beds</label>
                                    <input min="1" @keyup="inputFilterBeds()" type="number" name="searchBeds" id="searchBeds" class="w-50 ps-2">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="row row-cols-2 pt-4 services">
                                <div v-for="service in allServices" :key="service.id">
                                    <div class="col d-flex align-items-center mw-75">
                                        <div class="pe-1">
                                            <input @click="checkboxName = service.name; selectCheckbox()" type="checkbox" :name="service.name" :id="service.name">
                                        </div>
                                        <div>
                                            <label :for="service.name"> {{ service.name }} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Cards 
        :apartments="apartments"
        :getMap="getMap"
        />
    </section>
</template>

<script>
/* search */
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';
import Cards from '../components/Cards.vue';

export default{
    components: { Cards }, 
    name: 'AdvancedSearch',
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
    methods:{
        search(){
            let options = {
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

                                    let distance = this.km_20_Apartments(latitude, longitude, lat_inizio, lon_inizio);
                                    //let distance = (m_distance  / 1000).toFixed(1)                         
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

                                    return (distance < 20000) && this.stanze(apartment) && this.letti(apartment) && veritaServizio;
                                })
                                //console.log(newArrayPosition);

                                let biggest = 0
                                let ordered_array = [];
                                let single_apartment = {}
                            
                                while(newArrayPosition.length !== 0){
                                        let j;
                                    for (const apartment of newArrayPosition) {
                                        if(apartment.distance > biggest){
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
                                console.log(this.apartments);
                            })


                    })
            } else {
                this.callAPI();
            }
        },
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

            document.getElementById(this.checkboxName).classList.toggle('active')
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
    mounted(){
        this.callAPI()
        this.servicesCallAPI()
        this.search()
    }
}
</script>

<style lang="scss" scoped>
.searchbox{
    #searchBox{
        max-width: 500px !important;
        margin: 0;padding: 0;

        .tt-search-box{
            border-radius: 12px !important;
            .tt-search-box-input-container{
                border: none !important;
                border-radius: 12px !important;
            }
        }
    }
}
.services{
    width: 100% !important;
    max-width: 330px;
}
.filters{
    padding: 25px 25px 25px 60px !important;
}
.rooms, .beds{
    margin-left: -35px !important;
}

</style>