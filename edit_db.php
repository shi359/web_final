<?php
    session_start();
    if($_SESSION['uid']=="" || $_SESSION['aDMinD0sA']!="dosaadmin") header("Location: ./index.php");
    
    require('config.php');
    
    /***********************************************/
    /*     update announcement panel in display    */
    /***********************************************/
    
    if($_POST['action']=='update_announce')
    {
        $content = '<div>
                        <h1>公告事項</h1><hr style="width: 80%;">
                        <div class="row" style="margin:auto;">
                            <div class="col-sm-3">
                                <button class="btn btn-primary" onclick="newAnnounce();" style="width:100%; font-size:2em;"><i class="fa fa-plus"></i>&nbsp;新增公告</button>
                            </div>
                        </div>
                        <div class="anno_row">';
        $sql = 'select * from announce order by id DESC';
        $que = $conn->query($sql);
        while($row = $que->fetch_assoc())
        {
            $content .= '<div class="row anno_content">
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="col-sm-6"><button class="btn btn-danger delete_anno" onclick="deleteAnnounce('.$row['id'].', this);"><i class="fa fa-trash"></i></button></div>
                                    <div class="col-sm-6"><button class="btn btn-success" onclick="editAnnounce('.$row['id'].');"><i class="fa fa-edit"></i></button></div>
                                </div>
                            </div>
                            <div class="col-sm-2 anno_date">'.$row["start_time"].'</div>
                            <div class="col-sm-8 anno_title">'.$row["title"].'</div>
                        </div>';
        }         
        $content .= '   </div>
                     </div>';
        
        echo $content;
    }
    
    /***********************************************/
    /*         delete announcement in display      */
    /***********************************************/
    
    
    if($_POST['action']=='delete_announce' && isset($_POST['id']))
    {
        $sql = 'delete from annoFile where annoId='.$_POST['id'];
        $que = $conn->query($sql);
    
        $sql = 'delete from announce where id='.$_POST['id'];
        $que = $conn->query($sql);
    }
    
    /***********************************************/
    /*           add new announcement              */
    /***********************************************/
    
    
    if($_POST['action']=='new_announce')
    {
        $content = '<div class="edit_anno_row>
                        <div class="edit_area row">
                                <div class="edit_title col-sm-12">
                                    <h3>標題</h3>
                                    <input type="text" id="anno_title" value="">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>內容</h3>
                                    <textarea type="text" id="anno_content"></textarea>
                                </div>
                                <div class="edit_attach col-sm-12">
                                    <h3>附件檔案</h3>
                                    <div class="row outer_row">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="uploadForm" enctype="multipart/form-data">
                                                <div class="row add_file">
                                                    <div class="col-sm-10">
                                                        <input type="file" id="anno_file" name="file" draggable="true" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button id="upload" class="btn btn-primary" onclick=\'uploadAnnounceFile(-1, event);\' style="float:right; width: 100%; font-size: 1.8em;">上傳</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12" style="margin:20px auto 10px auto;">
                                    <hr>
                                </div>
                                
                                <div class="edit_start_time col-sm-12">
                                    <h3>公告起始時間</h3>
                                    <input type="date" id="anno_stime">
                                </div>
                                <div class="edit_end_time col-sm-12">
                                    <h3>公告結束時間</h3>
                                    <input type="date" id="anno_etime">
                                </div>
                                <div class="edit_owner col-sm-12">
                                    <h3>發佈人</h3>
                                    <select id="anno_owner">
                                        <option disabled selected value=""></option>';
         $sqlm = 'select * from member';
         $quem = $conn->query($sqlm);
         while($rowm = $quem->fetch_assoc())
         {
             if($rowm['name']=='default') $content .= '<option value="default"></option>';
             else $content .= '<option value="'.$rowm['name'].'">'.$rowm['name'].'</option>';
         }                           
         $content .=                '</select>
                                </div>
                                <div class="edit_save col-sm-12">
                                    <button class="btn btn-success" onclick="saveAnnounce(-1);">儲存</button>
                                    <button class="btn btn-default" onclick="cancelEdit(\'announce\');">取消</button>
                                </div>
                        </div>
                    </div>';
        echo $content;
    }
    
    /***********************************************/
    /*              edit announcement              */
    /***********************************************/
    
    
    if($_POST['action']=='edit_announce' && isset($_POST['id']))
    {
        $sql = 'select * from announce where id='.$_POST['id'];
        $que = $conn->query($sql);
        $row = $que->fetch_assoc();
        
        $str_no_br = str_replace("<br />",chr(13).chr(10), $row['content']);
        
        $content = '<div class="edit_anno_row>
                        <div class="edit_area row">
                                <div class="edit_title col-sm-12">
                                    <h3>標題</h3>
                                    <input type="text" id="anno_title" value="'.$row['title'].'">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>內容</h3>
                                    <textarea type="text" id="anno_content">'.$str_no_br.'</textarea>
                                </div>
                                <div class="edit_attach col-sm-12">
                                    <h3>附件檔案</h3>
                                    <div class="row outer_row">';

         $sql2 = 'select * from annoFile where annoId='.$_POST['id'];
         $que2 = $conn->query($sql2);
         while($row2 = $que2->fetch_assoc())
         {
            $content .=                '<div class="attach col-sm-4">
                                            <div class="row attach_row">
                                                <div class="col-sm-3">
                                                    <button class="btn btn-danger" onclick="discardFile(this);"><i class="fa fa-trash"></i></button>
                                                </div>
                                                <div class="col-sm-9 attach_name">'
                                                    .$row2['fileName'].
                                               '</div>
                                            </div>
                                        </div>';
         }
         
         $content .=               '</div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="uploadForm" enctype="multipart/form-data">
                                                <div class="row add_file">
                                                    <div class="col-sm-10">
                                                        <input type="file" id="anno_file" name="file" draggable="true" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button id="upload" class="btn btn-primary" onclick=\'uploadAnnounceFile('.$_POST['id'].', event);\' style="float:right; width: 100%; font-size: 1.8em;">上傳</button>
                                                    </div>
                                                </div>
                                            </form>';
         $content .=                   '</div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12" style="margin:20px auto 10px auto;">
                                    <hr>
                                </div>
                                
                                <div class="edit_start_time col-sm-12">
                                    <h3>公告起始時間</h3>
                                    <input type="date" id="anno_stime" value="'.$row['start_time'].'">
                                </div>
                                <div class="edit_end_time col-sm-12">
                                    <h3>公告結束時間</h3>
                                    <input type="date" id="anno_etime" value="'.$row['end_time'].'">
                                </div>
                                <div class="edit_owner col-sm-12">
                                    <h3>發佈人</h3>
                                    <select id="anno_owner">';
         $sqlm = 'select * from member';
         $quem = $conn->query($sqlm);
         while($rowm = $quem->fetch_assoc())
         {
             if($rowm['name']=='default') $content.= '<option value="default"></option>';
             else if($rowm['name']!=$row['name']) $content.= '<option value="'.$rowm['name'].'">'.$rowm['name'].'</option>';
             else $content.= '<option value="'.$rowm['name'].'" selected>'.$rowm['name'].'</option>';
         }                           
         $content .=                '</select>
                                </div>
                                
                                <div class="edit_save col-sm-12">
                                    <button class="btn btn-success" onclick="saveAnnounce('.$row['id'].');">儲存</button>
                                    <button class="btn btn-default" onclick="cancelEdit(\'announce\');">取消</button>
                                </div>
                        </div>
                    </div>';
        echo $content;
    }
    
    /***********************************************/
    /*         save announcement after edit        */
    /***********************************************/
    
    if($_POST['action']=='save_announce' && isset($_POST['id']))
    {
        if($_POST['id']==-1)        // new announcement
        {
            $sql = 'INSERT INTO announce (name, start_time, end_time, title, content) VALUES
("'.$_POST['name'].'", "'.$_POST['start_time'].'", "'.$_POST['end_time'].'", "'.$_POST['title'].'", "'.$_POST['content'].'")';
            $que = $conn->query($sql);
            
            $upload_array = json_decode($_POST['file_array']);
            
            $sql = 'select * from announce where title = "'.$_POST['title'].'"';
            $que = $conn->query($sql);
            $row = $que->fetch_assoc();
            $id = $row['id'];
            
            foreach ($upload_array as &$fname) {
                $sql = 'INSERT INTO annoFile (annoId, fileName) VALUES
('.$id.', "'.$fname.'");';
                $que = $conn->query($sql);
            }
        }
        else
        {
            $sql = 'UPDATE announce SET name="'.$_POST['name'].'", start_time="'.$_POST['start_time'].'", end_time="'.$_POST['end_time'].'", title="'.$_POST['title'].'", content="'.$_POST['content'].'" where id='.$_POST['id'];
            $que = $conn->query($sql);
            
            $upload_array = json_decode($_POST['file_array']);
            
            $sql = 'select * from annoFile where annoId = '.$_POST['id'];
            $que = $conn->query($sql);
            while($row = $que->fetch_assoc())
            {
                $hasFile = 0;
                foreach ($upload_array as &$fname) {
                    if($row['fileName'] == $fname)
                    {
                        $hasFile = 1;
                        break;
                    }
                }
                if($hasFile == 0)
                {
                    $sqld = 'delete from annoFile where fileName="'.$row['fileName'].'"';
                    $qued = $conn->query($sqld);
                }
            }
            
            foreach ($upload_array as &$fname) {
                $sql = "SELECT count(1) as cnt from annoFile where annoId = ".$_POST['id']." and fileName = '".$fname."';";
                $scnt = $conn->query($sql)->fetch_assoc()["cnt"];
                if($scnt==0)
                {
                    $sql = 'INSERT INTO annoFile (annoId, fileName) VALUES
    ('.$_POST['id'].', "'.$fname.'");';
                    $que = $conn->query($sql);
                }
            }
        }
    }
    
    /***********************************************/
    /*    upload file when editing announcement    */
    /***********************************************/
    
    if($_POST['action']=='upload_announce')
    {
        $list = json_decode($_POST['list']);
        $file_up = $_FILES['file'];
        $dir = __DIR__."/file/";
        $target = $dir.$file_up['name'];
        $err = move_uploaded_file($file_up['tmp_name'],$target);
        
        if($err==false) echo "error";
        else
        {
            array_push($list, $file_up['name']);
            
            $modify_attach = "";
            foreach ($list as &$fname) {
                $modify_attach .= '<div class="attach col-sm-4">
                                        <div class="row attach_row">
                                            <div class="col-sm-3">
                                                <button class="btn btn-danger" onclick="discardFile(this);"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="col-sm-9 attach_name">'
                                                .$fname.
                                           '</div>
                                        </div>
                                   </div>';
            
            }
            echo $modify_attach;
        }
    }
    
    /***********************************************/
    /*       update service panel in display       */
    /***********************************************/
    
    if($_POST['action']=='update_service')
    {
        $content = '<div>
                        <h1>服務辦理時程</h1><hr style="width: 80%;">
                        <div class="row" style="margin:auto;">
                            <div class="col-sm-3">
                                <button class="btn btn-primary" onclick="newService();" style="width:100%; font-size:2em;"><i class="fa fa-plus"></i>&nbsp;新增時程</button>
                            </div>
                        </div>
                        <div class="serv_row">';
        $sql = 'select * from schdule order by id DESC';
        $que = $conn->query($sql);
        while($row = $que->fetch_assoc())
        {
            $content .= '<div class="row serv_content">
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="col-sm-6"><button class="btn btn-danger delete_serv" onclick="deleteService('.$row['id'].', this);"><i class="fa fa-trash"></i></button></div>
                                    <div class="col-sm-6"><button class="btn btn-success" onclick="editService('.$row['id'].');"><i class="fa fa-edit"></i></button></div>
                                </div>
                            </div>
                            <div class="col-sm-2 serv_date">'.$row["start_time"].'</div>
                            <div class="col-sm-8 serv_service">'.$row["service"].'</div>
                        </div>';
        }         
        $content .= '   </div>
                     </div>';
        
        echo $content;
    }
    
    /***********************************************/
    /*           delete service in display         */
    /***********************************************/
    
    
    if($_POST['action']=='delete_service' && isset($_POST['id']))
    {
        $sql = 'delete from schdule where id='.$_POST['id'];
        $que = $conn->query($sql);
    }
    
    
    /***********************************************/
    /*                edit service                 */
    /***********************************************/
    
    
    if($_POST['action']=='edit_service' && isset($_POST['id']))
    {
        $sql = 'select * from schdule where id='.$_POST['id'];
        $que = $conn->query($sql);
        $row = $que->fetch_assoc();
        
        $content = '<div class="edit_serv_row>
                        <div class="edit_area row">
                                <div class="edit_title col-sm-12">
                                    <h3>服務名稱</h3>
                                    <select id="serv_service">';
                                    
        $service_arr = ["學雜費減免", "就學貸款", "學產低收" ,"還願獎學金", "旭日獎學金", "逐夢獎學金", "生活助學金", "兼任行政助理"];
        foreach($service_arr as &$sname){
            $selected = "";
            if($row['service']==$sname) $selected = "selected"; 
            $content .= '<option value="'.$sname.'" '.$selected.' >'.$sname.'</option>';
        }
        $content .=                '</select>
                                </div>
                                <div class="col-sm-12" style="margin:20px auto 10px auto;">
                                    <hr>
                                </div>
                                
                                <div class="edit_start_time col-sm-12">
                                    <h3>服務辦理時程起始時間</h3>
                                    <input type="date" id="serv_stime" value="'.$row['start_time'].'">
                                </div>
                                <div class="edit_end_time col-sm-12">
                                    <h3>服務辦理時程結束時間</h3>
                                    <input type="date" id="serv_etime" value="'.$row['end_time'].'">
                                </div>
                        </div>
                    </div>
                    <div class="edit_save col-sm-12">
                                    <button class="btn btn-success" onclick="saveService('.$row['id'].');">儲存</button>
                                    <button class="btn btn-default" onclick="cancelEdit(\'service\');">取消</button>
                                </div>
                        </div>
                    </div>';
        echo $content;
    }
    
    /***********************************************/
    /*              add new service                */
    /***********************************************/
    
    
    if($_POST['action']=='new_service')
    {
        $content = '<div class="edit_serv_row>
                        <div class="edit_area row">
                                <div class="edit_title col-sm-12">
                                    <h3>服務名稱</h3>
                                    <select id="serv_service">
                                        <option disabled selected value=""></option>';
                                        
        $service_arr = ["學雜費減免", "就學貸款", "學產低收" ,"還願獎學金", "旭日獎學金", "逐夢獎學金", "生活助學金", "兼任行政助理"];
        foreach($service_arr as &$sname){
            $content .= '<option value="'.$sname.'">'.$sname.'</option>';
        }
        $content .=                '</select>
                                </div>
                                <div class="col-sm-12" style="margin:20px auto 10px auto;">
                                    <hr>
                                </div>
                                
                                <div class="edit_start_time col-sm-12">
                                    <h3>服務辦理時程起始時間</h3>
                                    <input type="date" id="serv_stime" value="">
                                </div>
                                <div class="edit_end_time col-sm-12">
                                    <h3>服務辦理時程結束時間</h3>
                                    <input type="date" id="serv_etime" value="">
                                </div>
                        </div>
                    </div>
                    <div class="edit_save col-sm-12">
                                    <button class="btn btn-success" onclick="saveService(-1);">儲存</button>
                                    <button class="btn btn-default" onclick="cancelEdit(\'service\');">取消</button>
                                </div>
                                    
                        </div>
                    </div>';
        echo $content;
    }
    
    /***********************************************/
    /*           save service after edit           */
    /***********************************************/
    
    if($_POST['action']=='save_service' && isset($_POST['id']))
    {
        if($_POST['id']==-1)        // new service
        {
            $sql = 'INSERT INTO schdule (service, start_time, end_time) VALUES
("'.$_POST['service'].'", "'.$_POST['start_time'].'", "'.$_POST['end_time'].'")';
            $que = $conn->query($sql);
        }
        else
        {
            $sql = 'UPDATE schdule SET service="'.$_POST['service'].'", start_time="'.$_POST['start_time'].'", end_time="'.$_POST['end_time'].'" where id='.$_POST['id'];
            $que = $conn->query($sql);
        }
    }
    
    /***********************************************/
    /*         update lost panel in display        */
    /***********************************************/
    
    if($_POST['action']=='update_lost')
    {
        $content = '<div>
                        <h1>失物招領</h1><hr style="width: 80%;">
                        <div class="row" style="margin:auto;">
                            <div class="col-sm-3">
                                <button class="btn btn-primary" onclick="newLost();" style="width:100%; font-size:2em;"><i class="fa fa-plus"></i>&nbsp;新增公告</button>
                            </div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4 lost_switch">
                                <table class="switch_table">
                                    <tr>
                                        <td>允許貼文</td>';
                                
        $sql = 'SELECT post FROM allowPost';
        $status = $conn->query($sql)->fetch_assoc()['post'];
        
        if($status==1)
        {
            $content .= '               <td class="switch_state_on" id="switch_state">ON</td>
                                        <td class="switch_icon_on" id="switch_icon"><i class="fa fa-toggle-on" onclick="lostSwitch(0);"></i></td>';
        }
        else
        {
            $content .= '               <td class="switch_state_off" id="switch_state">OFF</td>
                                        <td class="switch_icon_off" id="switch_icon"><i class="fa fa-toggle-off" onclick="lostSwitch(1);"></i></td>';
        }
        $content .= '               </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="lost_row">';
        $sql = 'select * from lost order by id DESC';
        $que = $conn->query($sql);
        while($row = $que->fetch_assoc())
        {
            $content .= '<div class="row lost_content">
                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12 lost_option"><button class="btn btn-danger delete_lost" onclick="deleteLost('.$row['id'].', this);"><i class="fa fa-trash"></i></button></div>
                                        <div class="col-sm-12 lost_option"><button class="btn btn-success" onclick="editLost('.$row['id'].');"><i class="fa fa-edit"></i></button></div>
                                        <div class="col-sm-12 lost_option"><img src="./lost_photo/'.$row["img"].'?'.time().'"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="col-sm-3 lost_head">物品名稱</div><div class="col-sm-9 lost_element">'.$row["item"].'</div>
                                <div class="col-sm-3 lost_head">拾獲地點</div><div class="col-sm-9 lost_element">'.$row["place"].'</div>
                                <div class="col-sm-3 lost_head">到期日期</div><div class="col-sm-9 lost_element">'.$row["expire"].'</div>
                                <div class="col-sm-3 lost_head">聯絡人</div><div class="col-sm-9 lost_element">'.$row["name"].'</div>
                                <div class="col-sm-3 lost_head">聯絡電話</div><div class="col-sm-9 lost_element">'.$row["phone"].'</div>
                            </div>
                        </div>';
        }         
        $content .= '   </div>
                     </div>';
        
        echo $content;
    }
    
    /***********************************************/
    /*              delete lost in display          */
    /***********************************************/
    
    
    if($_POST['action']=='delete_lost' && isset($_POST['id']))
    {
        $sql = 'delete from lost where id='.$_POST['id'];
        $que = $conn->query($sql);
    }
    
    /***********************************************/
    /*                  edit lost                  */
    /***********************************************/
    
    
    if($_POST['action']=='edit_lost' && isset($_POST['id']))
    {
        $sql = 'select * from lost where id='.$_POST['id'];
        $que = $conn->query($sql);
        $row = $que->fetch_assoc();
        
        $content = '<div class="edit_lost_row>
                        <div class="edit_area row">
                                <div class="edit_content col-sm-12">
                                    <h3>物品名稱</h3>
                                    <input type="text" id="lost_item" value="'.$row['item'].'">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>拾獲地點</h3>
                                    <input type="text" id="lost_place" value="'.$row['place'].'">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>到期日期</h3>
                                    <input type="date" id="lost_expire" value="'.$row['expire'].'">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>聯絡人</h3>
                                    <input type="text" id="lost_name" value="'.$row['name'].'">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>聯絡電話</h3>
                                    <input type="text" id="lost_phone" value="'.$row['phone'].'">
                                </div>
                                <div class="edit_attach col-sm-12">
                                    <h3>圖片</h3>
                                    <img id="lost_preview" src="./lost_photo/'.$row['img'].'?'.time().'"></img>
                                    <form id="uploadForm" enctype="multipart/form-data">
                                        <div class="row add_file">
                                            <div class="col-sm-10">
                                                <input type="file" id="lost_file" name="file" draggable="true" accept="image/jpg, image/jpeg, image/png" />
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="upload" class="btn btn-primary" onclick=\'uploadLostFile('.$row['id'].', event);\' style="float:right; width: 100%; font-size: 1.8em;">上傳</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="edit_save col-sm-12">
                                    <button class="btn btn-success" onclick="saveLost('.$row['id'].');">儲存</button>
                                    <button class="btn btn-default" onclick="cancelEdit(\'lost\');">取消</button>
                                </div>
                        </div>
                    </div>';
        echo $content;
    }
    
    /***********************************************/
    /*                add new lost                 */
    /***********************************************/
    
    
    if($_POST['action']=='new_lost')
    {
        $content = '<div class="edit_lost_row>
                        <div class="edit_area row">
                                <div class="edit_content col-sm-12">
                                    <h3>物品名稱</h3>
                                    <input type="text" id="lost_item" value="">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>拾獲地點</h3>
                                    <input type="text" id="lost_place" value="">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>到期日期</h3>
                                    <input type="date" id="lost_expire" value="">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>聯絡人</h3>
                                    <input type="text" id="lost_name" value="">
                                </div>
                                <div class="edit_content col-sm-12">
                                    <h3>聯絡電話</h3>
                                    <input type="text" id="lost_phone" value="">
                                </div>
                                <div class="edit_attach col-sm-12">
                                    <h3>圖片</h3>
                                    <img id="lost_preview" src="" style="display: none;"></img>
                                    <form id="uploadForm" enctype="multipart/form-data">
                                        <div class="row add_file">
                                            <div class="col-sm-10">
                                                <input type="file" id="lost_file" name="file" draggable="true" accept="image/jpg, image/jpeg, image/png" />
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="upload" class="btn btn-primary" onclick=\'uploadLostFile(-1, event);\' style="float:right; width: 100%; font-size: 1.8em;">上傳</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="edit_save col-sm-12">
                                    <button class="btn btn-success" onclick="saveLost(-1);">儲存</button>
                                    <button class="btn btn-default" onclick="cancelEdit(\'lost\');">取消</button>
                                </div>
                        </div>
                    </div>';
        echo $content;
    }
    
    /***********************************************/
    /*            save lost after edit             */
    /***********************************************/
    
    if($_POST['action']=='save_lost' && isset($_POST['id']))
    {
        if($_POST['id']==-1)        // new lost
        {
            $sql = 'INSERT INTO lost (item, place, name, expire, phone, img) VALUES
("'.$_POST['item'].'", "'.$_POST['place'].'", "'.$_POST['name'].'", "'.$_POST['expire'].'", "'.$_POST['phone'].'", "'.$_POST['img'].'")';
            $que = $conn->query($sql);
        }
        else
        {
            $sql = 'UPDATE lost SET item="'.$_POST['item'].'", place="'.$_POST['place'].'", name="'.$_POST['name'].'", expire="'.$_POST['expire'].'", phone="'.$_POST['phone'].'", img="'.$_POST['img'].'" where id='.$_POST['id'];
            $que = $conn->query($sql);
        }
    }
    
    
    
    /***********************************************/
    /*        upload file when editing lost        */
    /***********************************************/
    
    if($_POST['action']=='upload_lost' && isset($_POST['id']))
    {
        $file_up = $_FILES['file'];
        $dir = "./lost_photo/";
        $type = pathinfo($file_up['name'], PATHINFO_EXTENSION);
        
        if($_POST['id']!=-1)
        {
            $target = $dir.$_POST['id'].'.'.$type;
        }
        else
        {
            $sql = "select id from lost where id in (select MAX(id) from lost)";
            $lid = $conn->query($sql)->fetch_assoc()["id"]+1;
            $target = $dir.$lid.'.'.$type;
        }
        $err = move_uploaded_file($file_up['tmp_name'],$target);
        
        
        if($err==false) echo "error";
        else echo $target . "?" . time();
    }
    
    /***********************************************/
    /*      turn on / off lost and found form      */
    /***********************************************/
    
    if($_POST['action']=='lost_switch' && isset($_POST['state']))
    {
        $sql = 'UPDATE allowPost SET post='.$_POST['state'].' where name="post"';
        $que = $conn->query($sql);
        
        echo ($_POST['state']==1)?'ON':'OFF';
    }
    
    /***********************************************/
    /*                edit article                 */
    /***********************************************/
    
    if($_POST['action']=='edit_article' && isset($_POST['page']))
    {
        $pagedata = array();
        $pagedata[0] = file_get_contents($_POST["page"].'.txt');
	    
	    $pagefile = '';
	    $sql = 'select * from pageUpload where pageName="'.$_POST['page'].'"';
        $que = $conn->query($sql);
        while($row = $que->fetch_assoc())
        {
             $pagefile .=           '<div class="attach col-sm-4">
                                        <div class="row attach_row">
                                            <div class="col-sm-3">
                                                <button class="btn btn-danger" onclick="discardFile(this);"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="col-sm-9 attach_name">'
                                                .$row['uploadFile'].
                                           '</div>
                                        </div>
                                    </div>';
        }
        $pagedata[1] = $pagefile;
        
        $pageowner = '
                                    <h3>負責人</h3>
                                    <select id="page_owner">';                        
        $sqlo = 'select * from pages where pageName = "'.$_POST['page'].'"';
        $queo = $conn->query($sqlo);
        $owner_name = $queo->fetch_assoc()['manager'];
        
        $sqlm = 'select * from member';
        $quem = $conn->query($sqlm);
        while($rowm = $quem->fetch_assoc())
        {
            if($rowm['name']=='default') $pageowner .= '<option value="default"></option>';
            else if($rowm['name']!=$owner_name) $pageowner.= '<option value="'.$rowm['name'].'">'.$rowm['name'].'</option>';
            else $pageowner.= '<option value="'.$rowm['name'].'" selected>'.$rowm['name'].'</option>';
        }                    
        $pageowner .=                '</select>';
        
        $pagedata[2] = $pageowner;
        
	    echo json_encode($pagedata);
    }
    
    /***********************************************/
    /*                save article                 */
    /***********************************************/
    
    if($_POST['action']=='save_article')
    {
        file_put_contents($_POST["page"].'.txt', $_POST["content"]);
        
        $upload_array = json_decode($_POST['file_array']);
            
        $sql = 'select * from pageUpload where pageName = "'.$_POST["page"].'"';
        $que = $conn->query($sql);
        while($row = $que->fetch_assoc())
        {
            $hasFile = 0;
            foreach ($upload_array as &$fname) {
                if($row['uploadFile'] == $fname)
                {
                    $hasFile = 1;
                    break;
                }
            }
            if($hasFile == 0)
            {
                $sqld = 'delete from pageUpload where uploadFile="'.$row['uploadFile'].'"';
                $qued = $conn->query($sqld);
            }
        }
        
        foreach ($upload_array as &$fname) {
            $sql = "SELECT count(1) as cnt from pageUpload where pageName = \"".$_POST['page']."\" and uploadFile = '".$fname."';";
            $scnt = $conn->query($sql)->fetch_assoc()["cnt"];
            if($scnt==0)
            {
                $sql = 'INSERT INTO pageUpload (pageName, uploadFile) VALUES
("'.$_POST['page'].'", "'.$fname.'");';
                $que = $conn->query($sql);
            }
        }
        
        $sql = 'UPDATE pages SET manager="'.$_POST['manager'].'" where pageName="'.$_POST["page"].'"';
        $que = $conn->query($sql);
    }
    
    /***********************************************/
    /*      upload file when editing articles      */
    /***********************************************/
    
    if($_POST['action']=='upload_article')
    {
        $list = json_decode($_POST['list']);
        $file_up = $_FILES['file'];
        $dir = __DIR__.'/file/'.$_POST['page'].'/';
        $target = $dir.$file_up['name'];
        $err = move_uploaded_file($file_up['tmp_name'],$target);
        
        if($err==false) echo "error";
        else
        {
            array_push($list, $file_up['name']);
            
            $modify_attach = "";
            foreach ($list as &$fname) {
                $modify_attach .= '<div class="attach col-sm-4">
                                        <div class="row attach_row">
                                            <div class="col-sm-3">
                                                <button class="btn btn-danger" onclick="discardFile(this);"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="col-sm-9 attach_name">'
                                                .$fname.
                                           '</div>
                                        </div>
                                   </div>';
            
            }
            echo $modify_attach;
        }
    }
?>
