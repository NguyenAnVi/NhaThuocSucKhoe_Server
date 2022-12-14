{{-- adding form --}}
<form id="register-form"  uk-grid class="uk-grid-small uk-form uk-child-width-1-1"
		method="POST" 
		action="{{ route('admin.hr.store') }}">
	@csrf

	<div class="uk-form" uk-grid>
		<div class="uk-width-expand uk-grid-match" uk-grid>
			<div class="uk-width-1-1@s uk-width-1-5@l">
				<label class="uk-form-large ">
					<label for="name" class="uk-text-bold uk-form-large">Họ và Tên: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-4-5@l">
				<input id="name" value="@if(old('name')!=NULL){{old('name')}}@endif" tabindex="1" class="uk-input uk-form-large @error('name') uk-form-danger @enderror" type="text" name="name" placeholder="Họ và tên">
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
			<div class="uk-width-1-1@s uk-width-1-5@l">
				<label class="uk-form-large">
					<label for="phone" class="uk-text-bold uk-form-large">Điện thoại: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-4-5@l">
				<input id="phone" value="@if(old('phone')!=NULL){{old('phone')}}@endif" tabindex="1" class="uk-input uk-form-large @error('phone') uk-form-danger @enderror" type="text" name="phone" placeholder="Điện thoại">
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
			<div class="uk-width-1-1@s uk-width-1-5@l">
				<label class="uk-form-large ">
					<label for="password" class="uk-text-bold uk-form-large">Mật khẩu: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-4-5@l">
				<input id="password" tabindex="1" class="uk-input uk-form-large @error('password') uk-form-danger @enderror" type="text" name="password" placeholder="Mật khẩu mới">
				@error('password')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>
	</div>

	<div class="uk-form" uk-grid>
		<div class="uk-width-expand uk-grid-match" uk-grid>
			<div class="uk-width-1-1@s uk-width-1-5@l">
				<label class="uk-form-large ">
					<label for="password_confirmation" class="uk-text-bold uk-form-large">Nhập lại mật khẩu: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-4-5@l">
				<input id="password_confirmation" tabindex="1" class="uk-input uk-form-large @error('password_confirmation') uk-form-danger @enderror" type="text" name="password_confirmation" placeholder="Nhập lại mật khẩu: ">
				@error('password_confirmation')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>
	</div>
	

	<div class="uk-width-1-1@s uk-text-center">
		<button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-1-4@l" type="submit" form="register-form">Thêm</button>
	</div>
</form>