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