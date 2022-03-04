<?= $this->extend('general_layout'); ?>
<?= $this->section('breadcrumb'); ?>
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item">Website CMS</li>
    <li class="breadcrumb-item active">Pengaturan</li>
</ol>
<?= $this->endSection('breadcrumb'); ?>
<?= $this->section('main'); ?>
<div class="container-fluid">
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Pengaturan</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('cms/setting/save'); ?>" class="ajax" data-respond="reload">
                    <?php foreach ($data as $key => $item) : ?>
                    <div class="form-group row mb-1">
                        <input type="hidden" name="id[]" value="<?= $item['id'] ?>">
                        <label class="col-md-3 col-form-label" for="input-<?= $key ?>"><?= $item['name'] ?></label>
                        <div class="col-md-7">
                            <input class="form-control" id="input-<?= $key ?>" type="text" name="data[]"
                                value="<?= $item['value'] ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="c-switch c-switch-pill c-switch-lg c-switch-success">
                                <input name="flag[]" class="c-switch-input" type="checkbox"
                                    <?= (@$item['status'] == '1' ? 'checked' : '') ?> value="1"><span
                                    class="c-switch-slider"></span>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('main'); ?>