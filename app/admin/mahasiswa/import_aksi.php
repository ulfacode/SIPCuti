<!-- import excel ke mysql -->
<!-- www.malasngoding.com -->

<?php
// menghubungkan dengan koneksi
include '../../config/koneksi.php';
// menghubungkan dengan library excel reader
include "../../../public/excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['filemahasiswa']['name']);
move_uploaded_file($_FILES['filemahasiswa']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filemahasiswa']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filemahasiswa']['name'], false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 2; $i <= $jumlah_baris; $i++) {

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nim = $data->val($i, 1);
	$email = $data->val($i, 2);
	$doswal = $data->val($i, 3);
	$kajur = $data->val($i, 4);
	$password = $data->val($i, 5);
	$nama     = $data->val($i, 6);
	$thn_angkatan = $data->val($i, 7);
	$kelas = $data->val($i, 8);
	$tempat_lhr = $data->val($i, 9);
	$tgl_lhr = $data->val($i, 10);
	$jk = $data->val($i, 11);
	$alamat   = $data->val($i, 12);
	$no_telp  = $data->val($i, 13);

	// cari nama doswal dan kajur
	$cekD = mysqli_query($conn, "SELECT nip_npak, nama, jabatan FROM tb_pegawai WHERE nama = $doswal");
	$cekK = mysqli_query($conn, "SELECT nip_npak, nama, jabatan FROM tb_pegawai WHERE nama = $kajur");

	// cari id_doswal
	if ($cekD > 0) {
		$dataD = mysqli_fetch_assoc($cekD);
		if($dataD['jabatan']=='Dosen Wali' OR $dataD['jabatan']=='Dosen Wali dan Ketua Jurusan'){
			$data_doswal =  mysqli_query($conn, "SELECT id_doswal FROM tb_doswal WHERE nip_npak=$data[nip_npak]");
			$dataDoswal = mysqli_fetch_assoc($data_doswal);
			$id_doswal = $dataDoswal['id_doswal'];
		}else{
			echo "Data dosen wali tidak ditemukan!";
		}
	}else{
		echo "Nama dosen wali tidak ditemukan!";
	}
	
	// cari id_kajur
	if ($cek_kajur > 0) {
		$dataK = mysqli_fetch_assoc($cek_kajur);
		if($dataK['jabatan']=='Ketua Jurusan' OR $dataK['jabatan']=='Dosen Wali dan Ketua Jurusan'){
			$data_kajur =  mysqli_query($conn, "SELECT id_kajur FROM tb_kajur WHERE nip_npak=$data[nip_npak]");
			$dataKajur = mysqli_fetch_assoc($data_kajur);
			$id_kajur = $dataKajur['id_kajur'];
		}else{
			echo "Data ketua jurusan tidak ditemukan!";
		}
	}else{
		echo "Nama ketua jurusan tidak ditemukan!";
	}


	mysqli_query($conn, "INSERT into data_mahasiswa (nim, email, id_doswal, id_kajur, password, nama, thn_angkatan,
							kelas, tempat_lhr, tgl_lhr, jk, alamat, no_telp) values('$nim','$email','$id_doswal','$id_kajur','$password','$nama',
							'$thn_angkatan','$kelas','$tempat_lhr','$tgl_lhr','$jk','$alamat','$telepon')");
	$berhasil++;
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filemahasiswa']['name']);

// alihkan halaman ke index.php
header("location:index.php?berhasil=$berhasil");
?>