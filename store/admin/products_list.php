<?php

session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once "initapp.php";

$list_page = "products_list.php";
$detail_page = "product_detail.php";

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

            $content_data = "<thead><tr>
						<td style='width:5%;'>#</td>
						<td  style='width:35%;'>Product Name</td>
						<td  style='width:15%;'>Category</td>
						<td  style='width:15%;'>Pattern</td>
						<td  style='width:10%;'>Price (USD)</td>
						<td style='width:5%;'>Up</td>
						<td style='width:5%;'>Down</td>
						<td style='width:5%;'></td>
						<td style='width:5%;'></td>
					</tr></thead><tbody>";

            $page = 1;

            $cause = "";
            $cause2 = "";
            $cause3 = "";
            $cause4 = "";
            if (isset($_POST[search_text])) {
                $search_text = $_POST[search_text];
                $cause .= "and p_name LIKE '%" . $search_text . "%'	";
            }

            if (isset($_POST[p_cate_id]) && !empty($_POST[p_cate_id])) {
                $p_cate_id = $_POST[p_cate_id];
                $cause2 .= " and prod.p_cate_id = '" . $p_cate_id . "'";
            }

            if (isset($_POST[p_pattern_id]) && !empty($_POST[p_pattern_id])) {
                $p_pattern_id = $_POST[p_pattern_id];
                $cause3 .= " and prod.p_pattern_id = '" . $p_pattern_id . "'";
            }

            if (isset($_POST[p_price_start]) && !empty($_POST[p_price_start]) && isset($_POST[p_price_last]) && !empty($_POST[p_price_last])) {
                $p_price_start = $_POST[p_price_start];
                $p_price_last = $_POST[p_price_last];


                $cause4 .= " and p_price BETWEEN '" . $p_price_start . "' and '" . $p_price_last . "'";
            }


//            $sql = "select count(p_id) as data_count from sto_products where p_id <> 0 " . $cause;
            $sql = "select count(p_id) as data_count from sto_products prod join sto_category cate on cate.p_cate_id = prod.p_cate_id join sto_pattern pat on pat.p_pattern_id = prod.p_pattern_id where prod.p_id <> 0 " . $cause . $cause2 . $cause3 . $cause4;
            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            if (!$db->read())
                throw new Exception("Operation Error");
            $data_count = $db->result['data_count'];
            $page_size = 2000;
            $num_page = ceil($data_count / $page_size);
            $start_limit = ($page - 1) * $page_size;
            $i = $start_limit;
            $order = 1;
            $sql = "select * from sto_products prod join sto_category cate on cate.p_cate_id = prod.p_cate_id join sto_pattern pat on pat.p_pattern_id = prod.p_pattern_id where prod.p_id <> 0 " . $cause . $cause2 . $cause3 . $cause4 . " order by prod.seq desc LIMIT " . $start_limit . "," . $page_size;
            if (!$db->execute($sql))

                throw new Exception("Operation Error");

            while ($db->read()) {
                $i += 1;

                $content_data .= "<tr  cellpadding='2'>
								<td style='text-align:center;'>" . $order++ . "</td>
								<td >" . $db->result['p_name'] . "</td>
								<td >" . $db->result['p_cate_name'] . "</td>
								<td >" . $db->result['p_pattern_name'] . "</td>
								<td style='text-align:right'>" . number_format($db->result['p_price'], 2, '.', ',') . "</td>
	                            <td style='text-align:center;'>
									<img id='upItem" . $db->result['p_id'] . "' src='images/arrow-up2.png' style='width:16px;height:16px;cursor:pointer;' onclick='processMoveRow(\"" . $db->result['p_id'] . "\" , \"" . $db->result['seq'] . "\", \"" . 'up' . "\" )' title='ขึ้น' />
								</td>
								<td style='text-align:center;'>
									<img id='downItem" . $db->result['p_id'] . "' src='images/arrow-down1.png' style='width:16px;height:16px;cursor:pointer;' onclick='processMoveRow(\"" . $db->result['p_id'] . "\" , \"" . $db->result['seq'] . "\", \"" . 'down' . "\" )' title='ลง'  />
								</td>
								<td style='text-align:center;'>
									<a href='" . $detail_page . "?mode=edit&id=" . $db->result[p_id] . "' title='แก้ไข' ><img src='images/edit.png' style='width:16px;height:16px;'  /></a>
								</td>
								<td style='text-align:center;'>
									<a href='#' onclick='processDelete(\"" . $db->result[p_id] . "\")' title='ลบ'><img src='images/delete.gif' style='width:16px;height:16px;' /></a>
								</td>
							</tr>";

            }


            if ($data_count == 0) {
                $content_data .= "<tr><td colspan=6 style='text-align:center;'>No Data</td></tr>";
            }
