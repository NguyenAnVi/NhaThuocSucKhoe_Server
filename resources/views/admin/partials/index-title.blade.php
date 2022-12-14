<div class="uk-flex-around uk-flex">
    <H3 class="uk-text-bold uk-text-center">{{$title}}</H3>
</div>
<div class="uk-flex uk-flex-center uk-flex-right@m uk-flex-middle uk-flex-wrap">
    <div>
        <input disabled class="uk-form uk-input uk-icon-button" style="border-radius: 25px"  
        type="text" name="info" value="Tổng số : {{$collection -> total()}}">
    </div> &nbsp;
    @include('admin.partials.searchbar') &nbsp;
    @if(isset($createRoute))
    <div>
        <button class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small" 
                onclick="window.location.href='{{$createRoute}}'">
            Thêm mới &nbsp;&nbsp;&nbsp; 
            <span uk-icon="plus"></span>
        </button>
    </div>
    @endif
</div>
