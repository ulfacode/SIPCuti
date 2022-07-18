<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


function tambah($data)
{
    global $conn;
    $nip = $data["nip"];
    $id_jabatan = $data["id_jabatan"];
    $jml_jabatan = count($id_jabatan);

    for($i=0; $i<$jml_jabatan; $i++){
    mysqli_query($conn, "INSERT INTO tb_hak_akses 
    (nip_npak, id_jabatan) 
    VALUES 
    ('$nip', '$id_jabatan[$i]')");
    }
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_hak_akses WHERE id_hak_akses = '$id'");

    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $id = $data["id"];
    $id_jabatan = $data["id_jabatan"];
    
    $query = "UPDATE tb_hak_akses SET id_jabatan='$id_jabatan' WHERE id_hak_akses='$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}