<!-- modal edit lampiran -->
<div class="modal fade" id="modal_lampiran">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Lampiran</h4>
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
                        <label for="">Lampiran</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="lampiran" id="lampiran" accept=".pdf">
                            <label class="custom-file-label" for=""></label>
                            <p style="color: red;">* Lampiran berisi: Bukti UKT, KTM, Kartu Perpus, Surat Keterangan Sakit (yang relevan) dalam bentuk PDF!</p>
                            <p style="color: red;">* Maksimal 10MB!</p>
                        </div>
                    </div>
                    <br><br><br>
            </div>
            <div class="modal-footer">
                <!-- untuk submit name nya harus sama dengan function -->
                <button name="editLampiran" class="btn btn-primary">Simpan</button>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->