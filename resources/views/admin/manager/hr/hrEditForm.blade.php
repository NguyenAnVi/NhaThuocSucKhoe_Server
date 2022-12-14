<form id="edit-form" uk-grid class="uk-grid-small uk-form uk-child-width-1-1" method="POST" action="{{ route('admin.hr.update', $admin->id) }}">
	@csrf
	@method('put')
	<div class="uk-form" uk-grid>
		<div class="uk-width-expand uk-grid-match" uk-grid>
			<div class="uk-width-1-1@s uk-width-1-4@l">
				<label class="uk-form-large ">
					<input id="name_check" name="name_check" class="uk-checkbox" type="checkbox">
					<label for="name_check" class="uk-text-bold uk-form-large">Họ và Tên: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-3-4@l">
				<input value="@if(old('name')!=NULL){{old('name')}}@else{{$admin->name}}@endif" tabindex="1" class="uk-input uk-form-large @error('name') uk-form-danger @enderror" type="text" name="name" placeholder="Họ và tên">
				@error('name')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>
	</div>
	<div class="uk-form" uk-grid>
		<div class="uk-width-expand uk-grid-match" uk-grid>
			<div class="uk-width-1-1@s uk-width-1-4@l">
				<label class="uk-form-large">
					<input id="phone_check" name="phone_check" class="uk-checkbox" type="checkbox">
					<label for="phone_check" class="uk-text-bold uk-form-large">Điện thoại: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-3-4@l">
				<input value="@if(old('phone')!=NULL){{old('phone')}}@else{{$admin->phone}}@endif" tabindex="1" class="uk-input uk-form-large @error('phone') uk-form-danger @enderror" type="text" name="phone" placeholder="Điện thoại">
				@error('phone')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>
	</div>
	<div class="uk-form" uk-grid>
		<div class="uk-width-expand uk-grid-match" uk-grid>
			<div class="uk-width-1-1@s uk-width-1-4@l">
				<label class="uk-form-large ">
					<input id="password_check" name="password_check" class="uk-checkbox" type="checkbox">
					<label for="password_check" class="uk-text-bold uk-form-large">Mật khẩu: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-3-4@l">
				<input tabindex="1" class="uk-input uk-form-large @error('password') uk-form-danger @enderror" type="text" name="password" placeholder="Mật khẩu mới">
				@error('password')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>
	</div>
	<div class="uk-width-1-1@s  uk-text-center">
		<button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-1-4" type="submit" form="edit-form">Thay đổi</button>
	</div>
</form>
<script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
<script> 
$(document).ready(function(){
  initialize();
});

function initialize(){
  $('input').on('change', function(e){
    let name = $(this).attr('name')+'_check';
    $('input[name='+name+']').attr('checked','checked');
    });
}

</script>