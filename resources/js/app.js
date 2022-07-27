/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import App from './layouts/App';


/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faBed, faDoorClosed } from '@fortawesome/free-solid-svg-icons'


/* search */
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

/* add icons to the library */
library.add(faBed, faDoorClosed)

/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#root',
    render: h => h(App) // mostriamo App all'avvio di Vue
})



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