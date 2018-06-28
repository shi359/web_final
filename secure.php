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
    <link rel="stylesheet" href="/src/css/secure.css">
    <script src="/src/js/jquery.min.js"></script>
    <script src="/src/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/src/js/fix_layout.js" charset="UTF-8"></script>
</head>
<body>
<?php
    require_once("header.php");
?>
    
    <section class="container">
        <div>
            <h1>校園安全</h1>
            <hr>
            <div class="safe-itm row">
              <div class="safe-pic col-sm-6" style="background-image: url('/src/pic/campus.jpg');"></div>
              <div class="item col-sm-6">
                <h3>校園安全宣導</h3>
                <ul>
                  <li> <a href="https://www.facebook.com/清大校安人人顧-854872174595378/?__mref=message_bubble" target="_blank">清大校安人人顧</a></li>
                  <li> <a href="/file/secure/dorm-flow.pdf" target="_blank"></a>住宿區學生事件處理流程圖</li>
                  <li> <a href="/file/secure/dorm-contact.pdf" target="_blank"></a>住宿區學生事件緊急聯絡方式</li>
                </ul>  
              </div>
            </div>
            <div class="safe-itm row">
              <div class="safe-pic col-sm-6" style="background-image: url('/src/pic/safe00.jpg')"></div>
              <div class="item col-sm-6">
                <h3>生活安全宣導</h3>
                <ul>
                  <li> <a href="https://www.165.gov.tw/list_news.aspx" target="_blank"> 165防詐騙宣導 </a></li>
                  <li> <a href="https://www.nfa.gov.tw/cht/index.php?code=list&ids=56" target="_blank">消防署防溺水安全宣導</a></li>
                </ul>  
              </div>
            </div>
            <div class="safe-itm row">
              <div class="safe-pic col-sm-6" style="background-image: url('/src/pic/traffic.jpg')"></div>
              <div class="item col-sm-6">
                <h3>交通安全宣導</h3>
                <ul>
                  <li> <a href="/file/secure/scooter_law.docx" target="_blank">機車違規入校處分標準</a></li>
                  <li> <a href="/file/secure/summer_scooter.pptx" target="_blank">暑期交通安全宣導</a></li>
                </ul>  
              </div>
            </div>
            <div class="safe-itm row">
              <div class="safe-pic col-sm-6" style="background-image: url('/src/pic/house.jpg')"></div>
              <div class="item col-sm-6">
                <h3>賃居安全宣導</h3>
                <ul>
                  <li> <a href="https://www.nfa.gov.tw/cht/index.php?code=list&ids=265" target="_blank">住宅防火</a></li>
                  <li> <a href="https://www.nfa.gov.tw/cht/index.php?code=list&ids=284" target="_blank">防範一氧化碳中毒</a></li>
                </ul>  
              </div>
            </div>
        </div>
    </section>
    
<?php
    require_once("footer.php");
?>
</body>

