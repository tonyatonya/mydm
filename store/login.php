<div id="login" class="std-popup modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please Login</h4>
                <div class="line-section"></div>
            </div>
            <div class="modal-body">
	            <form class="form-section">
	                <div class="form-section-group">
	                	<label>username <span>(Require)</span></label>
	                	<input type="text">
	                </div>
	                <div class="form-section-group">
	                	<label>password <span>(Require)</span></label>
	                	<input type="password">
	                </div>
	                <a href="#" class="form-section-link register" data-dismiss="modal">register</a>
	            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  data-dismiss="modal">LOGIN</button>
                <button type="button" class="btn btn-default">RESET</button>
            </div>
        </div>
    </div>
</div>
<div id="register" class="std-popup modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Register</h4>
                <p>- Fill below form to be our member -</p>
                <div class="line-section"></div>
            </div>
            <div class="modal-body">
	            <form class="form-section">
	                <div class="form-section-group">
	                	<label>your name <span>(Require)</span></label>
	                	<input type="text">
	                </div>
	                <div class="form-section-group">
	                	<label>your e-mail <span>(Require)</span></label>
	                	<input type="text">
	                </div>
	                <div class="form-section-group">
	                	<label>username <span>(Require)</span></label>
	                	<input type="text">
	                </div>
	                <div class="form-section-group">
	                	<label>password <span>(Require)</span></label>
	                	<input type="password">
	                </div>
	                <div class="form-section-group">
	                	<label>re-enter password <span>(Require)</span></label>
	                	<input type="password">
	                </div>
	                <div class="form-section-group">
	                	<label>your country <span>(Require)</span></label>
	                	<div class="clear"></div>
	                	<div class="select-holder">
		                	<div><img src="images/addtheme/select-arrow.png" alt="select-arrow" width="9" height="8" /></div>
		                	<select>
			                	<option>-Please select-</option>
		                	</select>
	                	</div>
	                </div>
	                <div class="form-section-group">
	                	<label>zipcode <span>(Require)</span></label>
	                	<input type="password">
	                </div>
	                <div class="form-section-group">
	                	<label>your address <span>(Require)</span></label>
	                	<textarea></textarea>
	                </div>
	            </form>
            </div>
            <div class="modal-footer">
	            <button type="button" class="btn btn-primary"  data-dismiss="modal">Register</button>
                <button type="button" class="btn btn-default">RESET</button>
            </div>
        </div>
    </div>
</div>

<div id="complete" class="std-popup modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login Status</h4>
                <div class="line-section"></div>
            </div>
            <div class="modal-body">
	           <h4>Login Complete</h4>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>





<link href="css/modal.css" rel="stylesheet"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".member-btn").click(function(e){
			e.preventDefault();
			$("#login").modal('show');
		})

		$(".register").click(function(e){
			e.preventDefault();
			$('#login').on('hidden.bs.modal', function (e){
				$("#register").modal('show');
			})
		})

		$("#complete").on('show.bs.modal', function (e){
			setTimeout(function(){
				$("#complete").modal('hide');
			}, 5000)
		});
		$('#modal').on('hidden.bs.modal', function (e){})

		$("#complete").modal('show');
	});
</script>

