<!-- Modal Edit ttd-->
<div class="modal fade" id="modalEditTTD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit TTD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form edit foto -->
                <form action="" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="nim" value="<?= $mhs['nim']; ?>">
                    <input type="hidden" name="nama" value="<?= $mhs['nama']; ?>">

                    <div class="form-group">
                        <label for="">Tanda Tangan</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ttd">
                                <label class="custom-file-label" for=""></label>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <!-- untuk submit name nya harus sama dengan function -->
                <button name="editTTD" class="btn btn-primary">Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /modal edit ttd -->