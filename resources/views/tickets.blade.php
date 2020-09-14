@extends('app')

@section('content')
<div class="container" style="margin-top: 2rem;">
    <div class="row">
        <div style="text-align: center;">
            <a class="waves-effect waves-light btn modal-trigger" href="#sort-modal"><i class="material-icons left">view_headline</i>Rendezési beállítások</a>
            {{$tickets->withQueryString()->links('vendor.pagination.default')}}
        </div>
    @foreach($tickets as $ticket)
        <div class="col s12 m6 l4 xl3">
          <div class="card medium">
            <div class="card-content black-text">
              <span class="card-title">{{$ticket->title}}</span>
              <p>{{$ticket->content}}</p>
              <br/>
              <p style=""> <b>Beküldve:</b> {{$ticket->created_at}}</p>
              <p style=""> <b>Beküldő:</b> <a href="{{route('customers.tickets', ['customer' => $ticket->customer])}}">{{$ticket->customer->name}}</a></p>
            </div>
            <div class="card-action">
                Esedékes:
                <div class="chip">
                    {{$ticket->due_date}}
                </div>
            </div>
          </div>
        </div>
    @endforeach
    </div>
</div>

<div id="sort-modal" class="modal">
    <div class="modal-content">
      <h4 style="padding-bottom: 1rem !important;">Rendezési beállítások</h4>
      <form id="sort-form">
        <div class="input-field" style="padding-bottom: 1rem !important;">
            <select name="sort-by">
              <option value="created_at">Beküldési dátum szerint</option>
              <option value="due_date">Esedékességi dátum szerint</option>
            </select>
            <label>Rendezés</label>
          </div>
          <div class="input-field" style="padding-bottom: 1rem !important;">
            <select name="order-by">
              <option value="asc">Növekvő (régiek előre)</option>
              <option value="desc">Csökkenő (újak előre)</option>
            </select>
            <label>Rendezés módja</label>
          </div>
          <div class="input-field">
            <select name="per-page">
                <option value="15">15</option>
                <option value="10">10</option>
                <option value="5">5</option>
            </select>
            <label>Maximum találatok egy oldalon</label>
          </div>
    </form>
    </div>
    <div class="modal-footer" style="margin-bottom: 0.2rem;">
        <button type="submit" form="sort-form" class="btn modal-close waves-effect waves-light" style="margin-right: 2.9rem;">Rendezés</button>
    </div>
</div>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
    var modalElems = document.querySelectorAll('.modal');
    var modalInstances = M.Modal.init(modalElems);
  });
</script>
@endsection