<div id="message_field" class="uk-container uk-padding-horizontal">

@error('danger')
<div class="uk-margin-top uk-alert-danger" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}</p>
</div>
@enderror

@error('success')
<div class="uk-margin-top uk-alert-success" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}</p>
</div>

@enderror

@error('warning')
<div class="uk-margin-top uk-alert-warning" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}</p>
</div>
@enderror

@foreach ($errors->all() as $key => $error)
{{$key.'  '.$error}}
    <script>
        Uikit.notification({{$error}}, {status : {!! $key !!} })
    </script>
@endforeach
    
</div>

