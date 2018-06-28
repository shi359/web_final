$(document).ready(function() {
    
    $(".edit_panel .cover").css({"display":"block"});
    
    $('.side_list_title').click(function() {
        var drop_number = $(this).parent().find('.drop > div').length;
        if($(this).parent().find('.drop').css('display') == 'none' && drop_number > 0)
        {
            $(this).parent().find('.drop').css('display', 'block');
            $(this).parent().find('.drop').animate({'height': drop_number*50+"px"}, 300);
            $(this).parent().find('.drop').find('div').animate({'padding': '7.5px auto', 'box-shadow': '20px auto'}, 300);
        }
        else if($(this).parent().find('.drop').css('display') == 'block' && drop_number > 0)
        {
            $(this).delay(300).queue(function(next){ 
                $(this).parent().find('.drop').css('display', 'none'); 
                next(); 
            });
            $(this).parent().find('.drop').animate({'height': '0px'}, 300);
            $(this).parent().find('.drop').find('div').animate({'padding': '0px auto'}, 300);
        }
    });
    
    $(".side_list_title").each(function(){
        $(this).attr("title", $(this).text());
    });
    
    $(".drop").find("div").each(function(){
        $(this).attr("title", $(this).text());
    });
    
    $("#summernote").summernote({
            lang : 'zh-TW',
            dialogsFade : true,
            dialogsInBody : true,
            disableDragAndDrop : false
    });
    
});
    

function logOut()
{
    var confirm_logout = confirm("確定登出？");
    if(confirm_logout) document.location.href="./logout.php";
}

function changeView(view)
{
    $(".edit_panel section").each(function(){
        $(this).css({"display":"none"});
    });

    var str = ".edit_panel ."+view;
    $(str).css({"display":"block"});
}

function changePage(pageFunction)
{
    /* check whether the user leave the edit panel while editing */
    
    var leave = 0;
    var check = 0;
    $('section').each(function(){
        if($(this).css("display")=="block" && $(this).attr("class").indexOf("edit_")!=-1)
        {
            check = 1;
            if(confirm("您尚有未儲存的編輯。確定退出此頁面？")) pageFunction();
            return false;
        }
    });
    
    /*-----------------------------------------------------------*/
    if(check==0) pageFunction();
}

function cancelEdit(page)
{
    var confirm_cancel = confirm("確定取消此次編輯？");
    if(confirm_cancel) changeView(page);
}

function showSave()
{
    $("#savePanel").css("display", "block");
    $("#savePanel").css("opacity", 1);
    setTimeout(function(){
        $("#savePanel").fadeOut(500);
    }, 1000);
    
}


function updateAnnounce()
{
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'update_announce'},
        success:function(content){
            $(".announce").html(content);
            changeView("announce");
        },
        error:function(){
        }
    });
}

function deleteAnnounce(anno_id)
{
    var confirm_delete = confirm("確定刪除此公告？");
    if(confirm_delete)
    {
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            data:{'action':'delete_announce', 'id':anno_id},
            success:function(){
                updateAnnounce();
            },
            error:function(){
            }
        });
        
    }
}

function newAnnounce()
{
    changeView("edit_anno");
    
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'new_announce'},
        success:function(content){
            $(".edit_anno").html(content);
        },
        error:function(){
        }
    });
}

function editAnnounce(anno_id)
{
    changeView("edit_anno");
    
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'edit_announce', 'id':anno_id},
        success:function(content){
            $(".edit_anno").html(content);
        },
        error:function(){
        }
    });
}

function saveAnnounce(anno_id)
{
    var start_time = new Date($("#anno_stime").val());
    var end_time = new Date($("#anno_etime").val());
    var file_array = new Array();
    $(".edit_anno .attach_name").each(function(){
            file_array.push($(this).html());
    });
    
    if($("#anno_title").val()=="" || $("#anno_content").val()=="") alert("標題及內容不可為空白");
    else if($("#anno_stime").val()=="" || $("#anno_etime").val()=="") alert("公告起始時間及結束時間不可為空白");
    else if(start_time.getTime() > end_time.getTime()) alert("公告起始時間不可大於公告結束時間");
    else if($("#anno_owner").val()==null) alert("發佈人不可為空白");
    else
    {
        var str_br = $("#anno_content").val().replace(/\n/g,"<br />");
    
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            data:{'action':'save_announce', 'id':anno_id, 'title': $("#anno_title").val(),
                  'content': str_br, 'file': $("#anno_file").val(), 'start_time': $("#anno_stime").val(),
                  'end_time': $("#anno_etime").val(), 'name': $("#anno_owner").val(), 'file_array': JSON.stringify(file_array)},
            success:function(){
                updateAnnounce();
                showSave();
            },
            error:function(){
            }
        });
    }
}

