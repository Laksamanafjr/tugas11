<?php
include('koneksi.php');
$produk = mysqli_query($koneksi,"select * from tb_covid");
while($row = mysqli_fetch_array($produk)){
	$nama_produk[] = $row['country'];
	
	$query = mysqli_query($koneksi,"select sum(new_sembuh) as new_sembuh from tb_covid where new_sembuh='".$row['new_sembuh']."'");
	$row = $query->fetch_array();
	$jumlah_produk[] = $row['new_sembuh'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'Grafik total mati',
					data: <?php echo json_encode($jumlah_produk); ?>,
					backgroundColor: [
					'rgba(127, 92, 145, 0.8)',
					'rgba(81, 182, 188, 0.8)',
					'rgba(255, 116, 0, 0.19)',
					'rgba(83, 91, 156, 0.19)',
					'rgba(245, 40, 145, 0.8)',
					'rgba(127, 92, 145, 0.8)',
					'rgba(27, 91, 156, 0.19)',
					'rgba(216, 218, 156, 0.19)',
					'rgba(0, 255, 30, 1)',
					'rgba(0, 0, 255, 1)',

					],
					borderColor: [
						'rgba(127, 92, 145, 0.8)',
					'rgba(81, 182, 188, 0.8)',
					'rgba(255, 116, 0, 0.19)',
					'rgba(83, 91, 156, 0.19)',
					'rgba(245, 40, 145, 0.8)',
					'rgba(127, 92, 145, 0.8)',
					'rgba(27, 91, 156, 0.19)',
					'rgba(216, 218, 156, 0.19)',
					'rgba(0, 255, 30, 1)',
					'rgba(0, 0, 255, 1)',
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>