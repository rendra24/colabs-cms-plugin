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
                <a class="btn btn-success mb-2 float-right"
                    href="<?= base_url('cms/content/form?menu=' . $data_menu['id']); ?>">
                    <div class="c-icon mr-1 cil-plus"></div>
                    <span>Tambah Konten <?= $data_menu['nama_menu'] ?></span>
                </a>
                <div class="table-responsive">
                    <table id="tableAjax" class="tableAjax table table-bordered table-striped w-100"
                        data-source="<?= base_url('cms/content/data?menu=' . $data_menu['id']); ?>">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('main'); ?>