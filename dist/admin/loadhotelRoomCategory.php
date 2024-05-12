<?php
include "inc.php";  
 
$hotelnamemaster=$_REQUEST['hotelnamemaster'];
$allRooms='';
$where=' id="'.$hotelnamemaster.'" order by name asc';  
$rs=GetPageRecord('*','hotelMaster',$where); 
$resListing=mysqli_fetch_array($rs);   
echo 'hotelId="'.$resListing['id'].'" and startDate<="'.$_REQUEST['day'].'" order by id desc';
$ab=GetPageRecord('*','hotelRateList','hotelId="'.$resListing['id'].'" and startDate<="'.$_REQUEST['day'].'" order by id desc');  
while($data=mysqli_fetch_array($ab)){
$allRooms.=$data['roomType'].',';
} 
 ?> 
 <option value="">Select Room</option>
<?php $a=GetPageRecord('*','RoomTypeMaster',' id in ('.rtrim($allRooms,',').')');  
while($resulthot=mysqli_fetch_array($a)){ ?>
 <option value="<?php echo strip($resulthot['name']); ?>" <?php if($resulthot['name']==$result['hotelRoom']){ ?> selected="selected" <?php } ?>><?php echo strip($resulthot['name']); ?></option>  
 <?php } ?>
 
 