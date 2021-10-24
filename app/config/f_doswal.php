<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


function tambah($data)
{
    global $conn;
    $nip = $data["nip"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];

    $query = "INSERT INTO tb_doswal (nip_npak, thn_jabatan, status) VALUES ('$nip', '$thn_jabatan', '$status')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $id_doswal = $data["id"];
    $nip_npak = $data["nip"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];

    $query = "UPDATE tb_doswal SET nip_npak='$nip_npak', thn_jabatan='$thn_jabatan', status='$status' WHERE id_doswal='$id_doswal'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// untuk menampilkan data nama penyewa dan nama kamar dari database
function sql($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_doswal WHERE id_doswal = '$id'");

    return mysqli_affected_rows($conn);
}
