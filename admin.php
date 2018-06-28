<?php
    session_start();
    if($_SESSION['uid']=="" || $_SESSION['aDMinD0sA']!="dosaadmin") header("Location: ./index.php");
    
    require('config.php');
    
?>

<head>
    <title>清華大學生活輔導組管理系統</title>
    <link rel="shortcut icon" type="image/png" href="/src/pic/logo.png" sizes="72x72" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/src/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/css/font-awesome.min.css">
    <script src="/src/js/jquery.min.js"></script>
    <script src="/src/js/bootstrap.min.js"></script>
    
    <link href="/src/css/summernote.css" rel="stylesheet">
    <script src="/src/js/summernote.js"></script>
    <script src="/src/js/summernote-zh-TW.js"></script>
    <link rel="stylesheet" href="/src/css/example.css">
    <link rel="stylesheet" href="src/css/admin.css">
    <script type="text/javascript" language="javascript" src="/src/js/fix_layout.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="/src/js/admin.js" charset="UTF-8"></script>
    <script type="text/javascript" language="javascript" src="/src/js/echinacea.js" charset="UTF-8"></script>
</head>
<body>
    <!-- header -->
    <div class="roof container">
        <div class="row">
                <img src="/src/pic/title.png">
                <div style="float: right; font-size: 20px; margin: 10px; cursor: pointer;" onclick="logOut();"><i class="fa fa-sign-out"></i> 登出</a></div>
        </div>
    </div>
    <div class="main">
            <div class="side_list">
                <div class="side_list_row row">
                    <div class="side_list_item">
                        <div class="side_list_title" onclick="changePage(updateAnnounce);">公告事項</div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title" onclick="changePage(updateService);">服務辦理時程</div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title" onclick="changePage(updateLost);">失物招領</div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">救助減免</div>
                        <div class="drop">
                            <div onclick="editArticle('assurance');">平安保險</div>
                            <div onclick="editArticle('tuition');">學雜費減免</div>
                            <div onclick="editArticle('disadv');">弱勢助學金</div>
                            <div onclick="editArticle('studyloan');">就學貸款</div>
                            <div onclick="editArticle('property');">學產低收</div>
                        </div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">急難扶助</div>
                        <div class="drop">
                            <div onclick="editArticle('emergency');">校內急難</div>
                            <div onclick="editArticle('KHemergency');">安心就學</div>
                            <div onclick="editArticle('studentEmergency');">學產急難</div>
                            <div onclick="editArticle('XingTianGongEmergency');">行天宮急難</div>
                            <div onclick="editArticle('TaiwanPulbicInterestEmergency');">台灣公益急難</div>
                            <div onclick="editArticle('ZhangRongFaEmergency');">張榮發急難</div>
                        </div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">獎助學金</div>
                        <div class="drop">
                            <div onclick="editArticle('feedback');">還願獎學金</div>
                            <div onclick="editArticle('sun');">旭日獎學金</div>
                            <div onclick="editArticle('dream');">逐夢獎學金</div>
                            <div onclick="editArticle('liveadv');">生活助學金</div>
                            <div onclick="editArticle('assistant');">兼任行政助理</div>
                        </div>
                    </div>
                    <div class="side_list_item">
                        <div class="side_list_title">住宿賃居</div>
                        <div class="drop">
                            <div onclick="editArticle('dorm');">校內住宿須知</div>
                            <div onclick="editArticle('outside');">校外賃居</div>
                            <div onclick="editArticle('serve');">服務學長姐申請</div>
                            <div onclick="editArticle('waitList');">候補宿舍申請</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit_panel">
                <section class="cover">
                    <div>
                        <h1>最新公告</h1>
                        <div class="cover_row">
<?php
    
    $sql = 'select * from announce order by id DESC';
    $que = $conn->query($sql);
    while($row = $que->fetch_assoc())
    {
        echo '<div class="row cover_content">';
        echo '<div class="col-sm-2 cover_date">'.$row["start_time"].'</div>';
        echo '<div class="col-sm-10 cover_title">'.$row["title"].'</div>';
        echo '</div>';
    }    
?>
                        </div>
                    </div>
                </section>
                
                <section class="announce"></section>
                
                <section class="edit_anno"></section>
                
                <section class="service"></section>
                
                <section class="edit_serv"></section>
                
                <section class="lost"></section>
                
                <section class="edit_lost"></section>
                
                <section class="edit_summernote">
                    <div class="container" style="width: 100%;">
                        <div class="article_name">
                            <h1></h1>
                        </div>    
                        <hr style="width: 80%;">
                        <div class="row" style="margin:auto;">
                            <div class="col-sm-12">
                                <iframe id="summernote"></iframe>
                            </div>
                            <hr style="width: 80%;">
                            <div class="edit_attach col-sm-12">
                                <h3>附件檔案</h3>
                                <div class="row outer_row"></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form id="uploadForm" enctype="multipart/form-data">
                                            <div class="row add_file">
                                                <div class="col-sm-10">
                                                    <input type="file" id="art_file" name="file" draggable="true" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <button id="upload" class="btn btn-primary" onclick="uploadArticleFile(event);" style="float:right; width: 100%; font-size: 1.8em;">上傳</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="edit_owner col-sm-12">
                                    
                            </div>
                            <div class="edit_save col-sm-12">
                                <button class="btn btn-success" onclick="saveArticle();">儲存</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </div>
    
    <div id="savePanel">
        <i class="fa fa-check"></i>&nbsp;&nbsp;修改內容已儲存
    </div>
</body>
o
