<?php 
include "inc.php"; 
include "config/logincheck.php"; 

$managerwhere='';
 
 $managerwhere=' and agentId="'.$_SESSION['agentUserid'].'"   ';
 
 
 

header('Content-type: application/excel');
$filename = 'Flight-Booking-'.mt_rand().'.xls';
header('Content-Disposition: attachment; filename='.$filename);
$data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Sheet 1</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
</head>

<body>	
			<table>
				<tr>
					<th>SN</th>
					<th>Reference No.</th> 
					<th>Booking Date</th>
					<th>Booking Time</th>
					<th>Corporate</th>
					<th>Billing Entity</th>
					<th>Gst No</th>
					<th>Booking Type</th>
					<th>Trip Type</th>
					<th>Passanger</th> 
					<th>Travel Date</th>
					<th>Sector</th>
					<th>Flight</th>
					<th>Class</th>
					<th>PNR</th>
					<th>Ticket No</th>
					<th>Base Fare</th>
					<th>Tax</th>
					<th>Service Fee</th>
					<th>Total Fare</th> 
					<th>Status</th>
				</tr>';
				
$search='';
$sn=1;

if($_REQUEST['status']!=''){
$search.=' and  status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(journeyDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(journeyDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" )) ';
}

$query=GetPageRecord('*','flightBookingMaster','1   '.$search.' '.$managerwhere.' order by id desc'); 
while($rest=mysqli_fetch_array($query)){

$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 
$agentcate=mysqli_fetch_array($rs6);

$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 
$cont=mysqli_num_rows($cft);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

if($cont>1){ 
$trip='<span class="badge bg-blue" style="background-color: #5d5d5e;">Round Trip</span><?php }else{ ?><span class="badge bg-blue" style="background-color: #42af35;">Oneway</span>';
}else{
$trip='<span class="badge bg-blue" style="background-color: #42af35;">Oneway</span>';
}

if (!empty($rest['gstNo'])) {
$bookingType = 'Official';
} else {
$bookingType = 'Personal';
}


$arr = explode('-', $rest['source']);
$arr2 = explode('-', $rest['destination']);

$sector = $arr[0] . '-' . $arr2[0];






if($rest['pickedBy']>0){ 
$se=GetPageRecord('*','sys_userMaster',"id='".$rest['pickedBy']."' "); 
$userinfo=mysqli_fetch_array($se);
$user=$userinfo['name'];
}else{
$user='';
}


if($rest['status']==1){
$status='<span class="badge bg-blue" style="background-color:#FF6600;">Pending</span>';
}
if($rest['status']==2){
$status='<span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span>';
}

if($rest['status']==3){
$status='<span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span>';
}

if($rest['status']==4){
$status='<span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span>';
}



    
	   
			$pass='';	 
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
		    
		
		
		$pass.=stripslashes($paxData['title']).' '.stripslashes($paxData['firstName']).' '.stripslashes($paxData['lastName']).', ';
		}

            $ticketno = '';	 
        $rs6 = GetPageRecord('*', 'flightBookingPaxDetailMaster', 'BookingId="'.$rest['id'].'"'); 
        while ($paxData = mysqli_fetch_array($rs6)) {
    
        $ticket = stripslashes($paxData['ticketNo']);
        if (!empty($ticket)) {$ticketno .= "'" . $ticket . "', ";}}
        
         $searchArrey = unserialize($rest['searchArrey']);
         $baseFare = $searchArrey['Fare']['BaseFare'];
         $taxFare = $searchArrey['Fare']['Tax'];
         $taxAmount = $taxFare + $rest['agentMarkup'];
         
        $servicefee = ($rest['agentTotalFare']-$rest['totalFare']); 
        

		$data .= '<tr>
					<td>'.$sn.'</td>
					<td>'.encode($rest['id']).'</td> 
					<td>'.date('d-m-Y', strtotime($rest['bookingDate'])).'</td>
					<td>'.date('G:i', strtotime($rest['bookingDate'])).'</td>
					<td>'.stripslashes($agentData['companyName']) . '</td>
					<td>'.stripslashes($rest['companyName']).'</td>
					<td>'.stripslashes($rest['gstNo']).'</td>
					<td>'.$bookingType.'</td>
					<td>'.$trip.'</td>
					<td>'.$pass.'</td> 
					<td>'.date('d-m-Y', strtotime($rest['journeyDate'])).'</td>
					<td>'.$sector.'</td> 
					<td>'.stripslashes($rest['flightName'].' '.$rest['flightNo']).'</td>
					<td>'.stripslashes($rest['flightClass']).'</td> 
					<td>'.stripslashes($rest['pnrNo']).'</td>
					<td>'.$ticketno.'</td> 
					<td>'.$baseFare.'</td> 
					<td>'.$taxAmount.'</td> 
					<td>'.$servicefee.'</td> 
					<td>'.stripslashes($rest['agentTotalFare']).'</td> 
					<td>'.$status.'</td>
				</tr>';
$sn++;
}

		$data .= '
			</table>
</body>
</html>';
echo $data;

?>