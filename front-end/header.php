<div class="header_back">
<figure class="logo">
<img src="images/Forsight_Logo.png" alt="logo" />

</figure>
<nav id='nav'>

<ul>
<li><a href="index.php">HOME</a></li>
<li><a href="review.php">REVIEW CODE</a></li>
<?php
if($current_user){
?>
<li> <a href="member_portal.php">ACCOUNT</a>
<?php
}else{?>
<li> <a href="member_portal.php">LOGIN</a> </li>
<?php }?>
</ul>
</nav>




</div>
