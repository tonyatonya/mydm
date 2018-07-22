<?php
	Class Encryption{
//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------------------------------------------
	public static function utf8_to_tis620($string){
		$str = $string;
		$res = "";
		for ($i = 0; $i < strlen($str); $i++) {
		  if (ord($str[$i]) == 224) {
			$unicode = ord($str[$i+2]) & 0x3F;
			$unicode |= (ord($str[$i+1]) & 0x3F) << 6;
			$unicode |= (ord($str[$i]) & 0x0F) << 12;
			$res .= chr($unicode-0x0E00+0xA0);
			$i += 2;
		  } else {
			$res .= $str[$i];
		  }
		}
		return $res;
	}

	public static function decodeHex($encoded){
		return PREG_REPLACE("'([\S,\d]{2})'e","chr(hexdec('\\1'))",$encoded);
	}

	public static function encodeHex($text){
		return PREG_REPLACE("'(.)'e","dechex(ord('\\1'))",$text);
	}
	
	public static function random_gen($length){
		$random= "";
		srand((double)microtime()*1000000);
		$char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$char_list .= "abcdefghijklmnopqrstuvwxyz";
		$char_list .= "1234567890";
		// Add the special characters to $char_list if needed

		for($i = 0; $i < $length; $i++)
		{ 
		$random .= substr($char_list,(rand()%(strlen($char_list))), 1);
		}
		return $random;
	}
	
	public static function SQLInjection($param){
		foreach($param as $i => $data){
			if(is_array($param[$i])){
				$param[$i] = Encryption::SQLInjection($param[$i]);
			}else{
				$param[$i] = str_replace("'","^",$param[$i]);
			}
		}
		return $param;
	}
	
	public static function convertNumberToReadable($number){
		$txtnum1 = 
		array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
		$txtnum2 = 
		array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
		$number = str_replace(",","",$number);
		$number = str_replace(" ","",$number);
		$number = str_replace("บาท","",$number);
		$number = explode(".",$number);
		if(sizeof($number)>2){
		return 'ทศนิยมหลายตัวนะจ๊ะ';
		exit;
		}
		$strlen = strlen($number[0]);
		$convert = '';
		for($i=0;$i<$strlen;$i++){
		$n = substr($number[0], $i,1);
		if($n!=0){
		if($i==($strlen-1) AND $n==1){ $convert .= 
		'เอ็ด'; }
		elseif($i==($strlen-2) AND $n==2){ 
		$convert .= 'ยี่'; }
		elseif($i==($strlen-2) AND $n==1){ 
		$convert .= ''; }
		else{ $convert .= $txtnum1[$n]; }
		$convert .= $txtnum2[$strlen-$i-1];
		}
		}
		$convert .= 'บาท';
		if($number[1]=='0' OR $number[1]=='00' OR 
		$number[1]==''){
		$convert .= 'ถ้วน';
		}else{
		$strlen = strlen($number[1]);
		for($i=0;$i<$strlen;$i++){
		$n = substr($number[1], $i,1);
		if($n!=0){
		if($i==($strlen-1) AND $n==1){$convert 
		.= 'เอ็ด';}
		elseif($i==($strlen-2) AND 
		$n==2){$convert .= 'ยี่';}
		elseif($i==($strlen-2) AND 
		$n==1){$convert .= '';}
		else{ $convert .= $txtnum1[$n];}
		$convert .= $txtnum2[$strlen-$i-1];
		}
		}
		$convert .= 'สตางค์';
		}
		return $convert;
	}
	
}
?>