
var cart;
var products = [];
var index;
function addToCart(product){
    var exist = false;
    // for (var i = 0; i < cart.length; i++) {
    //
    //     if(cart[i].id == product.id)
    //     {
    //
    //         cart[i].qty += 1;
    //         exist = true;
    //     }
    // }
    if(exist == false)
    {
        cart.push(product);
    }

    writeCart();
    setCookie('shoppingCart',JSON.stringify(cart) ,1);
}

function writeCart(){
    $(".bagcount").html(cart.length);
    $(".inbag").html(cart.length);

    $('.cartunit').remove();
    if(cart.length > 0) {
        for (var i = 0; i < cart.length; i++) {

            $("#totalcart").append("<table id='cartunit" + i + "' class='cartunit'>" +
                "<tr>" +
                "	<td rowspan='5'><img src='/store/images/products/product-thumbs/" + cart[i].image + "' width='80px' height='64px'></td>" +
                "</tr><tr>   <td >" + cart[i].name + "</td> " +
                "</tr><tr>   <td >Item no : " + cart[i].code + "</td> " +
                "</tr><tr>   <td >Price : " + cart[i].price + "</td> " +
                "</tr><tr>   <td >Quantity : " + cart[i].qty + "</td> " +
                "</tr>" +
                "</table>");

        }

            $('#viewbag').show();

    }else if(cart.length == 0 ){
        $("#totalcart").append("<table id='cartunit" + i + "' class='cartunit'>" +
            "<tr>" +
            "	<td rowspan=''><p>  FULLFILL YOUR INSPIRATION.</p> </td>" +
            "</tr>" +

            "</table>");
    }

    $("#totalcart").trigger('create');
}

function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value + "; path=/store/";

}

function getCookie(c_name)
{
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1)
    {
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1)
    {
        c_value = null;
    }
    else
    {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1)
        {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
}

function deleteCookie(name) {
    var value = "";
    var days = -1;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/store/";

    $(".bagcount").html(cart.length);
    $(".inbag").html(cart.length);
}

$(document).ready(function() {


    var tmpval=getCookie("shoppingCart");
    if (tmpval!=null && tmpval!=""){
        cart = JSON.parse(tmpval) ;
    }else{
        cart = [];
    }

    writeCart();

    if(cart.length > 0){
        $('#viewbag').show();
    }


});



