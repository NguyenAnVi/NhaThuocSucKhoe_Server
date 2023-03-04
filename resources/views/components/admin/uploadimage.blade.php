<a class="uk-button uk-button-default" href="#uploadimage" uk-toggle>upload</a>
<div id="uploadimage" uk-modal="bg-close:false;">
  <div class="uk-modal-dialog">
      <button class="uk-modal-close-default" type="button" uk-close></button>
      <div class="uk-modal-header">
          <h2 class="uk-modal-title">@lang('admin.component.uploadimage.title')</h2>
      </div>
      <div class="uk-modal-body">
        <form action="{{ route('admin.image.upload') }}" enctype="multipart/form-data">
          <div class="js-upload uk-placeholder uk-text-center ">
            <div uk-form-custom="target:true" class="uk-flex">
              <img class="uk-width-1-3" id="upload-image-img" src="" alt="">
              <div class="uk-width-2-3">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">Attach binaries by dropping them here or</span>
                <input id="upload-image-input" name="image" type="file">
                <span class="uk-link">selecting one</span>
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
  console.log(URL.createObjectURL(e.target.files[0]));
});

$('#upload-image-button-submit').on('click', function() {
  if (currentFile) {
    var formData = new FormData()
    formData.append('image', currentFile)
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'post',
      url: '{{route("admin.image.upload")}}',
      data: formData,
      dataType: 'json',
      // data: {
      //   'image': currentFile
      // },
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      success:function(obj){
        console.log('Upload success: '+ JSON.parse(obj));
        // UIkit.modal.alert('Upload success: '+ JSON.parse(obj));
      }
    });
  }
});
</script>