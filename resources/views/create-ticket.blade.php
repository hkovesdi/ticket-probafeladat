@extends('app')

@section('content')
<div class="row" style="margin-top: 2rem">
    <div class="col s12 m6 lg4 xl4 offset-m3 offset-l4 offset-xl4">
      <div class="card">
        <div class="card-content">
          <span class="card-title black-text">Új hibajegy beküldése</span>
          <form>
            <div class="row">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">account_circle</i>
                  <input placedholder="Név" id="name" type="text" class="validate">
                  <label for="name">Név</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">email</i>
                  <input id="email" type="email" class="">
                  <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">edit</i>
                  <input id="subject" type="text" class="validate">
                  <label for="subject">Tárgy</label>
              </div>
            </div>
            <div class="row" style="margin-bottom: 0px">
              <div class="input-field col s12">
                  <i class="material-icons prefix grey-text text-darken-2">textsms</i>
                  <textarea id="content" class="materialize-textarea"></textarea>
                  <label for="content">Tartalom</label>
              </div>
            </div>
          </form>
        </div>
        <div class="card-action right-align">
          <button type="submit" class="btn waves-effect waves-light">Beküldés</button>
        </div>
      </div>
@endsection