var cart;
function makeSubmit() {

		event.preventDefault();
		$(this).attr('disabled', 'disabled');
		this.innerHTML = 'please wait...';


		var sumprice = removeCommas($('#totalvalue').html());
		var value =JSON.stringify(cart);

//        var encodedString = Base64.encode(value);
		window.location = 'library/paypal/SetExpressCheckout.php?id=1&name=MYDM.ME Products&price=' + sumprice+ '&qty=1&tax=0&cart='+value;

}


function setCookie(c_name, value, exdays) {
		var exdate = new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
		document.cookie = c_name + "=" + c_value + "; path=../";
}

function getCookie(c_name) {
		var c_value = document.cookie;
		var c_start = c_value.indexOf(" " + c_name + "=");
		if (c_start == -1) {
				c_start = c_value.indexOf(c_name + "=");
		}
		if (c_start == -1) {
				c_value = null;
		}
		else {
				c_start = c_value.indexOf("=", c_start) + 1;
				var c_end = c_value.indexOf(";", c_start);
				if (c_end == -1) {
						c_end = c_value.length;
				}
				c_value = unescape(c_value.substring(c_start, c_end));
		}
		return c_value;
}

function deleteCookie(name) {
		var value = "";
		var days = -1;
		if (days) {
				var date = new Date();
				date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
				var expires = "; expires=" + date.toGMTString();
		}
		else var expires = "";
		document.cookie = name + "=" + value + expires + "; path=/";

}

function addCommas(nStr) {
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
}
function removeCommas(nStr) {
		return nStr.replace(/,/g, "");
}
function formatNumber(value, dec) {
		return addCommas((parseFloat(removeCommas(value))).toFixed(dec));
}
function toStrNumber(value, dec) {
		return addCommas(value.toFixed(dec));
}
function toNumber(value) {
		if (value == "")
				return 0;
		else
				return parseFloat(removeCommas(value));
}

function writeCarts() {
		$("#totalcont").empty();
		$("#totalcont").html("<table class='totalunit'>" +
				"<tr>" +
				"	<th class='item'>Products</th>" +
				"    <th class='description'>Name</th> " +
				"    <th >Code</th> " +
				"    <th class='quantity'>Quantity</th> " +
				"    <th class='price'> Price  (baht)</th> " +
				"   <th class='total'>Total</th>" +
				"    <th class='remove'>remove</th>" +
				"</tr>" +
				"</table>");
		var total = 0;

		for (var i = 0; i < cart.length; i++) {
				$("#totalcont").append("<table id='totalunit" + i + "' class='totalunit'>" +
						"<tr>" +
						"	<td class='item'><img src='../images/products/product-thumbs/" + cart[i].image + "'></td>" +
						"    <td class='description'>" + cart[i].name + "</td> " +
						"    <td >" + cart[i].code + "</td> " +
						"    <td class='quantity'><input name='qty' type='text' size='3' value='" + toStrNumber(cart[i].qty, 0) + "' onchange='changeQty(" + i + ",this);' ></td> " +
						"   <td class='price'>" + toStrNumber(cart[i].price, 2) + "</td> " +
						"   <td class='total'>" + toStrNumber(cart[i].qty * cart[i].price) + "</td>" +
						"   <td class='remove'><img src='images/bullet-remove.gif' style='cursor:pointer;' onclick='removeItem(" + i + ")' ></td>  " +
						"</tr>" +
						"</table>");
				total += cart[i].qty * cart[i].price;
		}
		$("#totalcont").trigger('create');
		$("#totalvalue").html(toStrNumber(total, 2));
}

function changeQty(i, obj) {
		obj.value = formatNumber(obj.value, 0);
		if (obj.value === "NaN")
				obj.value = "";
		cart[i].qty = toNumber(obj.value);
		writeCarts();
		setCookie('shoppingCart', JSON.stringify(cart), 1);
}

function removeItem(i) {
		cart.splice(i, 1);
		writeCarts();
		setCookie('shoppingCart', JSON.stringify(cart), 1);

		writeCart();
}

$(document).ready(function () {

		var nice = $("html").niceScroll();  // The document page (body)

		var tmpval = getCookie("shoppingCart");
		if (tmpval != null && tmpval != "") {
				cart = JSON.parse(tmpval);
		} else {
				cart = [];
		}

		writeCarts();

});
$(document).ready(function () {

		var nice = $("html").niceScroll();  // The document page (body)

});
