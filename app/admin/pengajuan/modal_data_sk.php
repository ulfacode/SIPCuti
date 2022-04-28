<!-- Modal Insert Data SK  yaitu no dan tgl-->
<div class="modal fade" id="dataSK<?php echo $row_user['id_pengajuan']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Surat Keputusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" enctype="multipart/form-data" method="POST">
                    <?php
                    $query     = mysqli_query($conn, "SELECT * FROM tb_pengajuan WHERE id_pengajuan='$row_user[id_pengajuan]'");
                    $result    = mysqli_fetch_array($query);
                    ?>
                    <input type="hidden" name="id_pengajuan" value="<?= $row_user['id_pengajuan']; ?>">

                    <div class="form-group">
                        <label class="float-left">Nomor Surat Keputusan</label>
                        <input type="text" class="form-control" name="no_sk" value="<?php echo $result['no_sk']; ?>">
                    </div>

                    <!-- tanggal SK ditetapkan/diterbitkan -->
                    <div class="form-group">
                        <label class="float-left">Tanggal Surat Keputusan</label>
                        <input type="date" class="form-control" name="tgl_sk" value="<?php echo $result['tgl_sk']; ?>">
                    </div>

            </div>
            <div class="modal-footer">

                <!-- untuk submit name nya harus sama dengan isset -->
                <button name="data_SK" class="btn btn-primary">Simpan</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /modal upload sk cuti -->