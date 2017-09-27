function SmartAjax(method,url,parameters,processImage,dataImage) {
	this.method = method;	/*GET or POST or GETFORM or POSTFORM*/
	this.url = url;		/*URL*/
	this.parameters = parameters;				/* Parameter or Form name (In case of method = GETFORM,POSTFORM )*/
	this.addtional_param="";
	if(processImage)
		this.processAjaxHTML = processImage;
	else
		this.processAjaxHTML = "<img src='images/loading1.gif' />";
	if(dataImage)
		this.dataAjaxHTML = dataImage;
	else 
		this.dataAjaxHTML = "<img src='images/loading.gif' />";
	
	this.getAjax = function() {
		var HttPRequest = false;
		if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		} else if (window.ActiveXObject) { // IE
			 try {
				 HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					alert("This browser does not support XMLHttpRequest.");
				}
			 }
		}
		if (!HttPRequest) {
			alert('Cannot create XMLHTTP instance');
			return false;
		}
		return HttPRequest;
	};

	this.doGet = function(HttPRequest,url){
		if(HttPRequest != false){
			
			if(url.search(".php") + 4 == url.length)
				var conj = "?";
			else
				var conj = "&";
			url = url+conj+"randomtrick="+Math.random();

			HttPRequest.open('GET',url,true);
			HttPRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); //Header ตอนส่ง GET
			HttPRequest.send(null);
			
		}
		return HttPRequest;
	};

	this.doPost = function(HttPRequest,url,pmeters){
		if(pmeters)
			pmeters = pmeters+"&randomtrick="+Math.random();
			
		if(HttPRequest != false){
			HttPRequest.open('POST',url,true);
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
		}
		return HttPRequest;
	};
	
	this.getDOM = function(XMLstring){
		var xmlDoc;
		try /*Internet Explorer*/
		{
			xmlDoc=new ActiveXObject('Microsoft.XMLDOM');
			xmlDoc.async='false';
			xmlDoc.loadXML(XMLstring);
		}
		catch(e)
		{
			try /*Firefox, Mozilla, Opera, etc.*/
			{
				var parser=new DOMParser();
				xmlDoc=parser.parseFromString(XMLstring,'text/xml');
			}
			catch(e)
			{
				alert(e.message);
				return false;
			}
		}
		return xmlDoc;
	};
	
	this.getXMLData = function (xmlDoc,element){
		return xmlDoc.getElementsByTagName(element)[0].childNodes[0].nodeValue.replace('empty;','');
	};
	
	this.performAjax = function(processSpan,dataSpan,cfunc){		
		try {
			
			if(processSpan){
				var processSpanTmp = document.getElementById(processSpan).innerHTML;
				document.getElementById(processSpan).innerHTML = this.processAjaxHTML;
			}
			
			if(dataSpan){
				var dataSpanTmp = document.getElementById(dataSpan).innerHTML;
				document.getElementById(dataSpan).innerHTML = this.dataAjaxHTML;
			}

			if(this.method == 'GETFORM' || this.method == 'POSTFORM'){
				var elem = document.getElementById(this.parameters).elements;
				param = elem[0].name+"="+encodeURIComponent(elem[0].value);
				for(var i = 1; i < elem.length; i++){
					param = param + "&" + elem[i].name+"="+ encodeURIComponent(elem[i].value);
				} 
				param = param + this.addtional_param;
			}else{
				param = this.parameters;
			}

			HttPRequest = this.getAjax(); 
			if(HttPRequest != false)
				HttPRequest.onreadystatechange = function(){
				 if(HttPRequest.readyState == 4 && HttPRequest.status==200) {
					if(processSpan)
						document.getElementById(processSpan).innerHTML = processSpanTmp;
					if(dataSpan)
						document.getElementById(dataSpan).innerHTML = HttPRequest.responseText;
					var result = HttPRequest.responseText.split(String.fromCharCode(31));
					if(getType(cfunc) == "function")
						cfunc(result);
				 }
			}
			
			if(this.method == 'GET' || this.method == 'GETFORM'){
				this.doGet(HttPRequest,this.url+"?"+param);
			}else if(this.method == 'POST' || this.method == 'POSTFORM'){
				this.doPost(HttPRequest,this.url,param);
			}else
				 throw "Invalid method";
			
				
		}catch(err){
			alert("Error : " + err.message + "\n\n");
			if(processSpanTmp)
				document.getElementById(processSpan).innerHTML = processSpanTmp;
			if(dataSpanTmp)
				document.getElementById(dataSpan).innerHTML = dataSpanTmp;
		}
	};
	
	
	this.executeAjax =function(cmd,cfunc){
			
		if(this.method == 'GETFORM' || this.method == 'POSTFORM'){
			var param = "cmd="+cmd+"&";
			var elem = document.getElementById(this.parameters).elements;
			param = param + elem[0].name+"="+encodeURIComponent(elem[0].value);
			for(var i = 1; i < elem.length; i++){
				param = param + "&" + elem[i].name+"="+ encodeURIComponent(elem[i].value);
			} 
			param = param + this.addtional_param;
		}else{
			var param = "cmd="+cmd+"&"+this.parameters;
		}

		/*if(this.method == 'GETFORM' || this.method == 'POSTFORM'){
			var param = {cmd:cmd};
			var elem = document.getElementById(this.parameters).elements;
			for(var i = 0; i < elem.length; i++){
				param[elem[i].name] = elem[i].value;
			} 
		}else{
			var param = "cmd="+cmd+"&"+this.parameters;
		}*/
		
		if(this.method == 'GET' || this.method == 'GETFORM'){
			var methodtype = "get";
		}else if(this.method == 'POST' || this.method == 'POSTFORM'){
			var methodtype = "post";
		}
		
		this.request = $.ajax({
			url: this.url,
			type: methodtype,
			data:  param,
			dataType:"text",
			timeout:20000,
			error: function(xhr,state,exception) { 
					var result = Array();
					result[0] = "false";
					result[1] =  "พบปัญหาการเชื่อมต่อ กรุณาลองใหม่อีกครั้ง";
					//result[1] = "An error occured: " + xhr.status + " " + xhr.statusText;
					cfunc(result);
			}
		}).done(function(html) {
			var result = html.split(String.fromCharCode(31));
			if(getType(cfunc) == "function")
				cfunc(result);
		});
	};
	
	this.requestJSON =function(cmd,cfunc){
		
		if(this.method == 'GETFORM' || this.method == 'POSTFORM'){
			var param = "cmd="+cmd+"&";
			var elem = document.getElementById(this.parameters).elements;
			param = param + elem[0].name+"="+encodeURIComponent(elem[0].value);
			for(var i = 1; i < elem.length; i++){
				param = param + "&" + elem[i].name+"="+ encodeURIComponent(elem[i].value);
			} 
			param = param + this.addtional_param;
		}else{
			var param = "cmd="+cmd+"&"+this.parameters;
		}

		if(this.method == 'GET' || this.method == 'GETFORM'){
			var methodtype = "get";
		}else if(this.method == 'POST' || this.method == 'POSTFORM'){
			var methodtype = "post";
		}    

		$.ajax({
			type: methodtype,
            dataType: 'json',
			url: this.url,
			data: param,
			success: function (data) {
				if(getType(cfunc) == "function")
					cfunc(data);
			},
			error: function () {
				
			}
		});
	};
}
/*########################################################### Encoding ###########################################################*/
var Encoding = new function(){

	this.toHex = function toHex(n){
		var digitArray = new Array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
		var result = ''
		var start = true;
		for (var i=32; i>0;){
			i-=4;
			var digit = (n>>i) & 0xf;
			if (!start || digit != 0){
				start = false;
				result += digitArray[digit];
			}
		}
		return (result==''?'0':result);
	};

	this.pad = function (str, len, pads){
		var result = str;
		for (var i=str.length; i<len; i++){
			result = pads+ result;
		}
		return result;
	};

	this.ntos =function (n){
		n=n.toString(16);
		if (n.length == 1) n="0"+n;
		n="%"+n;
		return unescape(n);
	};

	this.encodeHex = function (str){
		var result = "";
		for (var i=0; i<str.length; i++){
			result += this.pad(this.toHex(str.charCodeAt(i)&0xff),2,'0');
		}
		return result;
	};

	this.decodeHex = function (str){
		var hexv = {
		  "00":0,"01":1,"02":2,"03":3,"04":4,"05":5,"06":6,"07":7,"08":8,"09":9,"0A":10,"0B":11,"0C":12,"0D":13,"0E":14,"0F":15,
		  "10":16,"11":17,"12":18,"13":19,"14":20,"15":21,"16":22,"17":23,"18":24,"19":25,"1A":26,"1B":27,"1C":28,"1D":29,"1E":30,"1F":31,
		  "20":32,"21":33,"22":34,"23":35,"24":36,"25":37,"26":38,"27":39,"28":40,"29":41,"2A":42,"2B":43,"2C":44,"2D":45,"2E":46,"2F":47,
		  "30":48,"31":49,"32":50,"33":51,"34":52,"35":53,"36":54,"37":55,"38":56,"39":57,"3A":58,"3B":59,"3C":60,"3D":61,"3E":62,"3F":63,
		  "40":64,"41":65,"42":66,"43":67,"44":68,"45":69,"46":70,"47":71,"48":72,"49":73,"4A":74,"4B":75,"4C":76,"4D":77,"4E":78,"4F":79,
		  "50":80,"51":81,"52":82,"53":83,"54":84,"55":85,"56":86,"57":87,"58":88,"59":89,"5A":90,"5B":91,"5C":92,"5D":93,"5E":94,"5F":95,
		  "60":96,"61":97,"62":98,"63":99,"64":100,"65":101,"66":102,"67":103,"68":104,"69":105,"6A":106,"6B":107,"6C":108,"6D":109,"6E":110,"6F":111,
		  "70":112,"71":113,"72":114,"73":115,"74":116,"75":117,"76":118,"77":119,"78":120,"79":121,"7A":122,"7B":123,"7C":124,"7D":125,"7E":126,"7F":127,
		  "80":128,"81":129,"82":130,"83":131,"84":132,"85":133,"86":134,"87":135,"88":136,"89":137,"8A":138,"8B":139,"8C":140,"8D":141,"8E":142,"8F":143,
		  "90":144,"91":145,"92":146,"93":147,"94":148,"95":149,"96":150,"97":151,"98":152,"99":153,"9A":154,"9B":155,"9C":156,"9D":157,"9E":158,"9F":159,
		  "A0":160,"A1":161,"A2":162,"A3":163,"A4":164,"A5":165,"A6":166,"A7":167,"A8":168,"A9":169,"AA":170,"AB":171,"AC":172,"AD":173,"AE":174,"AF":175,
		  "B0":176,"B1":177,"B2":178,"B3":179,"B4":180,"B5":181,"B6":182,"B7":183,"B8":184,"B9":185,"BA":186,"BB":187,"BC":188,"BD":189,"BE":190,"BF":191,
		  "C0":192,"C1":193,"C2":194,"C3":195,"C4":196,"C5":197,"C6":198,"C7":199,"C8":200,"C9":201,"CA":202,"CB":203,"CC":204,"CD":205,"CE":206,"CF":207,
		  "D0":208,"D1":209,"D2":210,"D3":211,"D4":212,"D5":213,"D6":214,"D7":215,"D8":216,"D9":217,"DA":218,"DB":219,"DC":220,"DD":221,"DE":222,"DF":223,
		  "E0":224,"E1":225,"E2":226,"E3":227,"E4":228,"E5":229,"E6":230,"E7":231,"E8":232,"E9":233,"EA":234,"EB":235,"EC":236,"ED":237,"EE":238,"EF":239,
		  "F0":240,"F1":241,"F2":242,"F3":243,"F4":244,"F5":245,"F6":246,"F7":247,"F8":248,"F9":249,"FA":250,"FB":251,"FC":252,"FD":253,"FE":254,"FF":255
		};
		str = str.toUpperCase().replace(new RegExp("s/[^0-9A-Z]//g"));
		var result = "";
		var nextchar = "";
		for (var i=0; i<str.length; i++){
			nextchar += str.charAt(i);
			if (nextchar.length == 2){
				result += this.ntos(hexv[nextchar]);
				nextchar = "";
			}
		}
		return result;
	};
}
/*########################################################### Date Time ###########################################################*/
var DateTimeObj = new function(){

	this.day_names = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	this.month_names = new Array("January","February","March", "April", "May","June","July","August","September","October","November","December");
	
	/* Check if valid date string (Static)*/
	this.isValidDate = function (strdate){
		if(this.getDateValue(strdate) === false)
			return false;
		else
			return true;
	};
	
	/* Get real datetime object  from string (Static)*/
	this.getDateValue = function (pdate){
	
		if(getType(pdate) == "date")
			return pdate;
		
		
		var format = "",isTimePresent = false;
		if(pdate.length == 10 && pdate.substr(2,1) == "/" && pdate.substr(5,1) == "/" )
			format = "DD/MM/YYYY";
		else if(pdate.length == 19 && pdate.substr(2,1) == "/" && pdate.substr(5,1) == "/" && pdate.substr(10,1) == " " && pdate.substr(13,1) == ":" && pdate.substr(16,1) == ":"){
			format = "DD/MM/YYYY HH:MM:SS";
			isTimePresent = true;
		}else if(pdate.length == 10 && pdate.substr(4,1) == "-" && pdate.substr(7,1) == "-")
			format = "YYYY-MM-DD";
		else if(pdate.length == 19 && pdate.substr(4,1) == "-" && pdate.substr(7,1) == "-" && pdate.substr(10,1) == " " && pdate.substr(13,1) == ":" && pdate.substr(16,1) == ":"){
			format = "YYYY-MM-DD HH:MM:SS";
			isTimePresent = true;
		}
		
		if(format == "") return false;
		var year=0,month=0,day=0,hour=0,minute=0,second=0;
		if(format.substr(0,10) == "YYYY-MM-DD"){
			year = parseInt(pdate.substr(0,4));
			month = parseInt(pdate.substr(5,2));
			day = parseInt(pdate.substr(8,2));
		}else if(format.substr(0,10)  == "DD/MM/YYYY"){
			year = parseInt(pdate.substr(6,4));
			month = parseInt(pdate.substr(3,2));
			day = parseInt(pdate.substr(0,2));
		}
		if(isTimePresent){
			hour = parseInt(pdate.substr(11,2));
			minute = parseInt(pdate.substr(14,2));
			second = parseInt(pdate.substr(17,2));
		}
		
		
		
		if(year < 1900 || year > 2400 || month < 1 || month > 12)
			return false;
		if(isTimePresent && (hour < 1 || hour > 23 || minute < 1 || minute > 59 || second < 1 || second > 59))
			return false;
		
		switch(month){
			case 1: case 3: case 5: case 7: case 8: case 10: case 12:
				if(day > 31 || day < 1) return false;
				break;
			case 2:
				if(day > 29 || day < 1) return false;
				if(year % 4 != 0 && day > 28) return false;
				break;
			case 4: case 6: case 9: case 11:
				if(day > 30 || day < 1) return false;
				break;
			default:
				return false;
		}
		
		if(isTimePresent)
			return new Date(year,month-1,day,hour,minute,second);
		else
			return new Date(year,month-1,day);
	};
	
	/* Get date string specific format (pass 2 parameters for Static) */
	this.formatDate = function (p1,pformat){
		/*try{*/
			var source = this.getDateValue(p1);
			
			if(source === false)
				throw "Invalid datetime value";
			if(!pformat) 
				pformat = "DBDate";

			if(pformat == "DBDate"){
				return dateFormat(source,"yyyy-mm-dd");
			}else if(pformat == "DBDateTime"){
				return dateFormat(source,"yyyy-mm-dd HH:MM:ss");
			}else if (pformat == "FullDateTime"){
			/*	return this.day_names[source.getDay()]+" "+this.month_names[source.getMonth()]+" "+source.getDate()+", "+source.getFullYear() + " " + 
			 	source.getHours()+":"+source.getMinutes()+":"+source.getSeconds();*/
				return dateFormat(source,"dddd mmmm d, yyyy");
			}else{
				return dateFormat(source,pformat);
			}
	/*	}catch(err){
			alert("DateTime object error (formatDate): "+err.message);
			return "";
		 }*/
	};
	
	this.formatLeadingZero = function (str, n){
		if (n <= 0)
			return "";
		else {
			var str_ = "";
			for(i=1;i<=n;i++){
				str_ += "0";
			}
			str = str_+str;
			return right(str,n);
		}
	};
	
	this.getCurrentDate = function (pformat){
		var date = new Date();
		return this.formatDate(date,pformat);
	};
	
	this.DateAdd = function (pdate,interval,num,pformat){
		var mydate = this.getDateValue(pdate);
		
		if(interval == "m" || interval == "month")
			mydate.setMonth(parseInt(mydate.getMonth())+num);
		else if(interval == "d" || interval == "day")
			mydate.setDate(parseInt(mydate.getDate())+num);
		else if(interval == "y" || interval == "year"){
			mydate.setYear(parseInt(mydate.getYear())+num);
		}else if(interval == "h" || interval == "hour")
			mydate.setHours(parseInt(mydate.getHours())+num);
		else if(interval == "M" || interval == "minute")
			mydate.setMinutes(parseInt(mydate.getMinutes())+num);
		else if(interval == "s" || interval == "second")
			mydate.setSeconds(parseInt(mydate.getSeconds())+num);
			
		return this.formatDate(mydate,pformat);
	};
	
	this.DateDiff =function (date1, date2, pformat) {
		var mydate1 = this.getDateValue(date1);
		var mydate2 = this.getDateValue(date2);
		var datediff = mydate1.getTime() - mydate2.getTime(); //store the getTime diff - or +
		if(!pformat)
			pformat = "day";
		var leap = Math.floor(datediff / (24*60*60*1000*1461));
		datediff = datediff-((24*60*60*1000)*leap);
		var days = Math.floor(datediff / (24*60*60*1000));
		var num_years = Math.floor(datediff/31536000000);
		var num_months = Math.floor((datediff % 31536000000)/2628000000);
		var num_days =Math.floor( ((datediff % 31536000000) % 2628000000)/86400000);
		if(pformat == "day")
			return days;
		else if(pformat == "year")
			return  num_years.toString() + String.fromCharCode(31)+ num_months.toString() + String.fromCharCode(31)+ num_days.toString() ;
	}
}

