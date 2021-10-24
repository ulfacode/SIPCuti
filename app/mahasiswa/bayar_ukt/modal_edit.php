<div class="modal fade" id="myModal<?php echo $row_user['id_bayar']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $id = $row_user["id_bayar"];
            $data = mysqli_query($conn, "SELECT * FROM tb_bayar WHERE id_bayar = '$id'");
            while ($bayar = mysqli_fetch_array($data)) {
            ?>

                <div class="modal-body">
                    <!-- form start -->
                    <form action="" method="POST">

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $bayar["id_bayar"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="number" class="form-control" id="nim" name="nim" value="<?= $bayar["nim"]; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">UKT Semester</label>
                            <input type="number" class="form-control" name="ukt_smt" value="<?= $bayar["ukt_smt"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" value="<?= $bayar["jumlah"]; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="">Bukti Bayar</label>
                            <div class="input-group">
                                <a class="btn btn-light" data-toggle="modal" data-target="#editBukti">
                                    <i class="fa fa-edit" style="color: green;"></i> Edit
                                </a>

                            </div>
                        </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <a type="submit" onclick='window.location.reload();' class="btn btn-default" data-dismiss="modal">Tutup</a>

                    <!-- untuk submit name nya harus sama dengan function -->
                    <button name="edit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>

            <?php
                include "modal_edit_bukti.php";
            }
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->