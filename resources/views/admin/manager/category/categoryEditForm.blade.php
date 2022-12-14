<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
<form id="edit-form" uk-grid
    class="uk-grid-small uk-form uk-child-width-1-1" 
    method="POST"
    action="{{route('admin.category.update', $category->id)}}">
  @csrf
  @method('put')
  <div class="uk-form" uk-grid>
    <div class="uk-width-expand uk-grid-match" uk-grid>
      <div class="uk-width-1-1@s uk-width-1-4@l">
        <label class="uk-form-large ">
          <input name="name_check" id="name_check" class="uk-checkbox" type="checkbox" >
          <label for="name_check" class="uk-text-bold uk-form-large">Tên Danh Mục: </label>
        </label>
      </div>
      <div class="uk-width-1-1@s uk-width-3-4@l">
        <input value="@if(old('name')!=NULL){{old('name')}}@else{{$category->name}}@endif" tabindex="1" 
        class="uk-input uk-form-large @error('name') uk-form-danger @enderror" 
        type="text" name="name" placeholder="Họ và tên">
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
        <label class="uk-form-large ">
          <input name="parent_id_check" id="parent_id_check" class="uk-checkbox" type="checkbox">
          <label for="parent_id_check" class="uk-text-bold uk-form-large">Danh Mục Cha: </label>
        </label>
      </div>
      <div class="uk-width-1-1@s uk-width-3-4@l">
        <div class="uk-width-1-1@s"> {{-- Danh muc cha --}}
            <label class="uk-form-label" for="form-horizontal-select">Danh Mục</label>
            <div class="uk-form-controls">
                <select class="uk-select @error('parent_id') uk-form-danger @enderror" id="form-horizontal-select" name="parent_id">
                    <option value="0"> * </option>
                    @foreach($categories as $item)
                    <option @if(old('parent_id')==$item->id)selected @endif value="{{(int) $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @error('parent_id')
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
          <input id="detail_check" name="detail_check" class="uk-checkbox" type="checkbox">
          <label for="detail_check" class="uk-text-bold uk-form-large">Chi tiết: </label>
        </label>
      </div>
      <div class="uk-width-1-1@s uk-width-3-4@l">
        <textarea tabindex="1" name='detail' tabindex="2" id="froala-editor">@if(old('detail')!=NULL){{old('detail')}}@else{{$category->detail}}@endif</textarea>
        @error('detail')
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
          <input name="status_check" id="status_check" class="uk-checkbox" type="checkbox">
          <label for="status_check" class="uk-text-bold uk-form-large">Kích Hoạt: </label>
        </label>
      </div>
      <div class="uk-width-1-1@s uk-width-3-4@l">
        <label>
            <input tabindex="1" class="uk-radio" type="radio" @if($category->status === 1){{__('checked')}}@endif name="status" value="1">
            Có:
        </label>
        <label>
            <input tabindex="1" class="uk-radio" type="radio" @if($category->status === 0){{__('checked')}}@endif name="status" value="0">
            Không:
        </label>
      </div>
    </div>
  </div>

  <div class="uk-width-1-1@s  uk-text-center">
    <button tabindex="2" 
      class="uk-button uk-button-primary uk-button-large uk-width-1-4" 
      type="submit" form="edit-form" >Thay đổi</button>
  </div>
</form>

<script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
<script> 
$(document).ready(function(){
  FroalaEditor('textarea#froala-editor');
  initialize();
});

function initialize(){
  $('input').on('change', function(e){
    let name = $(this).attr('name')+'_check';
    $('input[name='+name+']').attr('checked','checked');
    });
  $('select').on('click', function(){
    let name = $(this).attr('name')+'_check';
    $('input[name='+name+']').attr('checked','checked');
    });
  $('input').on('focus', function(){
    let name = $(this).attr('name')+'_check';
    $('input[name='+name+']').attr('checked','checked');
    });
}

</script>