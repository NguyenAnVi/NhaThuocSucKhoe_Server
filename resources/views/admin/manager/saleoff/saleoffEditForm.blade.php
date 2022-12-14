<form id="edit-form" class="uk-grid-small uk-form uk-child-width-1-1" uk-grid method="POST" enctype="multipart/form-data"
  action="{{ route('admin.saleoff.update', $saleoff) }}">
  @csrf
  @method('put')
  <div class="uk-form" uk-grid>
    <div class="uk-width-expand uk-grid-match" uk-grid>
      <div class="uk-width-1-1@s uk-width-1-4@l">
        <label class="uk-form-large ">
          <input id="name_check" name="name_check" class="uk-checkbox" type="checkbox">
          <label for="name_check" class="uk-text-bold uk-form-large">Tên CTKM: </label>
        </label>
      </div>
      <div class="uk-width-1-1@s uk-width-3-4@l">
        <input value="@if (old('name') != null) {{ old('name') }}@else{{ $saleoff->name }} @endif"
          tabindex="1" class="uk-input uk-form-large @error('name') uk-form-danger @enderror" type="text"
          name="name" placeholder="CTKM">
        @error('name')
          <span class="uk-text-danger">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>

  <hr>

  <div class="uk-form" uk-grid>
    <div class="uk-width-expand uk-grid-match" uk-grid>
      <div class="uk-width-1-1@s uk-width-1-4@l">
        <label class="uk-form-large ">
          <input id="change_price_check" name="change_price_check" class="uk-checkbox" type="checkbox">
          <label for="change_price_check" class="uk-text-bold uk-form-large">Giá KM: </label>
        </label>
      </div>
      <div class="uk-width-1-1@s uk-width-3-4@l">
        <div class="uk-margin uk-grid-large uk-child-width-auto uk-grid">
          <label><input class="uk-radio " type="radio" @if (old('price_amount') || $saleoff->amount != 0) {{ __('checked') }} @endif
              name="price_check" value="1">
            Giảm giá theo tiền mặt (VNĐ):
          </label>
        </div>
        <div class="uk-width-1-1">
          <input value="@if (old('price_amount') != null){{ old('price_amount') }}@else{{ $saleoff->amount }}@endif"
            tabindex="1"  data-value="1"
            class="price uk-input uk-width-expand uk-form-large @error('price_amount') uk-form-danger @enderror"
            type="number" min="0" name="price_amount" placeholder="Giá KM (vnd)">
          @error('price_amount')
            <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
          <label>
            <input class="uk-radio" type="radio" name="price_check" value="0"
              @if (old('price_percent') || $saleoff->percent != 0) {{ __('checked') }} @endif>
            Giảm giá theo phần trăm (%):
          </label>
        </div>
        <div class="uk-width-1-1">
          <input data-value="0"
            value="@if (old('price_percent') != null){{ old('price_percent') }}@else{{ $saleoff->percent }}@endif"
            tabindex="1" class="price uk-input uk-form-large @error('price_percent') uk-form-danger @enderror"
            type="number" min="0" max="100"name="price_percent" placeholder="Giá KM theo phần trăm">
          @error('price_percent')
            <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

      </div>
    </div>
  </div>

  <hr>

  <div class="uk-form" uk-grid>
    <div class="uk-width-expand uk-grid-match" uk-grid>
      <div class="uk-width-1-1@s uk-width-1-4@l">
        <label class="uk-form-large ">
          <input id="time_check" name="time_check" class="uk-checkbox" type="checkbox">
          <label for="time_check" class="uk-text-bold uk-form-large">Thời gian diễn ra: </label>
        </label>
      </div>
      <div class="uk-width-1-1@s uk-width-3-4@l">
        <div class="uk-width-1-2@s">
          <label for="saleoff_start">
            Thời điểm bắt đầu: 
            <input
              value="@if (old('saleoff_starttime')){{ date('Y-m-dtH:i', strtotime(old('saleoff_starttime'))) }}@else{{ date('Y-m-d\TH:i', strtotime($saleoff->starttime)) }}@endif"
              tabindex="1" type="datetime-local"
              class="uk-input uk-width-1-1 uk-form-large @error('saleoff_starttime') uk-form-danger @enderror"
              name="saleoff_starttime">
          </label>
          @error('saleoff_starttime')
            <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="uk-width-1-2@s">
          <label for="saleoff_endtime">
            Thời điểm kết thúc:<input
              value="@if (old('saleoff_endtime')){{ date('Y-m-dtH:i', strtotime(old('saleoff_endtime'))) }}@else{{ date('Y-m-d\TH:i', strtotime($saleoff->endtime)) }}@endif"
              tabindex="1" type="datetime-local" name="saleoff_endtime"
              class="uk-input uk-width-1-1 uk-form-large @error('saleoff_endtime') uk-form-danger @enderror">
          </label>
          @error('saleoff_endtime')
            <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
    </div>
  </div>

  <hr>

  <div class="uk-form" uk-grid>
    <div class="uk-width-expand uk-grid-match" uk-grid>
      <div class="uk-width-1-1@s uk-width-1-4@l">
        <label class="uk-form-large ">
          <input id="banner_check" name="banner_check" class="uk-checkbox" type="checkbox">
          <label for="banner_check" class="uk-text-bold uk-form-large">Ảnh banner: </label>
        </label>
      </div>
      <div class="uk-width-1-1@s uk-width-3-4@l">
        <div class="uk-width-1-1" uk-form-custom>
          <input id="file-input" type="file" name="banner" accept="image/*">
          <button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh
            banner</button>
        </div>
        @error('banner')
          <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
        @enderror
        <div id="myImg" class="uk-width-1-1@s uk-text-center" uk-margin></div>
      </div>
    </div>
  </div>


  <div class="uk-width-1-1@s  uk-text-center">
    <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-1-4" type="submit"
      form="edit-form">Thay đổi</button>
  </div>
