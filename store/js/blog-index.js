
    function searchProduct(type) {
        var submit = 1;
        if (typeof(type) === "undefined") {
            type = 0;
        }
        var tag = $('#tag').val();
        var navigate_type = $('#type').val();

        if (navigate_type != "") {
            type = navigate_type;
        }


        if (submit == 1) {
            var ajax = new SmartAjax('POST', 'blog.php', 'type=' + type + '&tag=' + tag);
            ajax.requestJSON("loadBlog",
                function (response) {
                    var msg = response.message;

                    $('#cont').html(msg.content_data);
                    $('#cont').trigger("create");
                    $('.wall').jaliswall({item: '.wall-item'});

                }
            );
        }
        setTimeout(function(){
	        equalheight('.wall-item');
        }, 300)


    }

    $(document).ready(function () {
        searchProduct();
    });


    $(document).ready(function () {

        $('#all').click(function () {
            searchProduct(0);
        });

        $('#inspi_type').click(function () {
            searchProduct('inspiring design');
        });

        $('#press_type').click(function () {

            searchProduct('press');
        });
    });
		$(window).load(function() {
			//equalheight('.wall-item');
		});


		$(window).resize(function(){
			equalheight('.wall-item');
		});