function uploadAnnounceFile(id, event)
{
    var form_data = new FormData();
    var file_data = $("#anno_file")[0].files[0];
    var file_array = new Array();
    
    if(file_data === undefined) alert("請選擇檔案");
    else
    {
        $(".edit_anno .attach_name").each(function(){
            file_array.push($(this).html());
        });
        
        form_data.append("action", "upload_announce");
        form_data.append("file", file_data);
        form_data.append("list", JSON.stringify(file_array));
        
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            processData: false,
            contentType: false,
            data: form_data,
            success:function(content){
                if(content=="error") alert("檔案上傳出現錯誤，請稍候再試");
                else $(".edit_anno .edit_attach .outer_row").html(content);
            },
            error:function(){
                alert("檔案上傳出現錯誤，請稍候再試");
            }
        });
    }
    event.preventDefault();
    
}

function discardFile(obj)
{
    var confirm_discard = confirm("確定刪除此附件？");
    if(confirm_discard) $(obj).parent().parent().parent().remove();
}


function updateService()
{
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'update_service'},
        success:function(content){
            $(".service").html(content);
            changeView("service");
        },
        error:function(){
        }
    });
}

function deleteService(anno_id)
{
    var confirm_delete = confirm("確定刪除此服務？");
    if(confirm_delete)
    {
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            data:{'action':'delete_service', 'id':anno_id},
            success:function(){
                updateService();
            },
            error:function(){
            }
        });
        
    }
}

function newService()
{
    changeView("edit_serv");
    
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'new_service'},
        success:function(content){
            $(".edit_serv").html(content);
        },
        error:function(){
        }
    });
}

function editService(serv_id)
{
    changeView("edit_serv");
    
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'edit_service', 'id':serv_id},
        success:function(content){
            $(".edit_serv").html(content);
        },
        error:function(){
        }
    });
}


function saveService(serv_id)
{
    var start_time = new Date($("#serv_stime").val());
    var end_time = new Date($("#serv_etime").val());
    
    if($("#serv_service").val()=="") alert("服務名稱不可為空白");
    else if($("#serv_stime").val()=="" || $("#serv_etime").val()=="") alert("服務辦理時程起始時間及服務辦理時程時間不可為空白");
    else if(start_time.getTime() > end_time.getTime()) alert("服務辦理時程起始時間不可大於服務辦理時程結束時間");
    else
    {
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            data:{'action':'save_service', 'id':serv_id, 'service': $("#serv_service").val(),
                  'start_time': $("#serv_stime").val(), 'end_time': $("#serv_etime").val()},
            success:function(){
                updateService();
                showSave();
            },
            error:function(){
            }
        });
    }
}


function updateLost()
{
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'update_lost'},
        success:function(content){
            $(".lost").html(content);
            changeView("lost");
        },
        error:function(){
        }
    });
}

function deleteLost(lost_id)
{
    var confirm_delete = confirm("確定刪除此公告？");
    if(confirm_delete)
    {
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            data:{'action':'delete_lost', 'id':lost_id},
            success:function(){
                updateLost();
            },
            error:function(){
            }
        });
        
    }
}


function newLost()
{
    changeView("edit_lost");
    
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'new_lost'},
        success:function(content){
            $(".edit_lost").html(content);
        },
        error:function(){
        }
    });
}

function editLost(lost_id)
{
    changeView("edit_lost");
    
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'edit_lost', 'id':lost_id},
        success:function(content){
            $(".edit_lost").html(content);
        },
        error:function(){
        }
    });
}


