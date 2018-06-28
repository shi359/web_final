<?php

echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <title>v0icetube</title>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/src/css/index.css\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.0.9/css/all.css\" integrity=\"sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1\" crossorigin=\"anonymous\">
    <script src=\"https://code.jquery.com/jquery-3.3.1.min.js\" ></script>
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
      <link href=\"http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css\" rel=\"stylesheet\">
  <script src=\"http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js\"></script>
  <script src=\"http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-zh-TW.js\"></script>
</head>
<body>




<div class=\"container\">
    <div class=\"row\">
        <div >
        	
        	<table >
  			<tr>
    			<td><a href='javascript:alterPage(\"assurance.php\");'>平安保險</a></td>
    			<td><a href='javascript:alterPage(\"tuition.php\");'>學雜費減免</a></td>
    			<td><a href='javascript:alterPage(\"disadv.php\");'>弱勢助學</a></td>
  			</tr>
			</table>
        </div>
        <div id=\"summernote\"><p>Hello Summernote</p></div>
        <div><button type=\"button\" onclick=\"buttontest()\" >修改完成</button></div>
    </div>
</div>

<script>


    var currentPage;


    $(document).ready(function() {
        $('#summernote').summernote({
    		lang: 'zh-TW',
    		height: 600
  		});
    });
    function alterPage(page)
    {


        currentPage = page;


         $.when(
        $.ajax({                                      
              url: 'getsource.php',       
                
              type: \"POST\",

              data: \"page=\"+page,

              success: function(data) 
              {           
         
                $('#summernote').summernote('code',data);
              } 
            })
            
            ).done(
                //window.location.replace('fuck4.php')
            );
    	
        
 
    }

    function buttontest()
    {

       var markupStr = $('#summernote').summernote('code');

         $.when(
        $.ajax({                                      
              url: 'write_new_content_to_webpage.php',       
                
              type: \"POST\",

              data: {'page':currentPage,'content':markupStr},

              success: function(data) 
              {           
         
                console.log(data);
              } 
            })
            
            ).done(
                //window.location.replace('fuck4.php')
            );
    	
 


 
    }
   
  </script>







</body>
</html>



"

?>

