<?php
    require('config.php');
    
    $sql = 'select * from announce where id = ' . $_GET['id'];
    $que = $conn->query($sql);
    $row = $que->fetch_assoc();
    if($row==NULL) header("Location: ./index.php"); 
?>

<head>
    <title>清華大學生活輔導組</title>
    <link rel="shortcut icon" type="image/png" href="logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./fix_layout.css">
    <link rel="stylesheet" href="./news.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="./fix_layout.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="./news.js" charset="UTF-8"></script>
</head>
<body>
<?php
    require_once("header.php");
?>
      
    <section class="news">
        <div class="news_div">
            <div class="title"><?php echo $row['title']; ?></div>
            <div class="date">
                <i class="fa fa-calendar"></i><?php echo $row['start_time']; ?> - <?php echo $row['end_time']; ?>
            </div>
            <hr>
            <div class="content"><?php echo $row['content']; ?></div>
            <hr>
<?php
    if($row['files']!=NULL)
    {
        echo '<div class="attachment">';
        echo '<i class="fa fa-paperclip"></i>' . $row['files'];
        echo '</div>';
    }
    
    if($row['name']!=NULL)
    {
        $sql2 = 'select * from member where name = "' . $row['name'] . '"';
        $que2 = $conn->query($sql2);
        $row2 = $que2->fetch_assoc();
        
        echo '<div class="contact">';
        echo '<i class="fa fa-user"></i>' . $row2['name'];
        echo '</div>';
        echo '<div class="extension">';
        echo '<i class="fa fa-phone"></i>' . $row2['phone'];
        echo '</div>';
        echo '<div class="mail">';
        echo '<i class="fa fa-envelope"></i><a href="' . $row2['mail'] . '">' . $row2['mail'] . '</a>';
        echo '</div>';
    }
?>
        </div>
    </section>

<?php
    require_once("footer.php");
?>
</body>