/*
 * Date Format 1.2.3
 * (c) 2007-2009 Steven Levithan <stevenlevithan.com>
 * MIT license
 *
 * Includes enhancements by Scott Trenda <scott.trenda.net>
 * and Kris Kowal <cixar.com/~kris.kowal/>
 *
 * Accepts a date, a mask, or a date and a mask.
 * Returns a formatted version of the given date.
 * The date defaults to the current date/time.
 * The mask defaults to dateFormat.masks.default.

d		Day of the month as digits; no leading zero for single-digit days.
dd		Day of the month as digits; leading zero for single-digit days.
ddd		Day of the week as a three-letter abbreviation.
dddd	Day of the week as its full name.
m		Month as digits; no leading zero for single-digit months.
mm		Month as digits; leading zero for single-digit months.
mmm	Month as a three-letter abbreviation.
mmmm	Month as its full name.
yy		Year as last two digits; leading zero for years less than 10.
yyyy		Year represented by four digits.
h		Hours; no leading zero for single-digit hours (12-hour clock).
hh		Hours; leading zero for single-digit hours (12-hour clock).
H		Hours; no leading zero for single-digit hours (24-hour clock).
HH		Hours; leading zero for single-digit hours (24-hour clock).
M		Minutes; no leading zero for single-digit minutes.
MM		Minutes; leading zero for single-digit minutes.
s		Seconds; no leading zero for single-digit seconds.
ss		Seconds; leading zero for single-digit seconds. l or L	Milliseconds. l gives 3 digits. L gives 2 digits.
t		Lowercase, single-character time marker string: a or p.
tt		Lowercase, two-character time marker string: am or pm.
T		Uppercase, single-character time marker string: A or P.
TT		Uppercase, two-character time marker string: AM or PM.
Z		US timezone abbreviation, e.g. EST or MDT. With non-US timezones or in the Opera browser, the GMT/UTC offset is returned, e.g. GMT-0500
o		GMT/UTC timezone offset, e.g. -0500 or +0230.
S		The date's ordinal suffix (st, nd, rd, or th). Works well with d.
'�' or "�"	Literal character sequence. Surrounding quotes are removed.
UTC:	Must be the first four characters of the mask. Converts the date from local time to UTC/GMT/Zulu time before applying the mask. The "UTC:" prefix is removed.

*/
var dateFormat = function () {
	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function (val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};

	/* Regexes and supporting functions are cached through closure*/
	return function (date, mask, utc) {
		var dF = dateFormat;

		/* You can't provide utc if you skip other args (use the "UTC:" mask prefix)*/
		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}

		/* Passing date through Date applies Date.parse, if necessary*/
		date = date ? new Date(date) : new Date;
		if (isNaN(date)) throw SyntaxError("invalid date");

		mask = String(dF.masks[mask] || mask || dF.masks["default"]);

		/* Allow setting the utc argument via the mask*/
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}

		var	_ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d:    d,
				dd:   pad(d),
				ddd:  dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m:    m + 1,
				mm:   pad(m + 1),
				mmm:  dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy:   String(y).slice(2),
				yyyy: y,
				h:    H % 12 || 12,
				hh:   pad(H % 12 || 12),
				H:    H,
				HH:   pad(H),
				M:    M,
				MM:   pad(M),
				s:    s,
				ss:   pad(s),
				l:    pad(L, 3),
				L:    pad(L > 99 ? Math.round(L / 10) : L),
				t:    H < 12 ? "a"  : "p",
				tt:   H < 12 ? "am" : "pm",
				T:    H < 12 ? "A"  : "P",
				TT:   H < 12 ? "AM" : "PM",
				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};

		return mask.replace(token, function ($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();

/* Some common format strings*/
dateFormat.masks = {
	"default":      "ddd mmm dd yyyy HH:MM:ss",
	shortDate:      "m/d/yy",
	mediumDate:     "mmm d, yyyy",
	longDate:       "mmmm d, yyyy",
	fullDate:       "dddd, mmmm d, yyyy",
	shortTime:      "h:MM TT",
	mediumTime:     "h:MM:ss TT",
	longTime:       "h:MM:ss TT Z",
	isoDate:        "yyyy-mm-dd",
	isoTime:        "HH:MM:ss",
	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

/* Internationalization strings*/
dateFormat.i18n = {
	dayNames: [
		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	],
	monthNames: [
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	]
};
/*########################################################### General Function ###########################################################*/
function getType(obj){
	if (obj === undefined) { return 'undefined'; }
	if (obj === null) { return 'null'; }
	return Object.prototype.toString.call(obj).split(' ').pop().split(']').shift().toLowerCase();
}
function left(str, n){
	if (n <= 0)
		return "";
	else if (n > String(str).length)
		return str;
	else
		return String(str).substring(0,n);
}
function right(str, n){
	if (n <= 0)
	   return "";
	else if (n > String(str).length)
	   return str;
	else {
	   var iLen = String(str).length;
	   return String(str).substring(iLen, iLen - n);
	}
}
function getElementFromID(id){
	var elem = document.getElementById(id).childNodes;
	var param = "";
	for(var i = 0; i < elem.length; i++){
		if ( elem[i].nodeType==1 && elem[i].name != "undefined" && elem[i].name != ""){
			if(param == "")
				param = elem[i].name+"="+ encodeURIComponent(elem[i].value);
			else
				param = param + "&" + elem[i].name+"="+ encodeURIComponent(elem[i].value);
		}
	} 
	return param;
}
function getElementFromObj(obj,param){
	var elem = obj.childNodes;
	for(var i = 0; i < elem.length; i++){
		if ( elem[i].nodeType==1 && elem[i].name !== undefined && elem[i].name != "" && (elem[i].childNodes.length == 0 || elem[i].nodeName == "SELECT") ){
			if(param == "")
				param = elem[i].name+"="+ encodeURIComponent(elem[i].value);
			else
				param = param + "&" + elem[i].name+"="+ encodeURIComponent(elem[i].value);
		}else if(elem[i].childNodes.length > 0){
			param = getElementFromObj(elem[i],param);
		}
	} 
	return param;
}
function DumpObject(obj)
{
  var od = new Object;
  var result = "";
  var len = 0;

  for (var property in obj)
  {
    var value = obj[property];
    if (typeof value == 'string')
      value = "'" + value + "'";
    else if (typeof value == 'object')
    {
      if (value instanceof Array)
      {
        value = "[ " + value + " ]";
      }
      else
      {
        var ood = DumpObject(value);
        value = "{ " + ood.dump + " }";
      }
    }
    result += "'" + property + "' : " + value + ", ";
    len++;
  }
  od.dump = result.replace(/, $/, "");
  od.len = len;

  return od;
}