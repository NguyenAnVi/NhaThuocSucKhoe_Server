<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
<form id="create-form" uk-grid class="uk-grid-small uk-form" method="POST" enctype="multipart/form-data"
  action="{{ route('admin.product.store') }}">
  @csrf

  
  <div class="uk-width-1-2@s uk-grid-top" uk-grid>
    {{-- tensp --}}
    <div class="uk-width-1-1">
      <label for="name">Tên SP</label>
      <input autofocus value="{{ old('name') }}" tabindex="1"
        class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" type="text" name="name"
        placeholder="Tên SP" required>
      @error('name')
        <span class="uk-text-danger">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    {{-- khuyenmai --}}
    <div class="uk-width-1-2@s">
      <label class="uk-form-label" for="saleoff">
        Chương trình khuyến mãi
      </label>
      <div class="uk-form-controls">
        <select class="uk-select" id="saleoff_list" name="saleoff" onchange="changeFunc()">
          
          <hr class="uk-divider-icon">
          <option value="-1">{{ __('Thêm CTKM mới') }}</option>
        </select>
      </div>
    </div>

    {{-- danhmuc --}}
    <div class="uk-width-1-2@s">
      <label class="uk-form-label" for="category">
        Danh mục
      </label>
      <div class="uk-form-controls">
        <select class="uk-select" id="category_list" name="category">
          <hr class="uk-divider-icon">
          <option>{{ __('Thêm danh mục mới') }}</option>
        </select>
      </div>
    </div>

    {{-- giaban --}}
    <div class="uk-width-1-2@s">
      <label class="uk-form-label" for="">
        Giá bán
      </label>
      {{-- <a class="uk-form-icon uk-form-icon-flip" href="#" uk-icon="icon: link"></a> --}}
      <input tabindex="1" value="{{ old('price') }}"
        class="uk-input uk-width-1-1 uk-form @error('price') uk-form-danger @enderror" type="number" min="0"
        step="1000" name="price" placeholder="Giá bán (vnd)" required>
      @error('price')
        <span class="uk-text-danger">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    {{-- tonkho --}}
    <div class="uk-width-1-2@s">
      <label class="uk-form-label" for="stock">
        Tồn kho
      </label>
      {{-- <a class="uk-form-icon uk-form-icon-flip" href="#" uk-icon="icon: link"></a> --}}
      <input tabindex="1" value="{{ old('stock') }}"
        class="uk-input uk-width-1-1 uk-form @error('stock') uk-form-danger @enderror" type="number" min="0"
        step="1" name="stock" placeholder="Tồn kho" required>
      @error('stock')
        <span class="uk-text-danger">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>

  {{-- hinhanh --}}
  <div class="uk-width-1-2@s uk-grid-match">
    <div class="uk-width-1-1 uk-match" uk-form-custom>
      <input name="images[]" type="file" accept="image/*" multiple>
      <button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh</button>
    </div>
    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
      uk-slider="sets: true; finite: true; easing; velocity:3">
      <ul id="myImg" class="uk-grid uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m">
      </ul>
    </div>
  </div>

  {{-- chitiet --}}
  <div class="uk-width-1-1@s uk-grid-match">
    <textarea name='detail' tabindex="2" id="froala-editor">{{ old('detail') }}</textarea>
    @error('detail')
      <span class="uk-text-danger">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>


  <div class="uk-width-1-1@s uk-text-center">
    <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-1-4@l" type="submit"
      form="create-form">Thêm</button>
  </div>
</form>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
<script>
	$(document).ready(function(){
		let editor = new FroalaEditor('textarea#froala-editor');
    init();
	});

  function init(){
    $(function() {
      $(":file").change(function() {
        if (this.files && this.files[0]) {
          for (var i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[i]);
          }
        }
      });
    });
    function imageIsLoaded(e) {
      // $('#myImg').append('<li class="uk-active uk-width-1-4"><img class="uk-comment-avatar" src=' + e.target.result + ' width="100" height="67" ></li>');
      $('#myImg').append(
        '<li><button class="uk-button uk-button-danger uk-position-small uk-position-absolute uk-position-top-right" onclick="" uk-close></button><img src=' +
        e.target.result + ' width="400" height="600" alt=""></li>');
    };
    $(function (){
      let olddata = $('#category_list').html();
      $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: 'get',
        url: '{{route("admin.category.getallleaf")}}',
        data: {},
        success:function(obj){
          // alert(JSON.parse(obj)[1].id)
          $('#category_list').html(select_row(JSON.parse(obj))+olddata);
        }
      });

      olddata = $('#saleoff_list').html();
      $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: 'get',
        url: '{{route("admin.saleoff.getall")}}',
        data: {},
        success:function(obj){
          $('#saleoff_list').html(select_row(JSON.parse(obj))+olddata);
        }
      });
      
    });

    function select_row(collection){
      let o= '';
      collection.forEach(function (item) {
        o +=  '<option value="'+item.id+'">'+item.name+'</option>';
      });
      return o;
	  }
  }

  $('#category_list').change(function(){
    if($(this).val() == -1){
      window.location.href='/admin/category/create';
    };
  });
  $('#saleoff_list').change(function(){
    if($(this).val() == -1){
      window.location.href='/admin/saleoff/create';
    };
  });
  
</script>
