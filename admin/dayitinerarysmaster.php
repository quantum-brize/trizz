<?php 
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
$result=mysqli_fetch_array($abcd); 
?> 
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title cardtitle cardtitle" >Day Itinerary
									<form  action=""  class="newsearchsecform"   method="post" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" >
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" />
								  </form>
								  
								  
									<div class="float-right">
								   <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Day Itinerary',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static" popaction="action=adddayitinerary"   >Add Day Itinerary</button>  
									</div></h4> 
							  
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>&nbsp;</th>
                                                  <th>Title</th>
                                                    <th>Detail</th>
                                                    <th>Status</th>
                                                    <th> By</th>
                                                    <th>Date</th>
                                                    <th align="left">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$wheres='';
if($_REQUEST['keyword']!=''){
$wheres=' and  name like "%'.$_REQUEST['keyword'].'%" ';
}

$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where name!="" '.$wheres.' order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','dayItineraryMaster','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td style="cursor:pointer; position:relative;"   >
  
  
  
  <div class="eventimgclass" onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&afunctin=changeeventimagedetailphoto<?php echo $rest['id']; ?>&pid=<?php echo encode($result['id']); ?>" style="cursor:pointer;"><img  src="<?php  if($rest['eventPhoto']!=''){ echo $fullurl;  echo 'package_image/'.$rest['eventPhoto']; } else { 
	
	echo 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAEKklEQVRoge2YzW8bRRjGf2M7azshbp02jUAFoaZUiAtC4gAX7lz4C3rugRO95wASZ45A/wBOSKhSaStAokg9gKDAgYoDClVdp45p4nzYqR2v7RkO/trZndmdjcsJP9LI431nZp9n9nnfHRvmmGOOOeb4P0MEvzz+svDhmUv+hveczGqjFPzw8eqwq4bfXfpKTeer8Li4a1pMBGNbQqkr7327c3tMLRPkubLubywUZVYNQGtySsSZfEB8sE8obhQ0iYlw7LyEa0HOueAXb1FmkZhhIhIjRCNqIqhIFGSOiRetAqzkQzfVhAQXN/RR+lDrjkdIC2vMKkDFCDDuKDoRF9+7WUjYx4doOT+ByeTwrgWCzr4PXdcFRXwfHX8iAf+l72MFRdeyCoizkLZgQt+50oRJK7vvTfePCEAGmJoUxHh9YSFH+fQyXj6PEJY1bEtL6HR8dustup1+Kgtp74FxzTc1baGAKMWQ/NraWfKF9OQBRAYWlzzOX1jBy+dObqHYMhrj+3K5hBDwa/ktrq1fpZE/m0rAir/D+5uf8Mb+z6w+v8zWg31nC2lPABnTDAuM+57nAfD5xQ9SkwfY81b5bP0qAIXFheQkDyDVe8BW78e22fNWUxH/4p3TKAWX7x7QyJ8DIJOJSeRZLKQJMfXDw6Tk6b3f8GvbFC+9QvG1V6NjLPPjzkdhpM4BrcZbVlZyQOu7Oxz//QCAVm0b4XkULl5ADBTewTF+Kc/luweWm0HE9xYFyRZShs+QEG14v0/z9jd0H1W1663v75BfLnGu0iN31GdQzLHz5hpyQU9D7bYW3wehzx4YWiCJ4w5pAKrXo/n1LfxKBaGk1vC7NG/cQjSPAch2+pTv7xqNnVQ6rQJs7wAlzQkcfrQHX13Hf1QFqYzNb7eobv0+mZTf73Jq8zDKKmQhZwGJZTSUwOHHO6jXIzsfbs3DxzzZ2ZzMWaq2WKodGTW4KEh1mNMS2FQdYuvwFP/U71MslFheXgOg9Nc+vSVPu5fT9pPCQsGFbdVBSOnUGAyoVn7C95+O5kH5j90pD0fyEQFxFoo/RQ5jSwWRaKFxk70u1Yc/oka7kxWDIQWZgn0aARP2Bgsdd3wANl7+hcWiSKgG09Y52qVWvYfKC95dvA5Au9VLJUB/DwxiRpp8PxLT2GnywktnePtUnZuv30xFYIhPoT3c/SfVZqqZ+hNQ9hbxfUCQ3+1TqzRot33XPNYgpeLo0Ofhnw26nbhdjCKXPGSEBEH+cZ/tyt4oJqYCw5YLX4s5krjA/B63CHD7fRvzj4Ilh05KPpUAJxJGQTGxFPXehlRPIHlXk8/ykdiMeIYWGpG3kbbEZkVqC5l31c334dizgCbA72TsNcy6qw7/pJly4sRQ2g8NTUCj5n1kFeG4q05JPgN5IbgyywpzzDHHHHNo+BcdJCRRPMlRjwAAAABJRU5ErkJggg==';
	
	 } ?>" name="eventimage<?php echo $rest['id']; ?>" width="46" height="46" id="eventimage<?php echo $rest['id']; ?>" />
	
	<i class="fa fa-pencil fa-pencil-blk" style="position: absolute;left: 10px; background-color: #000; padding: 2px 5px; color: #fff; border-radius: 2px;" aria-hidden="true" onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&afunctin=changeeventimagedetailphoto<?php echo $rest['id']; ?>&pid=<?php echo encode($rest['id']); ?>"></i>	</div>
  
  
  	 <script>
function changeeventimagedetailphoto<?php echo $rest['id']; ?>(img){




if (img.indexOf('https://') > -1)
{  
 $('#eventimage<?php echo $rest['id']; ?>').attr('src',img);

  } else { 
 $('#eventimage<?php echo $rest['id']; ?>').attr('src','<?php echo $fullurl; ?>package_image/'+img);
 }

 
 
 
 $( ".close" ).trigger( "click" );
 $('#ActionDiv').load('actionpage.php?pid=<?php echo encode($rest['id']); ?>&id=<?php echo ($rest['id']); ?>&action=daydetailsphoto&imagename='+img);
}
</script>
  </td>
  <td style="cursor:pointer;"  onclick="loadpop2('Edit Day Itinerary',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static" popaction="action=adddayitinerary&id=<?php echo encode($rest['id']); ?>" ><?php echo stripslashes($rest['name']); ?></td>
  <td><?php echo substr(stripslashes($rest['details']),0,100); ?>...</td>
  <td><?php echo newstatusbadges($rest['status']); ?></td>
<td><?php echo addbynewbadges($rest['addedBy']); ?></td>
<td>
<?php echo date('d-m-Y', strtotime($rest['dateAdded'])); ?></td>
<td align="left">
<a class="dropdown-item neweditpan" onclick="loadpop2('Edit Day Itinerary',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static" popaction="action=adddayitinerary&id=<?php echo encode($rest['id']); ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Day Itinerary</div>
						   <?php } else { ?>
								<div class="mt-3 pageingouter">	
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
							  </div>
										  
										<?php } ?>
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>
	
	
	<div id="ActionDiv" style="display:none;"></div>