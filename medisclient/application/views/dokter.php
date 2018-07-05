
<script>

    document.write("<table border='1px' solid>");
    document.write("<tr>");
    document.write("<th>Nama</th>");
    document.write("<th>Jenis Kelamin</th>");
    document.write("<th>Profesi</th>");
    // document.write("<th>Action</th>");
    document.write("</tr>");

    var arr = <?= $result; ?>;

    for(i = 0; i < arr.length; i++) {
        document.write("<tr>");
        document.write("<td>"+arr[i].nama+"</td>");
        document.write("<td>"+arr[i].jenis_kelamin+"</td>");
        document.write("<td>"+arr[i].profesi+"</td>");
        document.write("<td><a href='dokter/listUpdateDokter/"+arr[i].id+"'>edit</a></td>");
        document.write("<td><a href='dokter/deleteDokter/"+arr[i].id+"'>delete</a></td>");
        document.write("</tr>");
    }
    document.write("</table>");

</script>
