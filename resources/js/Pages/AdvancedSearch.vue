<template>
    <div class="jumbotron  d-flex flex-column align-items-center justify-content-center">
        <div class="jumbo-img"></div>
        <div class="jumbo-text d-flex flex-column align-items-center mx-4 gap-5">
            <div class="cta">
                <h1 class="display-3 text-light text-center">Search your favourite location</h1>
            </div>
            <div class="searchbox d-flex flex-column">
                <div>
                    <div class="d-flex d-flex justify gap-2 align-items-center">
                        <div id="searchBox"></div>
                    <button id="btnSearch" class="btn btn-danger text-white" @click="positionSearch()">Search</button>
                    </div>
                    <div>
                        <router-link :to="`/advanced-search`" class="advancedSearch text-danger">Advanced Search</router-link>
                    </div>
                    </div>
            </div>
            <div class="mx-4 text-white">
                <!-- FILTER SEARCH -->

                <div v-if="search_value !== ''" class="d-flex gap-3">
                    <div>
                        <label for="searchRooms">Rooms</label>
                        <input min="1" @keyup="inputFilterRooms()" @click="inputFilterRooms()" type="number"
                            name="searchRooms" id="searchRooms">
                    </div>

                    <div>
                        <label for="searchBeds">Beds</label>
                        <input min="1" @keyup="inputFilterBeds()" type="number" name="searchBeds" id="searchBeds">
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
</template>

<script>
/* search */
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

export default {
    name: 'Jumbotron',
    props: ['positionSearch', 'search_value', 'inputFilterRooms', 'inputFilterBeds', 'allServices', 'checkboxName', 'selectCheckbox', 'queryServices'],
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
    },
    mounted(){
        this.search()
    }
}
</script>

<style lang="scss">
.searchbox{
    #searchBox{
        width: 150% !important;
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

</style>