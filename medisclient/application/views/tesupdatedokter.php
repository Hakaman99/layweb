<!DOCTYPE html>
<html>
<head>
    <title>Update Form Dokter</title>
</head>
<body>

<script type="text/javascript">
    
    var arr = <?=$result?>;
    var z= 1;
    document.write("<form action='http://localhost/medisclient/index.php/dokter/updateDataDokter' method='post'>");
    for (var i =0;i < arr.length; i++) {
            document.write("<input name='id' type='hidden' value='"+arr[i].id+"'><br> ");
            document.write("<input name='nama' type='text' value='"+arr[i].nama+"'><br> ");
            document.write("<input name='jeniskelamin' type='text' value='"+arr[i].jenis_kelamin+"'><br> ");
            document.write("<input name='profesi' type='text' value='"+arr[i].profesi+"'><br> ");
            document.write("<button type='submit'>Proses</button>");
    }
    document.write("</form>");
</script>
</body>
</html>