function saveLost(lost_id)
{
    var lost_src = $("#lost_preview").attr("src").split("lost_photo/")[1].split("?")[0];
    
    if($("#lost_item").val()=="") alert("物品名稱不可為空白");
    else if($("#lost_place").val()=="") alert("拾獲地點不可為空白");
    else if($("#lost_expire").val()=="") alert("到期日期不可為空白");
    else if($("#lost_name").val()=="") alert("聯絡人不可為空白");
    else if($("#lost_phone").val()=="") alert("聯絡電話不可為空白");
    else if($("#lost_preview").attr("src") === "") alert("請上傳物品圖片");
    else
    {
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            data:{'action':'save_lost', 'id':lost_id, 'item': $("#lost_item").val(),
                  'place': $("#lost_place").val(), 'expire': $("#lost_expire").val(),
                  'name': $("#lost_name").val(), 'phone': $("#lost_phone").val(),
                  'img': lost_src},
            success:function(){
                updateLost();
                showSave();
            },
            error:function(){
            }
        });
    }
}


function uploadLostFile(id, event)
{
    var form_data = new FormData();
    var file_data = $("#lost_file")[0].files[0];
    
    if(file_data === undefined) alert("請選擇檔案");
    else
    {
        form_data.append("action", "upload_lost");
        form_data.append("file", file_data);
        form_data.append("id", id);
        
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            processData: false,
            contentType: false,
            data: form_data,
            success:function(content){
                if(content=="error") alert("檔案上傳出現錯誤，請稍候再試");
                else
                {
                    $("#lost_preview").attr("src", content);
                    $("#lost_preview").css("display", "block");
                }
            },
            error:function(){
                alert("檔案上傳出現錯誤，請稍候再試");
            }
        });
    }
    event.preventDefault();
    
}

function lostSwitch(state)
{
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'lost_switch' ,'state':state},
        success:function(content){
            $("#switch_state").html(content);
            
            if(content=='OFF')
            {
                $("#switch_icon").html('<i class="fa fa-toggle-off" onclick="lostSwitch(1);"></i>');
                $("#switch_state").removeClass("switch_state_on");
                $("#switch_state").addClass("switch_state_off");
                $("#switch_icon").removeClass("switch_icon_on");
                $("#switch_icon").addClass("switch_icon_off");
            }
            else
            {
                $("#switch_icon").html('<i class="fa fa-toggle-on" onclick="lostSwitch(0);"></i>');
                $("#switch_state").removeClass("switch_state_off");
                $("#switch_state").addClass("switch_state_on");
                $("#switch_icon").removeClass("switch_icon_off");
                $("#switch_icon").addClass("switch_icon_on");
            }
        },
        error:function(){
        }
    });
}

function editArticle(page)
{
    changeView("edit_summernote");
    
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'edit_article' ,'page':page},
        success: function(content){
            var content_arr = JSON.parse(content);
            $('#summernote').summernote('code',content_arr[0]);
            $('.outer_row').html(content_arr[1]);
            $('.edit_owner').html(content_arr[2]);
            
            var page_name = "";
            switch(page)
            {
                case 'assurance':
                    page_name = '平安保險';
                    break;
                case 'tuition':
                    page_name = '學雜費減免';
                    break;
                case 'disadv':
                    page_name = '弱勢助學金';
                    break;
                case 'studyloan':
                    page_name = '就學貸款';
                    break;
                case 'property':
                    page_name = '學產低收';
                    break;
                case 'emergency':
                    page_name = '校內急難';
                    break;
                case 'KHemergency':
                    page_name = '安心就學';
                    break;
                case 'studentEmergency':
                    page_name = '學產急難';
                    break;
                case 'XingTianGongEmergency':
                    page_name = '行天宮急難';
                    break;
                case 'TaiwanPulbicInterestEmergency':
                    page_name = '台灣公益急難';
                    break;
                case 'ZhangRongFaEmergency':
                    page_name = '張榮發急難';
                    break;
                case 'feedback':
                    page_name = '還願獎學金';
                    break;
                case 'sun':
                    page_name = '旭日獎學金';
                    break;
                case 'dream':
                    page_name = '逐夢獎學金';
                    break;
                case 'liveadv':
                    page_name = '生活助學金';
                    break;
                case 'assistant':
                    page_name = '兼任行政助理';
                    break;
                case 'dorm':
                    page_name = '校內住宿須知';
                    break;
                case 'outside':
                    page_name = '校外賃居';
                    break;
                case 'serve':
                    page_name = '服務學長姐申請';
                    break;
                case 'waitList':
                    page_name = '候補宿舍申請';
                    break;
            }
            $(".article_name h1").html(page_name);
        },
        error:function(){
        }
    });
}

