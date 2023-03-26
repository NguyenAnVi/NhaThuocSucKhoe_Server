<div id="uploadimage" uk-modal="bg-close:false;stack: true">
  <div class="uk-modal-dialog">
      <button class="uk-modal-close-default" type="button" uk-close></button>
      <div class="uk-modal-header">
          <h2 class="uk-modal-title">@lang('admin.component.uploadimage.title')</h2>
      </div>
      <div class="uk-modal-body">
        <form action="{{ route('admin.image.upload') }}" enctype="multipart/form-data">
          <div class="js-upload uk-placeholder uk-text-center ">
            <div uk-form-custom="target:true" class="uk-flex uk-flex-row">
              <style>
                
                #upload-image-img{
                  width: 30%; height:30%; object-fit:cover;
                }
              </style>
              <img class="uk-border-rounded-10 uk-box-shadow-small" id="upload-image-img" alt="">
              <div class="uk-flex uk-width-1-1">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">@lang('admin.component.uploadimage.dropimagehere')</span>
                <input id="upload-image-input" name="image" type="file">
                
              </div>
            </div>
          </div>
        </form>
        

      </div>
      <div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-default uk-modal-close" type="button">@lang('admin.button.cancel')</button>
          <button id="upload-image-button-submit" class="uk-button uk-button-primary" type="button">@lang('admin.button.upload')</button>
      </div>
  </div>
</div>
<script>
  var currentFile;
  $('#upload-image-input').on('change',function(e){
    $('#upload-image-img').attr('src', URL.createObjectURL(e.target.files[0]));
    currentFile = e.target.files[0];
    // console.log(URL.createObjectURL(e.target.files[0]));
  });

  $('#upload-image-button-submit').on('click', function() {
    if (currentFile) {
      var formData = new FormData()
      formData.append('image', currentFile)
      formData.append('uid', '{{ Auth::user()->id }}')
      $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: 'post',
        url: '{{route("admin.image.upload")}}',
        data: formData,
        dataType: 'json',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        success:function(obj){
          $('input#uploaded-image-url[type=text]').val(obj.url)
          $('input#uploaded-image-url[type=text]').trigger('oninput')

          UIkit.notification('@lang('admin.component.uploadimage.uploadsuccess')');
          UIkit.modal('#uploadimage').hide();
          {{ isset($optional)?$optional:"" }}
        }
      });
    }
  });
</script>