<?php
    require('config.php');  
?>

<head>
    <title>清華大學生活輔導組</title>
    <link rel="shortcut icon" type="image/png" href="/src/pic/logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/src/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/css/font-awesome.min.css">
    <link rel="stylesheet" href="/src/css/fix_layout.css">
    <link rel="stylesheet" href="/src/css/example.css">
    <script src="/src/js/jquery.min.js"></script>
    <script src="/src/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/src/js/fix_layout.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="/src/js/echinacea.js" charset="UTF-8"></script>
</head>
<body>
<?php
    require_once("header.php");
    $pagename = htmlspecialchars($_GET["page"]);
    echo file_get_contents($pagename.'.txt');
    
    $sql = "SELECT count(1) as cnt from pageUpload where pageName = \"".$_GET['page']."\"";
    $scnt = $conn->query($sql)->fetch_assoc()["cnt"];
    if($scnt>0)
    {
        echo '  <section class="contain">
                    <hr>
                    <div>
                        <div class="content">
                            <div class="subtitle">
                                 相關下載
                                <i class="fa fa-chevron-down"></i>
                            </div>
                            <div class="article">
                                <div class="link">';
        $sql = 'select * from pageUpload where pageName = "'.$pagename.'"';
        $que = $conn->query($sql);
        while($row = $que->fetch_assoc())
        {
            echo '<i class="fa fa-file"></i><a href="./file/'.$pagename.'/'.$row['uploadFile'].'">'.$row['uploadFile'].'</a><br>';
        }   
        
        echo '              </div>
                        </div>
                    </div>
                </div>
                <hr>
            </section>';
    }
    
    $sql = "SELECT count(1) as cnt from pages where pageName = \"".$_GET['page']."\" and manager <> \"default\"";
    $scnt = $conn->query($sql)->fetch_assoc()["cnt"];
    if($scnt>0)
    {
        echo '<section class="contain">
            <div class="content">
                <div class="contact">
                    <i class="fa fa-user"></i>';
                    
        $sql = 'select * from pages where pageName = "'.$pagename.'"';
        $name = $conn->query($sql)->fetch_assoc()['manager'];
        echo $name;
        
        echo'     </div>
                <div class="extension">
                    <i class="fa fa-phone"></i>';
                    
        $sql = 'select * from member where name = "'.$name.'"';
        $phone = $conn->query($sql)->fetch_assoc()['phone'];
        echo $phone;

        echo '    </div>
            </div>
        </section>';
    }
    require_once("footer.php");
?>
</body>

