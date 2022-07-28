<template>
    <div class="jumbotron  d-flex flex-column align-items-center justify-content-center">
        <div class="jumbo-img"></div>
        <div class="jumbo-text d-flex flex-column align-items-center mx-4 gap-5">
            <div class="cta">
                <h1 class="display-3 text-light text-center">Search your favourite location</h1>
            </div>
            <div class="mx-4 text-white">
                <!-- FILTER SEARCH -->
                <div id="searchBox"></div>
                <button class="btn btn-primary text-white" id="btnSearch" @click="positionSearch()">search</button>

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

<style>

</style>