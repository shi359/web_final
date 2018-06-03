var hidList = document.getElementsByClassName("hid");
function showName() {
	var check = document.getElementById("anom"); 
	if(check.checked == true){
		for(var i=0; i < hidList.length; i++)
			hidList[i].style.display="inline-block";
	} else{
		for(var i=0; i < hidList.length; i++)
			hidList[i].style.display="none";
	}
	
}

function preview(event){
	var img = event.target;
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
  var $post = $("#post");
   $sort.click(function(){
     if($(this).attr("class") == "fa fa-caret-up"){
     	$(this).attr("class","fa fa-caret-down");
     } else{
     	$(this).attr("class","fa fa-caret-up");
     }
   });	
   
    $post.click(function(){
        var $itm = $("#item").val();
        var $place = $("#place").val();
        var $days = $("#days").val();
        var $name = $("#name").val();
        var $phone = $("#phone").val();
        var $anom = $("#anom").is(":checked");
        var patt = /^09\d{8}$/;
        if($itm.length == 0 || $place.length == 0){
            alert("請填寫完整");
            return;
        }
        if($anom == true){
            console.log($anom);
            if($name.length == 0 || $phone.length == 0){
                alert("請填寫完整");
                return;
            }
            if(patt.test($phone)==false){
                alert("電話號碼格式錯誤");
                return;
            }
        }
        $.ajax({
            type: "POST",
            url: "lost.php",
            data: {
                item: $itm,
                place: $place,
                days: $days,
                anom: $anom,
                name: $name,
                phone: $phone
            },
            success: function(){
             $('#postModal').modal('hide');
            }
        });
    });
}); 
