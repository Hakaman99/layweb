<!DOCTYPE html>
<html>
<head>
	<title>Update Form Update</title>
</head>
<body>

	<script type="text/javascript">
		
		var arr = <?=$result?>;
		var z= 1;
		document.write("<form action='http://localhost/medisclient/index.php/rekamdatapasien/setDataUpdate' method='post'>");
		for (var i =0;i < arr.length; i++) {
			document.write("<input name='id' type='hidden' value='"+arr[i].id+"'><br> ");
			document.write("<input name='nama' type='text' value='"+arr[i].nama+"'><br> ");
			document.write("<input name='jeniskelamin' type='text' value='"+arr[i].jenis_kelamin+"'><br> ");
			document.write("<input name='nik' type='text' value='"+arr[i].nik+"'><br> ");
			document.write("<input name='notlp' type='text' value='"+arr[i].no_tlp+"'><br>");
			document.write("<input name='alamat' type='text' value='"+arr[i].alamat+"'><br>");
			document.write("<input name='tanggallahir' type='text' value='"+arr[i].tanggal_lahir+"'><br>");
			document.write("<input name='golongandarah' type='text' value='"+arr[i].golongan_darah+"'><br>");
			document.write("<button type='submit'>Proses</button>");

		}
		document.write("</form>");
	</script>
</body>
</html>