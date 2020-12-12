<?php
  require("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
  $sql = mysqli_query($koneksi, "SELECT * FROM datasensor ORDER BY id DESC LIMIT 10");
  $datas = mysqli_query($koneksi, "SELECT * FROM datasensor ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <script src="jquery.min.js"></script>

  <meta http-equiv="refresh" content="30">

  <script type="js/Chart.js"></script>>
  <script type="text/javascript" src="Chart.js"></script>
  <script src="jquery.min.js"></script>
  <style type="text/css">
    .sidebar{
      width: 30%
      margin: 15px auto;
    }
  </style>>
  <style>
        #wntable {
          border-collapse: collapse;
          width: 100%;
        }

        #wntable td, #wntable th {
          border: 1px solid #ddd;
          padding: 8px;
        }

        #wntable tr:nth-child(even){background-color: #f2f2f2;}
        #wntable tr:hover {background-color: #ddd;}
        #wntable th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #00A8A9;
          color: white;
        }
        /*.container
        {
          width: 100%;
        }*/
        .cards
        {
          width: 100%;
          float left;
        }
        .sidebar 
        {
          width: 30%;
          display: inline-block;
          float :right;
        }

      </style>
      
  </head>
    <body>
      <!-- header -->
 <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">

  <a class="navbar-expand" ><img  src="UMS.png" width="50" height="50" alt="" loading="lazy"></a>
    <a class="navbar-expand text-white navbar-text mr-auto">Temperature Monitoring System | <b>UMS</b> </a>
</nav>
<!-- AKHIR HEADER -->


<div class="pt-5 mt-3 p-5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1><center> Data Sensor Suhu Mesin</center></h1>
      </div>
    </div>

    <center>
    <button type="button" class="btn btn-lg active bg-success p-1 text-white rounded" data-toggle="modal" data-target="#staticBackdrop" ><i class="fa fa-print mr-1 mt-1"></i>Cetak Exel</button></center>

        <div class="row mt-5">
          <div class="col-sm-6"> 
            <h2><center>GRAFIK</center></h2>
                <div id="linechart"></div>
          </div>

  
          <div class="col-sm-6"  >
              <h2 class="text-center">TABEL</h2>
              <p class="text-center">Temperature Measurement Table</p>
                <table id="wntable" align="center">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Data</th>
                  <th class="text-center">Waktu</th>
                  <th class="text-center">Tanggal</th>
                </tr>
                  
                <?php
                  if(mysqli_num_rows($sql) == 0){ 
                    echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
                  }else{ // jika terdapat entri maka tampilkan datanya
                    $no = 1; // mewakili data dari nomor 1
                    while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row["data"]; ?></td>
                        <td><?php echo $row['waktu'] ; ?></td>
                        <td><?php echo date('d F Y', strtotime($row['tanggal'])) ; ?></td>
                      </tr>
                  <?php
                  }
                  }
                  ?> 
                </table>
          </div>
        </div>
    <!-- </div> -->
  </div>
</div>


<form action="cetakexel.php" method="post" target="_blank">
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cetak Data Monitoring Sensor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <tr>
            <td width="200" ><b>Dari Tanggal :</b></td>
            <td ><input class="ml-4" type="date" name="tanggal_awal" required />                
            </td> <br> <br>
            <td width="200"><b>Sampai Tanggal :</b></td>
            <td><input  type="date" name="tanggal_akhir" required />                
            </td>
          </tr>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <td>
              <input type="submit" name="cetak" class="btn btn-primary" value="Cetak">
            </td>
          </div>
      </form >
    </div>
  </div>
</div>
</form>

<?php
$data = mysqli_query($koneksi, "SELECT * FROM datasensor ORDER BY id DESC LIMIT 10 ");

$sensor = array();
while($input = mysqli_fetch_assoc($data)){
$sensor = array_merge($sensor, array_map('floatval', explode(",", $input['data'])));
}

?>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- <script src="https://code.highcharts.com/modules/export-data.js"></script> -->
<!-- <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
<script>
    Highcharts.chart('linechart', {

    title: {
        text: 'Temperature Measurement Chart'
    },


    yAxis: {
        title: {
            text: 'PARAMETER'
        }
    },
    xAxis: {
        accessibility: {
            rangeDescription: 'Range: 1 to 20'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },

        }
    },

    series: [{
        name: 'TEMPERATURE',
        data: <?= json_encode($sensor) ; ?>
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
  </script>

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
