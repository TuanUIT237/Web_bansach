<?php
	use Carbon\Carbon;
    use Carbon\CarbonInterval;
    require('../carbon/autoload.php');
	include("../connect_db.php");
    if(isset($_POST['thang'])){
    	$thang = $_POST['thang'];
		if(isset($_POST['nam'])){
			$nam = $_POST['nam'];
		}else{
			$nam = '';
		}	
		$sql = "SELECT * FROM thongke WHERE MONTH(ngaythongke)='$thang' AND YEAR(ngaythongke)='$nam'" ;
		$sql_query = mysqli_query($con,$sql);
	
		while($val = mysqli_fetch_array($sql_query)){
	
			$chart_data[] = array(
				'date' => $val['ngaythongke'],
				'order' => $val['sohoadon'],
				'sales' => $val['doanhthu'],
				'quantity' => $val['soluongban']
	
			);
		}
		  // print_r($chart_data);
		echo $data = json_encode($chart_data);
	}else{
		if(isset($_POST['nam'])){
			$nam = $_POST['nam'];
		}else{
			$nam = '';
		}	
		$sql = "SELECT * FROM thongke WHERE YEAR(ngaythongke)='$nam'" ;
		$sql_query = mysqli_query($con,$sql);
	
		while($val = mysqli_fetch_array($sql_query)){
	
			$chart_data[] = array(
				'date' => $val['ngaythongke'],
				'order' => $val['sohoadon'],
				'sales' => $val['doanhthu'],
				'quantity' => $val['soluongban']
	
			);
		}
		  // print_r($chart_data);
		echo $data = json_encode($chart_data);
	}	
	
?>