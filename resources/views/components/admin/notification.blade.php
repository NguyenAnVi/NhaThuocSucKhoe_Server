  @foreach ($errors->all() as $key => $error)
  {{-- {{$key.'  '.$error}} --}}
      <script>
          UIkit.notification("{!! $error !!}", {status : 'primary', pos:'bottom-right'});
      </script>
  @endforeach
  