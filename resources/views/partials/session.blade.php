@if(!empty(Session::get('message')))
<script>Materialize.toast('{{ Session::get('message') }}', 4000, 'green accent-4');</script>
@elseif(!empty(Session::get('error')))
<script>Materialize.toast('{{ Session::get('error') }}', 4000, 'materialize-red');</script>
@endif
