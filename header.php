<?php
    echo '<!-- header -->
    <div class="roof container">
        <div class="row">
            <a href="./index.php"><img src="/src/pic/title.png"></a>
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
              <li><a href="./member.php">成員介紹</a></li>
              <li><a href="./lost.php">失物招領</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">救助減免<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="./page.php?page=assurance">平安保險</a></li>
                  <li><a href="./page.php?page=tuition">學雜費減免</a></li>
                  <li><a href="./page.php?page=disadv">弱勢助學</a></li>
                  <li><a href="./page.php?page=studyloan">就學貸款</a></li>
                  <li><a href="./page.php?page=property">學產低收</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">急難扶助<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="./page.php?page=emergency">校內急難</a></li>
                  <li><a href="./page.php?page=KHemergency">安心就學</a></li>
                  <li><a href="./page.php?page=studentEmergency">學產急難</a></li>
                  <li><a href="./page.php?page=XingTianGongEmergency">行天宮急難</a></li>
                  <li><a href="./page.php?page=TaiwanPulbicInterestEmergency">台灣公益急難</a></li>
                  <li><a href="./page.php?page=ZhangRongFaEmergency">張榮發急難</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">獎助學金<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="./page.php?page=feedback">還願獎學金</a></li>
                  <li><a href="./page.php?page=sun">旭日獎學金</a></li>
                  <li><a href="./page.php?page=dream">逐夢獎學金</a></li>
                  <li><a href="./page.php?page=liveadv">生活助學金</a></li>
                  <li><a href="./page.php?page=assistant">兼任行政助理</a></li>
                  <li><a href="http://sthousing.nthu.edu.tw/scholarship/" target="_blank">校內外獎學金</a></li>
                  <li><a href="https://helpdreams.moe.edu.tw/" target="_blank">圓夢助學網</a></li>
                </ul>
              </li>
              <li><a href="./secure.php">校園安全</a></li>
              <li><a href="./echinacea.php">紫錐花運動</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">住宿賃居<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="./page.php?page=dorm">校內住宿須知</a></li>
                  <li><a href="./page.php?page=outside">校外賃居</a></li>
                  <li><a href="./page.php?page=waitList">候補宿舍申請</a></li>
                  <li><a href="./page.php?page=serve">新生宿舍服務學長姐</a></li>
                </ul>
              </li>
              <li><a href="./reward.php">學生獎懲</a></li>
              <li><a href="./download.php">相關下載</a></li>
            </ul>
          </div>
        </div>
    </nav>';
?>
