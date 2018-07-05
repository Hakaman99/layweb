<!DOCTYPE HTML>
<html>
<head>
	<title>Tes Penjumlahan</title>
</head>
<body>
	<h2>Rekam Data Pasien</h2>
	<form method="post" action="<?php echo $action; ?>">

		<input type="text" name="nama" required="required" placeholder="nama" />
		<br/>
		<input type="text" name="jeniskelamin" required="required"placeholder="jenis kelamin" />
		<br/>
		<input type="text" name="nik" required="required" placeholder="nik" />
		<br/>
		<input type="text" name="notlp" required="required" placeholder="no telepon" />
		<br/>
		<input type="text" name="alamat" required="required" placeholder="alamat" />
		<br/>
		<input type="date" name="tanggallahir" required="required"/>
		<br/>
		<input type="text" name="golongandarah" required="required" placeholder="golongan darah" />
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