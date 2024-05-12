<?php
include "inc.php";

function getusermail($email){

$a=GetPageRecord('*','userMaster','email="'.$email.'"');
$client=mysqli_fetch_array($a);
if($client['id']!=''){

if($client['userType']=='4'){
return '<div class="identifyclient">CLT</div>';
}
if($client['userType']=='5'){
return '<div class="identifysupplier">SUP</div>';
}

} else {
 
$a=GetPageRecord('*','sys_userMaster','email="'.$email.'"');
$user=mysqli_fetch_array($a);

if($user['id']!=''){
return '<div class="identifyuser">USR</div>';
}

}


}



function getEncodedSubject(string $subject): string {
    if (!preg_match('/[^\x20-\x7e]/', $subject)) {
        // ascii-only subject, return as-is
        return $subject;
    }
    // Subject is non-ascii, needs encoding
    $encoded = quoted_printable_encode($subject);
    $prefix = '=?UTF-8?q?';
    $suffix = '?=';
    return $prefix . str_replace("=\r\n", $suffix . "\r\n  " . $prefix, $encoded) . $suffix;
}

$domain=explode("@",$LoginUserDetails['emailAccount']);

if( $mbox = imap_open("{".$domain[1].":110/pop3/notls}INBOX", $LoginUserDetails['emailAccount'], $LoginUserDetails['emailPassword'])){
    $path = "downloadMailsAttachments/";
    $check = imap_mailboxmsginfo($mbox);     
    function getmsg($mbox,$mid) {   
        global $charset,$htmlmsg,$plainmsg,$attachments,$from,$to,$subj,$timages,$path;
        $htmlmsg = $plainmsg = $charset = '';
        $attachments = array();
        // HEADER
        $h = imap_headerinfo($mbox,$mid);
        // add code here to get date, from, to, cc, subject...
        $date = $h->date;
		$fromaddr = $h->from[0]->mailbox . "@" . $h->from[0]->host;
        $from = $h->fromaddress;
        $to = $h->toaddress;
        $subj = htmlspecialchars($h->Subject);
		  
        // BODY
        $s = imap_fetchstructure($mbox,$mid);
		/*echo '<pre>';
		print_r($s);*/
        if (!$s->parts)  // simple
        getpart($mbox,$mid,$s,0,$date,$fromaddr,$from,$to,$subj);  // pass 0 as part-number
        else {  // multipart: cycle through each part
        foreach ($s->parts as $partno0=>$p)
		
		
          getpart($mbox,$mid,$p,$partno0+1,$date,$fromaddr,$from,$to,$subj);
        }
    }

    function getpart($mbox,$mid,$p,$partno,$mailDate,$fromEmailAddr,$fromName,$to,$subject) {
        // $partno = '1', '2', '2.1', '2.1.3', etc for multipart, 0 if simple
		
        global $htmlmsg,$plainmsg,$charset,$attachments,$partid,$last_mail_id,$patterns,$pic,$newstr,$c,$ok,$timages,$subj,$path;
        $patterns = array();
        $pic =  array();
        $image=array();
        $data = ($partno) ? imap_fetchbody($mbox,$mid,$partno) : imap_body($mbox,$mid);  // simple
        if ($p->encoding==4)
        $data = quoted_printable_decode($data);
        else if ($p->encoding==3)
        $data = base64_decode($data);
        // PARAMETERS    // get all parameters, like charset, filenames of attachments, etc.
        $params = array();
        if ($p->parameters)
        foreach ($p->parameters as $x)
            $params[strtolower($x->attribute)] = $x->value;
        if ($p->dparameters)
        foreach ($p->dparameters as $x)
            $params[strtolower($x->attribute)] = $x->value;

        // ATTACHMENT    // Any part with a filename is an attachment,
        // so an attached text file (type 0) is not mistaken as the message.
        if ($params['filename'] || $params['name']) {
        $partid = htmlentities($p->id,ENT_QUOTES);

           // filename may be given as 'Filename' or 'Name' or both
        $filename = ($params['filename'])? $params['filename'] : $params['name'];
        // filename may be encoded, so see imap_mime_header_decode()
         $attachments[$filename] = $data;  // this is a problem if two files have same name
        //store id and filename in array
        $image[$key] = $filename;

        }
         
            // TEXT 
			
            if ($p->type==0 && $data) {
            // Messages may be split in different parts because of inline attachments,   // so append parts together with blank row.
            if (strtolower($p->subtype)=='plain')
                $plainmsg .= trim($data)."\n\n";
            else
                //preg_match_all('/<img[^>]+>/i',$data, $result);
                $htmlmsg .= $data;
			    $mailBody = mb_convert_encoding($htmlmsg,"HTML-ENTITIES","UTF-8");
				 /*echo '<pre>';  
				 echo $mailBody;*/
				 
			//	$rs2=GetPageRecord('*','getAllMailMaster','subject="'.addslashes(trim($subject)).'" and fromEmailAddress="'.addslashes(trim($fromEmailAddr)).'"');
				 
				 //$subject=quoted_printable_encode($subject);

 				if(trim($mailBody)!=''){
				
				if (strpos($subject, '=?UTF-8?B?') !== false) { 
			  //$subject=base64_encode($subject);
				}
				if (strpos($subject, '=3D?UTF-8?Q?') !== false) { 
				 //$subject=imap_utf8($subject);
				}
				if (strpos($fromName, '\"') !== false) { 
				 // $fromName=base64_encode($fromName);
				}
				
				//$subject=str_replace('=?UTF-8?Q?','',$subject);
				
		 
				
					if (strpos($subject, 'UTF-8') === false) { 
				
				
				$subject=str_replace('\"','',$subject); 
				$fromName=str_replace('\"','',$fromName);   
				
				// echo $finaldateto.'___';
				
				if($finaldateto!=$mailDate){ ?>
				<!--<div class="datelist"><?php echo date('F j Y',strtotime($mailDate)); ?></div>-->
				<?php }
				
				$onlymail=explode("<",$fromName);
				 ?>
				
				
				<input id="mailsubject<?php echo $mid; ?>" type="hidden" value="<?php echo addslashes(strip_tags($subject)); ?>" />
				<input id="mailemail<?php echo $mid; ?>" type="hidden" value="<?php echo  str_replace('>','',str_replace('<',' | ',str_replace('\"','',addslashes(trim($fromName))))); ?>" />
				
				<input id="mailemailonly<?php echo $mid; ?>" type="hidden" value="<?php $mailonly=str_replace('>','',str_replace('<',' | ',str_replace('\"','',addslashes(trim($onlymail[1]))))); if($mailonly!=''){ echo $showmail=$mailonly;} else { echo $showmail=str_replace('>','',str_replace('<',' | ',str_replace('\"','',addslashes(trim($fromName))))); } ?>" />
				
				<input id="maildate<?php echo $mid; ?>" type="hidden" value="<?php echo $finaldateto=date('d/m/Y - h:i A',strtotime($mailDate));  ?>" />
				 <textarea id="mailtextbody<?php echo $mid; ?>" style="display:none;" cols="" rows=""><?php echo  str_replace('','',str_replace('display: ;','display:none ;',str_replace('\"','',addslashes(($mailBody))))); ?></textarea>
				
	<div class="maillist" onclick="clicktoviewmail('<?php echo $mid; ?>');selectopen(this);">
	<div class="globalname" id="globalname<?php echo $mid; ?>"><?php echo substr(trim($fromName),0,1); ?></div>
	<div class="content">
	<div class="text" ><?php echo str_replace('\"','',addslashes(trim($fromName))); ?><span style="display:none;"><?php echo strtolower(trim($fromName)); ?> <?php echo strtolower(strip_tags($subject)); ?></span></div>
	<div class="text" ><?php echo addslashes(strip_tags($subject)); ?></div>
	<div class="textbody"><?php echo substr(addslashes(strip_tags($mailBody)),0,200); ?></div>
	
	<?php if(date('Y',strtotime($mailDate))==date('Y')){ ?>
	<div class="mailtime"><?php echo $finaldateto=date('j M - h:i A',strtotime($mailDate));  ?></div>
	<?php } else { ?>
	<div class="mailtime"><?php echo $finaldateto=date('d/m/Y - h:i A',strtotime($mailDate));  ?></div>
	<?php } ?>
	<?php echo getusermail($showmail); ?>
	 
	</div>
	</div>
				
				<?php
				}
				
			//addlistinggetlastid('getAllMailMaster','subject="'.addslashes(trim($subject)).'",mailBody="'.addslashes(trim($mailBody)).'",fromEmailAddress="'.addslashes(trim($fromEmailAddr)).'",fromName="'.addslashes(trim($fromName)).'",toEmailAddress="'.addslashes(trim($to)).'",mailDate="'.addslashes(trim($mailDate)).'"'); 
 				//addlistinggetlastid('visitorChat','subject="'.addslashes(trim($subject)).'",msg="'.addslashes(trim($mailBody)).'"'); 
				
				 
				}






				
			 //echo mb_convert_encoding($htmlmsg,"HTML-ENTITIES","UTF-8");
                $charset = $params['charset'];  // assume all parts are same charset
            }

        // There are no PHP functions to parse embedded messages, so this just appends the raw source to the main message.
        else if ($p->type==2 && $data) {
        $plainmsg .= $data."\n\n";
        }
        // SUBPART RECURSION
        if ($p->parts) {
        foreach ($p->parts as $partno0=>$p2)
            getpart($mbox,$mid,$p2,$partno.'.'.($partno0+1),$mailDate,$fromEmailAddr,$fromName,$to,$subject);  // 1.2, 1.2.1, etc.
        }
    }

    $attachments = array();
    $num_msg = imap_num_msg($mbox);  
	$mailsectionnumber=$_REQUEST['moremail'];
	
    if($num_msg>0) {
	$nc=1;
       for($i=$num_msg; $i>=($num_msg-$mailsectionnumber); $i--){  
	   
	   getmsg($mbox,$i); 
	   
	   if($i==0){
	 
	   }
	   
	    }
    }else {
         echo "No Messages in MailBox...<br>";
    }
	

    //imap_delete and imap_expunge are used to delete the mail after fetching....Uncomment it if you want to delete the mail from mailbox
    //imap_delete($mbox,1); 
    //imap_expunge($mbox);
    imap_close($mbox);

}else { exit ("Can't connect: " . imap_last_error() ."\n");  echo "FAIL!\n";  };
 
