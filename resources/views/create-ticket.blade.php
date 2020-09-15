@extends('app')

@section('content')
<div class="row" style="margin-top: 2rem">
    <div class="col s12 m6 lg4 xl4 offset-m3 offset-l4 offset-xl4">
      <div class="card">
        <div class="card-content">
          <span class="card-title black-text">@lang('messages.tickets.create.form.name')</span>
          <form id="create-ticket-form" method="POST" action="{{route('tickets.store')}}">
            @csrf
            <div class="row">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">account_circle</i>
                  <input name="name" id="name" type="text" class="validate">
                  <label for="name">@lang('messages.tickets.create.form.inputs.name')</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">email</i>
                  <input name="email" id="email" type="email" class="">
                  <label for="email">@lang('messages.tickets.create.form.inputs.email')</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">edit</i>
                  <input name="title" id="title" type="text" class="validate">
                  <label for="title">@lang('messages.tickets.create.form.inputs.title')</label>
              </div>
            </div>
            <div class="row" style="margin-bottom: 0px">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">textsms</i>
                  <textarea name="content" id="content" class="materialize-textarea"></textarea>
                  <label for="content">@lang('messages.tickets.create.form.inputs.content')</label>
              </div>
            </div>
          </form>
        </div>
        <div class="card-action right-align">
          <button type="submit" form="create-ticket-form" class="btn waves-effect waves-light">@lang('messages.tickets.create.form.inputs.submit')</button>
        </div>
      </div>
@endsection