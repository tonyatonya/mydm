<?php
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once "initapp.php";

$list_page = "blog_list.php";
$detail_page = "blog_detail.php";

$timestamp = time();

if (!$_POST) {
    if ($user->checkUser() != "admin") {
        header("Location: login.php");
    }
    $mode = $_GET['mode'];
    $id = $_GET['id'];
    $tag_name = "";
    $sql = "select * from sto_blog_tags tag where tag.blog_id = '" . $id . "'";
    if (!$db->execute($sql))
        throw new Exception("Operation Error");


    while ($db->read()) {
        $tag_name .= $db->result['blog_tag_name'] . ',';
    }

} else {

    try {

        if ($user->checkUser() != "admin") {
            throw new Exception("Session Expired. Please login again !!!");
        }

        $result = array();
        if ($_POST["cmd"] == "loadData") {

            if ($_POST['id'] == "") {
                throw new Exception("Id not found");
            }
            // ALL product
            $sql = "select * from sto_blog blog where blog.blog_id = '" . $_POST['id'] . "'";
            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            if ($db->read()) {
                $data = $db->result;
                if (!empty($db->result['blog_thumb_img'])) {
                    $data['blog_thumb_img'] = "../blog/images/blog/" . $db->result['blog_thumb_img'];
                } else {
                    $data['blog_thumb_img'] = "";
                }

            }
            $result['message'] = $data;
//            ###############################3 In Case Description Image ############################
        } else {
            throw new Exception("No operations");
        }
        $result['msgStatus'] = "ok";
        $result['type'] = $_POST['type'];
        print json_encode($result);

    } catch (Exception $ex) {
        $result = array();
        $result['msgStatus'] = "error";
        $result['message'] = $ex->getMessage();
        print json_encode($result);
    }

    exit();
}

function utf8_urldecode($str)
{
    $str = preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str));
    return html_entity_decode($str, null, 'UTF-8');
}

function escape_text($str)
{
    $result = str_replace("\'", "#NL#", $str);
    $result = str_replace("'", "#NL#", $result);
    $result = str_replace("#NL#", "''", $result);
    return $result;
}

?>

<?php include "header.php" ?>
<script src="library/uploadify/jquery.uploadify.min.js" type="text/javascript"
        xmlns="http://www.w3.org/1999/html"></script>
<link rel="stylesheet" type="text/css" href="library/uploadify/uploadify.css">
<script src="library/ckeditor/ckeditor.js"></script>
<script src="library/ckeditor/adapters/jquery.js"></script>
<script src='js/jquery.form.js'></script>
<style>
    /*       Upload Bar    */
    .upload_progress {
        position: relative;
        width: 400px;
        border: 1px solid #ddd;
        padding: 1px;
        border-radius: 3px;
        display: none;
    }

    .upload_bar {
        background-color: #B4F5B4;
        width: 0%;
        height: 20px;
        border-radius: 3px;
    }

    .upload_percent {
        position: absolute;
        display: inline-block;
        top: 3px;
        left: 8%;
    }
</style>
<script language="JavaScript">
    form_name = "info_form";
    var tag_name ;

    function loadData(id) {

        var ajax = new SmartAjax('POST', '<?=$detail_page?>', 'id=' + id);
        ajax.requestJSON("loadData",
            function (response) {

                var status = response.msgStatus;
                var msg = response.message;

                if (status == "ok") {
                    $('#blog_title').val(msg.blog_title);

                    $('input[name=blog_status][value=  "' + msg.blog_status + '"]').attr('checked', true);
                    $('#blog_type').val(msg.blog_type);
                    $('#blog_content').val(msg.blog_content);
                    $('#blog_information').val(msg.blog_information);


                    if (msg.blog_thumb_img == "" | msg.blog_thumb_img == null) {
                        $("#thumb_image_image").attr("src", "images/nopic.png");
                    } else {
                        $("#thumb_image_image").attr("src", msg.blog_thumb_img);
                    }
                }
            }
        );
    }


    function loadTags()
    {
        // get tags list
        var ajax = new SmartAjax('POST', 'loadTags.php');
        ajax.requestJSON("loadData",
            function (response) {
                // list of tag existing
                tag_name = response.tag_name;

                $('#blog_tag').tagit({
                    // set for autocomplete value
                    availableTags: tag_name
                });
            }

        );

    }
    
    $(document).ready(function () {



        if ($('#mode').val() != "add") {
            loadData($('#id').val());
            loadTags();

        } else {
            $("#thumb_image_image").attr("src", "images/nopic.png");
            loadTags();
        }

    });

</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="./library/bootstrap-3.3.6-dist/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="./library/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="./library/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<!-- Sweet alert JS and CSS -->
<script src="./library/sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="./library/sweetalert-master/dist/sweetalert.css">
<!-- Auto Complete -->
<!-- Using jQuery with a CDN -->

