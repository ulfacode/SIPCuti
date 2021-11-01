<!-- Modal Upload SK-->
<div class="modal fade" id="uploadSKcuti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Surat Keputusan Cuti</h4>
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
                    <input type="hidden" name="nim" value="<?= $row_user['nim']; ?>">

                    <div class="form-group">
                        <label class="float-left">Surat Keputusan</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="upload_sk">
                                <label class="custom-file-label" for=""></label>
                            </div>
                            <div class="input-group-append">
                                <a class="input-group-text" href="surat_keputusan/<?php echo $result['upload_sk']; ?>"><i class="fa fa-download"></i> Cek Berkas SK</a>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">

                <!-- untuk submit name nya harus sama dengan isset -->
                <button name="up_SK" class="btn btn-primary">Simpan</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /modal upload sk cuti -->