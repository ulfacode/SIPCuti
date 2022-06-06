<!-- modal tambah keterangan -->
<div class="modal fade" id="modal-keterangan<?php echo $row_user['id_pengajuan'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Keterangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?php echo $row_user['id_pengajuan'] ?>">
                        <input type="hidden" name="nip_npak" value="<?php echo $nip_npak?>">
                        <div class="form-group">
                            <label for="">Keterangan Menolak Pengajuan</label>
                            <textarea class="form-control" name="keterangan" id="" cols="50" rows="10"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

            </div>
            <div class="modal-footer justify-content-between">

                <!-- untuk submit name nya harus sama dengan isset -->
                <button onclick="window.location.reload();" class="btn btn-primary">Tutup</button>
                <button class="btn btn-primary" name="simpan">Simpan</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- ./modal tambah keterangan -->