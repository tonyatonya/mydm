$(document).ready(function() {

		var nice = $("html").niceScroll();  // The document page (body)


});

function keepdata() {

}

function searchProduct(cat_id) {
    var submit = 1;
    var price = $('#price').val();
    if(cat_id != null){
        var category = cat_id;
    }else{
        var category = '';
           category = $('#cateogory').val();
		}
    var pattern = $('#pattern').val();
		if (submit == 1) {
      	var ajax = new SmartAjax('POST', list_page, 'category_id=' + category + '&pattern_id=' + pattern + '&price=' + price);
                ajax.requestJSON("loadProduct",
                    function (response) {
                        var msg = response.message;

                        $('#dataSpan').html(msg.content_data);
                        $('#dataSpan').trigger("create");

                    }
                );
            }

        }

        $(document).ready(function () {
            var type = $('#type').val()
            console.log(type)
            if(type){
                $('#cateogory').val(type)
                searchProduct(type);
            }else{

                 searchProduct();
            }

        });


        $(document).ready(function () {

            $('#all').click(function () {
                $('#pattern').val('');
                $('#cateogory').val('');
                $('#price').val('');
                searchProduct();
            });

            $('#pattern').change(function () {
                searchProduct();
            });

            $('#cateogory').change(function () {
                searchProduct();
            });

            /*$('#price').change(function () {
                searchProduct();
            });
*/
            $('#cat_home').click(function () {
                searchProduct(1);
            });
            $('#cat_wear').click(function () {
                searchProduct(2);
            });
            $('#cat_fab').click(function () {
                searchProduct(3);
            });
        });
