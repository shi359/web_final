function showName() {
    var hidList = document.getElementsByClassName("hid");
	var check = document.getElementById("anom"); 
	if(check.checked == true){
        $("#name").prop('required',true);
        $("#phone").prop('required',true);
		for(var i=0; i < hidList.length; i++)
			hidList[i].style.display="inline-block";
	} else{
        $("#name").prop('required',false);
        $("#phone").prop('required',false);
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
        if(size > 5000){
            alert("檔案不可超過 5MB");
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

function getParameter(param){
  var query = window.location.search;
  var iLen = param.length;
  var iStart = query.indexOf(param);
  if (iStart == -1)
　   return "";
  iStart += iLen + 1;
  var iEnd = query.indexOf("&", iStart);
  if (iEnd == -1)
　   return query.substring(iStart);
  
  return query.substring(iStart, iEnd);
}

$(document).ready(function() {
  var $sort = $("#sort");
  var $phone = $("#phone");
  // sort item by date
  $sort.click(function(){
     var search = getParameter("search");
     if($(this).attr("class") == "fa fa-caret-up"){
     	$(this).attr("class","fa fa-caret-down");
        $.get("lost.php", {sort: "DESC", k: search},function(result){
                $(".row.item-list").html(result); 
             });
     } else{
     	$(this).attr("class","fa fa-caret-up");
        $.get("lost.php", {sort: "ASC", k: search},function(result){
               $(".row.item-list").html(result); 
             },"html");
     }
   });	

}); 
