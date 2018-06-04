<?php
    require('db.php');  
?>

<head>
    <title>清華大學生活輔導組</title>
    <link rel="shortcut icon" type="image/png" href="logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./fix_layout.css">
    <link rel="stylesheet" href="./announce.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="./fix_layout.js" charset="UTF-8"></script>
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
    
    $sql = 'select * from announce';
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

