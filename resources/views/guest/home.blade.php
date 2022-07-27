<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>Document</title>
    
</head>
<body>
    @include('components.navbar')
    <div id="root"></div>
    
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/front.js')}}"></script>
</body>
</html>