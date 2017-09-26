<?php
	Class HTMLGenerator{
//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------
		private $html;
		
		function __construct() {
			
		}
	
//--------------------------------------------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------------------------------------------
		
		public static function pagingPane($search, $count, $per_page,$start_seq, $end_seq, $page, $page_count){
			return "<div class='topCenterPaging'  style='".($count > $per_page ? "" : "display:none;")."' >
				<table style='margin-top:-3px;'>
				<tr>
					<td class='navPaging'>
						<div class='ui-icon ui-icon-seek-first' style='float:left;' onclick='search(\"".$search."\",\"&page=1\");'></div>
					</td>
					<td class='navPaging'>
						<div class='ui-icon ui-icon-seek-prev' style='float:left;' onclick='search(\"".$search."\",\"&page=".($page == 1 ? 1 : $page - 1)."\");'>
					</td>
					<td>
						<span>".($start_seq+1)."-".($end_seq < $count ? $end_seq : $count )."</span>
					</td>
					<td class='navPaging'>
						<div class='ui-icon ui-icon-seek-next' style='float:left;' onclick='search(\"".$search."\",\"&page=".($page == $page_count ? $page_count : $page +1)."\");'>
					</td>
					<td class='navPaging'>
						<div class='ui-icon ui-icon-seek-end' style='float:left;' onclick='search(\"".$search."\",\"&page=".$page_count."\");'>
					</td>
				</tr>
				</table>
			</div>";
		} 

		public static function drawSelect($name,$mode,$style,$datalist,$value,$event=""){
			$html="";
			$html .= "<select name='$name' ";
			if ($mode == "view")
				$html .= " disabled=true ";
			if($style != "")
				$html .= " style= '$style' ";
			if($event != "")
				$html .= $event;
			$html .= ">";
			if ($value == "")
				$value = $data_list[0][0];
			
			
			foreach($datalist as $data){
				$html .= "<option value='$data[0]' ";
				if ($data[0] == $value)
					$html .= " selected = 'selected' ";
				$html .= " >$data[1]</option>";
			}
			$html .= "</select>";
			echo $html;
		}
		
		public static function selectList($value,$listvalue){
			if($value == $listvalue)
				return "selected = 'selected'";
			else
				return "";
		}

		public static function selectCheck($value,$listvalue){
			if($value == $listvalue)
				return " checked ";
			else
				return "";
		}

		public static function selectValue($value,$itemvalue){
			$items = explode("|",$itemvalue);
			$count = count($items);
			$i = 0;
			while ($i < $count){
				$str_item = explode(",",$items[$i]);
				if($value == $str_item[0]){
					return $str_item[1];
				}
				$i++;
			}
			return "";
		}
		
		public static function rgb2html($r, $g=-1, $b=-1){    
			if (is_array($r) && sizeof($r) == 3)        
				list($r, $g, $b) = $r;    
				$r = intval($r); 
				$g = intval($g);    
				$b = intval($b);    
				$r = dechex($r<0?0:($r>255?255:$r));    
				$g = dechex($g<0?0:($g>255?255:$g));    
				$b = dechex($b<0?0:($b>255?255:$b));    
				$color = (strlen($r) < 2?'0':'').$r;    
				$color .= (strlen($g) < 2?'0':'').$g;    
				$color .= (strlen($b) < 2?'0':'').$b;    
				return $color;
		}
		
		public static function left($str, $n){
			if ($n <= 0)
				return "";
			else if ($n > strlen($str))
				return $str;
			else
				return substr($str,0,$n);
		}
		
		public static function right($str, $n){
			if ($n <= 0)
				return "";
			else if ($n > strlen($str))
				return $str;
			else
				return substr($str,-$n,$n);
		}
	}

?>