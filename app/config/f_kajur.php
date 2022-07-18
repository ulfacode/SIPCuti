<?php
$conn = mysqli_connect("localhost", "root", "", "si_cuti");


function tambah($data)
{
    global $conn;
    $id_pegawai = $data["id_pegawai"];
    $nm_jurusan = $data["nm_jurusan"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];

    $query = mysqli_query($conn, "SELECT id_pegawai FROM tb_kajur WHERE id_pegawai = '$id_pegawai'");

    if ($query->num_rows > 0) {
        echo "<script>alert('Data tersebut sudah terdaftar!');</script>";
    } else {
        $query = "INSERT INTO tb_kajur 
                (id_pegawai, nm_jurusan, thn_jabatan, status) 
                VALUES 
                ('$id_pegawai', '$nm_jurusan', '$thn_jabatan', '$status')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}

function edit($data)
{
    global $conn;
    $id_kajur = $data["id"];
    $nm_jurusan = $data["nm_jurusan"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];

    $query = "UPDATE tb_kajur SET nm_jurusan='$nm_jurusan', thn_jabatan='$thn_jabatan', status='$status' WHERE id_kajur='$id_kajur'";
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
