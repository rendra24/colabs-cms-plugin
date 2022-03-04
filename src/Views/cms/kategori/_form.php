<form action="<?= base_url('cms/kategori/save') ?>" class="ajax-multipart modal-content" data-respond="reload">
    <?php if (@$id) : ?>
    <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>
    <div class="modal-header">
        <h4 class="modal-title"><?= (!@$id ? 'Tambah' : '') ?> Data Kategori</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label for="nama" class="mb-1">Nama Kategori</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= @$nama ?>">
                <div class="invalid-feedback"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-success float-right" type="submit">Simpan</button>
    </div>
</form>