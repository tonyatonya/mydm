<div id="login" class="std-popup modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
          <?php
          if(empty($_SESSION['u_id']) ):
          ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please Login</h4>
                <div class="line-section"></div>
            </div>

            <form id="form" name="form" method="post">
            <div class="modal-body">
	            <div class="form-section">
	                <div class="form-section-group">
	                	<label>username <span>(Require)</span></label>
	                	<input type="text" name='u_login' id="u_login" required>
	                </div>
	                <div class="form-section-group">
	                	<label>password <span>(Require)</span></label>
	                	<input type="password" name='u_password' id="u_password" required>
	                </div>
	                <a href="#" class="form-section-link register" data-dismiss="modal">register</a>
	            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-login" onclick="processLogin()">LOGIN</button>
                <button type="button" class="btn btn-default">RESET</button>
            </div>
        </div>
      </form>
    <?php else:
      ?>
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">MY ACCOUNT</h4>
          <div class="line-section"></div>
      </div>
      <div class="modal-body">
        <div class="form-section">
            <div class="form-section-group">
              <label>WISH LIST</label>
              <div><?php echo $_SESSION['u_email']; ?>  </div>
            </div>
        </div>
        <div class="form-section">
            <div class="form-section-group">
              <label>INVENTORY</label>
              <div> <?php echo $_SESSION['u_country'] ?> </div>
            </div>
        </div>
        <div class="form-section">
            <div class="form-section-group">
              <label>MY ORDERS</label>
              <div>  </div>
            </div>
        </div>
        <div class="form-section">
            <div class="form-section-group">
              <label>MY GIFT CARDS</label>
              <div>  </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <a href="member-account.php" class="btn btn-default">YOUR INFO</a>
          <a href="logout.php" class="btn btn-default">SIGN OUT</a>
      </div>
  </div>
    <?php endif; ?>
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
