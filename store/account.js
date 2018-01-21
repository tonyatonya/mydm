
$(function(){

    $.ajax({
        method: "POST",
        url: "myinfo.php",

        success : function (data) {
            var user = $.parseJSON(data);

            // alert(user.user.u_id);
            if(user.user != null ) {
                $('#myemail').html(user.user.u_email);
                $('#myaddress').html(user.user.u_country);
                if(user.order == null){

                    $('#myorder').html('-');

                }else{
                    $('#myorder').html(user.order);
                }

                $('#myfav').html(user.fav);

                $('#signin').hide();
                $('#member').show();
                $('#signout').show();
            }
        }
    });
    $('#signout').on('click',function() {
        if(confirm("Are you sure you want log out")){

            $.ajax({
                method: "POST",
                url: "logout.php",

                success : function (data) {
                    var msg = $.parseJSON(data);
                    location.reload();

                    // $('#myemail').html('-');
                    // $('#myaddress').html('-');
                    // $('#myorder').html('-');
                    // $('#myfav').html('-');
                    //
                    // $('#signin').show();
                    // $('#member').hide();
                    // $('#signout').hide();

                }
            });

        }else{



        }


    });
});
