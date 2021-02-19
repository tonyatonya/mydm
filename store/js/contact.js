$(".send").click(function(){
	// check เงื่อนไขว่ากรอกครบแล้วด้วยค่อยแสดง
	// เมื่อปิดแล้วให้ Redirect กลับไปหน้า Home ตามชื่อปุ่ม
	$("#thx-complete").modal('show');
})
function refreshCaptcha() {
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
}

// Code for validating the form
// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
// for details
var frmvalidator = new Validator("form");
//remove the following two lines if you like error message box popups
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("name", "req", "Please provide your name");
frmvalidator.addValidation("email", "req", "Please provide your email");
frmvalidator.addValidation("email", "email", "Please enter a valid email address");
