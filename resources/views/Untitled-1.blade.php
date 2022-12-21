<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<style>
  img {
  display: block;

  /* This rule is very important, please don't ignore this */
  max-width: 100%;
}
</style>


<img src="/logo/billing.png" alt="" id="image">
<img src="" alt="" id="output">


<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
  <script>
    i = new Cropper(document.getElementById('image'),{
      aspectRatio: 16 / 9,
      viewMode: 2,
      dragMode: 'none',
      zoomable: false,  
      crop(event) {
        url =  i.getCroppedCanvas().toDataURL();
        document.getElementById('output').setAttribute('src', url);
      },
    })
    
  
  </script>