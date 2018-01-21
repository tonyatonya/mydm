<header class="header">
    <div id="top-nav">
        <div class="boxleft">
            <a id="swit-btn" class="current" href="index.php">STORE</a>
            <a id="swit-btn" href="../studio/index.php" target="_blank" style="margin-right:20px;">STUDIO</a>
        </div>
    </div>
    <div class="container clearfix">
        <a id="logo" class="col" href="index.php"></a>
        <div class="boxright">
            <ul>
                <li>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip1', {sticky:true, position:4, cssClass:'no-padding'})"><img
                            src="images/top-icon-fav.svg"></a>
                </li>

                <li style="position:relative">
                	<div class="bag-container">
                    <div class="bagcount"></div>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip2', {sticky:true, position:4, cssClass:'no-padding'})"><img
                            src="images/top-icon-count.svg"></a>
                	</div>
                </li>

                <li>
               		<a id="icon-btn" class="tooltip member-btn" href="#">
	               		<img src="images/top-icon-member.svg">
	               	</a>

                </li>
            </ul>
        </div>
        <nav>
            <a href="collection.php" class="navitem">COLLECTIONS</a>
            <a href="shops.php" class="navitem">SHOP</a>
            <a href="story.php" class="navitem">STORY</a>
            <a href="blog.php" class="navitem">BLOG</a>
            <a href="contact.php" class="navitem">LOCATION</a>
        </nav>
    </div>
</header>
<div style="display:none;">
    <div id="tip1">
        <div>
            <div class="head">MY FAVOURITE</div>
            <div class="body" style="padding:20px; background:#f5f6f7">
                <p>COLLECT YOUR FAVOURITE ITEMS AND REVIEW THEM NEXT VISITFOR INSPIRATION.</p>
            </div>
            <div class="bottom">
                <a href="member-account.php" class="btn">VIEW MY FAVOURITE</a>
            </div>
        </div>
    </div>

    <div id="tip2">
        <div>
            <div class="head"><span class="inbag"></span> ITEM IN BAG</div>
            <div class="body">
                <div id="totalcart"></div>
            </div>
            <div class="bottom">
                <div class="seedetail">
                    <span>
                    <a href="shop-cart-total.php" class="btn" id="viewbag"
                       style="display: none">VIEW BAG </a>
                    <a href="shops.php" class="btn">SHOP NOW!!</a>
                        </span>
                </div>
            </div>
        </div>
    </div>

    <div id="tip3">
        <div>
            <div class="head">MY ACCOUNT</div>
            <div class="body">
                <table>
                    <tr>
                        <td>WISH LIST</td>
                        <td id="myemail">MY EMAIL PREFERENCE</td>
                    </tr>
                    <tr>
                        <td>INVENTORY</td>
                        <td id="myaddress">ADDRESS BOOK</td>
                    </tr>
                    <tr>
                        <td>MY ORDERS</td>
                        <td id="myorder">ACCOUNT DETAILS</td>
                    </tr>
                    <tr>
                        <td>MY GIFT CARDS</td>
                        <td id="myfav">FAVOURITE COLLECTIONS</td>
                    </tr>
                </table>

            </div>
            <div class="bottom">
                <a href="member-account.php" class="btn" id="member" style="display: none">YOUR INFO</a>
                <a href="login.php" class="btn" id="signin">SIGN IN</a>
                <a class="btn" id="signout" style="display: none;cursor: pointer">SIGN OUT</a>
            </div>
        </div>
    </div>

</div>
