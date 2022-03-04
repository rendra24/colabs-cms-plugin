<?= $this->extend('general_layout'); ?>
<?= $this->section('breadcrumb'); ?>
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item">CMS</li>
    <li class="breadcrumb-item active">Kategori Konten</li>
</ol>
<?= $this->endSection('breadcrumb'); ?>
<?= $this->section('main'); ?>
<div class="container-fluid">
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Kategori Konten</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-success mb-2 float-right" data-toggle="modal" data-target="#modalSide"
                    data-page="cms/kategori/form">
                    <div class="c-icon mr-1 cil-plus"></div>
                    <span>Tambah Kategori</span>
                </button>
                <div class="table-responsive">
                    <table id="tableAjax" class="tableAjax table table-bordered table-striped w-100"
                        data-source="<?= base_url('cms/kategori/data'); ?>">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('main'); ?>