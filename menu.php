<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "db_makanan";
$con = mysqli_connect($server, $username, $password) or die ("<h1>Koneksi MySqli Eror : </h1>" .mysqli_connect_error());
mysqli_select_db($con, $database) or die("<h1>Koneksi Database Eror : </h1>" .mysqli_connect_error($con));

@$operasi = $_GET ['operasi'];

switch ($operasi) {
	case 'view':	
		$query_tampil_makanan = mysqli_query($con, "SELECT * FROM menu") or die (mysqli_error($con));
		$data_array = array();

		while($data = mysqli_fetch_assoc($query_tampil_makanan)) {
			$data_array[]=$data;
		}
		echo json_encode($data_array);
		break;
	
	case "insert":
	$nama_mkn = $_GET['nama_mkn'];
	$jenis_mkn = $_GET['jenis_mkn'];
	$ket_mkn = $_GET['ket_mkn'];

	$query_insert_data = mysqli_query($con, "INSERT INTO menu(nama_mkn,jenis_mkn,ket_mkn) VALUES ('$nama_mkn','$jenis_mkn','$ket_mkn')");
	if ($query_insert_data){
		echo "Data Berhasil Diupdate";
	}
	else{
		echo "Data Gagal Diupdate" . mysqli_error($con);
	}

		break;

	case "get_makanan_by_id";
	$id_mkn = $_GET['id_mkn'];
	$query_tampil_makanan = mysqli_query($con, "SELECT * FROM menu WHERE id_mkn='$id_mkn'") or die (mysqli_error($con));
	$data_array= array();
	$data_array= mysqli_fetch_assoc($query_tampil_makanan);
	echo "[" . json_encode ($data_array) . "]";
	break;

	case "update":
	$nama_mkn = $_GET['nama_mkn'];
	$jenis_mkn = $_GET['jenis_mkn'];
	$ket_mkn = $_GET['ket_mkn'];
	$id_mkn = $_GET['id_mkn'];
	$query_update_makanan = mysqli_query($con, "UPDATE menu SET nama_mkn='$nama_mkn', jenis_mkn='$jenis_mkn', ket_mkn='$ket_mkn' WHERE id_mkn='$id_mkn'");

	if($query_update_makanan){
		echo "Update Berhasil";
	}
	else{
		echo mysqli_error($con);
	}
	break;

	case "delete";
	@$id_mkn = $_GET['id_mkn'];
	$query_delete_makanan = mysqli_query($con, "DELETE FROM menu WHERE id_mkn='$id_mkn' ");
	if ($query_delete_makanan){
		echo "Data berhasil Dihapus";
	}
	else{
		echo mysqli_error($con);
	}
	break;
	default;
	break;
}
?>
