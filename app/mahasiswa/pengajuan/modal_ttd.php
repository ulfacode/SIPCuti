<!-- modal edit ttd ortu -->
<div class="modal fade" id="edit_ttd">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Tanda Tangan Orang Tua</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST">

                    <input type="hidden" class="form-control" name="id_pengajuan" value="<?= $pj["id_pengajuan"]; ?>">
                    <input type="hidden" class="form-control" name="jns_pengajuan" value="<?= $pj["jns_pengajuan"]; ?>">
                    <input type="hidden" class="form-control" id="nim" name="nim" value="<?= $pj["nim"]; ?>">

                    <div class="form-group">
                        <label for="">Tanda Tangan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="ttd_ortu">
                            <label class="custom-file-label" for=""></label>
                            <p style="color: red;">* Upload file dalam bentuk (jpg/jpeg/png) dan transparan!</p>
                            <p style="color: red;">* Maksimal 10MB!</p>
                        </div>
                    </div>
                    <br><br><br>
            </div>
            <div class="modal-footer">
                <!-- untuk submit name nya harus sama dengan function -->
                <button name="editTTD" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->