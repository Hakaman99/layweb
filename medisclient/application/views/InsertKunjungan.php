<!DOCTYPE HTML>
<html>
<head>
	<title>Tes Penjumlahan</title>
</head>
<body>
	<h2>Rekam Data Pasien</h2>
	<form method="post" action="<?php echo $action; ?>">

		<input type="text" name="idpasien" required="required" placeholder="id pasien" />
		<br/>
		<input type="text" name="iddokter" required="required"placeholder="jenis kelamin" />
		<br/>
		<input type="text" name="keterangan" required="required" placeholder="nik" />
		<br/>
		<input type="date" name="tanggalkunjungan" required="required" placeholder="no telepon" />
		<br/>
		<input type="text" name="keluhan" required="required" placeholder="alamat" />
		<br/>
		<input type="text" name="diagnosis" required="required"/>
		<br/>
		<button type="submit">Proses</button>

	</form>

</body>
</html>

<?php
	if(isset($error)){
		echo $error;
	}
	if(isset($fault)){
		echo $fault; 
	}
	if(isset($result)){
		echo $result;
	}
?>