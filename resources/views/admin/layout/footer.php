

<footer>
<p>Copyright © 2022 Dreamguys.</p>
</footer>
<div class="div-loader">
<span class="loader"></span>

  </div>
</div>

</div>


<script src="resources/views/admin/assets/js/jquery-3.6.0.min.js"></script>

<script src="resources/views/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="resources/views/admin/assets/js/feather.min.js"></script>

<script src="resources/views/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="resources/views/admin/assets/plugins/datatables/datatables.min.js"></script>

<!-- Calendrier -->
<?php
$sched_res = [];
foreach($schedules as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row["start_datetime"]));
    $row['edate'] = date("F d, Y h:i A",strtotime($row["start_datetime"]));
    $sched_res[$row["id"]] = $row;
}

?>
<script>

    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    // console.log(scheds);
</script>

<script src="public/js/calendrier.js?v=<?php echo time(); ?>"></script>

<!-- Chart -->
<div id='chart_div'></div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(draw_my_chart)

    function draw_my_chart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Date');
      data.addColumn('number', 'Bénéfices');
      data.addColumn('number', 'Pertes');
      for (i = 0; i < my_2d.length; i++)
      // date // total_benefice // total_pert
        data.addRow([my_2d[i][4], parseInt(my_2d[i][1]), parseInt(my_2d[i][2])]);
      var options = {
        title: 'bénéfice graphique',
        hAxis: {
          title: 'Date',
          titleTextStyle: {
            color: '#333'
          }
        },
        vAxis: {
          minValue: 0
        },
        height: 400,
        width: '100%',
        isStacked: false,
        legend: {
          position: 'top'
        }
      };
      var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
      chart.draw(data, options)
    }
  </script>
<!-- --------- -->

<script src="resources/views/admin/assets/js/script.js"></script>
<script src="public/js/jQuery/jquery-3.6.0.min.js"></script>
<script src="public/js/loader.js?v=<?php echo time(); ?>"></script>


<script src="resources/views/admin/assets/js/feather.min.js?v=<?php echo time(); ?>"></script>

<script src="resources/views/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js?v=<?php echo time(); ?>"></script>

<script src="resources/views/admin/assets/plugins/countup/jquery.counterup.min.js?v=<?php echo time(); ?>"></script>
<script src="resources/views/admin/assets/plugins/countup/jquery.waypoints.min.js?v=<?php echo time(); ?>"></script>
<script src="resources/views/admin/assets/plugins/countup/jquery.missofis-countdown.js?v=<?php echo time(); ?>"></script>


<script>
  function addClassActive(x) {
    x.classList.add("active");
  }
</script>









</body>
</html>
