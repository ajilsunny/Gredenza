<?php
$CI=&get_instance();
$session_check=$CI->session_check(0);
if ($session_check==0) {
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Fuel Filling
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url() ?>assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url() ?>assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="dark-edition">
  <div class="wrapper ">

    <?php require('include/menu_bar.php') ?>
    
    <div class="main-panel">
      <!-- Navbar -->
      <?php require('include/navbar.php') ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h3 class="card-title mt-0">Fuel Filling Details
                  <button id="modalbtn" class="btn btn-success pull-right" data-toggle="modal" data-target="#FuelModal">Add Fuel Filling</button></h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>Registration Number</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Time</th>
                      </thead>
                      <tbody>
                        <?php echo $fuel_filling; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
           </div> 
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="FuelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #1a2035">
      <div class="modal-header">
        <h4 class="modal-title text-light" id="exampleModalLabel">Add Fuel Filling</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="fuelform" method="post">
          <div class="formbody">
            <h4 class="text-light">Select Registration Number</h4>
              <select class="form-control" name="vehicle_id" id="vehicle_id" required="">
                <option value="">- - Select - -</option>
                <?php foreach ($vehicles as $key) {?>
                  <option value="<?php echo $key->v_id ?>"><?php echo $key->registration_number ?></option>
                <?php } ?>
              </select>
            <h4 class="text-light mt-3">Quantity</h4>
            <input type="text" name="qty" placeholder="Eg:- 10.500" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <h4 class="text-light mt-3">Amount</h4>
            <input type="text" name="amount" placeholder="Eg:- 1250" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
  
  <!--   Core JS Files   -->
  <script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="<?php echo base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="<?php echo base_url() ?>assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url() ?>assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo base_url() ?>assets/demo/demo.js"></script>
  <script>
    
    $('#fuelform').submit(function (event){
      event.preventDefault();
      var data=new FormData(this)
      $('.form-control').val('')
      $('.close').click();
      $.ajax({
        url:"<?php echo site_url('Upload-Fuel') ?>",
        type: "POST",
        data:data,
        contentType:false,
        cache:false,
        processData:false,
        success:function(result)
        {
          $('tbody').html(result)
        }
      });

      return false;
    })
  </script>
  <script>
    $(document).ready(function() {
      $('#headername').html('Fuel Filling')
      $('.classclr').removeClass('active')
      $('#fuel').addClass('active')
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });


      });
    });
  </script>
</body>

</html>
<?php
}
else
{
  redirect('','reload');
}
?>