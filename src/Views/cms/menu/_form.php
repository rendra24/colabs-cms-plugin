<form action="<?= base_url('cms/menu/save') ?>" class="ajax-multipart modal-content" data-respond="reload">
    <?php if (@$id) : ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>
    <input type="hidden" name="old_img" value="<?= @$img ?>">
    <div class="modal-header">
        <h4 class="modal-title"><?= (!@$id ? 'Tambah' : '') ?> Data Menu</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label for="nama" class="mb-1">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= @$nama ?>">
                <div class="invalid-feedback"></div>
            </div>
            <div class="col-md-12 mt-2">
                <label for="banner" class="mb-1">Banner</label>
                <input type="file" name="img" id="banner" class="form-control-file">
                <div class="invalid-feedback"></div>
            </div>
            <div class="col-md-12 mt-2">
                <label for="keterangan" class="mb-1">Keteranagan</label>
                <textarea name="keterangan" id="keterangan" class="form-control"><?= @$keterangan ?></textarea>
                <div class="invalid-feedback"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-success float-right" type="submit">Simpan</button>
    </div>
</form>