@extends('app')

@section('content')
<div class="container" style="margin-top: 2rem;">
    <div class="row">
        <div class="center-align">{{$customers->links('vendor.pagination.default')}}</div>
    @foreach($customers as $customer)
        <div class="col s12 m6 l4 xl3">
          <div class="card small">
            <div class="card-content black-text">
              <span class="card-title">{{$customer->name}}</span>
              <p><b>Email:</b> {{$customer->email}}</p>
            </div>
            <div class="card-action">
            <a href="{{route('customers.tickets', ['customer' => $customer])}}" class="teal-text">Beküldött hibajegyek</a>
            </div>
          </div>
        </div>
    @endforeach
    </div>
    <div class="center-align" style="margin-bottom: 2rem;">{{$customers->links('vendor.pagination.default')}}</div>
</div>
@endsection