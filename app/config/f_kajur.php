<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


function tambah($data)
{
    global $conn;
    $nip = $data["nip"];
    $nm_jurusan = $data["nm_jurusan"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];

    $query = "INSERT INTO tb_kajur 
                (nip_npak, nm_jurusan, thn_jabatan, status) 
                VALUES 
                ('$nip', '$nm_jurusan', '$thn_jabatan', '$status')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $id_kajur = $data["id"];
    $nip_npak = $data["nip"];
    $nm_jurusan = $data["nm_jurusan"];
    $thn_jabatan = $data["thn_jabatan"];

    $query = "UPDATE tb_kajur SET nip_npak='$nip_npak', nm_jurusan='$nm_jurusan', thn_jabatan='$thn_jabatan' WHERE id_kajur='$id_kajur'";
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
    mysqli_query($conn, "DELETE FROM tb_kajur WHERE id_kajur = '$id'");

    return mysqli_affected_rows($conn);
}
