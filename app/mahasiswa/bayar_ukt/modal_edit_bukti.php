<!-- Modal Edit Bukti-->
<div class="modal fade" id="editBukti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit Bukti</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" enctype="multipart/form-data" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="id_bayar" value="<?= $bayar['id_bayar']; ?>">
                    <input type="hidden" name="nim" value="<?= $bayar['nim']; ?>">

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
                <div class="modal-footer">
                    <!-- untuk submit name nya harus sama dengan function -->
                    <button name="editBukti" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /modal edit bukti -->