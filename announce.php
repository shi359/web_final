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
    <link rel="stylesheet" href="src/css/announce.css">
    <script src="/src/js/jquery.min.js"></script>
    <script src="/src/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/src/js/fix_layout.js" charset="UTF-8"></script>
</head>
<body>
<?php
    require_once("header.php");
?>
    
    <!-- Announcement -->
    <section class="announce">
        <h1>公告事項</h1>
        <div>
            <div class="anno_row">
<?php
    
    $sql = 'select * from announce order by (start_time) DESC';
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
        </div>
    </section>

<?php
    require_once("footer.php");
?>
</body>

