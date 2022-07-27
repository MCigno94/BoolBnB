/*  */

import axios from 'axios'

function callStreet() {

    /* window.axios.defaults.headers.common = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    } */

    const keyAPI = 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV';
    const street = document.getElementById('address').value
    const resultElement = document.querySelector('.result')
    resultElement.innerHTML = ''
    axios
        .get(`https://api.tomtom.com/search/2/geocode/${street}.json?key=${keyAPI}`)
        .then(response => {
            const attempts = response.data.results
            attempts.forEach(address => {
                const divElement = document.createElement('div')
                divElement.classList.add('list-result')
                const markup = `<span>${address.address.freeformAddress}</span>`;
                divElement.insertAdjacentHTML('beforeend', markup)
                divElement.addEventListener('click', function() {
                    document.getElementById('address').value = `${address.address.streetName}, ${address.address.streetNumber}, ${address.address.postalCode}, ${address.address.localName}, ${address.address.country}`;
                    document.getElementById('latitude').value = address.position.lat
                    document.getElementById('longitude').value = address.position.lon
                    resultElement.innerHTML = ''
                    resultElement.setAttribute('hidden', 'true')
                })
                resultElement.append(divElement)
                resultElement.removeAttribute('hidden')
            });
        })
}

let indirizzo = document.getElementById('address').addEventListener('keyup', callStreet)