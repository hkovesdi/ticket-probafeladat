@extends('app')

@section('content')
<div class="container" style="margin-top: 2rem;">
    <div class="row">
        <div style="text-align: center;">
            {{$tickets->withQueryString()->links('vendor.pagination.default')}}
        </div>
    @foreach($tickets as $ticket)
        <div class="col s12 m12 l6 xl4">
          <div class="card medium">
            <div class="card-content black-text">
              <span class="card-title">{{$ticket->title}}</span>
              <p>{{$ticket->content}}</p>
              <br/>
              <p style=""> <b>@lang('messages.tickets.submitted'):</b> {{$ticket->created_at}}</p>
              <p style=""> <b>@lang('messages.tickets.submitter'):</b> <a href="{{route('customers.tickets', ['customer' => $ticket->customer])}}">{{$ticket->customer->name}} ({{$ticket->customer->email}})</a></p>
            </div>
            <div class="card-action">
                @lang('messages.tickets.due'):
                <div class="chip">
                    {{$ticket->due_date}}
                </div>
            </div>
          </div>
        </div>
    @endforeach
    </div>
    <div class="center-align" style="margin-bottom: 2rem;">{{$tickets->links('vendor.pagination.default')}}</div>
</div>

<div id="sort-modal" class="modal">
    <div class="modal-content">
      <h4 style="padding-bottom: 1rem !important;">@lang('messages.menu.sortOptions')</h4>
      <form id="sort-form">
        <div class="input-field" style="padding-bottom: 1rem !important;">
            <select name="per-page">
                <option value="15" {{request()->query('per-page') == 15 ? 'selected' : ''}}>15</option>
                <option value="10" {{request()->query('per-page') == 10 ? 'selected' : ''}}>10</option>
                <option value="5" {{request()->query('per-page') == 5 ? 'selected' : ''}}>5</option>
            </select>
            <label>@lang('messages.tickets.sortOptions.perPage.name')</label>
          </div>
        <div class="input-field" style="padding-bottom: 1rem !important;">
            <select name="sort-by">
              <option value="created_at" {{request()->query('sort-by') == 'created_at' ? 'selected' : ''}}>@lang('messages.tickets.sortOptions.sortBy.createdAt')</option>
              <option value="due_date" {{request()->query('sort-by') == 'due_date' ? 'selected' : ''}}>@lang('messages.tickets.sortOptions.sortBy.dueDate')</option>
            </select>
            <label>@lang('messages.tickets.sortOptions.sortBy.name')</label>
          </div>
          <div class="input-field" style="padding-bottom: 1rem !important;">
            <select name="order-by">
              <option value="asc" {{request()->query('order-by') == 'asc' ? 'selected' : ''}}>@lang('messages.tickets.sortOptions.orderBy.asc')</option>
              <option value="desc" {{request()->query('order-by') == 'desc' ? 'selected' : ''}}>@lang('messages.tickets.sortOptions.orderBy.desc')</option>
            </select>
            <label>@lang('messages.tickets.sortOptions.orderBy.name')</label>
          </div>
    </form>
    </div>
    <div class="modal-footer" style="margin-bottom: 0.2rem;">
        <button type="submit" form="sort-form" class="btn modal-close waves-effect waves-light" style="margin-right: 2.9rem;">@lang('messages.tickets.sortOptions.sort')</button>
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