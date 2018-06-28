<?php
    require('config.php');
    
    function createCard($row)
    {
        $card = '';
        $card .= '<div class="card col-sm-6">';
        $card .= '<div class="member_title row">';
        $card .= '<span class="member_name">' . $row['name'] . '</span>&nbsp;';
        $card .= '<span class="member_class">' . $row['class'] . '</span>';
        $card .= '</div>';
        $card .= '<div class="member_content row">';
        $card .= '<div class="pic col-sm-4">';
        $card .= '<img src="./member_photo/' . $row['id'] . '.png"></img>';
        $card .= '</div>';
        
        $card .= '<div class="spanout col-sm-8">';
        $card .= '<table>';
        if($row['phone']!="" && $row['phone']!=NULL)
        {
            $card .= '<tr><td>';

            $card .= '<i class="fa fa-phone"></i>' . $row['phone'];
            $card .= '</td></tr>';
        }
        if($row['mail']!="" && $row['mail']!=NULL)
        {
            $card .= '<tr><td>';
            $card .= '<i class="fa fa-envelope"></i>';
            $card .= '<a href="mailto:' . $row['mail'] . '">' . $row['mail'] . '</a>';
            $card .= '</td></tr>';
        }
        if($row['dept']!="" && $row['dept']!=NULL)
        {
            $card .= '<tr><td>';
            $card .= '<i class="fa fa-users"></i>' . $row['dept'];
            $card .= '</td></tr>';
        }
        if($row['work']!="" && $row['work']!=NULL)
        {
            $card .= '<tr><td>';
            $card .= '<i class="fa fa-gear"></i>' . $row['work'];
            $card .= '</td></tr>';
        }
        $card .= '</table>';
        $card .= '</div></div></div>';
        
        return $card;
    }
?>

<head>
    <title>清華大學生活輔導組</title>
    <link rel="shortcut icon" type="image/png" href="/src/pic/logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/src/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/css/font-awesome.min.css">
    <link rel="stylesheet" href="/src/css/fix_layout.css">
    <link rel="stylesheet" href="/src/css/member.css">
    <script src="/src/js/jquery.min.js"></script>
    <script src="/src/js/jquery-ui.js"></script>
    <script src="/src/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/src/js/fix_layout.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="/src/js/member.js" charset="UTF-8"></script>
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
        echo createCard($row);
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
        echo createCard($row);
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
        echo createCard($row);
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
        echo createCard($row);
    }    
?>
                </div>
            </div>
        </div>
        <div class="position_div container">
            <div class="position row">
                學務助理
            </div>
            <div class="member_row">
                <div class="row">
<?php
    $sql = 'select * from member where title="學務助理"';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo createCard($row);
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

