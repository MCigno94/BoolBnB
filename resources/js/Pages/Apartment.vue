<template>
    <div class="container ">
        <!-- ========== Start APARTMENT ========== -->
        <div>
            <div class="title">
                <h1> {{ apartment.title }} </h1>
            </div>
            <div class="img_container mt-4">
                <img :src="((apartment.img === 'Case-moderne.jpg') ? '../../img/Case-moderne.jpg' : `storage/${apartment.img}`)"
                    class="apartment_img" alt="" />
            </div>
        </div>
        <!-- ========== End APARTMENT ========== -->
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col mt-2">
                <h2>Description</h2>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque dolores perferendis veniam
                    fuga quae iste aperiam quas? Hic, eum ipsum nam unde repellat suscipit, laborum doloremque quis
                    tempore beatae sed, corrupti perferendis quos molestiae sequi eligendi soluta possimus autem.
                    Unde voluptatibus ea quo, dolorum ipsum architecto. Voluptate accusamus dolorum reprehenderit
                    provident error nisi omnis alias similique nam? Dolore et in inventore doloremque velit optio
                    ad, aut blanditiis tempora nostrum aliquam quibusdam fugit magni atque laboriosam earum, ex quis
                    cumque, repellendus nisi quo temporibus nam esse. Voluptates voluptatum illo adipisci
                    voluptatibus ad iusto culpa odio a aperiam architecto tenetur praesentium fugiat cumque, fuga
                    aliquid laboriosam rem eum error ullam! Praesentium nisi eveniet iure ipsum dolorem voluptas
                    esse vero aspernatur quibusdam ullam sit harum quas, quae ad architecto eaque dolore, eum
                    facilis eligendi sint voluptatum doloremque nemo magnam fugiat. Iste fugit temporibus ea,
                    voluptatem architecto sit? Voluptates qui nam magni eum ab distinctio cum doloremque impedit
                    quas, modi obcaecati quidem aliquam suscipit voluptatem consequuntur quisquam consequatur,
                    assumenda laborum nesciunt. Rerum sequi sit hic molestias quibusdam laboriosam omnis, cumque
                    non, minima magni nesciunt! Ad rem, labore, debitis quae sed minima similique culpa possimus hic
                    et ea quia corporis quis temporibus, perferendis magni delectus.
                </p>

            </div>
            <!-- d-flex justify-content-center align-items-center flex-column -->
            <div class="col mt-2">
                <!-- ========== Start MAP ========== -->
                <h2>Map</h2>
                <div class="d-flex justify-content-center align-items-center pt-3">
                    <div id="map" style="width: 500px; height: 300px;"></div>
                </div>
            </div>

        </div>
        <div class="row row-cols-1 row-cols-md-2">
            <!-- ========== End MAP ========== -->
            <div class="col">
                <h2>Services</h2>
                <div v-for="service in apartment.service" :key="service.id">
                    <span>
                        <i :class="service.icon" class="ps-1 pe-3" style="width: 8px;"></i>
                        {{ service.name }}
                    </span>
                </div>
            </div>


            <!-- ========== Start MESSAGE ========== -->
            <div class="col">
                <div class="messages">
                    <h3>Send a message</h3>
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text"></div>
                        </div>
                        <textarea type="text" cols="60" rows="10" class="form-control mt-3" name="" id=""
                            aria-describedby="helpId" placeholder=""></textarea>
                        <button class="btn btn-danger mt-3">Send</button>
                    </form>
                </div>
            </div>
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