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
    Dashboard
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
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">directions_car</i>
                  </div>
                  <p class="card-category">Number of Vehicles</p>
                  <h3 class="card-title"><?php echo sizeof($vehicles) ?>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Number of vehicles added to the application
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">ev_station</i>
                  </div>
                  <p class="card-category">Total Fuel Cost</p>
                  <h3 class="card-title">₹<?php echo $total_cost ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Total fuel filling cost 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
              <div class="card card-chart">
                <div class="card-body">
                  <h4 class="card-title">Registration Number</h4>
                  <select class="form-control" name="vehicle_id" id="vehicle_id" required="">
                  <option value="">- - Select - -</option>
                  <?php foreach ($vehicles as $key) {?>
                    <option value="<?php echo $key->v_id ?>"><?php echo $key->registration_number ?></option>
                  <?php } ?>
                </select>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
              <div class="card card-chart">
                <div class="card-body">
                  <h4 class="card-title">From Date</h4>
                  <input type="date" id="from_date" class="form-control" name="">
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
              <div class="card card-chart">
                <div class="card-body">
                  <h4 class="card-title">To Date</h4>
                  <input type="date" id="to_date" class="form-control" name="">
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
              <div class="card card-chart">
                <div class="card-body">
                  <h4 class="card-title mt-3"></h4>
                  <button id="search" class="btn btn-success pull-right">Search</button>
                </div>
              </div>
            </div>

          </div> 
          <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th class="text-info">Registration Number</th>
                        <th class="text-info">Amount</th>
                        <th class="text-info">Time</th>
                      </thead>
                      <tbody>
                        <?php echo $report; ?>
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
    $('#search').click(function (){
      var reg_no=$('#vehicle_id').val()
      var from=$('#from_date').val()
      var to=$('#to_date').val()
      $.ajax({
        url:"<?php echo site_url('Search-Report') ?>",
        type: "POST",
        data:{reg_no:reg_no,from:from,to:to},
        success:function(result)
        {
          $('tbody').html(result)
        }
      });
    })
    $(document).ready(function() {
      $('#headername').html('Dashboard')
      $('.classclr').removeClass('active')
      $('#dashboard').addClass('active')
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