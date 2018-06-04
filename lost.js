function showName() {
    var hidList = document.getElementsByClassName("hid");
	var check = document.getElementById("anom"); 
	if(check.checked == true){
        $("#name").prop('required',true);
        $("#phone").prop('required',true);
		for(var i=0; i < hidList.length; i++)
			hidList[i].style.display="inline-block";
	} else{
		for(var i=0; i < hidList.length; i++)
			hidList[i].style.display="none";
	}
	
}

function preview(event){
	var img = event.target;

    /// check file size
    var size = img.files[0].size;
    if(size/1024 > 1){
        size = Math.round(((size/1024)*1000)/1000);
        if(size > 2000){
            alert("檔案不可超過 2MB");
            event.target.value="";
            document.getElementById('prevw').style.display="none";
            return;
        }
    }

    // check file type
    var type = img.files[0].type;
    var valid = ["image/jpg", "image/jpeg", "image/png"];
    if($.inArray(type,valid) < 0){
        alert("檔案格式錯誤");
        event.target.value="";
        document.getElementById('prevw').style.display="none";
        return;
    }
    // previw the uploaded photo
	var reader = new FileReader();
	reader.readAsDataURL(img.files[0]);
	reader.onload = function(){
		var dataURL = reader.result;
		var prvw = document.getElementById('prevw');
		prvw.src = dataURL;
		prvw.style.display="block";

	}
}

$(document).ready(function() {
  var $sort = $("#sort");
  var $phone = $("#phone");
 // var $post = $("#post");
   $sort.click(function(){
     if($(this).attr("class") == "fa fa-caret-up"){
     	$(this).attr("class","fa fa-caret-down");
     } else{
     	$(this).attr("class","fa fa-caret-up");
     }
   });	

   /*
    $post.click(function(){
        var $anom = $("#anom").is(":checked");
        var patt = /^09\d{8}$/;

        // check form completion
        if($anom == true && patt.test($("#phone").val())==false){
                alert("電話號碼格式錯誤");
        }
        else
            $.post("lost.php",$(".pop-form".serialize())); // post request
    }); */
}); 