//            if(mysql_num_rows($result)==0){
//                $content_data .= "<tr><td colspan=4 style='text-align:center;'>No Data</td></tr>";
//            }

            $content_data .= "</tbody>";

            $data = array();
            $data['data_count'] = $data_count;
            $data['content_data'] = $content_data;

            $result['message'] = $data;
        } else if ($_POST["cmd"] == "deleteData") {
            if ($_POST['id'] == "") {
                throw new Exception("Id not found");
            }

            $sql = "delete from sto_products where p_id='" . $_POST['id'] . "'; ";
            if (!$db->executeNonquery($sql))
                throw new Exception("Operation Error");
        }else if($_POST["cmd"] == "moveRow" ){

            if ($_POST["mode"] == "up" ) {

                $sql = "select * from sto_products where seq = (select min(seq) from sto_products where seq > " . $_POST["seq"] . ") ;";
                $msgerror = "On Top Now!!";
            } else if ($_POST["mode"] == "down" ) {
//                $sql = "select min(seq) from sto_product_collection where p_id=" . $_POST['p_id'];
                $sql = "select * from sto_products where seq = (select max(seq) from sto_products where seq < " . $_POST["seq"] . ") ;";
                $msgerror = "On Bottom Now!!";
            }

            if (!$db->execute($sql))
                throw new Exception("execute Error");
            if (!$db->read())
                throw new Exception($msgerror);

            $p_id = $db->result['p_id'];
            //1
            $s_seq = $db->result['seq'];
            //2

            if ($p_id <> "" ) {

                $sql = "update sto_products set seq = '" . $s_seq . "' where p_id = '" . $_POST['p_id'] . "' ;";
                if (!$db->execute($sql))
                    throw new Exception("1 Error");

                $sql = "update sto_products set seq = '" . $_POST['seq'] . "' where p_id = '" . $p_id . "' ;";
                if (!$db->execute($sql))
                    throw new Exception("2 Error");
            }else{
                throw new Exception("id null");
            }
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
            var submit = 1;
            var p_cate_id = $('#p_cate_id').val();
            var p_pattern_id = $('#p_pattern_id').val();
            var p_price_start = $('#p_price_start').val();
            var p_price_last = $('#p_price_last').val();
            if (p_price_start > 0 && p_price_last <= 0) {
                swal('Please type input Price Last');
                submit = 0;
            }

            if (p_price_last > 0 && p_price_start <= 0) {
                swal('Please type input Price start');
                submit = 0;
            }
            if (submit == 1) {
                var p_name = $('#search_text').val();
                var ajax = new SmartAjax('POST', '<?=$list_page?>', "search_text=" + p_name + "&p_cate_id=" + p_cate_id + "&p_pattern_id=" + p_pattern_id + "&p_price_start=" + p_price_start + "&p_price_last=" + p_price_last);
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

        function processMoveRow(p_id, seq, mode) {
            var ajax = new SmartAjax('POST', '<?=$list_page?>', 'p_id=' + p_id + '&seq=' + seq + '&mode=' + mode);
            ajax.requestJSON("moveRow",
                function (response) {
                    var status = response.msgStatus;
                    var type = response.type;
                    var msg = response.message;
                    if (status == "ok") {
                        search(1);
                    } else {
                        alert(msg);
                    }
                }
            );

        }
        $(document).ready(function () {
            search(1);
        });
    </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="./library/bootstrap-3.3.6-dist/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="./library/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="./library/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <!-- Sweet alert JS and CSS -->
    <script src="./library/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./library/sweetalert-master/dist/sweetalert.css">

    <h1>Products List</h1>
    <div style='clear:both;'></div><br/>
    <div id='search_pane'>


        <div class="jumbotron">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">

                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Category</h4>
                            <select class="form-control" id="p_cate_id" name="p_cate_id">
                                <option value="">Select Categories</option>
                                <option value="1">Home & Living</option>
                                <option value="2">Wear</option>
                                <option value="3">Fabric</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Pattern</h4>
                            <select class="form-control" id="p_pattern_id" name="p_pattern_id">
                                <option value="">Select Pattren</option>
                                <option value="1">Paint & Point</option>
                                <option value="2">Dash & Tear</option>
                                <option value="3">Brush & Brushing</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <h4 class="" style="text-align: left"> Product Price Start</h4>

                            <input maxlength="100" type="number" class="form-control"
                                   value=""
                                   id="p_price_start" name="p_price_start"
                                   placeholder="Price Start ..."/>

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Price Last</h4>
                            <input maxlength="100" type="number" class="form-control"
                                   value=""
                                   id="p_price_last" name="p_price_last"
                                   placeholder="Price last here ..."/>
                        </div>
                    </div>

                </div>


                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left"> Product Name</h4>
                            <input class="form-control" id='search_text' name='search_text' type='text' value=''
                                   style='' placeholder="Search Product Name here ..."
                                   onkeypress="if (event.keyCode == 13) {search(1); return false;}  "/>
                        </div>
                    </div>

                </div>


                </br>

                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
                    </div>

                    <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
                        <button class="btn btn-primary" onclick="search(1);" type="button">
                            <span class="glyphicon glyphicon-search"> Search</span></button>


                    </div>

                </div>


            </div>
        </div>


        <!--    <table   class='form-search' >-->
        <!--        <tr>-->
        <!--            <td class='form-caption'>-->
        <!--                <span class="text_label">คำค้น :</span>-->
        <!--            </td>-->
        <!--            <td colspan=3>-->
        <!--                <input class="form-control" id='search_text' name='search_text' type='text' value='' style='width:400px;' onkeypress="if (event.keyCode == 13) {search(1); return false;}  " />-->
        <!--            </td>-->
        <!--            <td>-->
        <!--                <input  type='button' value='ค้นหา' onclick="search(1);" />-->
        <!--            </td>-->
        <!--        </tr>-->
        <!--    </table>-->
    </div>
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
           style="margin-top:5px;">

    </table>


    <script>
        function show() {
            swal('test', 'success', 'success');
        }

    </script>

    </br>
    </br>
    </br>
    </br>
    </br>
<?php include "footer.php"; ?>