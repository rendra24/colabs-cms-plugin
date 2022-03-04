<?= $this->extend('general_layout'); ?>
<?= $this->section('breadcrumb'); ?>
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item">CMS</li>
    <li class="breadcrumb-item active"><?= $data_menu['nama_menu'] ?></li>
</ol>
<?= $this->endSection('breadcrumb'); ?>
<?= $this->section('main'); ?>
<div class="container-fluid">
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Konten <?= $data_menu['nama_menu'] ?></h5>
            </div>
            <div class="card-body">

                <form action="<?= base_url('cms/content/save') ?>" class="ajax-cms-multipart">
                    <?php if (@$id) : ?>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <?php endif; ?>
                    <input type="hidden" name="menu_id" value="<?= $data_menu['id'] ?>">
                    <input type="hidden" name="old_file" value="<?= @$thumbnail ?>">



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="category_id" id="kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach($categories as $row): ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title" class="mb-1">Judul</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?= @$title ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword" class="mb-1">Meta Keyword</label>
                                <input type="text" name="meta_keyword" id="meta_keyword" class="form-control"
                                    value="<?= @$meta_keyword ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="banner" class="mb-1">Gambar Banner</label>
                                <input type="file" name="file" id="banner" class="form-control-file">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="editor" class="mb-1">Konten</label>
                                <textarea name="keterangan"
                                    class="mytextarea form-control"><?= @$description ?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>



                    <button class="btn btn-success float-right mt-3" type="submit">Simpan</button>

                </form>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection('main'); ?>