<template>
    <div class="container ">
        <!-- ========== Start APARTMENT ========== -->
        <div>
            <div class="title">
                <h1> {{ apartment.title }} </h1>
            </div>
            <div class="img_container">
                <img :src="((apartment.img === 'Case-moderne.jpg') ? '../../img/Case-moderne.jpg' : `storage/${apartment.img}`)"
                    class="apartment_img" alt="" />
            </div>
            <div v-for="service in apartment.service" :key="service.id">
                <span>
                    <i :class="service.icon" class="ps-1 pe-3" style="width: 8px;"></i>
                    {{ service.name }}
                </span>
            </div>
        </div>
        <!-- ========== End APARTMENT ========== -->

        <!-- ========== Start MAP ========== -->
        <div class="maps">
            <h2>Map</h2>
            <div id="map" style="width: 500px; height: 300px;"></div>
        </div>
        <!-- ========== End MAP ========== -->
        
        <!-- ========== Start MESSAGE ========== -->
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
        <!-- ========== End MESSAGE ========== -->
    </div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';

export default {
    name: 'Apartment',
    data() {
        return {
            apartment: [],
            city: '',
            address: '',
        };
    },
    methods: {
        getApartment() {
            axios
                .get("/api/apartment/" + this.$route.params.id)
                .then((response) => {
                    //console.log(response.data);
                    this.apartment = response.data[0];
                    this.address = this.apartment.address
                    console.log(this.apartment);
                this.getMap()
                })
        },
        getMap() {
            let apartmentSelectd = [this.apartment.longitude, this.apartment.latitude];
            const map = tt.map({
                container: 'map',
                key: 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV',
                center: apartmentSelectd,
                zoom: 15
            });
            let marker = new tt.Marker().setLngLat(apartmentSelectd).addTo(map);

            var popupOffsets = {
                top: [0, 0],
                bottom: [0, -40],
                'bottom-right': [0, -70],
                'bottom-left': [0, -70],
                left: [25, -35],
                right: [-25, -35]
            }
            var popup = new tt.Popup({
                offset: popupOffsets
            }).setHTML(`${this.address}`);
            marker.setPopup(popup).togglePopup();

        },
    },
    mounted() {
        this.getApartment();
    },
}
</script>

<style>

</style>