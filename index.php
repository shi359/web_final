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
    <link rel="stylesheet" href="/src/css/index.css">
    <script src="/src/js/jquery.min.js"></script>
    <script src="/src/js/jquery-ui.js"></script>
    <script src="/src/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/src/js/fix_layout.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="/src/js/index.js" charset="UTF-8"></script>
</head>
<body>
<?php
    require_once("header.php");
?>
    
    <!-- slide -->
    <section class="cover">
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
                 <!-- Indicators -->
                 <ol class="carousel-indicators">
                   <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                   <li data-target="#myCarousel" data-slide-to="1"></li>
                   <li data-target="#myCarousel" data-slide-to="2"></li>
                 </ol>
               
                 <!-- Wrapper for slides -->
                 <div class="carousel-inner" role="listbox">
                   <div class="item active">
                     <img src="/src/pic/0.jpg" alt="...">
                   </div>
               
                   <div class="item">
                     <img src="/src/pic/1.jpg" alt="...">
                   </div>
               
                   <div class="item">
                     <img src="/src/pic/2.jpg" alt="...">
                   </div>
                 </div>
               
                 <!-- Left and right controls -->
                 <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                   <span class="glyphicon glyphicon-chevron-left"></span>
                   <span class="sr-only">Previous</span>
                 </a>
                 <a class="right carousel-control" href="#myCarousel" data-slide="next">
                   <span class="glyphicon glyphicon-chevron-right"></span>
                   <span class="sr-only">Next</span>
                 </a>
         </div>      
    </section>
    <hr>
    
    <!-- Newest Announcement -->
    <section class="ano">
        <div>
            <h1>最新公告</h1>
            <div class="anno_row">
<?php
    
    $sql = 'select * from announce order by id DESC limit 5';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo '<div class="row announce">';
        echo '<div class="col-sm-2 anno_date">'.$row["start_time"].'</div>';
        echo '<a href="./news.php?id='.$row["id"].'"><div class="col-sm-10 anno_title">'.$row["title"].'</div></a>';
        echo '</div>';
    }    
?>
            </div>
            
            <div class="more_anno">
                <a href="./announce.php">
                    <i class="fa fa-toggle-right"></i>
                    <span>更多公告...</span>
                </a>
            </div>
        </div>
    </section>
    <hr>
    
    <!-- Popular -->
    <section class="popular">
        <div class="container">
            <h1>常用項目</h1>
            <div class="pop_row row">
                <div class="pop_item col-sm-4">
                    <div class="pop_title">救助減免</div>
                    <div class="drop">
                        <div><a href="./page.php?page=assurance">平安保險</a></div>
                        <div><a href="./page.php?page=tuition">學雜費減免</a></div>
                        <div><a href="./page.php?page=dream">逐夢獎學金</a></div>
                        <div><a href="./page.php?page=disadv">弱勢助學金</a></div>
                        <div><a href="./page.php?page=studyloan">就學貸款</a></div>
                    </div>
                </div>
                <div class="pop_item col-sm-4">
                    <div class="pop_title">急難扶助</div>
                    <div class="drop">
                        <div><a href="./page.php?page=emergency">校內急難</a></div>
                        <div><a href="./page.php?page=studentEmergency">學產急難</a></div>
                    </div>
                </div>
                <div class="pop_item col-sm-4">
                    <div class="pop_title">獎助學金</div>
                    <div class="drop">
                        <div><a href="./page.php?page=sun">旭日獎學金</a></div>
                        <div><a href="./page.php?page=dream">逐夢獎學金</a></div>
                        <div><a href="#">校內外獎學金</a></div>
                        <div><a href="#">生活助學金</a></div>
                        <div><a href="./page.php?page=assistant">兼任行政助理</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="deadline">
        <div class="container">
            <h1>服務辦理時程</h1>
            <div class="row event">
<?php
    
    $sql = 'select * from schdule where CURDATE() between DATE(start_time) and DATE(end_time)';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo '<div class="event-header col-sm-6">';
        echo '<div class="col-sm-4 event-date">'.date("Y-m-d", strtotime($row["end_time"])).'</div>';
        echo '<div class="col-sm-8 event-title">'.$row["service"].'</div>';
        echo '</div>';
    }    
?>
            </div>
        </div>
    </section>
    
<?php
    require_once("footer.php");
?>
</body>

