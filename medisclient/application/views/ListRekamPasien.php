<!DOCTYPE html>
<html>
<head>
	<title>List Data Pasien</title>
</head>
<body>
<script type="text/javascript">
	document.write("<table border=1px solid");

	document.write("<tr>");
	document.write("<th>Nomor</th>");
	document.write("<th>Nama</th>");
	document.write("<th>Jenis Kelamin</th>");
	document.write("<th>NIK</th>");
	document.write("<th>No Telepon</th>");
	document.write("<th>Alamat</th>");
	document.write("<th>Tanggal Lahir</th>");
	document.write("<th>Golongan Darah</th>");
	document.write("<th colspan='2'>Action</th>");
	document.write("</tr>");
	var arr = <?=$result?>;

	var z= 1;
	for (var i =0;i < arr.length; i++) {
			document.write("<tr>");
			document.write("<td>"+(z++)+ "</td>");
			document.write("<td>"+arr[i].nama+ "</td>");
			document.write("<td>"+arr[i].jenis_kelamin+ "</td>");
			document.write("<td>"+arr[i].nik+ "</td>");
			document.write("<td>"+arr[i].no_tlp+ "</td>");
			document.write("<td>"+arr[i].alamat+ "</td>");
			document.write("<td>"+arr[i].tanggal_lahir+ "</td>");
			document.write("<td>"+arr[i].golongan_darah+ "</td>");
			document.write("<td><a href='dataPasien/"+arr[i].id+"'>edit</a></td>");
			document.write("<td><a href='deletePasien/"+arr[i].id+"'>delete</a></td>");
			document.write("</tr>");
	}
	document.write("</table>")
</script>

</body>
</html>