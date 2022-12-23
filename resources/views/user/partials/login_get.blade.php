<script>
  $(document).ready(function() {
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();

        // Thuc hien lay element trigger
        $trigger = $('input:focus').data('trigger');
        // Thuc hien lay element trigger lien quan 
        $button = $($trigger);

        $button.click();
        return;
      }
    });
  });
</script>



<div id="group1" uk-modal>
  <div class="uk-modal-dialog uk-margin-auto-vertical ">
    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-body">

      <div id="group1_slider" class="uk-position-relative uk-visible-toggle uk-width-1-1" tabindex="-1" uk-slider="center: true; draggable:false; finite: true;">
        
          <ul class="uk-slider-items uk-grid">
            
            <li id="group1_page1" class="uk-width-1-1 uk-flex uk-flex-column">
              <div class="uk-panel uk-height-1-1 uk-flex uk-flex-stretch uk-flex-column">
                <div>
                  <div>
                    <h4 class="uk-text-center">@lang('auth.login') / @lang('auth.register')</h4>
                  </div>
                  <div>
                    <input name="phone" data-trigger="a#group1_button" id="group1_input_phone" onchange="$('#group1_input_newphone').val($(this).val())" type="text" placeholder="@lang('auth.msg.type_phone')" class="uk-input uk-width-expand">
                  </div>
                </div>
                <div>
                  <a id="group1_button" class="uk-width-1-1 uk-button uk-button-primary" data-route="{{ route('checkphone') }}">@lang('auth.confirm')</a>
                </div>

              </div>
            </li>

            <li id="group1_page2" class="uk-width-1-1">
              <div class="uk-panel">
                <a onclick="UIkit.slider('#group1_slider').show(0)"><h4 class="uk-text-center"><span uk-icon="icon:arrow-left; ratio:1.5;"></span>@lang('general.back')</h4></a>
                  <div class="uk-width-1-1">
                    
                  </div>
                  <div id="group1_inputgroup_password" class="uk-width-1-1 uk-flex">
                    <input name="password" data-trigger="a#group1_submit" id="group1_input_password" type="password" placeholder="@lang('auth.msg.type_password')"  class="uk-input uk-width-expand">
                  </div>

                  <a id="group1_submit" class="uk-width-1-1 uk-button uk-button-primary" >@lang('auth.login')</a>

              </div>
            </li>

            <li id="group1_page3" class="uk-width-1-1">
              <div class="uk-panel">
                <form id="group1_form_register" action="{{route('register')}}" method="post"></form>
                <a onclick="UIkit.slider('#group1_slider').show(0)"><h4 class="uk-text-center"><span uk-icon="icon:arrow-left; ratio:1.5;"></span>@lang('general.back')</h4></a>
                <div id="group1_inputgroup_newname" class="uk-width-1-1 uk-flex">
                  <input name="newname" data-trigger="a#group1_submit_register" id="group1_input_newname" type="name" placeholder="@lang('auth.msg.type_name')" class="uk-input uk-width-expand">
                  <input name="newphone" id="group1_input_newphone" type="hidden" >
                </div>

                <div id="group1_inputgroup_newpassword" class="uk-width-1-1 uk-flex">
                  <input name="newpassword" data-trigger="a#group1_submit_register" id="group1_input_newpassword" type="password" placeholder="@lang('auth.msg.type_newpassword')"  class="uk-input uk-width-expand">
                </div>

                <div id="group1_inputgroup_passwordconfirm" class="uk-width-1-1 uk-flex">
                  <input name="newpasswordconfirm" data-trigger="a#group1_submit_register" id="group1_input_newpasswordconfirm" type="password" placeholder="@lang('auth.msg.type_newpasswordconfirm')"  class="uk-input uk-width-expand">
                </div>

                <a id="group1_submit_register" onclick="$('#group1_form_register').submit()"  class="uk-width-1-1 uk-button uk-button-primary" >@lang('auth.register')</a>
              </div>
            </li>

          </ul>
        
      
      </div>
      
    </div>
    
  </div>
</div>

<script>
            
  $('#group1_button').on('click',function(){
    console.log('send phone number to check');
    $route = $(this).data('route');
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'get',
      data:{
        'phone' : $('input#group1_input_phone').val(),
      },
      url: $route,
      success:function(obj){
        console.log('server responded phone status: ' );
        result = JSON.parse(obj);
        switch (result.response_code) {
          case 0:
            console.log('response_code == 0' );
            UIkit.slider($('#group1_slider')).show(1);

            break;
          case 1:
            console.log('response_code == 1' );
            UIkit.slider($('#group1_slider')).show(2);

            break;
          case 2:
            console.log('response_code == 2' );
            UIkit.slider($('#group1_slider')).show(0);
            UIkit.notification("@lang('auth.error')");
            break;
          default:
            break;
        }
          
      }
    });
  });

  $('#group1_submit').on('click',function(){
    console.log('Send login request');
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'post',
      url: "{{ route('login') }}",
      data:{
        'phone' : $('#group1_input_phone').val(),
        'password' : $('#group1_input_password').val(),
      },
      success:function(obj){

        stt = JSON.parse(obj).status;
        console.log('server responded status: ', stt );
        switch (stt) {
          case 0:
            UIkit.modal.alert("@@lang('auth.login_success')").then(function(){
              location.reload();
            });
            break;
        
          default:
            break;
        }
      }
    });
  });
</script>