<html>
    <head>
        <title>Reviewer - @yield('title')</title>
    </head>
    <h1>Reviewer - @yield('title')</h1>
    @if ($errors->any())
        <div>
            Errors:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
     @if (session('message'))
        <p><b>{{session('message')}}</b></p>
    @endif
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>