<script src="./library/jquery.easy-autocomplete.min.js"></script>
<link rel="stylesheet" href="./library/easy-autocomplete.min.css">
<script src="./library/ckeditor/ckeditor.js"></script>
<!-- TAG -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript"
        charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript"
        charset="utf-8"></script>
<script src="./library/tag/tag-it.min.js" type="text/javascript" charset="utf-8"></script>
<link href="./library/tag/jquery.tagit.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css"
      href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<!--<script src="./library/ckeditor/samples/js/sample.js"></script>-->
<!--<script src="./library/ckeditor/config.js"></script>-->


<div style="height:100% !important; margin-bottom:50px; padding-left:20px !important;">
    <style>
        .caption {
            font-weight: bold;
            vertical-align: top;
            padding-top: 5px;
        }

        .formtable td {
            text-align: left;
        }
    </style>
    <h1>BLOG DETAIL</h1>
    <div style=" width:98%;">
        <form id='info_form' name='info_form' method="post" enctype="multipart/form-data" action="blog_data.php">
            <input id='id' name="id" type="hidden" value='<?= $id ?>'>
            <input id='mode' name="mode" type="hidden" value='<?= $mode ?>'>
            <input type='hidden' id='upload_filename_field' name='upload_filename_field' value=''/>
            <input type='hidden' id='upload_target_path' name='upload_target_path' value=''/><br/>
            <p style="font-weight:bold;float:right;"><a href='<?= $list_page ?>' class="btn btn-primary"><< Back</a></p>
            <br/>
            <div style='clear:both;'></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">BLOG TITLE</h4>
                            <input maxlength="100" type="text" class="form-control"
                                   value=""
                                   id="blog_title" name="blog_title"
                                   placeholder="Title here ..." required/>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">BLOG STATUS</h4>
                            <label class="radio-inline"><input type="radio" id="blog_status" name="blog_status"
                                                               value="active" checked="checked"/>Active</label>
                            <label class="radio-inline"><input type="radio" id="blog_status" name="blog_status"
                                                               value="hide" required/>Hide</label>

                        </div>
                    </div>


                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">BLOG TYPE</h4>
                            <select class="form-control" id="blog_type" name="blog_type" required>
                                <option value="">Select BLOG TYPE</option>
                                <option value="inspiring design">inspiring design</option>
                                <option value="press">press</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">BLOG CONTENT</h4>
                            <!--                            <textarea name="editor1" id="editor1" rows="10" cols="80">-->
                            <!--                                     This is my textarea to be replaced with CKEditor.-->
                            <!--                              </textarea>-->

                            <textarea name="blog_content" id="blog_content" rows="25" cols="80"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">BLOG INFORMATION</h4>
                            <textarea class="form-control" name="blog_information" id="blog_information" rows="5"
                                      cols="80"></textarea>
                        </div>
                    </div>


                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">BLOG TAGS</h4>
                            <input class="form" name="blog_tag" id="blog_tag" value="<?= $tag_name ?>">
                        </div>
                    </div>
                    <h1><?php echo $tag_name; ?></h1>


                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">BLOG IMAGE</h4>
                            <div id='thumbPhotos'>
                                <div class='photo_block'>
                                    <a href="<?= $data['blog_thumb_img'] ?>" target='_blank'>
                                        <img id="thumb_image_image" name='thumb_image_image' src="images/loading2.gif"
                                             style='height:150px;width:auto;'/>
                                    </a>
                                </div>
                                <input type='hidden' name='thumb_image' value=''/>
                                <input type='hidden' name='thumb_image_ext' value=''/>
                                <div style='margin-left:10px;'>
                                    <input type="file" name="thumb_image_file" <?= $mode_edit_display ?> /><br/>
                                    <span class='comment' <?= $mode_edit_display ?> >Supported formats: Jpg, Png only, Size: Max 6 MB, Width : 250px - Height : 200px</span>
                                </div>
                                <br/>
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-success btn-md pull-mid" id="buttonSave" name="buttonSave" type="submit">
                        <span class="glyphicon glyphicon-floppy-save"> Save</span></button>


                </div>
            </div>
        </form>
    </div>
    <br/><br/><br/>


    <br/><br/><br/>

</div>
<script type="text/javascript">
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.

    CKEDITOR.replace('blog_content', {
//        filebrowserBrowseUrl : '/store/admin/library/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
//        filebrowserUploadUrl : 'library/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl: '/store/admin/library/responsive_filemanager/filemanager/dialog.php?type=1&editor=ckeditor&fldr='

    });


    //    initSample();


</script>
<iframe id="upload_file_target" name="upload_file_target" src="#"
        style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>

<?php include "footer.php" ?>

