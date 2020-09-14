@extends('app')

@section('content')
<div class="container" style="margin-top: 2rem;">
    <div class="row">
        <div>{{$tickets->links('vendor.pagination.default')}}</div>
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
@endsection