<?php

session_start();

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once "initapp.php";

$list_page = "blog_list.php";
$detail_page = "blog_detail.php";

if (!$_POST) {
    if ($user->checkUser() != "admin") {
        header("Location: login.php");
    }
} else {

    try {
        if ($user->checkUser() != "admin") {
            throw new Exception("Session Expired. Please login again !!!");
        }

        $result = array();
        if ($_POST["cmd"] == "loadData") {
            $data_count = 0 ;
            $content_data = "<thead><tr>
						<td style='width:5%;'>#</td>
						<td  style='width:45%;'>TITLE</td>
						<td  style='width:15%;'>TYPE</td>
						<td  style='width:15%;'>STATUS</td>
						<td  style='width:10%;'>EDIT</td>
						<td  style='width:10%;'>DEL</td>
					</tr></thead><tbody>";

            $sql = "select count(blog_id) as data_count from sto_blog where blog_id <> 0 ";
            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            if (!$db->read())
                throw new Exception("Operation Error");
            $data_count = $db->result['data_count'];
            $page_size = 2000;
            $num_page = ceil($data_count / $page_size);
            $start_limit = ($page - 1) * $page_size;
            $i = $start_limit;;
            $sql = "select * from sto_blog blog  where blog.blog_id <> 0 order by blog.blog_id DESC ";
            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            $order = 1;
            while ($db->read()) {
                $i += 1;

                $content_data .= "<tr  cellpadding='2'>
								<td style='text-align:center;'>" . $order++ . "</td>
								<td >" . $db->result['blog_title'] . "</td>
								<td >" . $db->result['blog_type'] . "</td>
								<td style='text-align:center;'>" . $db->result['blog_status'] . "</td>
								<td style='text-align:center;'>
									<a href='" . $detail_page . "?mode=edit&id=" . $db->result['blog_id'] . "' title='แก้ไข' ><img src='images/edit.png' style='width:16px;height:16px;'  /></a>
								</td>
								<td style='text-align:center;'>
									<a href='#' onclick='processDelete(\"" . $db->result['blog_id'] . "\")' title='ลบ'><img src='images/delete.gif' style='width:16px;height:16px;' /></a>
								</td>
							</tr>";
            }

            if ($data_count == 0) {
                $content_data .= "<tr><td colspan=6 style='text-align:center;'>No Data</td></tr>";
            }

            $content_data .= "</tbody>";

            $data = array();
            $data['data_count'] = $data_count;
            $data['content_data'] = $content_data;

            $result['message'] = $data;
        } else if ($_POST["cmd"] == "deleteData") {
            if ($_POST['id'] == "") {
                throw new Exception("Id not found");
            }

            $sql = "delete from sto_blog where blog_id ='" . $_POST['id'] . "' ";
            if (!$db->executeNonquery($sql))
                throw new Exception("Operation Error");
        } else {
            throw new Exception("No operations");
        }

        $result['msgStatus'] = "ok";
        print json_encode($result);

    } catch (Exception $ex) {
        $result = array();
        $result['msgStatus'] = "error";
        $result['message'] = $ex->getMessage();
        print json_encode($result);
    }

    exit();
}
?>

<?php include "header.php"; ?>

    <script language="JavaScript">
        function search(page) {

                var ajax = new SmartAjax('POST', '<?=$list_page?>', "");
                ajax.requestJSON("loadData",
                    function (response) {
                        var status = response.msgStatus;
                        var msg = response.message;
                        if (status == "ok") {
                            $('#countPane').html(msg.data_count);
                            $('#dataSpan').html(msg.content_data);
                            $('#dataSpan').trigger("create");
                        } else {
                            $('#dataSpan').html(msg);
                        }
                    }
                );
            }


        function processDelete(id) {
            if (confirm("Are you confirm to delete ?")) {
                var ajax = new SmartAjax('POST', '<?=$list_page?>', 'id=' + id);
                ajax.requestJSON("deleteData",
                    function (response) {
                        var status = response.msgStatus;
                        var msg = response.message;
                        if (status == "ok") {
                            swal("Delete", ' successful', 'success');
                            search(1);
                        } else {
                            swal(msg);
                        }
                    }
                );
            }
        }

        $(document).ready(function () {
            search(1);
        });

    </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="./library/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link  rel="stylesheet" href="./library/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="./library/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <!-- Sweet alert JS and CSS -->
    <script src="./library/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./library/sweetalert-master/dist/sweetalert.css">
    <!--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/af-2.1.2/b-1.2.1/b-html5-1.2.1/b-print-1.2.1/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.2/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.css"/>-->
    <!--    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>-->
    <!--    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/af-2.1.2/b-1.2.1/b-html5-1.2.1/b-print-1.2.1/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.2/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>-->

    <!--    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>-->

    <h1>BLOG LIST</h1>
    <div style="margin-top:15px;float:left;">
        จำนวน <span id='countPane' style='color:red;'> 0 </span> รายการ &nbsp;|&nbsp; <a
            href="<?= $detail_page ?>?mode=add">Add New</a>
    </div>
    <div style='clear:both;'></div>

    <!--<button onclick="show()">clickme</button>-->
    <style>
        .datatable {
            border-collapse: collapse;
        }

        .datatable thead tr {
            background-color: #F7F8E0;
        }

        .datatable thead td {
            font-weight: bold;
            text-align: center;
        }

        .datatable td {
            text-align: left;
            border: 1px solid #E6E6E6;
            padding: 5px;
        }
    </style>
    <table id='dataSpan' class='datatable' width="100%" border="0" cellspacing="1" cellpadding="0"
           style="margin-top:5px;margin-bottom: 150px">

    </table>


<?php include "footer.php"; ?>