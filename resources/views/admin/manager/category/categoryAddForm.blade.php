<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
{{-- adding form --}}
<form id="create-form" uk-grid
        class="uk-grid-small uk-form" 
        method="POST"
        action="{{route('admin.category.store')}}">
    @csrf
    <div class="uk-width-1-1@s"> {{-- Ten danh muc --}}
        <input autofocus value="" tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" 
            type="text" name="name" placeholder="Tên danh mục" required>
        @error('name')
        <span class="uk-text-danger">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    
    <div class="uk-width-1-1@s"> {{-- Danh muc cha --}}
        <label class="uk-form-label" for="form-horizontal-select">Danh Mục</label>
        <div class="uk-form-controls">
            <select class="uk-select" id="form-horizontal-select" name="parent_id">
                <option value="0"> * </option>
                @foreach($categories as $category)
                <option @if(old('parent_id')==$category->id)selected @endif value="{{(int) $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
    </div>

    <div class="uk-width-1-1@s"> {{--Mô Tả Chi Tiết--}}
        <textarea name='detail' tabindex="2" id="froala-editor">{{old('detail')}}</textarea>
        @error('detail')
        <span class="uk-text-danger">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="uk-width-1-2@s">
        <label class="uk-form-label" for="form-horizontal-select">Kích Hoạt</label>
        <label>
            <input class="uk-radio" type="radio" checked name="status" value="1">
            Có:
        </label>
        <label>
            <input class="uk-radio" type="radio" name="status" value="0">
            Không:
        </label>
    </div>

    <div class="uk-width-1-1@s uk-text-center">
        <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-1-4@l" type="submit" form="create-form">Thêm</button>
    </div>
</form>
<form hidden id="new-saleoff" action="{{route('admin.category.create')}}" method="get"></form>
<script type="text/javascript" src="{{asset('froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script>
    $(document).ready(function(){
        new FroalaEditor('textarea#froala-editor');
    });
</script>


        