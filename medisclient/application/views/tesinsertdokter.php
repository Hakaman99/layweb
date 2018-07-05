<!DOCTYPE HTML>
<html>
<head>
	<title>Tambah Data Dokter</title>
</head>
<body>
	<h2>Tambah Data Dokter via SOAP</h2>
	<form method="post" action="<?php echo $action; ?>">

		<input type="text" name="nama" required="required" placeholder="nama" />
		<br/>
		<input type="text" name="jeniskelamin" required="required"placeholder="jenis kelamin" />
		<br/>
		<input type="text" name="profesi" required="required" placeholder="profesi" />
		<br/>
		<button type="submit">Proses</button>

	</form>

</body>
</html>