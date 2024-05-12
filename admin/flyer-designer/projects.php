<?php include "inc.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Projects - <?php echo $systemname; ?></title>

<?php include "headerinc.php"; ?>
</head>

<body style="background-color:#FFFFFF;">
<?php include "header.php"; ?>

<div class="left">
<a href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #1473e6; color: #fff; border-radius: 32px; width: 49px; height: 49px; margin: auto; margin-bottom: 10px;"><i class="fa fa-plus" aria-hidden="true"></i></a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="top: 113px; left: 4px; }">
    <a class="dropdown-item" href="#" onclick="createflyer('Instagram Story');"><i class="fa fa-instagram" aria-hidden="true"></i> &nbsp;Instagram Story</a>
    <a class="dropdown-item" href="#" onclick="createflyer('Instagram Post');"><i class="fa fa-instagram" aria-hidden="true"></i> &nbsp;Instagram Post</a>
    <a class="dropdown-item" href="#" onclick="createflyer('Facebook Post');"><i class="fa fa-facebook-official" aria-hidden="true"></i> &nbsp;Facebook Post</a> 
    <a class="dropdown-item" href="#" onclick="createflyer('Emailer');"><i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp;Emailer</a>
    <a class="dropdown-item" href="#" onclick="createflyer('Custom Size');"><i class="fa fa-window-maximize" aria-hidden="true"></i> &nbsp;Custom Size</a>
  </div>
<a href="<?php echo $fullurl; ?>"><i class="fa fa-home" aria-hidden="true"></i><div>Home</div></a>
<a href="<?php echo $fullurl; ?>projects" class="active"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><div>Projects</div></a> 

</div>

<div class="bodyareahome">
<div class="bodysections">
 
<h1>Projects</h1>
<?php if($_REQUEST['dl']==1){ ?>
<div class="alert alert-danger" role="alert">
  Project Successfully Deleted!
</div>
<?php } ?>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th width="1%" scope="col">#</th>
      <th width="30%" scope="col">Name</th>
      <th scope="col">Type</th>
      <th align="left" scope="col">Size</th>
      <th scope="col">Last Update </th>
      <th width="20%" scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
<?php 
$where=' where userId="'.$_SESSION['userid'].'" order by id desc';
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='projects?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','flyer_project','   '.$where.'  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){  
?>
<tr>
  <th width="1%" scope="row"><?php echo $sNo; ?></th>
  <td width="30%"><?php echo stripslashes($rest['name']); ?></td>
  <td><span class="badge badge-primary"><?php echo stripslashes($rest['projectType']); ?></span></td>
  <td align="left"><?php echo stripslashes($rest['pageWidth']); ?> - <?php echo stripslashes($rest['pageHeight']); ?></td>
  <td><?php echo date('d/m/Y h:i A',strtotime($rest['editDate'])); ?></td>
  <td width="20%"><a href="edit-project.html?id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></a>
<button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-files-o" aria-hidden="true"></i> Duplicate</button>

<button type="button" class="btn btn-danger btn-sm" onclick="deleteproject(<?php echo encode($rest['id']); ?>);">&nbsp;<i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
 </td>
</tr>
 <?php $sNo++; } ?>
  </tbody>
</table>

<div>

</div>

<?php if($sNo==1){ ?>
<script>
$('.table').hide();
$('.alert').hide();
</script>
<div style="padding:100px 0px; text-align:center;">
<div style="margin-bottom:20px;"><img src="images/noproject.png" height="128" /></div>
<h1 style="font-size:22px; font-weight:700;">What would you like to create?</h1>
<div class="lighttext">Your story matters, Spark it!</div>
<div>
  <button type="button" class="btn btn-primary btn-sm">Create a project </button>
</div>
</div>
<?php  } else { ?>
<div class="mt-3 pageingouter">	
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
							  </div>
<?php } ?>
</div>

 

</div>
 

 




 


 
</body>
</html>
