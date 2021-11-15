<div class="modal fade" id="tambahBayar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Bukti Bayar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" enctype="multipart/form-data" method="POST">
                    <?php

                    $tb_mhs = sql("SELECT * FROM tb_mahasiswa ORDER BY nama ASC");

                    ?>
                    <div class="form-group">
                        <!-- nim berdasarkan yang login -->
                        <label for="nim">NIM</label>
                        <input type="number" class="form-control" name="nim" value="<?php echo $_SESSION['nim']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">UKT Semester</label>
                        <input type="number" class="form-control" name="ukt_smt" placeholder="Isikan UKT untuk semester berapa!" min="1" max="6" required>
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" placeholder="Isikan jumlah UKT tanpa titik!" required>
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="tgl_bayar" value="<?php echo date("Y-m-d"); ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Bukti Bayar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="bukti">
                                <label class="custom-file-label" for=""></label>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer justify-content-between">
                <a href="" type="button" class="btn btn-default" data-dismiss="modal" onclick='window.location.reload();'>Tutup</a>

                <!-- untuk submit name nya harus sama dengan function -->
                <button name="tambah" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->