<?php
$u = decode($_REQUEST['u']);

if ($_REQUEST['u'] == '') {
  $u = $_SESSION['userid'];
}
$abcd = GetPageRecord('*', 'userMaster', 'id="' . $u . '"');
$result = mysqli_fetch_array($abcd);

if ($_REQUEST['status'] == 1 || $_REQUEST['status'] == 2 || $_REQUEST['status'] == 3) {
  if ($_REQUEST['i'] != '') {
    $namevalue = 'status="' . $_REQUEST['status'] . '"';
    $where = 'id="' . decode($_REQUEST['i']) . '"';
    updatelisting('sys_packageBuilder', $namevalue, $where);
  }
}


if ($_REQUEST['status'] == 4) {
  if ($_REQUEST['i'] != '') {
    $namevalue = 'archiveThis=1';
    $where = 'id="' . decode($_REQUEST['i']) . '"';
    updatelisting('sys_packageBuilder', $namevalue, $where);
  }
}


if ($_REQUEST['status'] == 5) {
  if ($_REQUEST['i'] != '') {
    $namevalue = 'archiveThis=0';
    $where = 'id="' . decode($_REQUEST['i']) . '"';
    updatelisting('sys_packageBuilder', $namevalue, $where);
  }
}


?>


<div class="wrapper">
  <div class="container-fluid">
    <div class="main-content">

      <div class="page-content">



        <!-- start page title -->


        <div class="row">
          <div class="col-md-12 col-xl-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title cardtitle">Hotel

                  <form action="" class="newsearchsecform" style="left:54px;" method="get" enctype="multipart/form-data">
                    <input type="text" name="keyword" class="form-control newsearchsec" placeholder="Search by name" value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
                    <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
                  </form>

                  <div class="float-right">
                    <a href="<?php echo $fullurl; ?>imports/hotel-import.xls" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray">Download Format</a>
                    <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" onclick="loadpop('Import Hotel Excel',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=importhotelExcel">Import File</button>
                    <a href="<?php echo $fullurl; ?>exportHotel.php" target="_blank" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray">Export Data</a>
                    <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" onclick="loadpop2('Add Hotel',this,'600px')" data-toggle="modal" popaction="action=addhotel" data-target="#myModal2" data-backdrop="static">Add Hotel</button>



                  </div>
                </h4>

                <div class="table-responsive">
                  <table class="table table-hover mb-0">

                    <thead>
                      <tr>
                        <th width="32%">Name</th>
                        <th width="10%">Category</th>
                        <th width="15%">Destination</th>
                        <th width="1%" align="left">
                          <div align="center">Price</div>
                        </th>
                        <th width="1%" align="left">Status</th>
                        <th width="15%" align="left">By</th>
                        <th width="12%" align="left">Date</th>
                        <th width="1%">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $where4 = '';
                      if ($_REQUEST['keyword'] != '') {
                        $where4 = ' and  name like "%' . $_REQUEST['keyword'] . '%" ';
                      }


                      $totalno = '1';
                      $select = '';
                      $where = '';
                      $rs = '';
                      $select = '*';
                      $wheremain = '';
                      $where = ' where 1   ' . $where4 . '  order by id desc';
                      $limit = clean($_GET['records']);
                      $page = clean($_GET['page']);
                      $sNo = 1;
                      $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&s=' . $_REQUEST['s'] . '&';
                      $rs = GetRecordList('*', 'hotelMaster', '  ' . $where . '  ', '25', $page, $targetpage);

                      $totalentry = $rs[1];

                      $paging = $rs[2];
                      while ($rest = mysqli_fetch_array($rs[0])) {

                        $rs33 = GetPageRecord($select, 'sys_userMaster', 'id="' . $rest['addedBy'] . '" ');
                        $packagecreator = mysqli_fetch_array($rs33);
                      ?>

                        <tr>
                          <td width="35%" style="cursor:pointer;" onclick="loadpop('Update Price',this,'1320px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addHotelRate&id=<?php echo encode($rest['id']); ?>">

                            <table border="0" cellpadding="0" cellspacing="0" class="addbynewbadges">
                              <tr>
                                <?php if ($rest['hotelPhoto'] != '') { ?> <td colspan="2" style="padding-right:10px !important;"><img src="<?php echo $fullurl; ?>package_image/<?php echo stripslashes($rest['hotelPhoto']); ?>" width="25" height="25" /></td>
                                <?php } ?>
                                <td><?php echo stripslashes($rest['name']); ?></td>
                              </tr>
                            </table>
                          </td>
                          <td width="10%">
                            <div style="color:#FF9900;"><?php echo starcategory($rest['category']); ?></div>
                          </td>
                          <td width="15%"><?php echo getCityName($rest['destination']); ?></td>
                          <td width="1%" align="left">
                            <div align="center"><a class="dropdown-item" style="cursor:pointer; font-size:12px; text-decoration:underline;" onclick="loadpop('Update Price',this,'1320px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addHotelRate&id=<?php echo encode($rest['id']); ?>">Update</a></div>
                          </td>
                          <td width="1%" align="left"><?php echo newstatusbadges($rest['status']); ?></td>
                          <td width="15%" align="left"><?php echo addbynewbadges($rest['addedBy']); ?> </td>
                          <td width="12%" align="left"><?php echo date('d-m-Y', strtotime($rest['dateAdded'])); ?></td>
                          <td width="1%">


                            <a class="dropdown-item neweditpan" onclick="loadpop2('Edit Hotel',this,'600px')" data-toggle="modal" data-target="#myModal2" popaction="action=addhotel&id=<?php echo encode($rest['id']); ?>" data-backdrop="static"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                          </td>
                        </tr>


                      <?php $totalno++;
                      } ?>
                    </tbody>
                  </table>
                </div>
                <?php if ($totalno == 1) { ?>
                  <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Hotel </div>
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
  </div>
</div>


<script>
  function duplicatePackage(id) {
    var result = confirm("Are you sure you want to create duplicate package?");
    if (result == true) {
      $('#ActionDiv').load('actionpage.php?pid=' + id + '&action=addduplicatepackage');
    } else {
      return false;
    }
  }
</script>