</form>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script>
  $(document).ready(function() {
    initialize();
  });

  function initialize() {
    $('input').on('change', function(e) {
      let name = $(this).attr('name') + '_check';
      $('input[name=' + name + ']').attr('checked', 'checked');
    });
    $('[name=banner]').on('change', function(e) {
      $('input[name=banner_check]').attr('checked', 'checked');
    });
    $('select').on('click', function() {
      let name = $(this).attr('name') + '_check';
      $('input[name=' + name + ']').attr('checked', 'checked');
    });
    $('[type="datetime-local"]').on('change', function() {
      $('#time_check').attr('checked', 'checked');
    });
    $('.price').on('change', function() {
      let value = $(this).data('value');
      $('#change_price_check').attr('checked', 'checked');
      $('input[name=price_check][value='+ value +']').prop('checked', true);
    });

    $('input[name=price_check]').on('change', function() {
      let value = $(this).attr('value');
			let nameAct = '';
			let nameDis = '';
			if(value == 0){
				nameAct = 'price_percent';
				nameDis = 'price_amount';
			}else{
				nameAct = 'price_amount';
				nameDis = 'price_percent';
			}
      $('input[name='+nameDis+']').prop('disabled', true);
			$('input[name='+nameAct+']').prop('disabled',false);
    });

    $('input[name^=price_]').on('focus', function() {
			let value = $(this).attr('name');
			let nameAct = value;
			let nameDis = '';
			value = 0;
			if(nameAct == 'price_percent'){
				nameDis = 'price_amount';
			}else if(nameAct == 'price_amount'){
				nameDis = 'price_percent';
				value = 1;
			}
			else{ return}
      $('input[name='+nameDis+']').prop('disabled', true);
			$('input[name='+nameAct+']').prop('disabled',false);
			$('input[name=price_check][value='+value+']').prop('checked', true);
		});

    $(function() {
      $("#file-input").change(function() {
        if (this.files && this.files[0]) {
          var reader = new FileReader();
          reader.onload = imageIsLoaded;
          reader.readAsDataURL(this.files[0]);
        }
      });
    });

    function imageIsLoaded(e) {
      document.getElementById("myImg").innerHTML = "";
      $('#myImg').append('<img src="' + e.target.result + '"">');
    };
  }
</script>
