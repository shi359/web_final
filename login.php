<?php
    session_start();
    require('db.php');    

    if(isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"]!="" && $_POST["password"]!="")
    {
        $username = htmlspecialchars($_POST['username']);
	    $password = htmlspecialchars($_POST['password']);
        
        $sql = 'select * from admin';
        $que = $conn->query($sql);
        $success = 0;
        
        while($row = $que->fetch_assoc())
        {
            if($row['user']==$username && $row['password']==/*hash("sha256",*/ $password)
            {
                $_SESSION['uid'] = $row['user'];
                $_SESSION['aDMinD0sA']="dosaadmin";
                $success=1;
                break;
            }
        }
        
        if($success==1)
        {
            $url = "Location: ";
            $url .= "./admin.php";
            header($url);
        }
        else
        {
            echo "<script>alert('帳號或密碼錯誤');</script>";
            $success = 0;
        }
    }
?>

<head>
    <title>清華大學生活輔導組管理系統</title>
    <link rel="shortcut icon" type="image/png" href="logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script  src="./login.js"></script>
</head>
<body>
    <div class="container">
        <section id="content">
            <form action="login.php" method="post">
                <h1>清華大學生活輔導組管理系統</h1>
                <div>
                    <input type="text" placeholder="帳號" required id="username" name="username" />
                </div>
                <div>
                    <input type="password" placeholder="密碼" required id="password" name="password" />
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">登入</button>
                </div>
            </form>
            <div class="to_page">
                <a href="./index.php">回生輔組首頁</a>
            </div>
        </section>
    </div>
</body>
