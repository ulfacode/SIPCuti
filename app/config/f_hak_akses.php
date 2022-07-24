<?php
$conn = mysqli_connect("localhost", "root", "", "si_cuti");


function tambah($data)
{
    global $conn;
    $id = $data["id"];
    $id_jabatan = $data["id_jabatan"];
    $jml_jabatan = count($id_jabatan);

    for ($i = 0; $i < $jml_jabatan; $i++) {
        $sql = mysqli_query($conn, "SELECT * FROM tb_hak_akses");
        $result = mysqli_fetch_array($sql);

        if (($result['id_pegawai'] == $id) and ($result['id_jabatan'] == $id_jabatan[$i])) {
            echo "<script>
        alert('Hak akses sudah terdaftar!');
        </script>";
        } else {
            mysqli_query($conn, "INSERT INTO tb_hak_akses 
            (id_pegawai, id_jabatan) 
            VALUES 
            ('$id', '$id_jabatan[$i]')");

            return mysqli_affected_rows($conn);
        }
    }
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
    $id_pegawai = $data["id_pegawai"];
    $id_jabatan = $data["id_jabatan"];

    $sql = mysqli_query($conn, "SELECT id_jabatan FROM tb_hak_akses WHERE id_pegawai = '$id_pegawai'");
    $result = mysqli_fetch_array($sql);

    if ($result['id_jabatan'] == $id_jabatan) {
        echo "<script>
        alert('Hak akses sudah terdaftar!');
        </script>";
    } else {
        $query = "UPDATE tb_hak_akses SET id_jabatan='$id_jabatan' WHERE id_hak_akses='$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}
