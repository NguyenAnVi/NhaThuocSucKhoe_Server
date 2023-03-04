{{-- adding form --}}
<form id="main-form" class="uk-grid-small uk-form" method="POST" enctype="multipart/form-data"
  action="{{ route('admin.saleoff.store') }}" uk-grid="">
  @csrf

  {{-- name --}}
  <div class="uk-width-1-1@s">
    <input autofocus tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror"
      type="text" name="name" placeholder="Tên CTKM" required>
    @error('name')
      <span class="uk-text-danger">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- price_check(value=1) => price_amount --}}
  <div class="uk-width-1-1@s">
    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
      <label>
        <input class="uk-radio" type="radio" checked name="price_check" value="1">
        Giảm giá theo tiền mặt (VNĐ):
      </label>
    </div>
    <div class="uk-width-1-1">
      <input tabindex="1"
        class="uk-input uk-width-expand uk-form-large @error('price_amount') uk-form-danger @enderror" type="number"
        min="0" name="price_amount" placeholder="Giá KM (vnd)">
      @error('price_amount')
        <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>

  {{-- price_check(value=0) => price_percent --}}
  <div class="uk-width-1-1@s">
    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
      <label>
        <input class="uk-radio" type="radio" name="price_check" value="0">
        Giảm giá theo phần trăm (%):
      </label>
    </div>
    <div class="uk-width-1-1">
      <input tabindex="1" class="uk-input uk-form-large @error('price_percent') uk-form-danger @enderror"
        type="number" min="0" max="100"name="price_percent" placeholder="Giá KM theo phần trăm">
      @error('price_percent')
        <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>

  <div class="uk-width-1-1@s uk-child-width-expand uk-padding-remove-right" uk-grid>
    <div class="uk-width-1-2@s">
      <label for="saleoff_start">Thời điểm bắt đầu:
        <input tabindex="1" type="datetime-local"
          class="uk-input uk-width-1-1 uk-form-large @error('saleoff_starttime') uk-form-danger @enderror"
          name="saleoff_starttime">
      </label>
      @error('saleoff_starttime')
        <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
      @enderror
    </div>

    <div class="uk-width-1-2@s">
      <label for="saleoff_endtime">Thời điểm kết thúc:
        <input tabindex="1" type="datetime-local" name="saleoff_endtime"
          class="uk-input uk-width-1-1 uk-form-large @error('saleoff_endtime') uk-form-danger @enderror">
      </label>
      @error('saleoff_endtime')
        <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
      @enderror
    </div>

  </div>

  <div class="uk-width-1-1@s">
    <div class="uk-width-1-1 uk-match" uk-form-custom>
      <input type="file" name="banner" accept="image/*">
      <button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh
        banner</button>
      @error('banner')
        <span class="uk-text-danger"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
    <div id="myImg" class="uk-width-1-1@s uk-text-center" uk-margin></div>
  </div>

  <div class="uk-width-1-1@s uk-text-center">
    <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-1-4@l" type="submit"
      form="main-form">Thêm</button>
  </div>
</form>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script>
	$(document).ready(function() {
    initialize();
  });

  function initialize() {
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
		function imageIsLoaded(e) {
			document.getElementById("myImg").innerHTML = "";
			$('#myImg').append('<img src="' + e.target.result + '"">');
		};
		$(function() {
			$(":file").change(function() {
				if (this.files && this.files[0]) {
					// for (var i = 0; i < this.files.length; i++) {
					var reader = new FileReader();
					reader.onload = imageIsLoaded;
					reader.readAsDataURL(this.files[0]);
					// }
				}
			});
		});

	};
</script>
