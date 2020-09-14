 <nav class="teal lighten-2">
        <div class="nav-wrapper">
        <a href="#" class="brand-logo">Ticket rendszer</a>
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
                <li>{{auth()->user()->username}}</li>
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
    <li><div class="user-view">
      <div class="background">
        <img src="images/office.jpg">
      </div>
      <a href="#user"><img class="circle" src="images/yuna.jpg"></a>
      <a href="#name"><span class="white-text name">John Doe</span></a>
      <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
</ul>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });
  </script>
