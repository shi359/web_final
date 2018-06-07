<?php
    session_start();
    if($_SESSION['uid']=="" || $_SESSION['aDMinD0sA']!="dosaadmin") header("Location: ./index.php");
    
    require('config.php');
?>

<head>
    <title>清華大學生活輔導組管理系統</title>
    <link rel="shortcut icon" type="image/png" href="logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="./fix_layout.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="./admin.js" charset="UTF-8"></script>
</head>
<body>
    <!-- header -->
    <div class="roof container">
        <div class="row">
                <img src="title.png">
                <div style="float: right; font-size: 20px; margin: 10px;"><a href="./logout.php" style="text-decoration: none; color: black;"><i class="fa fa-sign-out"></i> 登出</a></div>
        </div>
    </div>
    <div class="main">
            <div class="side_list">
                <div class="side_list_row row">
                    <div class="side_list_item">
                        <div class="side_list_title">公告事項</div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">服務辦理時程</div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">失物招領</div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">救助減免</div>
                        <div class="drop">
                            <div><a href="#">平安保險</a></div>
                            <div><a href="#">學雜費減免</a></div>
                            <div><a href="#">弱勢助學金</a></div>
                            <div><a href="#">就學貸款</a></div>
                            <div><a href="#">學產低收</a></div>
                        </div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">急難扶助</div>
                        <div class="drop">
                            <div><a href="#">校內急難</a></div>
                            <div><a href="#">安心就學</a></div>
                            <div><a href="#">學產急難</a></div>
                            <div><a href="#">行天宮急難</a></div>
                            <div><a href="#">台灣公益急難</a></div>
                            <div><a href="#">張榮發急難</a></div>
                        </div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">獎助學金</div>
                        <div class="drop">
                            <div><a href="#">還願獎學金</a></div>
                            <div><a href="#">旭日獎學金</a></div>
                            <div><a href="#">逐夢獎學金</a></div>
                            <div><a href="#">生活助學金</a></div>
                            <div><a href="#">兼任行政助理</a></div>
                            <div><a href="#">校內外獎學金</a></div>
                            <div><a href="#">圓夢助學網</a></div>
                        </div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">住宿賃居</div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <section class="ano">
                    <div>
                        <h1>公告事項</h1>
                        <div class="anno_row">
<?php
    
    $sql = 'select * from announce';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo '<div class="row announce">';
        echo '<div class="col-sm-2 anno_date">'.$row["start_time"].'</div>';
        echo '<div class="col-sm-10 anno_title">'.$row["title"].'</div>';
        echo '</div>';
    }    
?>
                        </div>
                    </div>
                </section>
            </div>
    </div>
</body>

