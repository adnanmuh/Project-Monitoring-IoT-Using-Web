<?php
  require("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
  $tanggal_a=$_POST['tanggal_awal'];
  $tanggal_b=$_POST['tanggal_akhir'];
  $sql = mysqli_query($koneksi, "SELECT * FROM datasensor WHERE `datasensor`.`tanggal` between '$tanggal_a' and '$tanggal_b' ORDER BY id");
?>

<html>
<head>
	<title>Export Data Ke Excel</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data-Monitoring.xls");
	?>
 
	<center>
		<h1>DATA MONITORING TEMPERATURE</h1>
	</center>
 
	<table border="1">
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
</body>
</html>