function saveArticle()
{
    var art_name = $(".article_name h1").html();
    var markupStr = $('#summernote').summernote('code');
    var manager = $('#page_owner').val();
    
    switch(art_name)
    {
        case '平安保險':
            art_name = 'assurance';
            break;
        case '學雜費減免':
            art_name = 'tuition';
            break;
        case '弱勢助學金':
            art_name = 'disadv';
            break;
        case '就學貸款':
            art_name = 'studyloan';
            break;
        case '學產低收':
            art_name = 'property';
            break;
        case '校內急難':
            art_name = 'emergency';
            break;
        case '安心就學':
            art_name = 'KHemergency';
            break;
        case '學產急難':
            art_name = 'studentEmergency';
            break;
        case '行天宮急難':
            art_name = 'XingTianGongEmergency';
            break;
        case '台灣公益急難':
            art_name = 'TaiwanPulbicInterestEmergency';
            break;
        case '張榮發急難':
            art_name = 'ZhangRongFaEmergency';
            break;
        case '還願獎學金':
            art_name = 'feedback';
            break;
        case '旭日獎學金':
            art_name = 'sun';
            break;
        case '逐夢獎學金':
            art_name = 'dream';
            break;
        case '生活助學金':
            art_name = 'liveadv';
            break;
        case '兼任行政助理':
            art_name = 'assistant';
            break;
        case '校內住宿須知':
            art_name = 'dorm';
            break;
        case '校外賃居':
            art_name = 'outside';
            break;
        case '服務學長姐申請':
            art_name = 'serve';
            break;
        case '候補宿舍申請':
            art_name = 'waitList';
            break;
    }
    
    var file_array = new Array();
    $(".edit_summernote .attach_name").each(function(){
        file_array.push($(this).html());
    });
    
    $.ajax({
        type: "POST",
        url: "edit_db.php",
        data:{'action':'save_article', 'content': markupStr, 'page': art_name, 'file_array': JSON.stringify(file_array), 'manager': manager},
        success:function(){
            showSave();
        },
        error:function(){
        }
    });
}

function uploadArticleFile(event)
{
    var art_name = $(".article_name h1").html();
    
    switch(art_name)
    {
        case '平安保險':
            art_name = 'assurance';
            break;
        case '學雜費減免':
            art_name = 'tuition';
            break;
        case '弱勢助學金':
            art_name = 'disadv';
            break;
        case '就學貸款':
            art_name = 'studyloan';
            break;
        case '學產低收':
            art_name = 'property';
            break;
        case '校內急難':
            art_name = 'emergency';
            break;
        case '安心就學':
            art_name = 'KHemergency';
            break;
        case '學產急難':
            art_name = 'studentEmergency';
            break;
        case '行天宮急難':
            art_name = 'XingTianGongEmergency';
            break;
        case '台灣公益急難':
            art_name = 'TaiwanPulbicInterestEmergency';
            break;
        case '張榮發急難':
            art_name = 'ZhangRongFaEmergency';
            break;
        case '還願獎學金':
            art_name = 'feedback';
            break;
        case '旭日獎學金':
            art_name = 'sun';
            break;
        case '逐夢獎學金':
            art_name = 'dream';
            break;
        case '生活助學金':
            art_name = 'liveadv';
            break;
        case '兼任行政助理':
            art_name = 'assistant';
            break;
        case '校內住宿須知':
            art_name = 'dorm';
            break;
        case '校外賃居':
            art_name = 'outside';
            break;
        case '服務學長姐申請':
            art_name = 'serve';
            break;
        case '候補宿舍申請':
            art_name = 'waitList';
            break;
    }    
    
    var form_data = new FormData();
    var file_data = $("#art_file")[0].files[0];
    var file_array = new Array();
    
    if(file_data === undefined) alert("請選擇檔案");
    else
    {
        $(".edit_summernote .attach_name").each(function(){
            file_array.push($(this).html());
        });
        
        form_data.append("action", "upload_article");
        form_data.append("file", file_data);
        form_data.append("list", JSON.stringify(file_array));
        form_data.append("page", art_name);
        
        $.ajax({
            type: "POST",
            url: "edit_db.php",
            processData: false,
            contentType: false,
            data: form_data,
            success:function(content){
                if(content=="error") alert("檔案上傳出現錯誤，請稍候再試");
                else $(".edit_summernote .edit_attach .outer_row").html(content);
            },
            error:function(){
                alert("檔案上傳出現錯誤，請稍候再試");
            }
        });
    }
    event.preventDefault();

    
}
