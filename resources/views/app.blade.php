<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ticket</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="{{asset('css/app.css')}}"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="{{asset('css/vendor/materialize/materialize.css')}}"  media="screen,projection"/>

        <style>
            body {
                font-family: 'Roboto';
            }
        </style>
    </head>
    <body>
        <x-navbar/>
        @yield('content')
        <script type="text/javascript" src="{{asset('js/vendor/materialize/materialize.min.js')}}"></script>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <script type="text/javascript">
                    M.toast({
                        html: "<div class='valign-wrapper'><i class='material-icons' style='margin-right: 0.5rem;'>error_outline</i><span>{{$error}}</span></div>", 
                        classes: 'error',
                        displayLength: {{count($errors->all())}}*2500
                    })
                </script>
            @endforeach
        @endif
    </body>
</html>
