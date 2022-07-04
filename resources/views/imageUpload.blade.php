<!DOCTYPE html>
<html>
<head>
    <title>How to Image Upload in Laravel 9</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="card">
    <div class="card-header text-center font-weight-bold">
      <h2>You want upload your image ? Its here bro</h2>
    </div>
    <div class="card-body">
      <form name="image-upload" id="image-upload" method="post" action="{{url('image-upload')}}" enctype="multipart/form-data">
       @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Please Select Image</label>
          <input type="file" id="image" name="image" class="@error('image') is-invalid @enderror form-control">
          @error('image')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-12 mb-2">
                  <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                      alt="preview image" style="max-height: 250px;">
              </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  
</div>  
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 
<script type="text/javascript">
      
$(document).ready(function (e) {
 
   
   $('#image').change(function(){
            
    let reader = new FileReader();
 
    reader.onload = (e) => { 
 
      $('#preview-image-before-upload').attr('src', e.target.result); 
    }
 
    reader.readAsDataURL(this.files[0]); 
   
   });


   
});
 
</script>  
</body>
</html>
