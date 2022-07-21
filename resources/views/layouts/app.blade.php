<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('components.navbar')
        <main class="pt-4">
            @yield('content')
        </main>
        @include('components.footer')
    </div>

    <script>
        function callStreet() {
            window.axios.defaults.headers.common = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            };
            const keyAPI = 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV';
            const street = document.getElementById('street').value
            const resultElement = document.querySelector('.result')
            resultElement.innerHTML = ''
            axios
            .get(`https://kr-api.tomtom.com/search/2/geocode/${street}.json?key=${keyAPI}`)
            .then(response => {
                const attempts = response.data.results
                console.log(attempts);
                attempts.forEach(address => {
                    const divElement = document.createElement('div')
                    divElement.classList.add('list-result')
                    const markup = <span>${address.address.freeformAddress}</span>
                    divElement.insertAdjacentHTML('beforeend', markup)
                    divElement.addEventListener('click', function() {
                        document.getElementById('address').value = ${address.address.streetName}, ${address.address.streetNumber}, ${address.address.postalCode}, ${address.address.localName}, ${address.address.country}
                        document.getElementById('latitude').value = address.position.lat
                        document.getElementById('longitude').value = address.position.lon
                        resultElement.innerHTML = ''
                        resultElement.setAttribute('hidden','true')
                    })
                    resultElement.append(divElement)
                    resultElement.removeAttribute('hidden')
                });
            })
        }
    </script>
    
</body>
</html>
