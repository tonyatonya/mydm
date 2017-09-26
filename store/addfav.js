function addFav ( product_id )
{

    $.ajax({
        method: "POST",
        url: "/store/favorite.php",
        data: {
            p_id : product_id
        },
        success : function (data) {
            var msg = $.parseJSON(data);

            alert(msg.msg);



        }
    });


}