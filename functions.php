<?php
	require("dbconnection.php");
	session_start();
	function getNumRowsQuery($query) {
		global $sqlconnection;
		if ($result = $sqlconnection->query($query))
			return $result->num_rows;
		else
			echo "Something wrong the query!";
	}
	function getFetchAssocQuery($query) {
		global $sqlconnection;
		if ($result = $sqlconnection->query($query)) {
			
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        		echo "\n", $row["itemID"], $row["menuID"], $row["menuItemName"], $row["price"];
    		}
			return ($result);
		}
		else
			echo "Something wrong the query!";
			echo $sqlconnection->error;
	}
	function getLastID($id,$table) {
		global $sqlconnection;

		$query = "SELECT MAX({$id}) AS {$id} from {$table} ";

		if ($result = $sqlconnection->query($query)) {
			
			$res = $result->fetch_array();

			if ($res[$id] == NULL)
				return 0;

			return $res[$id];
		}
		else {
			echo $sqlconnection->error;
			return null;
		}
	}

	function getCountID($idnum,$id,$table) {
		global $sqlconnection;

		$query = "SELECT COUNT({$id}) AS {$id} from {$table} WHERE {$id}={$idnum}";

		if ($result = $sqlconnection->query($query)) {
			
			$res = $result->fetch_array();
			if ($res[$id] == NULL)
				return 0;

			return $res[$id];
		}
		else {
			echo $sqlconnection->error;
			return null;
		}
	}

	function getSalesTotal($orderID) {
		global $sqlconnection;
		$total = null;

		$query = "SELECT total FROM tbl_order WHERE orderID = ".$orderID;

		if ($result = $sqlconnection->query($query)) {
		
			if ($res = $result->fetch_array()) {
				$total = $res[0];
				return $total;
			}

			return $total;
		}

		else {

			echo $sqlconnection->error;
			return null;

		}
	}

	function getSalesGrandTotal($duration) {
		global $sqlconnection;
		$total = 0;

		if ($duration == "ALLTIME") {
			$query = "
					SELECT SUM(total) as grandtotal
					FROM tbl_order
					";
		}

		else if ($duration == ("DAY" || "MONTH" || "WEEK")) {

			$query = "
					SELECT SUM(total) as grandtotal
					FROM tbl_order

					WHERE order_date > DATE_SUB(NOW(), INTERVAL 1 ".$duration.")
					";
		}

		else 
			return null;

		if ($result = $sqlconnection->query($query)) {
		
			while ($res = $result->fetch_array(MYSQLI_ASSOC)) {
				$total+=$res['grandtotal'];
			}

			return $total;
		}

		else {

			echo $sqlconnection->error;
			return null;

		}
	}

	function updateTotal($orderID) {
		global $sqlconnection;

		$query = "
			UPDATE tbl_order o
			INNER JOIN (
			    SELECT SUM(OD.quantity*mi.price) AS total
			        FROM tbl_order O
			        LEFT JOIN tbl_orderdetail OD
			        ON O.orderID = OD.orderID
			        LEFT JOIN tbl_menuitem MI
			        ON OD.itemID = MI.itemID
			        LEFT JOIN tbl_menu M
			        ON MI.menuID = M.menuID
			        
			        WHERE o.orderID = ".$orderID."
			) x
			SET o.total = x.total
			WHERE o.orderID = ".$orderID."
		";

		if ($sqlconnection->query($query) === TRUE) {
				echo "updated.";
			} 

		else {
				echo "someting wong";
				echo $sqlconnection->error;

		}

	}
	if(isset($_POST['addnewbarang'])){
		$namabarang = $_POST['namabarang'];
		$deskripsi = $_POST['deskripsi'];
		$stok = $_POST['stok'];
	
		$addtotable = mysqli_query($sqlconnection, "insert into stock (namabarang, deskripsi, stok) values ('$namabarang', '$deskripsi', '$stok')");
		if($addtotable){
			header('location:index.php');
		}else{
	echo "gagal";
	header('location:index.php');
		}
	
	};
	
	// menambah barang masuk
	if(isset($_POST['barangmasuk'])){
		$barangnya = $_POST['barangnya'];
		$penerima = $_POST['penerima'];
		$qty = $_POST['qty'];
		
		$cekstoksekarang = mysqli_query($sqlconnection, "select * from stock where idbarang='$barangnya'");
		$ambildatanya = mysqli_fetch_array($cekstoksekarang);
	
		$stoksekarang = $ambildatanya['stok'];
		$tambahstoksekarangdenganqty = $stoksekarang + $qty;
	
		$addtomasuk = mysqli_query($sqlconnection, "insert into masuk (idbarang, keterangan, qty) values('$barangnya','$penerima', '$qty')");
		$updatestok = mysqli_query($sqlconnection, "update stock set stok='$tambahstoksekarangdenganqty' where idbarang='$barangnya'");
	
		if($addtomasuk&&$updatestok){
			header('location:masuk.php');
		}else{
	echo "gagal";
	header('location:masuk.php');
		}
	};
	
	// menambah barang keluar
	if(isset($_POST['barangkeluar'])){
		$barangnya = $_POST['barangnya'];
		$penerima = $_POST['penerima'];
		$qty = $_POST['qty'];
		
		$cekstoksekarang = mysqli_query($sqlconnection, "select * from stock where idbarang='$barangnya'");
		$ambildatanya = mysqli_fetch_array($cekstoksekarang);
	
		$stoksekarang = $ambildatanya['stok'];
		$tambahstoksekarangdenganqty = $stoksekarang - $qty;
	
		$addtokeluar = mysqli_query($sqlconnection, "insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima', '$qty')");
		$updatestok = mysqli_query($sqlconnection, "update stock set stok='$tambahstoksekarangdenganqty' where idbarang='$barangnya'");
	
		if($addtokeluar&&$updatestok){
			header('location:keluar.php');
		}else{
	echo "gagal";
	header('location:keluar.php');
		}
	};

?>