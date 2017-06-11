@if(!empty(Session::get('message')))
<script>Materialize.toast('<i class="material-icons left">check</i>{{ Session::get('message') }}', 4000, 'gradient-2');</script>
@elseif(!empty(Session::get('error')))
<script>Materialize.toast('<i class="material-icons left">warning</i>{{ Session::get('error') }}', 4000, 'materialize-red');</script>
@endif

@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <script>Materialize.toast('<i class="material-icons left">warning</i>{{ $error }}', 4000, 'materialize-red');</script>
    @endforeach
@endif
