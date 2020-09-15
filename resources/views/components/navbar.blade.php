 <nav class="teal lighten-2">
        <div class="nav-wrapper">
        <a href="#" class="brand-logo">Ticket rendszer</a>
        <a class="brand-logo center modal-trigger hide-on-med-and-down {{request()->route()->getName() != 'tickets.index' ? 'hide' : ''}}"
            href="#sort-modal" 
            style="font-size: 1.2rem !important; margin: 0px !important;"
        >
            <i class="material-icons left" style="margin-right: 10px;">sort</i>
            <span>Rendezési beállítások</span>
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down" style="margin-right: 1rem">
            @auth
                <li class="{{request()->route()->getName() == 'tickets.index' ? 'active' : ''}}">
                    <a href="{{route('tickets.index')}}">Hibajegyek</a>
                </li>

                <li class="{{request()->route()->getName() == 'customers.index' ? 'active' : ''}}">
                    <a href="{{route('customers.index')}}">Ügyfelek</a></li>
                <li>
                    <a href="javascript:{}" onclick="document.getElementById('logout-form').submit();">Kijelentkezés</a>
                    <form id="logout-form" method="POST" action="{{route('logout')}}">
                        @csrf
                    </form>
                </li>
            @endauth
            @guest
                <li class="{{request()->route()->getName() == 'tickets.create' ? 'active' : ''}}">
                    <a href="{{route('tickets.create')}}">Új hibajegy</a>
                </li>
                <li class="{{request()->route()->getName() == 'login' ? 'active' : ''}}">
                    <a href="{{route('login')}}">Bejelentkezés</a>
                </li>
            @endguest
        </ul>
        <a href="#" data-target="slide-out" class="sidenav-trigger left hide-on-lg-and-up"><i class="material-icons">menu</i></a>
    </div>
</nav>

<ul id="slide-out" class="sidenav">
    <li><a class="subheader">Ticket rendszer</a></li>
    @auth
        <li class="{{request()->route()->getName() == 'tickets.index' ? 'active' : ''}}">
            <a href="{{route('tickets.index')}}">Hibajegyek</a>
        </li>

        <li class="{{request()->route()->getName() == 'customers.index' ? 'active' : ''}}">
            <a href="{{route('customers.index')}}">Ügyfelek</a></li>
        <li>
            <a href="javascript:{}" onclick="document.getElementById('logout-form').submit();">Kijelentkezés</a>
            <form id="logout-form" method="POST" action="{{route('logout')}}">
                @csrf
            </form>
        </li>
    @endauth
    @guest
        <li class="{{request()->route()->getName() == 'tickets.create' ? 'active' : ''}}">
            <a href="{{route('tickets.create')}}">Új hibajegy</a>
        </li>
        <li class="{{request()->route()->getName() == 'login' ? 'active' : ''}}">
            <a href="{{route('login')}}">Bejelentkezés</a>
        </li>
    @endguest
</ul>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });
  </script>
