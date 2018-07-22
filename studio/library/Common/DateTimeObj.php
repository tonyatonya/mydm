<?php
	Class DateTimeObj{
//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------
		public static function getServerTimeToClient(){
			// Get server date
			$mydate = date("U");
			// Get Timezone offset
			$myoffs = date("Z") - $myServerOffset;
			// Adjust offsets for local machine
			print "<script language='JavaScript'>";
			print "var tzoffset = $myoffs + (new Date().getTimezoneOffset()*60);";
			// Set JavaScript variable to your server time as seen from client machine's location.
			print "var servertimeOBJ=new Date(($mydate+tzoffset)*1000);";
			print "</script>";
		}
//--------------------------------------------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------------------------------------------		
		public static function DatetoDatabase($date){
			if($date == "")
				return "";
			else if(gettype($date) == "boolean")
				return false;
			else if(gettype($date) == "integer")
				$strdate = $date;
			else if(($strdate = DateTimeObj::getDateValue($date)) === false)
				return false;
			return date("Y-m-d H:i:s",$strdate);
		}

		public static  function DatetoDisplay($date,$format = "Date"){
			if($date == "")
				return "";
			else if(gettype($date) == "boolean")
				return false;
			else if(gettype($date) == "integer")
				$strdate = $date;
			else if(($strdate = DateTimeObj::getDateValue($date)) === false)
				return false;
			
			if($format == "Date")	//Example : 15/01/2012
				return date("d/m/Y",$strdate );
			else if($format == "DateThai"){	//Example : 15/01/2555
				$tmpdate = getdate($strdate);
				return date("d/m/",$strdate ).($tmpdate[year]+543);
			}else if($format == "DateTime")	//Example : 15/01/2012 17:30:45
				return date("d/m/Y H:i:s",$strdate );
			else if($format == "EngDate")	//Example : January 15, 2012
				return date("F j, Y",$strdate );
			else if($format == "EngDateTime")	//Example : January 15, 2012 17:30:45
				return date("F j, Y H:i:s",$strdate );
			else if($format == "ShortEngDate")	//Example : Jan 15, 2012
				return date("M j, Y H:i:s",$strdate );
			else if($format == "ShortEngDateTime")	//Example : Jan 15, 2012 17:30:45
				return date("M j, Y H:i:s",$strdate );
			else if($format == "ShortEngDate2")	//Example : 1-Jan-12
				return date("j-M-y",$strdate );
			elseif($format == "FullEngDateTime")	//Example : Monday 19th of March 2012 02:58:39 PM
				return date("l jS \of F Y h:i:s A",$strdate );
			else if($format == "ThaiDate"){	//Example : 1 มีนาคม 2555
				$thaiMonth= Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
				$tmpdate = getdate($strdate);
				return $tmpdate[mday]." ".$thaiMonth[$tmpdate[mon]]." ".($tmpdate[year]+543);
			}else if($format == "ShortThaiDate"){	//Example : 1 มี.ค. 2555
				$shortThaiMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				$tmpdate = getdate($strdate);
				return $tmpdate[mday]." ".$shortThaiMonth[$tmpdate[mon]]." ".($tmpdate[year]+543);
			}else if($format == "ShortThaiDate2"){	//Example : 1 มี.ค. 55
				$shortThaiMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				$tmpdate = getdate($strdate);
				return $tmpdate[mday]." ".$shortThaiMonth[$tmpdate[mon]]." ".substr(($tmpdate[year]+543),-2);
			}else if($format == "ShortThaiDateTime"){	//Example : 1 มี.ค. 2555 12:12:10
				$shortThaiMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				$tmpdate = getdate($strdate);
				return $tmpdate[mday]." ".$shortThaiMonth[$tmpdate[mon]]." ".($tmpdate[year]+543). " ".date("H:i:s",$strdate );
			}else if($format == "ShortThaiDateTime2"){	//Example : 1 มี.ค. 55
				$shortThaiMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				$tmpdate = getdate($strdate);
				return $tmpdate[mday]." ".$shortThaiMonth[$tmpdate[mon]]." ".substr(($tmpdate[year]+543),-2)." ".date("H:i:s",$strdate );
			}else
				return date($format,$strdate);
		}
		
		public static function getDateValue($pdate){
			$hours = "00"; $minutes= "00"; $seconds = "00";
			// DD/MM/YYYY,DD/MM/YY (HH:MM:SS)
			// for 2 digits year(YY) must less than 38 (<=2037) or greater than 69 (>=1970)
			// for 4 digits year(YYYY) must less than 2038(<=2037) or greater than 1901 (>=1902)
			if(substr($pdate,2,1) == "/" and substr($pdate,5,1) == "/" ){
				$strdate = explode(" ",$pdate);
				$day = substr($strdate[0],0,2);
				$month = substr($strdate[0],3,2);
				$year = substr($strdate[0],6,4);
				if(count($strdate) == 2 and substr($strdate[1],2,1)== ":" and substr($strdate[1],5,1) == ":"){
					$hours = substr($strdate[1],0,2);
					$minutes = substr($strdate[1],3,2);
					$seconds = substr($strdate[1],6,2);
				}
				if($year + 0 > 2400)
					$year = $year - 543;
				if(!checkdate ($month+0,$day+0, $year+0))
					return false;
				$timestamp = strtotime($year."-".$month."-".$day." ".$hours.":".$minutes.":".$seconds);
			// YYYY-MM-DD (HH:MM:SS)
			// for 4 digits year(YYYY) must less than 2038(<=2037) or greater than 1901 (>=1902)
			}else if(substr($pdate,4,1) == "-" and substr($pdate,7,1) == "-" ){
				$strdate = explode(" ",$pdate);
				$day = substr($strdate[0],8,2);
				$month = substr($strdate[0],5,2);
				$year = substr($strdate[0],0,4);
				if(count($strdate) == 2 and substr($strdate[1],2,1)== ":" and substr($strdate[1],5,1) == ":"){
					$hours = substr($strdate[1],0,2);
					$minutes = substr($strdate[1],3,2);
					$seconds = substr($strdate[1],6,2);
				}
				if($year + 0 > 2400)
					$year = $year - 543;
				if(!checkdate ($month+0,$day+0, $year+0))
					return false;
				$timestamp = strtotime($year."-".$month."-".$day." ".$hours.":".$minutes.":".$seconds);
			}else{
				$timestamp = strtotime($pdate);
			} 

			return $timestamp;
		} 
		
		public static function isValidDate($strdate){
			// previous to PHP 5.1.0 you would compare with -1, instead of false
			if (DateTimeObj::getDateValue($strdate) === false) 
				return false;
			else
				return true;
		}

		public static function getCurrentDate($formatdate="Date"){
			return DateTimeObj::DatetoDisplay(date("Y-m-d H:i:s"),$formatdate);
		}
		
		public static function DateAdd($interval,$num,$basedate,$format="Date") {
			// Interval : year,month,day,hours,minutes,seconds
			return DateTimeObj::DatetoDisplay(strtotime(DateTimeObj::DatetoDatabase($basedate).$num. " ".$interval),$format);
		}
		
		public static function DateDiff($interval,$strDateTime1,$strDateTime2){
			$strdate = DateTimeObj::getDateValue($strDateTime2) - DateTimeObj::getDateValue($strDateTime1);
			if($interval == "seconds" or $interval == "second")
				return $strdate;
			else if($interval == "minutes" or $interval == "minute")
				return floor($strdate/60);
			else if($interval == "hours" or $interval == "hour")
				return floor($strdate/(60*60));
			else if($interval == "days" or $interval == "day")
				return floor($strdate/(60*60*24));
		}
		
		public static function getThaiMonth($strdate){
			$strMonth= date("n",strtotime($strdate));
			$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			$strMonthThai=$strMonthCut[$strMonth];
			return $strMonthThai; 
		}
/*
		public static function getShortThaiMonth($strdate){
			$strMonth= date("n",strtotime($strdate));
			$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			$strMonthThai=$strMonthCut[$strMonth];
			return $strMonthThai; 
		}

		public static function getShortEngMonth($strdate){
			$strMonth= date("n",strtotime($strdate));
			$strMonthCut = Array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
			$strMonthThai=$strMonthCut[$strMonth];
			return $strMonthThai; 
		}

		public static function getEngMonth($strdate){
			$strMonth= date("n",strtotime($strdate));
			$strMonthCut = Array("","January","Febuary","March","April","May","June","July","August","September","October","November","December");
			$strMonthThai=$strMonthCut[$strMonth];
			return $strMonthThai; 
		}

		public static function getThaiMonth($strdate){
			$strMonth= date("n",strtotime($strdate));
			$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			$strMonthThai=$strMonthCut[$strMonth];
			return $strMonthThai; 
		}

		public static function getThaiYear($strdate){
			$res_date = substr("00".date("Y",strtotime($strdate))+543,-2);
			return $res_date; 
		}

		public static function getYear($strdate){
			$res_date = substr("00".date("Y",strtotime($strdate)),-2);
			return $res_date; 
		}

		public static function getDay($strdate){
			$res_date = substr("00".date("j",strtotime($strdate)),-2);
			return $res_date; 
		}

		public static function getAddDate($basedate, $day) {
			return date("Y-m-d", strtotime($basedate . "+" . $day . " day"));
		}
	*/
	}
?>