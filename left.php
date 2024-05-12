<div id="leftsidemenu">

<div class="inlist">


	<?php if($LoginUserDetails['userType']=='agent'){ ?>
<div class="companyinfobox">

<a href="<?php echo $fullurl; ?>my-profile" style="color:#000000;">

<div class="companyname"><?php echo stripslashes($LoginUserDetails['companyName']); ?></div>

<strong>ID:</strong> <?php echo ($LoginUserDetails['agentId']); ?>

</a>

</div>

<?php } ?>

<div class="sidemenuleft">  

<a <?php if($selectleft=='bookings'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>flight-bookings"><span><i class="fa fa-list" aria-hidden="true"></i></span> Bookings</a>

<a <?php if($selectleft=='invoice'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>flight-bookings-invoice"><span><i class="fa fa-file" aria-hidden="true"></i></span> Invoices</a>
	<?php if($LoginUserDetails['userType']=='agent'){ ?>
<a <?php if($selectleft=='balancesheet'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>balance-sheet" ><span><i class="fa fa-money" aria-hidden="true"></i></span> Balance Sheet</a>

<a <?php if($selectleft=='topup-recharge'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>topup-recharge" ><span><i class="fa fa-retweet" aria-hidden="true"></i></span> Credit Pool Recharge</a>

<a style="display:none;" <?php if($selectleft=='topup-request'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>topup-request" ><span><i class="fa fa-cloud-upload" aria-hidden="true"></i></span> Credit Pool Request</a>

<a style="display:none;" <?php if($selectleft=='mycustomers'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>my-customer"><span><i class="fa fa-users" aria-hidden="true"></i></span> Customers</a>

<!--<a href="#"><span><i class="fa fa-plane" aria-hidden="true"></i></span> Flight Series Fare</a> -->

<?php } ?>

<a <?php if($selectleft=='branches'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>branches"><span><i class="fa fa-users" aria-hidden="true"></i></span> Branch</a> 

<a <?php if($selectleft=='settings'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>settings"><span><i class="fa fa-cog" aria-hidden="true"></i></span> Settings</a> 



</div>





	<?php if($LoginUserDetails['userType']=='agent'){ ?>

<div id="leftcontactbox">

<img src="images/flightlefticon.png">

<div class="head">Sales Manager</div>

<?php echo $acountmanager['name']; ?> <?php echo $acountmanager['lastName']; ?><br>

<?php echo $acountmanager['phone']; ?><br>

<?php echo $acountmanager['email']; ?>



</div>
<?php } ?>


</div> 

</div>