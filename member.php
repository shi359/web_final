<?php
    require('config.php');
?>

<head>
    <title>清華大學生活輔導組</title>
    <link rel="shortcut icon" type="image/png" href="logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./fix_layout.css">
    <link rel="stylesheet" href="./member.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="./fix_layout.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="./member.js" charset="UTF-8"></script>
</head>
<body>
<?php
    require_once("header.php");
?>
    <!-- Member -->
    <section class="member">
        <div class="position_div container">
            <div class="position row">
                生輔組組長
            </div>
            <div class="member_row">
                <div class="row">
<?php
    $sql = 'select * from member where title="生輔組長"';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo '<div class="card col-sm-6">';
        echo '<div class="member_title row">';
        echo '<span class="member_name">' . $row['name'] . '</span>&nbsp;';
        echo '<span class="member_class">' . $row['class'] . '</span>';
        echo '</div>';
        echo '<div class="member_content row">';
        echo '<div class="pic col-sm-4">';
        echo '<img src="./' . $row['id'] . '.png"></img>';
        echo '</div>';
        
        echo '<div class="spanout col-sm-8">';
        echo '<table>';
        if($row['phone']!="" && $row['phone']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-phone"></i>' . $row['phone'];
            echo '</td></tr>';
        }
        if($row['mail']!="" && $row['mail']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-envelope"></i>';
            echo '<a href="mailto:' . $row['mail'] . '">' . $row['mail'] . '</a>';
            echo '</td></tr>';
        }
        if($row['dept']!="" && $row['dept']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-users"></i>' . $row['dept'];
            echo '</td></tr>';
        }
        if($row['work']!="" && $row['work']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-gear"></i>' . $row['work'];
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</div></div></div>';
    }    
?>
                </div>
            </div>
        </div>
        <div class="position_div container">
            <div class="position row">
                教官
            </div>
            <div class="member_row">
                <div class="row">
<?php
    $sql = 'select * from member where title="教官"';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo '<div class="card col-sm-6">';
        echo '<div class="member_title row">';
        echo '<span class="member_name">' . $row['name'] . '</span>&nbsp;';
        echo '<span class="member_class">' . $row['class'] . '</span>';
        echo '</div>';
        echo '<div class="member_content row">';
        echo '<div class="pic col-sm-4">';
        echo '<img src="./' . $row['id'] . '.png"></img>';
        echo '</div>';
        
        echo '<div class="spanout col-sm-8">';
        echo '<table>';
        if($row['phone']!="" && $row['phone']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-phone"></i>' . $row['phone'];
            echo '</td></tr>';
        }
        if($row['mail']!="" && $row['mail']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-envelope"></i>';
            echo '<a href="mailto:' . $row['mail'] . '">' . $row['mail'] . '</a>';
            echo '</td></tr>';
        }
        if($row['dept']!="" && $row['dept']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-users"></i>' . $row['dept'];
            echo '</td></tr>';
        }
        if($row['work']!="" && $row['work']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-gear"></i>' . $row['work'];
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</div></div></div>';
    }    
?>
                </div>
            </div>
        </div>
        <div class="position_div container">
            <div class="position row">
                輔導老師
            </div>
            <div class="member_row">
                <div class="row">
<?php
    $sql = 'select * from member where title="輔導老師"';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo '<div class="card col-sm-6">';
        echo '<div class="member_title row">';
        echo '<span class="member_name">' . $row['name'] . '</span>&nbsp;';
        echo '<span class="member_class">' . $row['class'] . '</span>';
        echo '</div>';
        echo '<div class="member_content row">';
        echo '<div class="pic col-sm-4">';
        echo '<img src="./' . $row['id'] . '.png"></img>';
        echo '</div>';
        
        echo '<div class="spanout col-sm-8">';
        echo '<table>';
        if($row['phone']!="" && $row['phone']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-phone"></i>' . $row['phone'];
            echo '</td></tr>';
        }
        if($row['mail']!="" && $row['mail']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-envelope"></i>';
            echo '<a href="mailto:' . $row['mail'] . '">' . $row['mail'] . '</a>';
            echo '</td></tr>';
        }
        if($row['dept']!="" && $row['dept']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-users"></i>' . $row['dept'];
            echo '</td></tr>';
        }
        if($row['work']!="" && $row['work']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-gear"></i>' . $row['work'];
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</div></div></div>';
    }    
?>
                </div>
            </div>
        </div>
        <div class="position_div container">
            <div class="position row">
                行政助理
            </div>
            <div class="member_row">
                <div class="row">
<?php
    $sql = 'select * from member where title="行政助理"';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo '<div class="card col-sm-6">';
        echo '<div class="member_title row">';
        echo '<span class="member_name">' . $row['name'] . '</span>&nbsp;';
        echo '<span class="member_class">' . $row['class'] . '</span>';
        echo '</div>';
        echo '<div class="member_content row">';
        echo '<div class="pic col-sm-4">';
        echo '<img src="./' . $row['id'] . '.png"></img>';
        echo '</div>';
        
        echo '<div class="spanout col-sm-8">';
        echo '<table>';
        if($row['phone']!="" && $row['phone']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-phone"></i>' . $row['phone'];
            echo '</td></tr>';
        }
        if($row['mail']!="" && $row['mail']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-envelope"></i>';
            echo '<a href="mailto:' . $row['mail'] . '">' . $row['mail'] . '</a>';
            echo '</td></tr>';
        }
        if($row['dept']!="" && $row['dept']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-users"></i>' . $row['dept'];
            echo '</td></tr>';
        }
        if($row['work']!="" && $row['work']!=NULL)
        {
            echo '<tr><td>';
            echo '<i class="fa fa-gear"></i>' . $row['work'];
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</div></div></div>';
    }    
?>
                </div>
            </div>
        </div>
    </section>
    
<?php
    require_once("footer.php");
?>
</body>

