<?
if ($_SERVER['REQUEST_METHOD'] == "GET") {
     search();
 } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
     create();
 }

// calculate deadline in sql format
function calcDay($d){
    $dates = date('Y-m-d');
    $date = new DateTime($dates);
    $interval = "+".$d." day";
    $date->modify($interval);
    return $date->format('Y-m-d');
}

function uploadImg($id){
    if(isset($_FILES['photo'])){
        // check file type
        $file = $_FILES['photo'];
        $filename = $file['name'];
        $type = pathinfo($filename, PATHINFO_EXTENSION);
        $allow=array("jpg","jpeg","png");
        if(in_array($type,$allow)){
            $dir = __DIR__."/lost_photo/";
            $newName = $id.".".$type;
            $target = $dir.$newName;
            $err = move_uploaded_file($_FILES['photo']['tmp_name'],$target);
        } else{
            return "";
        }
        return $newName;
    }else{
        return "";
    }
}

function search(){

}

function create(){
    require('config.php');
    $sql = "Select id from lost where id in (Select MAX(id) from lost)";
    $id = $conn->query($sql)->fetch_assoc()["id"]+1;
    $result = uploadImg($id);
    if($result != ""){
        $stmt = $conn->prepare("Insert into lost (item, place, name, phone, expire,img) values (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $_POST["item"],$_POST["place"], $name,$phone, $expire,$result);
        // deal with anonymous
        if($_POST["name"] == ""){
            $name = "生輔組";
            $phone = "035711814";
            $expire = calcDay(180);
        } else{
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $expire = calcDay($_POST["days"]);    
        }
        $stmt->execute();
    }
 }
?>
<html>
<head>
    <title>清華大學生活輔導組</title>
    <link rel="shortcut icon" type="image/png" href="logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./fix_layout.css">
    <link rel="stylesheet" href="./lost.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="./fix_layout.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="./lost.js" charset="UTF-8"></script>
</head>
<body>
    <!-- header -->
    <div class="roof container">
        <div class="row">
            <a href="#"><img src="title.png"></a>
        </div>
        <div class="dept row">
            <ul>
                <li class="dpt"><a href="http://www.nthu.edu.tw" target="_blank">清華大學</a></li>
                <li class="dpt"><a href="http://student.web.nthu.edu.tw" target="_blank">學務處</a></li>
            </ul>
        </div>    
        <div class="clearfix"></div>
    </div>
    <!-- Navigation bar -->
    <nav id="navigation_bar" class="navbar navbar-fixed">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li class="active"><a href="./index.php">首頁</a></li>
              <li><a href="#">成員介紹</a></li>
              <li><a href="#">失物招領</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">救助減免<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">平安保險</a></li>
                  <li><a href="#">學雜費減免</a></li>
                  <li><a href="#">弱勢助學</a></li>
                  <li><a href="#">就學貸款</a></li>
                  <li><a href="#">學產低收</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">急難扶助<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">校內急難</a></li>
                  <li><a href="#">安心就學</a></li>
                  <li><a href="#">學產急難</a></li>
                  <li><a href="#">行天宮急難</a></li>
                  <li><a href="#">台灣公益急難</a></li>
                  <li><a href="#">張榮發急難</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">獎助學金<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">還願獎學金</a></li>
                  <li><a href="#">旭日獎學金</a></li>
                  <li><a href="#">築夢獎學金</a></li>
                  <li><a href="#">生活助學金</a></li>
                  <li><a href="#">兼任行政助理</a></li>
                  <li><a href="#">校內外獎學金</a></li>
                  <li><a href="#">圓夢助學網</a></li>
                </ul>
              </li>
              <li><a href="#">校園安全</a></li>
              <li><a href="#">紫錐花運動</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">住宿賃居<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">校外賃居</a></li>
                  <li><a href="#">候補宿舍申請</a></li>
                  <li><a href="#">新生宿舍服務學長姐</a></li>
                </ul>
              </li>
              <li><a href="#">學生獎懲</a></li>
              <li><a href="#">相關下載</a></li>
            </ul>
          </div>
        </div>
        </nav>
        <!-- End of Navigation bar -->
        
        <!-- main content -->
        <section>
        <div class="container">
            <div class="row">
                <div>
                    <h1>失物招領</h1>
                    <hr>
                </div>
                <div>
                    <!-- form -->
                    <button type="button" class="post btn btn-primary btn-lg" data-toggle="modal" data-target="#postModal">拾獲失物</button>
                    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" >
						<div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title" id="exampleModalLabel">失物通報</h1>
						      </div>
						      <form class="pop-form" method="post" enctype="multipart/form-data">
						      <div class="modal-body">
						      		<div class="fillup">
							      		<label for="item"><b>項目</b></label>
							      		<input type="text" id="item" name="item" maxlength="25" placeholder="項目" required>
						      		</div>
						      		<div class="fillup">
						      			<label for="place"><b>拾獲地點</b></label>
                                        <input type="text" id="place" name="place" maxlength="15" placeholder="地點" required>
						      		</div>
						      		<div class="fillup">
                                        <label for="anom"><b>是否匿名</b></label>


						      			<input type="checkbox" id="anom" name="anom" onclick="showName()">否(若匿名請將物品送至教官室)<br>
						      		</div>
						      		<div class="fillup">

                                        <label for="name" class="hid"><b>聯絡姓名</
b></label>
						      			<input class="hid" type="text" id="name" name="name" maxlength="10" placeholder="姓名">
						      		</div>
						      		<div class="fillup">	
                                        <label for="phone" class="hid"><b>聯絡電話</b></label
>
						      			<input class="hid" type="tel" id="phone" name="phone" maxlength="15" placeholder="09xx" pattern='\^09\d{8}$' >
						      		</div>
						      		<div class="fillup">	
                                        <label for="expire" class="hid"><b>到期時間</b></label>

							      		<select class="hid" id="days" name="days">

                                            <option value="3"> 3 天 </option>
							      			<option value="7"> 1 週 </option>
							      			<option value="14"> 2 週 </option>
							      			<option value="30"> 1 月 </option>
							      		</select>
							      	</div>
							      	<div class="fillup">	

                                        <label for="phto"><b>照片</b></label>
						      			<input type="file" name="photo" id="upload" required onchange="preview(event)">
						      			<img id="prevw" src="2.jpg">
						      		</div>	
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
						        <button type="submit" id="post" class="btn btn-primary">發佈</button>
						      </div>
                   </form>
						    </div>
						</div>
					</div> 
                </div>
            </div>   
            <!-- item bar -->
            <div class="row bar">
                <div class="col-sm-4">
                    <form action="" class="search-form">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="search" id="search" placeholder="搜尋">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>    
                    </form>
                </div>    
                <div class="col-sm-4 bar-content">
                    <p> 日期排序&nbsp;<i id="sort" class="fa fa-caret-up"></i> </p> 
                </div>    
                <div class="col-sm-4 bar-content">
                    <a href="./lost_rule.pdf" target="_blank">規章</a>
                </div>    
            </div>    
<?php
    // list all lost items 
    require('config.php');
    $sql = "select * from lost where img is not null order by expire ASC";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "<div class='row item-list'>";
        while($row = $result->fetch_assoc()) {
            echo "<div class='row item'>";
            // image
            echo "<div class='col-sm-5'>";
            echo "<div class='item-img'>";
            echo "<img src='./lost_photo/".$row["img"]."'>";
            echo "</div>";
            echo "</div>";
            // description
            echo "<div class='item-content col-sm-7'>";
            echo "<h4>".$row["item"]."</h4>";
            echo "<div class='place'>";
            echo"<span class='item-place'>拾獲地點:</span>";
            echo"<span class='place-dscrpt'>".$row["place"]."</span>";
            echo "</div>";
            echo"<div class='contact'>";
            echo"<i class='fa fa-clock-o'></i>".$row["expire"]."</div>";
            echo"<div class='contact'>";
            echo"<i class='fa fa-user'></i>".$row["name"]."</div>";
            echo"<div class='contact'>";
            echo"<i class='fa fa-phone'></i>".$row["phone"]."</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } 
?>
        <div class="pager">
            <ul class="pagination">
                <li class="disabled"><a href="#"><</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">></a></li>
            </ul>
        </div>
        </section>
        <!-- Footer -->
        <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    <img src="logo.png"></img>
                </div>
                <div class="col-sm-4">
                    <h4>國立清華大學</h4> 
                    <h5>National Tsing Hua University</h5> 
                </div>
                <div class="col-sm-7 foot_info">
                    <div><i class="fa fa-map-marker"></i>30013 新竹市光復路二段101號 水木生活中心二樓</div>
                    <div><i class="fa fa-phone"></i>03-5711814 或 03-5715131#66666</div>
                </div>
            </div>
        </div>
    </footer>
</html>