?>


<?php if($num_msg>$mailsectionnumber){ ?>
<div style="padding:15px; background-color:#F4F4F4; color:#000000; font-weight:600; text-align:center; font-size:14px; cursor:pointer;" onclick="mailboxmaillistingouterfun('<?php echo ($mailsectionnumber+100); ?>');">Load More...</div>
<?php } ?>

<script>
function clicktoviewmail(id){
var mailsubject = $('#mailsubject'+id).val();
var mailemail = $('#mailemail'+id).val();
var maildate = $('#maildate'+id).val();
var mailemailonly = $('#mailemailonly'+id).val();
var mailtextbody = $('#mailtextbody'+id).val();
var globalname = $('#globalname'+id).text();

$('.mailsubject').html(mailsubject);
$('.mailfrom .nameemail').html(mailemail);
$('.mailfrom .fromdate').html(maildate);
$('.mailbodybox').html(mailtextbody);
$('.mailbodyboxtrans').html(mailtextbody);
$('.globalnameicon').html(globalname);
$('#sendmailfiled').val(mailemailonly);
$('.mailoadingimgboxread').show();
$('#mailiddisplay').hide();
$('.sendmailbox').hide();
}


 $("#search-criteria").on("keyup", function() {

var g = $(this).val();
 
$(".mailboxmaillistingouter .maillist").each( function() {
var s = $(this).text();
if (s.indexOf(g)!=-1) {
$(this).show();
}
else {
$(this).hide();
}
});
});

$('.fa-refresh').removeClass('makeanimate');
</script>
	