<?php



if(isset($_POST["page"])&&$_POST["page"]!="")
{

      $pagedata = file_get_contents($_POST["page"]);
	echo $pagedata;
}
else
{
	echo "yeeeeee";
}


?>
