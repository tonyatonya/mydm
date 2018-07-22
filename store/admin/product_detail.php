<?php
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once "initapp.php";

$conn = mysql_connect("localhost", "$DB_USERNAME", "$DB_PASSWORD");
mysql_select_db($DB_NAME);

$list_page = "products_list.php";
$detail_page = "product_detail.php";

$timestamp = time();

if (!$_POST) {
    if ($user->checkUser() != "admin") {
        header("Location: login.php");
    }
    $mode = $_GET['mode'];
    $id = $_GET['id'];

    //List of item
    if ($mode != 'edit') {
        $checkbox_data = "";
        $sql = "select * from sto_icon_refer";
        if (!$db->execute($sql))
            throw new Exception("Operation Error");

        while ($db->read()) {

            $checkbox_data .= "   <div class='col-md-4 col-sm-4 col-lg-4 '>
                                             <div class='form-group'>
                                                 <div class='checkbox'>
                                                     <label><input type='checkbox' name='care_icon[]' value='" . $db->result['p_icon_id'] . "' ><img src='../images/care-icon/" . $db->result['p_icon_img'] . "' style='widht:16px;height:16px' ></label>
                                                 </div>
                                            </div>
                                      </div>";
        }
    } else {
        $list_icon = array();
        //icon exist on product
        $sql = "select * from sto_care_icon where p_id = '" . $id . " ' ";
        if (!$db->execute($sql))
            throw new Exception("Operation Error");
        while ($db->read()) {
            $list_icon[] = $db->result['p_icon_id'];
        }


        $checkbox_data = "";
        //all icon in table
        $sql = "select * from sto_icon_refer ";
        if (!$db->execute($sql))
            throw new Exception("Operation Error");

        while ($db->read()) {

            $set_checked = "";
            if (in_array($db->result['p_icon_id'], $list_icon)) {
                $set_checked = "checked";
            }

            $checkbox_data .= "   <div class='col-md-4 col-sm-4 col-lg-4 '>
                                             <div class='form-group'>
                                                 <div class='checkbox'>
                                                     <label><input type='checkbox' name='care_icon[]' value='" . $db->result['p_icon_id'] . "' $set_checked><img src='../images/care-icon/" . $db->result['p_icon_img'] . "' style='widht:16px;height:16px'></label>
                                                 </div>
                                            </div>
                                      </div>";
        }

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
            $sql = "select sto1.p_id , sto1.p_name,sto1.p_title ,sto1.p_code ,sto1.p_description , sto1.p_information , sto1.p_material ,sto1.p_cate_id,sto1.p_pattern_id,sto1.p_price ,sto1.p_quantity ,sto1.p_thumb_image ,
(select sto2.p_code from sto_products sto2 where sto2.p_id = sto1.p_ref1_id) as product_ref1 ,
(select sto3.p_code from sto_products sto3 where sto3.p_id = sto1.p_ref2_id) as product_ref2
from sto_products sto1
where sto1.p_id = '" . $_POST['id'] . "'";
            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            if ($db->read()) {
                $data = $db->result;
                if (!empty($db->result['p_thumb_image'])) {
                    $data['p_thumb_image'] = "../images/products/product-thumbs/" . $db->result['p_thumb_image'];
                } else {
                    $data['p_thumb_image'] = "";
                }
            }


            $list_icon = array();
            //icon exist on product
            $sql = "select * from sto_care_icon where p_id = '" . $_POST['id'] . "'";
            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            while ($db->read()) {
                $list_icon[] = $db->result['p_icon_id'];
            }

            $list_link_product = array();
            //icon exist on product
//            $sql = "select * from sto_product_link where p_head_id = '" . $_POST['id'] . "'";
//            if (!$db->execute($sql))
//                throw new Exception("Operation Error");
//            while ($db->read()) {
//                $data['proc_link'] = $db->result['p_id'];
//            }


            $checkbox_data = "";
            //all icon in table
            $sql = "select * from sto_icon_refer ";
            if (!$db->execute($sql))
                throw new Exception("Operation Error");

            if ($db->read()) {
                foreach ($db->result['p_icon_id'] as $val) {
                    $set_checked = "";
                    if (in_array($val, $list_icon)) {
                        $set_checked = "checked";
                    }

                    $checkbox_data .= "   <div class='col-md-4 col-sm-4 col-lg-4 '>
                                             <div class='form-group'>
                                                 <div class='checkbox'>
                                                     <label><input type='checkbox' name='carecare' value='" . $db->result['p_icon_id'] . "' $set_checked><img src='../images/care-icon/" . $db->result['p_icon_img'] . "' ></label>
                                                 </div>
                                            </div>
                                      </div>";
                }
            }


            $data['checkbox_data'] = $checkbox_data;
            $result['message'] = $data;
//            ###############################3 In Case Description Image ############################
        } else if ($_POST["cmd"] == "loadDescripImg") {

            $content_data = "<thead><tr>
						<td style='width:5%;'>Order</td>
						<td style='width:15%;'>type</td>
						<td style='width:65%;'>File</td>
						<td style='width:5%;'>Del</td>
						<td style='width:5%;'>Up</td>
						<td style='width:5%;'>Down</td>
					</tr></thead><tbody>";

            $page = 1;

            $i = 0;
            $sql = "select * from sto_product_descrip_img where p_id = '" . $_POST['id'] . "' order by seq desc";


            $i += 1;

            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            while ($db->read()) {
                $i += 1;
                $jsonUp = '{"p_id":' . $db->result['p_id'] . ',"seq":' . $db->result['seq'] . ',"mode": "up"}';
                $jsonDown = '{"p_id":' . $db->result['p_id'] . ',"seq":' . $db->result['seq'] . ',"mode": "down"}';
                if ($db->result['type'] == "picture") {
                    $file = "<a target='_blank' href='../images/products/product-description/" . $db->result['p_id'] . "/" . $db->result['p_img'] . "'>
											<img src='../images/products/product-description/" . $db->result['p_id'] . "/" . $db->result['p_img'] . "' style='width:50px;height:35px;' />
										</a>";
                } else {
                    $file = $db->result['p_img'];
                }
                $content_data .= "<tr id='item_" . $i . "'>
								<td style='text-align:center;'>" . $db->result['seq'] . "</td>
									<td  style='text-align:center;'>" . $db->result['type'] . "</td>
								<td style='padding:5px;'>" . $file . "</td>
								<td style='text-align:center;'>
								    <img id='deleteDescrip" . $db->result['p_id'] . "' src='images/delete.gif' style='width:16px;height:16px;cursor:pointer;' onclick='deleteDescrip(\"" . $db->result['p_id'] . "\" , \"" . $db->result['p_img'] . "\")' title='ลบ' />
								</td>
								<td style='text-align:center;'>
									<img id='upItem" . $db->result['p_id'] . "' src='images/arrow-up2.png' style='width:16px;height:16px;cursor:pointer;' onclick='processMoveRow(\"" . $db->result['p_id'] . "\" , \"" . $db->result['seq'] . "\", \"" . 'up' . "\" , \"" . $db->result['p_img'] . "\", \"" . 'descrip' . "\")' title='ขึ้น' />
								</td>
								<td style='text-align:center;'>
									<img id='downItem" . $db->result['p_id'] . "' src='images/arrow-down1.png' style='width:16px;height:16px;cursor:pointer;' onclick='processMoveRow(\"" . $db->result['p_id'] . "\" , \"" . $db->result['seq'] . "\", \"" . 'down' . "\" , \"" . $db->result['p_img'] . "\" , \"" . 'descrip' . "\")' title='ลง'  />
								</td>
							</tr>";
            }

            if ($i == 0) {
                $content_data .= "<tr><td colspan=5 style='text-align:center;'>No Data</td></tr>";
            }
//            <option value='video'>Video</option>

            $content_data .= "<tr>
						<td style='text-align:center;'>auto</td>
						<td style='text-align:center;'>
								<select id='add_type' name='add_type' style='padding:1px;'
											onchange=\"if(this.value == 'picture'){ $('#add_image_pane').show(); $('#add_video_pane').hide(); } else { $('#add_image_pane').hide(); $('#add_video_pane').show();  }\">
									<option value='picture' selected>Picture</option>
								</select>
						</td>
						<td>
								<div id='add_image_pane'>
									<form name='manage_form2' id='manage_form2' method='POST' >
										<div id='fileUploadDiv2'>
											<input id='Filedata2' name='Filedata' type='file' class='fileUpload' size='30' multiple>
											<input type='hidden' id='p_id' name='p_id' value='' />
											<input type='hidden' id='order_num2' name='order_num2' value='' />
											<input type='hidden' id='add_type' name='add_type' value='' />
											<input type='hidden' id='timestamp' name='timestamp' value='' />
											<input type='hidden' id='token' name='token' value='' />
										</div>
										<input type='hidden' id='fileUploaded' name='fileUploaded' />
										<div class='upload_progress'>
											<div class='upload_bar'></div>
											<div class='upload_percent'>0%</div>
										</div>
									</form>
								</div>

						</td>
						<td style='text-align:center;' colspan='3'>

						</td>

				</tr>";
            $content_data .= "<tr>
                                <td style='text-align:center;color: red' colspan='6'>
                                        Click Chose Files Button to Upload This Product Description Picture
                                </td>
                             </tr>";
            $content_data .= "</tbody>";

            $data = array();
            $data['data_count'] = $data_count;
            $data['content_data'] = $content_data;

            $result['message'] = $data;

            //###########################  Incase gallary image ###########################
        }else if ($_POST["cmd"] == "loadGall")
        {

            $content_data = "<thead><tr>

						<td style='width:15%;'>Order</td>
						<td style='width:15%;'>Link number</td>
						<td style='width:20%;'>File Show</td>
						<td style='width:20%;'>File Collector</td>
						<td style='width:20%;'>Del </td>

					</tr></thead><tbody>";

            $page = 1;

            $i = 0;
            $sql = "select * from sto_product_collection where p_id = '" . $_POST['id'] . "' and ( p_img_show != NULL or p_img_show != '' ) order by seq desc";


            $i += 1;

            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            while ($db->read()) {
                $i += 1;
                $jsonUp = '{"p_id":' . $db->result['p_id'] . ',"seq":' . $db->result['seq'] . ',"mode": "up"}';
                $jsonDown = '{"p_id":' . $db->result['p_id'] . ',"seq":' . $db->result['seq'] . ',"mode": "down"}';
                if ($db->result['type'] == "picture") {
                    $file = "<a target='_blank' href='../images/products/product-detail/" . $db->result['p_id'] . "/" . $db->result['p_img'] . "'>
											<img src='../images/products/product-detail/" . $db->result['p_id'] . "/" . $db->result['p_img'] . "' style='width:50px;height:35px;' />
										</a>";

                    if ($db->result['p_img_show']) {
                        $file2 = "<a target='_blank' href='../images/products/product-detail/" . $db->result['p_id'] . "/collect/" . $db->result['p_img_show'] . "'>
											<img src='../images/products/product-detail/" . $db->result['p_id'] . "/collect/" . $db->result['p_img_show'] . "' style='width:50px;height:35px;' />
										</a>";
                    } else {
                        $file2 = "";
                    }


                } else {

                }
                $content_data .= "<tr id='item_" . $i . "'>
						<td  style='text-align:center;'>" . $db->result['seq'] . "</td>
									<td  style='text-align:center;'>" . $db->result['seq'] . "</td>
								<td style='padding:5px;'>" . $file . "</td>
								<td style='padding:5px;'>" . $file2 . "</td>
								<td style='text-align:center;'>
								    <img id='deleteGall" . $db->result['collect_id'] . "' src='images/delete.gif' style='width:16px;height:16px;cursor:pointer;' onclick='deleteGall(\"" . $db->result['p_id'] . "\" , \"" . $db->result['p_img_show'] . "\" , \"" . $db->result['collect_id'] . "\")' title='ลบ' />
								</td>


							</tr>";
            }

            if ($i == 0) {
                $content_data .= "<tr><td colspan=5 style='text-align:center;'>No Data</td></tr>";
            }
//            <option value='video'>Video</option>

            $content_data .= "<tr>
						<td style='text-align:center;'>auto</td>
						<td style='text-align:center;'>
							    <input type='text' id='link' name='link'>
						</td>
						<td>
								<div id='add_image_pane'>
									<form name='manage_form3' id='manage_form3' method='POST' >
										<div id='fileUploadDiv3'>
											<input id='Filedata3' name='Filedata' type='file' class='fileUpload' size='30' multiple>
											<input type='hidden' id='collect' name='collect' value='' />
											<input type='hidden' id='p_id' name='p_id' value='' />
											<input type='hidden' id='order_num2' name='order_num' value='' />
											<input type='hidden' id='add_type' name='add_type' value='' />
											<input type='hidden' id='timestamp' name='timestamp' value='' />
											<input type='hidden' id='token' name='token' value='' />
										</div>
										<input type='hidden' id='fileUploaded' name='fileUploaded' />
										<div class='upload_progress'>
											<div class='upload_bar'></div>
											<div class='upload_percent'>0%</div>
										</div>
									</form>
								</div>
								<div id='add_video_pane' style='display:none;'>
									<input id='add_video' name='add_video' type='text' style='width:80%;float:left;' placeholder='Please input vimeo link' >
									<input type='button' name='buttonAddItem' id='buttonAddItem' value='Add' onclick='addItem();'  style='float:left'>
								</div>
						</td>
						<td style='text-align:center;' colspan='3'>

						</td>

				</tr>";
            $content_data .= "<tr>
                                <td style='text-align:center;color: red' colspan='6'>
                                        Click Chose Files Button to Upload This Product Gallery Picture
                                </td>
                             </tr>";
            $content_data .= "</tbody>";

            $data = array();
            $data['data_count'] = $data_count;
            $data['content_data'] = $content_data;

            $result['message'] = $data;
        }
        else if ($_POST["cmd"] == "loadItem")
        {

            $content_data = "<thead><tr>
						<td style='width:5%;'>Order</td>
						<td style='width:15%;'>type</td>
						<td style='width:15%;'>File Show</td>
						<td style='width:15%;'>File Collector</td>

						<td style='width:5%;'>Del</td>
						<td style='width:5%;'>Up</td>
						<td style='width:5%;'>Down</td>
					</tr></thead><tbody>";

            $page = 1;

            $i = 0;
            $sql = "select * from sto_product_collection where p_id = '" . $_POST['id'] . "' order by seq desc";


            $i += 1;

            if (!$db->execute($sql))
                throw new Exception("Operation Error");
            while ($db->read()) {
                $i += 1;
                $jsonUp = '{"p_id":' . $db->result['p_id'] . ',"seq":' . $db->result['seq'] . ',"mode": "up"}';
                $jsonDown = '{"p_id":' . $db->result['p_id'] . ',"seq":' . $db->result['seq'] . ',"mode": "down"}';
                if ($db->result['type'] == "picture") {
                    $file = "<a target='_blank' href='../images/products/product-detail/" . $db->result['p_id'] . "/" . $db->result['p_img'] . "'>
											<img src='../images/products/product-detail/" . $db->result['p_id'] . "/" . $db->result['p_img'] . "' style='width:50px;height:35px;' />
										</a>";

                    if ($db->result['p_img_show']) {
                        $file2 = "<a target='_blank' href='../images/products/product-detail/" . $db->result['p_id'] . "/collect/" . $db->result['p_img_show'] . "'>
											<img src='../images/products/product-detail/" . $db->result['p_id'] . "/collect/" . $db->result['p_img_show'] . "' style='width:50px;height:35px;' />
										</a>";
                    } else {
                        $file2 = "";
                    }


                } else {

                }
                $content_data .= "<tr id='item_" . $i . "'>
								<td style='text-align:center;'>" . $db->result['seq'] . "</td>
									<td  style='text-align:center;'>" . $db->result['type'] . "</td>
								<td style='padding:5px;'>" . $file . "</td>
								<td style='padding:5px;'>" . $file2 . "</td>


								<td style='text-align:center;'>
								    <img id='deleteItem" . $db->result['p_id'] . "' src='images/delete.gif' style='width:16px;height:16px;cursor:pointer;' onclick='deleteItem(\"" . $db->result['p_id'] . "\" , \"" . $db->result['p_img'] . "\")' title='ลบ' />
								</td>
								<td style='text-align:center;'>
									<img id='upItem" . $db->result['p_id'] . "' src='images/arrow-up2.png' style='width:16px;height:16px;cursor:pointer;' onclick='processMoveRow(\"" . $db->result['p_id'] . "\" , \"" . $db->result['seq'] . "\", \"" . 'up' . "\" , \"" . $db->result['p_img'] . "\" , \"" . 'item' . "\")' title='ขึ้น' />
								</td>
								<td style='text-align:center;'>
									<img id='downItem" . $db->result['p_id'] . "' src='images/arrow-down1.png' style='width:16px;height:16px;cursor:pointer;' onclick='processMoveRow(\"" . $db->result['p_id'] . "\" , \"" . $db->result['seq'] . "\", \"" . 'down' . "\" , \"" . $db->result['p_img'] . "\" , \"" . 'item' . "\")' title='ลง'  />
								</td>
							</tr>";
            }

            if ($i == 0) {
                $content_data .= "<tr><td colspan=5 style='text-align:center;'>No Data</td></tr>";
            }
//            <option value='video'>Video</option>

            $content_data .= "<tr>
						<td style='text-align:center;'>auto</td>
						<td style='text-align:center;'>
								<select id='add_type' name='add_type' style='padding:1px;'
											onchange=\"if(this.value == 'picture'){ $('#add_image_pane').show(); $('#add_video_pane').hide(); } else { $('#add_image_pane').hide(); $('#add_video_pane').show();  }\">
									<option value='picture' selected>Picture</option>
								</select>
						</td>
						<td>
								<div id='add_image_pane'>
									<form name='manage_form' id='manage_form' method='POST' >
										<div id='fileUploadDiv'>
											<input id='Filedata' name='Filedata' type='file' class='fileUpload' size='30' multiple>
											<input type='hidden' id='p_id' name='p_id' value='' />
											<input type='hidden' id='order_num2' name='order_num' value='' />
											<input type='hidden' id='add_type' name='add_type' value='' />
											<input type='hidden' id='timestamp' name='timestamp' value='' />
											<input type='hidden' id='token' name='token' value='' />
										</div>
										<input type='hidden' id='fileUploaded' name='fileUploaded' />
										<div class='upload_progress'>
											<div class='upload_bar'></div>
											<div class='upload_percent'>0%</div>
										</div>
									</form>
								</div>
								<div id='add_video_pane' style='display:none;'>
									<input id='add_video' name='add_video' type='text' style='width:80%;float:left;' placeholder='Please input vimeo link' >
									<input type='button' name='buttonAddItem' id='buttonAddItem' value='Add' onclick='addItem();'  style='float:left'>
								</div>
						</td>
						<td style='text-align:center;' colspan='3'>

						</td>

				</tr>";
            $content_data .= "<tr>
                                <td style='text-align:center;color: red' colspan='6'>
                                        Click Chose Files Button to Upload This Product Gallery Picture
                                </td>
                             </tr>";
            $content_data .= "</tbody>";

            $data = array();
            $data['data_count'] = $data_count;
            $data['content_data'] = $content_data;

            $result['message'] = $data;
        } else if ($_POST["cmd"] == "addItem") {

            if ($_POST['order_num'] == "") {
                throw new Exception('Please specify order number');
            }

            $sql = "insert into sto_product_collection (p_id, type ,p_img, seq)
							values ('" . $_POST['p_id'] . "','video','" . $_POST['p_img'] . "', '" . $_POST['seq'] . "'); ";
            if (!$db->executeNonQuery($sql)) {
                throw new Exception("Operation Error");
            }

        } else if ($_POST["cmd"] == "deleteDescrip") {

            $sql = "select * from sto_product_descrip_img where p_id  = '" . $_POST['p_id'] . "'";
            if (!$db->execute($sql)) {
                throw new Exception("Operation Error");
            }

            if ($db->read()) {
                $targetFile = "../images/products/product-description/" . $_POST['p_id'] . "/" . $_POST['p_img'];
                $sql = "delete from sto_product_descrip_img where p_id  = '" . $_POST['p_id'] . "' and p_img = '" . $_POST['p_img'] . "'";
                if (!$db->executeNonQuery($sql)) {
                    throw new Exception("Operation Error");
                }
                if (file_exists($targetFile)) {
                    unlink($targetFile);
                }
            }

        } else if ($_POST["cmd"] == "deleteItem") {

            $sql = "select * from sto_product_collection where p_id  = '" . $_POST['p_id'] . "'";
            if (!$db->execute($sql)) {
                throw new Exception("Operation Error");
            }

            if ($db->read()) {
                $targetFile = "../images/products/product-detail/" . $_POST['p_id'] . "/" . $_POST['p_img'];
                $sql = "delete from sto_product_collection where p_id  = '" . $_POST['p_id'] . "' and p_img = '" . $_POST['p_img'] . "'";
                if (!$db->executeNonQuery($sql)) {
                    throw new Exception("Operation Error");
                }
                if (file_exists($targetFile)) {
                    unlink($targetFile);
                }
            }

        } else if ($_POST["cmd"] == "deleteGall") {

//            $sql = "select * from sto_product_collection where collect_id  = '" . $_POST['p_id'] . "'";
//            if (!$db->execute($sql)) {
//                throw new Exception("Operation Error");
//            }
            
                $targetFile = "../images/products/product-detail/" . $_POST['p_id'] . "/collect/" . $_POST['p_img_show'];


                $query = "update sto_product_collection set p_img_show = NULL where collect_id='" . $_POST['collect_id'] . "' ";
                $exec = mysql_db_query($DB_NAME, $query);

                if (file_exists($targetFile)) {
                    unlink($targetFile);
                }




        } else if ($_POST["cmd"] == "moveRow") {
//            $data   =   $_POST['p_id'];
//            $data   =    json_decode("$data",true);
            if ($_POST['p_id'] == "" && $_POST['seq'] == "" && $_POST['mode'] == "" && $_POST['p_img'] == "" && $_POST['type'] == "") {
                throw new Exception("Id not found");
            }
            $s_seq = 0;

            if ($_POST["mode"] == "up" && $_POST["type"] == "item") {
//                $sql = "select max(seq) from sto_product_collection) where p_id =" .$_POST['p_id'];
                $sql = "select * from sto_product_collection where seq = (select min(seq) from sto_product_collection where seq > " . $_POST["seq"] . ") and p_id = '" . $_POST['p_id'] . "'";
                $msgerror = "On Top Now!!";
            } else if ($_POST["mode"] == "down" && $_POST["type"] == "item") {
//                $sql = "select min(seq) from sto_product_collection where p_id=" . $_POST['p_id'];
                $sql = "select * from sto_product_collection where seq = (select max(seq) from sto_product_collection where seq < " . $_POST["seq"] . ") and p_id = '" . $_POST['p_id'] . "'";
                $msgerror = "On Bottom Now!!";
            } else if ($_POST["mode"] == "up" && $_POST["type"] == "descrip") {
                $sql = "select * from sto_product_descrip_img where seq = (select min(seq) from sto_product_descrip_img where seq > " . $_POST["seq"] . ") and p_id = '" . $_POST['p_id'] . "'";
                $msgerror = "On Top Now!!";
            } else if ($_POST["mode"] == "down" && $_POST["type"] == "descrip") {
                $sql = "select * from sto_product_descrip_img where seq = (select max(seq) from sto_product_descrip_img where seq < " . $_POST["seq"] . ") and p_id = '" . $_POST['p_id'] . "'";
                $msgerror = "On Bottom Now!!";
            }

            if (!$db->execute($sql))
                throw new Exception("execute Error");
            if (!$db->read())
                throw new Exception($msgerror);

            $p_id = $db->result['p_id'];
            $s_seq = $db->result['seq'];
            $s_pig = $db->result['p_img'];

            if ($p_id <> "" && $_POST['type'] == "item") {

                $sql = "update sto_product_collection set seq = '" . $s_seq . "' where p_id = '" . $_POST['p_id'] . "' and p_img = '" . $_POST['p_img'] . "';";
                if (!$db->execute($sql))
                    throw new Exception("1 Error");

                $sql = "update sto_product_collection set seq = '" . $_POST['seq'] . "' where p_id = '" . $p_id . "' and p_img = '" . $s_pig . "';";
                if (!$db->execute($sql))
                    throw new Exception("2 Error");


            } else if ($p_id <> "" && $_POST['type'] == "descrip") {

                $sql = "update sto_product_descrip_img set seq = '" . $s_seq . "' where p_id = '" . $_POST['p_id'] . "' and p_img = '" . $_POST['p_img'] . "';";
                if (!$db->execute($sql))
                    throw new Exception("3 Error");

                $sql = "update sto_product_descrip_img set seq = '" . $_POST['seq'] . "' where p_id = '" . $p_id . "' and p_img = '" . $s_pig . "';";
                if (!$db->execute($sql))
                    throw new Exception("4 Error");


            } else {
                throw new Exception("id null");
            }

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

    function processMoveRow(p_id, seq, mode, p_img, type) {
        var ajax = new SmartAjax('POST', '<?=$detail_page?>', 'p_id=' + p_id + '&seq=' + seq + '&mode=' + mode + '&p_img=' + p_img + '&type=' + type);
        ajax.requestJSON("moveRow",
            function (response) {
                var status = response.msgStatus;
                var type = response.type;
                var msg = response.message;
                if (status == "ok" && type == "item") {
                    loadItem();
                } else if (status == "ok" && type == "descrip") {
                    loadDescripImg();
                } else {
                    alert(msg);
                }
            }
        );

    }

    function loadDescripImg() {
        var ajax = new SmartAjax('POST', '<?=$detail_page?>', "id=<?=$id?>");
        ajax.requestJSON("loadDescripImg",
            function (response) {
                var status = response.msgStatus;
                var msg = response.message;
                if (status == "ok") {
                    $('#descripSpan').html(msg.content_data);
                    $('#descripSpan').trigger("create");
                    //################################################## FOR UPLOAD
                    var fileuploadReset = $("#fileUploadDiv").html();
                    $('#manage_form2').ajaxForm({
                        beforeSend: function () {
                            $('#Filedata2').attr("disabled", "disabled");
                            $('#manage_form2 .upload_progress').show();
                            $('#manage_form2 .upload_bar').width('0%');
                            $('#manage_form2 .upload_percent').html('0%');
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $('#manage_form2 .upload_bar').width(percentComplete + "%");
                            $('#manage_form2 .upload_percent').html("กำลังอัพโหลดไฟล์ ความคืบหน้า " + percentComplete + "%");
                        },
                        success: function () {
                            $('#manage_form2 .upload_bar').width('100%');
                            $('#manage_form2 .upload_percent').html('100%');
                        },
                        complete: function (xhr) {
                            $('#manage_form2 .upload_progress').hide();
                            $('#Filedata2').removeAttr("disabled");

                            if (xhr.status == 200) {
                                var result = JSON.parse(xhr.responseText);
                                if (result.what == "ok") {
                                    loadDescripImg();
                                } else {
                                    alert(result.result_text);
                                    loadDescripImg();
                                }
                            } else {
                                alert("ไม่สามารถอัพโหลดไฟล์นี้ได้");
                            }

                        }
                    });
                    $("#fileUploadDiv2 .fileUpload").on("change", function () {

                        startDesUpload();
                    });
                } else {
                    $('#descripSpan').html(msg);
                }
            }
        );
    }

    function loadItem() {
        var ajax = new SmartAjax('POST', '<?=$detail_page?>', "id=<?=$id?>");
        ajax.requestJSON("loadItem",
            function (response) {
                var status = response.msgStatus;
                var msg = response.message;
                if (status == "ok") {
                    $('#dataSpan').html(msg.content_data);
                    $('#dataSpan').trigger("create");
                    //################################################## FOR UPLOAD
                    var fileuploadReset = $("#fileUploadDiv").html();
                    $('#manage_form').ajaxForm({
                        beforeSend: function () {
                            $('#Filedata').attr("disabled", "disabled");
                            $('#manage_form .upload_progress').show();
                            $('#manage_form .upload_bar').width('0%');
                            $('#manage_form .upload_percent').html('0%');
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $('#manage_form .upload_bar').width(percentComplete + "%");
                            $('#manage_form .upload_percent').html("กำลังอัพโหลดไฟล์ ความคืบหน้า " + percentComplete + "%");
                        },
                        success: function () {
                            $('#manage_form .upload_bar').width('100%');
                            $('#manage_form .upload_percent').html('100%');
                        },
                        complete: function (xhr) {
                            $('#manage_form .upload_progress').hide();
                            $('#Filedata').removeAttr("disabled");

                            if (xhr.status == 200) {
                                var result = JSON.parse(xhr.responseText);
                                if (result.what == "ok") {
                                    loadItem();
                                } else {
                                    alert(result.result_text);
                                    loadItem();
                                }
                            } else {
                                alert("ไม่สามารถอัพโหลดไฟล์นี้ได้");
                            }

                        }
                    });
                    $("#fileUploadDiv .fileUpload").on("change", function () {
                        startUpload();
                    });

                    /*$('#manage_form3').ajaxForm({
                        beforeSend: function () {
                            $('#Filedata3').attr("disabled", "disabled");
                            $('#manage_form3 .upload_progress').show();
                            $('#manage_form3 .upload_bar').width('0%');
                            $('#manage_form3 .upload_percent').html('0%');
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $('#manage_form3 .upload_bar').width(percentComplete + "%");
                            $('#manage_form3 .upload_percent').html("กำลังอัพโหลดไฟล์ ความคืบหน้า " + percentComplete + "%");
                        },
                        success: function () {
                            $('#manage_form3 .upload_bar').width('100%');
                            $('#manage_form3 .upload_percent').html('100%');
                        },
                        complete: function (xhr) {
                            $('#manage_form3 .upload_progress').hide();
                            $('#Filedata3').removeAttr("disabled");

                            if (xhr.status == 200) {
                                var result = JSON.parse(xhr.responseText);
                                if (result.what == "ok") {
                                    loadItem();
                                } else {
                                    alert(result.result_text);
                                    loadItem();
                                }
                            } else {
                                alert("ไม่สามารถอัพโหลดไฟล์นี้ได้");
                            }

                        }
                    });
                    $("#fileUploadDiv3 .fileUpload").on("change", function () {
                        startUpload2();
                    });*/


                } else {
                    $('#dataSpan').html(msg);
                }
            }
        );
    }

    function loadGall(){
        var ajax = new SmartAjax('POST', '<?=$detail_page?>', "id=<?=$id?>");
        ajax.requestJSON("loadGall",
            function (response) {
                var status = response.msgStatus;
                var msg = response.message;
                if (status == "ok") {
                    $('#gall_table').html(msg.content_data);
                    $('#gall_table').trigger("create");
                    //################################################## FOR UPLOAD
                    var fileuploadReset = $("#fileUploadDiv").html();
                    $('#manage_form3').ajaxForm({
                        beforeSend: function () {
                            $('#Filedata3').attr("disabled", "disabled");
                            $('#manage_form3 .upload_progress').show();
                            $('#manage_form3 .upload_bar').width('0%');
                            $('#manage_form3 .upload_percent').html('0%');
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $('#manage_form3 .upload_bar').width(percentComplete + "%");
                            $('#manage_form3 .upload_percent').html("กำลังอัพโหลดไฟล์ ความคืบหน้า " + percentComplete + "%");
                        },
                        success: function () {
                            $('#manage_form3 .upload_bar').width('100%');
                            $('#manage_form3 .upload_percent').html('100%');
                        },
                        complete: function (xhr) {
                            $('#manage_form3 .upload_progress').hide();
                            $('#Filedata3').removeAttr("disabled");

                            if (xhr.status == 200) {
                                var result = JSON.parse(xhr.responseText);
                                if (result.what == "ok") {
                                    loadGall();
                                    loadItem();
                                } else {
                                    alert(result.result_text);
                                    loadGall();
                                    loadItem();
                                }
                            } else {
                                alert("ไม่สามารถอัพโหลดไฟล์นี้ได้");
                            }

                        }
                    });
                    $("#fileUploadDiv3 .fileUpload").on("change", function () {
                        startUpload2();
                    });

                } else {
                    $('#gall_table').html(msg);
                }
            }
        );
    }

    function deleteItem(id, p_img) {
        $("#deleteItem" + id).attr('src', "images/loading1.gif");
        var ajax = new SmartAjax('POST', '<?=$detail_page?>', "p_id=<?=$id?>&p_img=" + p_img);
        ajax.requestJSON("deleteItem",
            function (response) {
                $("#deleteItem" + id).attr('src', "images/delete.gif");
                var status = response.msgStatus;
                var msg = response.message;
                if (status == "ok") {
                    loadItem();
                } else {
                    alert(msg);
                }
            }
        );
    }

    function deleteGall(id, p_img,collect_id) {
        $("#deleteGall" + id).attr('src', "images/loading1.gif");
        var ajax = new SmartAjax('POST', '<?=$detail_page?>', "p_id="+id+"&p_img_show=" + p_img + "&collect_id="+ collect_id );
        ajax.requestJSON("deleteGall",
            function (response) {
                $("#deleteGall" + id).attr('src', "images/delete.gif");
                var status = response.msgStatus;
                var msg = response.message;
                if (status == "ok") {
                    loadItem();
                    loadGall();
                } else {
                    alert(msg);
                }
            }
        );
    }


    function deleteDescrip(id, p_img) {
        $("#deleteDescrip" + id).attr('src', "images/loading1.gif");
        var ajax = new SmartAjax('POST', '<?=$detail_page?>', "p_id=<?=$id?>&p_img=" + p_img);
        ajax.requestJSON("deleteDescrip",
            function (response) {
                $("#deleteDescrip" + id).attr('src', "images/delete.gif");
                var status = response.msgStatus;
                var msg = response.message;
                if (status == "ok") {
                    loadDescripImg();
                } else {
                    alert(msg);
                }
            }
        );
    }

    function startUpload() {

        $("#manage_form input[name=p_id]").val('<?=$id?>');
//        $("#manage_form input[name=order_num]").val($("#order_num").val());
        $("#manage_form input[name=add_type]").val('picture');
        $("#manage_form input[name=timestamp]").val('<?=$timestamp?>');
        $("#manage_form input[name=token]").val('<?=md5('unique_salt' . $timestamp)?>');
        $("#manage_form").attr('action', 'uploadify.php');
        $("#manage_form").submit();
    }


    function startUpload2() {
        var link_id = $('#link').val()
        $("#manage_form3 input[name=collect]").val(link_id);
        $("#manage_form3 input[name=p_id]").val('<?=$id?>');
        $("#manage_form3 input[name=add_type]").val('picture');
        $("#manage_form3 input[name=timestamp]").val('<?=$timestamp?>');
        $("#manage_form3 input[name=token]").val('<?=md5('unique_salt' . $timestamp)?>');
        $("#manage_form3").attr('action', 'uploadcollect.php');
        $("#manage_form3").submit();
    }

    function startDesUpload() {


        $("#manage_form2 input[name=p_id]").val('<?=$id?>');
//        $("#manage_form input[name=order_num]").val($("#order_num").val());
        $("#manage_form2 input[name=add_type]").val('picture');
        $("#manage_form2 input[name=timestamp]").val('<?=$timestamp?>');
        $("#manage_form2 input[name=token]").val('<?=md5('unique_salt' . $timestamp)?>');
        $("#manage_form2").attr('action', 'uploaddesImg.php');
        $("#manage_form2").submit();
    }

    function loadData(id) {

        var ajax = new SmartAjax('POST', '<?=$detail_page?>', 'id=' + id);
        ajax.requestJSON("loadData",
            function (response) {

                var status = response.msgStatus;
                var msg = response.message;

                if (status == "ok") {
                    $('#p_name').val(msg.p_name);
                    $('#p_description').val(msg.p_description);
                    $('#p_information').val(msg.p_information);
                    $('#p_material').val(msg.p_material);
                    $('#p_cate_id').val(msg.p_cate_id);
                    $('#p_pattern_id').val(msg.p_pattern_id);
                    $('#p_price').val(msg.p_price);
                    $('#p_quantity').val(msg.p_quantity);
                    $('#p_code').val(msg.p_code);
                    $('#p_title').val(msg.p_title);
                    $('#proc_link1').val(msg.product_ref1);
                    $('#proc_link2').val(msg.product_ref2);
//                    $('#checkbox_data').html(msg.checkbox_data);
//                    $('#checkbox_data').trigger("create");

                    if (msg.p_thumb_image == "" | msg.p_thumb_image == null) {
                        $("#thumb_image_image").attr("src", "images/nopic.png");
                    } else {
                        $("#thumb_image_image").attr("src", msg.p_thumb_image);
                    }
                }
            }
        );
    }

    function saveData() {
        $('#description').html(encodeURI($('#description').val()));
        var ajax = new SmartAjax('POSTFORM', '<?=$detail_page?>', "info_form");
        ajax.requestJSON("saveData",
            function (response) {
                var status = response.msgStatus;
                var msg = response.message;
                if (status == "ok") {
                    alert("Save successful");
                    if ($("#mode").val() == "add") {
                        window.location = "<?=$detail_page . "?mode=edit&id="?>" + msg.save_id;
                    } else {
                        window.location = "<?=$list_page?>";
                    }
                } else {
                    alert(msg);
                }
            }
        );
    }


    $(document).ready(function () {
        $('#description').ckeditor();
        if ($('#mode').val() != "add") {
            loadData($('#id').val());
            loadItem();
            loadGall();
            loadDescripImg();

        } else {
            $("#thumb_image_image").attr("src", "images/nopic.png");
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
    <h1>Product Detail</h1>
    <div style=" width:98%;">
        <form id='info_form' name='info_form' method="post" enctype="multipart/form-data" action="upload_data.php">
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
                            <h4 class="" style="text-align: left">Product Name</h4>
                            <input maxlength="100" type="text" class="form-control"
                                   value=""
                                   id="p_name" name="p_name"
                                   placeholder="Name here ..." required/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Code</h4>
                            <input maxlength="100" type="text" class="form-control"
                                   value=""
                                   id="p_code" name="p_code"
                                   placeholder="Code here ..." required/>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Price</h4>
                            <input maxlength="100" type="number" class="form-control"
                                   value=""
                                   id="p_price" name="p_price"
                                   placeholder="Price here ..." required/>
                        </div>
                    </div>

                    <!--                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">-->
                    <!--                        <div class="form-group">-->
                    <!--                            <h4 class="" style="text-align: left">Product Quantity</h4>-->
                    <!--                            <input maxlength="100" type="number" class="form-control"-->
                    <!--                                   value=""-->
                    <!--                                   id="p_quantity" name="p_quantity"-->
                    <!--                                   placeholder="Quantity here ..." required/>-->
                    <!--                        </div>-->
                    <!--                    </div>-->

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Categories</h4>
                            <select class="form-control" id="p_cate_id" name="p_cate_id" required>
                                <option value="">Select Categories</option>
                                <option value="1">Home & Living</option>
                                <option value="2">Wear</option>
                                <option value="3">Fabric</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Pattern</h4>
                            <select class="form-control" id="p_pattern_id" name="p_pattern_id" required>
                                <option value="">Select Pattren</option>
                                <option value="1">Paint & Point</option>
                                <option value="2">Dash & Tear</option>
                                <option value="3">Brush & Brushing</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Title</h4>
                            <textarea class="form-control" placeholder="Title here ..."
                                      id="p_title" rows="3" maxlength="400"
                                      name="p_title"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Description</h4>
                            <textarea class="form-control" placeholder="Description here ..."
                                      id="p_description" rows="3" maxlength="400"
                                      name="p_description"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Information</h4>
                            <textarea class="form-control" placeholder="Information here ..."
                                      id="p_information" rows="2" maxlength="400"
                                      name="p_information"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Material & Care</h4>
                            <textarea class="form-control" placeholder="Material here ..."
                                      id="p_material" rows="3" maxlength="400"
                                      name="p_material"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Product Care Icon</h4>
                        </div>

                        <!--                        <div class="row" id="checkbox_data"></div>-->
                        <?php echo $checkbox_data ?>

                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Relative Item link</h4>
                            <input class="form-control" type="text" id="proc_link1" name="proc_link1" value=""
                                   placeholder="พิมพ์รหัสสินค้าเพื่อทำการลิ้งสินค้า"/>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Relative Item link</h4>
                            <input class="form-control" type="text" id="proc_link2" name="proc_link2" value=""
                                   placeholder="พิมพ์รหัสสินค้าเพื่อทำการลิ้งสินค้า"/>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <h4 class="" style="text-align: left">Thumbnail Image</h4>
                            <div id='thumbPhotos'>
                                <div class='photo_block'>
                                    <a href="<?= $data['p_thumb_image'] ?>" target='_blank'>
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
    <div style=" width:98% float:left; clear:both;<?= ($mode == "add" ? "display:none;" : "") ?>">
        <h1>Product Gallery</h1>
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
                padding: 2px;
            }
        </style>
        <table id='dataSpan' class='datatable' width="100%" border="0" cellspacing="1" cellpadding="0"
               style="margin-top:5px;">

        </table>
        <span class='comment' <?= $mode_edit_display ?> >Supported formats: Jpg, Png only, Size: Max 6 MB</span>
    </div>

    <br/>
    <div style=" width:98% float:left; clear:both;<?= ($mode == "add" ? "display:none;" : "") ?>">
        <h1>Gallery Thumbs</h1>
        <style>
            .gall_table {
                border-collapse: collapse;
            }

            .gall_table thead tr {
                background-color: #F7F8E0;
            }

            .gall_table thead td {
                font-weight: bold;
                text-align: center;
            }

            .gall_table td {
                text-align: left;
                border: 1px solid #E6E6E6;
                padding: 2px;
            }
        </style>
        <table id='gall_table' class='gall_table' width="100%" border="0" cellspacing="1" cellpadding="0"
               style="margin-top:5px;">

        </table>
        <span class='comment' <?= $mode_edit_display ?> >Supported formats: Jpg, Png only, Size: Max 6 MB, Width : 200px - Height : 200px</span>
    </div>

    <br/><br/><br/>
    <div style=" width:98% float:left; clear:both;<?= ($mode == "add" ? "display:none;" : "") ?>">
        <h1>Product Description Images</h1>
        <style>
            .descripSpan {
                border-collapse: collapse;
            }

            .descripSpan thead tr {
                background-color: #F7F8E0;
            }

            .descripSpan thead td {
                font-weight: bold;
                text-align: center;
            }

            .descripSpan td {
                text-align: left;
                border: 1px solid #E6E6E6;
                padding: 2px;
            }
        </style>
        <table id='descripSpan' class='descripSpan' width="100%" border="0" cellspacing="1" cellpadding="0"
               style="margin-top:5px;">

        </table>
        <span class='comment' <?= $mode_edit_display ?> >Supported formats: Jpg, Png only, Size: Max 6 MB</span>
    </div>
</div>

<iframe id="upload_file_target" name="upload_file_target" src="#"
        style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>

<script>
    var options = {

        url: function (phrase) {
            return "/store/admin/product_link.php";
        },

        getValue: function (element) {
            return element.p_code;
        },

        ajaxSettings: {
            dataType: "json",
            method: "POST",
            data: {
                dataType: "json"
            }
        },

        preparePostData: function (data) {
            data.phrase = $("#proc_link1").val();
            return data;
        },
        list: {
            maxNumberOfElements: 10,
            match: {
                enabled: true
            }
        },

        requestDelay: 400
    };

    $("#proc_link1").easyAutocomplete(options);

    var options2 = {

        url: function (phrase) {
            return "/store/admin/product_link.php";
        },

        getValue: function (element) {
            return element.p_code;
        },

        ajaxSettings: {
            dataType: "json",
            method: "POST",
            data: {
                dataType: "json"
            }
        },

        preparePostData: function (data) {
            data.phrase = $("#proc_link2").val();
            return data;
        },
        list: {
            maxNumberOfElements: 10,
            match: {
                enabled: true
            }
        },
        requestDelay: 400
    };

    $("#proc_link2").easyAutocomplete(options2);

</script>


<script type="text/javascript">
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.

    CKEDITOR.replace('p_information', {
//        filebrowserBrowseUrl : '/store/admin/library/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
//        filebrowserUploadUrl : 'library/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl: '/store/admin/library/responsive_filemanager/filemanager/dialog.php?type=1&editor=ckeditor&fldr='

    });


    //    initSample();


</script>
<?php include "footer.php" ?>

