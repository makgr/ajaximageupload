<!DOCTYPE html>
<html>
<head>
  <title></title>

  <meta name="csrf_token" content="{{csrf_token()}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  
</head>
<body>
  <center>
    
  
<div class="row">
  @if(empty($emp_data->emp_img))
  <img id="img_prv" style="max-width: 150px;max-height: 150px" class="img-thumbnail" src="{{asset('emp_profile/user.jpg')}}">

  @else
  <img id="img_prv" style="max-width: 150px;max-height: 150px" class="img-thumbnail" src="{{asset('emp_profile/'.$emp_data->emp_img)}}">
  @endif
  
</div>
<div class="row">
  <label>Image upload</label>
  <input type="file" name="file_img" id="img_file_upid">
  <span id="mgs_ta">
    
  </span>
</div>
</center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
  $('#img_file_upid').on('change',function(ev){
    console.log("here inside");

    var filedata=this.files[0];
    var imgtype=filedata.type;


    var match=['image/jpeg','image/jpg'];

    if(!(imgtype==match[0])||(imgtype==match[1])){
        $('#mgs_ta').html('<p style="color:red">Plz select a valid type image..only jpg jpeg allowed</p>');

    }else{

      $('#mgs_ta').empty();
    

    //---image preview

    var reader=new FileReader();

    reader.onload=function(ev){
      $('#img_prv').attr('src',ev.target.result).css('width','150px').css('height','150px');
    }
    reader.readAsDataURL(this.files[0]);

    /// preview end

        //upload

        var postData=new FormData();
        postData.append('file',this.files[0]);

        var url="{{url('ajaxuploadimg')}}";

        $.ajax({
        headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
        async:true,
        type:"post",
        contentType:false,
        url:url,
        data:postData,
        processData:false,
        success:function(){
          console.log("success");
          $('#mgs_ta').html('<p style="color:green">Upload successfully.</p>');
        }


        });

    }

  });

</script>


</body>
</html>