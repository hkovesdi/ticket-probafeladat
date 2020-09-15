@extends('app')

@section('content')
<div class="row" style="margin-top: 2rem">
    <div class="col s12 m6 lg4 xl4 offset-m3 offset-l4 offset-xl4">
      <div class="card">
        <div class="card-content">
          <span class="card-title black-text">@lang('messages.login.submit')</span>
          <form id="login-form" method="POST" action="{{route('login')}}">
            @csrf
            <div class="row">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">account_circle</i>
                  <input id="username" name="username" type="text" class="validate">
                  <label for="username">@lang('messages.login.username')</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">https</i>
                  <input id="password" name="password" type="password" class="">
                  <label for="password">@lang('messages.login.password')</label>
              </div>
            </div>
          </form>
        </div>
        <div class="card-action right-align">
          <button type="submit" form="login-form" class="btn waves-effect waves-light">@lang('messages.login.submit')</button>
        </div>
      </div>
@endsection