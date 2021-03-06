 <nav class="teal lighten-2">
        <div class="nav-wrapper">
        <a href="#" class="brand-logo">@lang('messages.menu.title')</a>
        @if(request()->route()->getName() == 'tickets.index' || request()->route()->getName() == 'customers.tickets')
        <a class="brand-logo center modal-trigger hide-on-med-and-down"
            href="#sort-modal" 
            style="font-size: 1.2rem !important; margin: 0px !important;"
        >
            <i class="material-icons left" style="margin-right: 10px;">sort</i>
            <span>@lang('messages.menu.sortOptions')</span>
        </a>
        <div class="fixed-action-btn">
            <a class=" modal-trigger btn-floating btn-large teal" href="#sort-modal" >
              <i class="large material-icons">sort</i>
            </a>
          </div>
        @endif
        <ul id="nav-mobile" class="right hide-on-med-and-down" style="margin-right: 1rem">
            @auth
                <li class="{{request()->route()->getName() == 'tickets.index' ? 'active' : ''}}">
                    <a href="{{route('tickets.index')}}">@lang('messages.menu.tickets')</a>
                </li>

                <li class="{{request()->route()->getName() == 'customers.index' ? 'active' : ''}}">
                    <a href="{{route('customers.index')}}">@lang('messages.menu.customers')</a></li>
                <li>
                    <a href="javascript:{}" onclick="document.getElementById('logout-form').submit();">@lang('messages.menu.logout')</a>
                    <form id="logout-form" method="POST" action="{{route('logout')}}">
                        @csrf
                    </form>
                </li>
            @endauth
            @guest
                <li class="{{request()->route()->getName() == 'tickets.create' ? 'active' : ''}}">
                    <a href="{{route('tickets.create')}}">@lang('messages.menu.newTicket')</a>
                </li>
                <li class="{{request()->route()->getName() == 'login' ? 'active' : ''}}">
                    <a href="{{route('login')}}">@lang('messages.menu.login')</a>
                </li>
            @endguest
        </ul>
        <a href="#" data-target="slide-out" class="sidenav-trigger left hide-on-lg-and-up"><i class="material-icons">menu</i></a>
    </div>
</nav>

<ul id="slide-out" class="sidenav">
    <li><a class="subheader">@lang('messages.menu.title')</a></li>
    @auth
        <li class="{{request()->route()->getName() == 'tickets.index' ? 'active' : ''}}">
            <a href="{{route('tickets.index')}}">@lang('messages.menu.tickets')</a>
        </li>

        <li class="{{request()->route()->getName() == 'customers.index' ? 'active' : ''}}">
            <a href="{{route('customers.index')}}">@lang('messages.menu.customers')</a></li>
        <li>
            <a href="javascript:{}" onclick="document.getElementById('logout-form').submit();">@lang('messages.menu.logout')</a>
            <form id="logout-form" method="POST" action="{{route('logout')}}">
                @csrf
            </form>
        </li>
    @endauth
    @guest
        <li class="{{request()->route()->getName() == 'tickets.create' ? 'active' : ''}}">
            <a href="{{route('tickets.create')}}">@lang('messages.menu.newTicket')</a>
        </li>
        <li class="{{request()->route()->getName() == 'login' ? 'active' : ''}}">
            <a href="{{route('login')}}">@lang('messages.menu.login')</a>
        </li>
    @endguest
</ul>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });
  </script>
