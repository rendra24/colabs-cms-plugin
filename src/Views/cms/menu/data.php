<?= $this->extend('general_layout'); ?>
<?= $this->section('breadcrumb'); ?>
<style></style>
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item">Website CMS</li>
    <li class="breadcrumb-item active">Menu</li>
</ol>
<?= $this->endSection('breadcrumb'); ?>
<?= $this->section('main'); ?>
<div class="container-fluid">
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Menu</h5>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-lg-7">
                        <h4>Menu</h4>
                        <?php if(count($menus) > 0){ ?>
                        <form id="form-sort">
                            <div id="nestedDemo" class="list-group col nested-sortable">
                                <?php 
                            $no=1;
                            foreach($menus as $row): 
                            ?>

                                <div class="list-group-item" data-id="<?= $no; ?>">
                                    <i class="c-icon cil-move"></i>
                                    <?= $row['nama_menu']; ?>
                                    <input type="hidden" name="id_menu[]" value="<?= $row['id']; ?>">

                                    <a href="#" class="float-right get-data"
                                        data-url="<?= base_url('cms/menu/get_menu'); ?>" key="<?= $row['id']; ?>">
                                        <i class="c-icon cil-pencil"></i>
                                    </a>
                                    <?php 
                                        $db = \Config\Database::connect();
                                        $get = $db->table('cms_menu_sub')->where('menu_id', $row['id'])->get()->getResultArray();

                                        if(count($get) > 0){
                                        echo '<div class="list-group nested-sortable">';

                                        foreach($get as $sub):
                                    ?>
                                    <div class="list-group-item"><?= $sub['nama_sub']; ?>
                                        <input type="hidden" name="id_submenu[]" value="<?= $sub['id']; ?>">
                                        <a href="#" class="float-right get-data"
                                            data-url="<?= base_url('cms/menu/get_submenu'); ?>"
                                            key="<?= $sub['id']; ?>">
                                            <i class="c-icon cil-pencil"></i>
                                        </a>
                                    </div>
                                    <?php 
                                        endforeach;
                                    echo '</div>';
                                } ?>
                                </div>

                                <?php $no++; endforeach; ?>
                            </div>


                            <button type="submit" class="btn btn-primary float-right mr-3 mt-3">Update Urutan
                                Menu</button>
                        </form>
                        <?php } ?>
                        <!-- <div id="nestedDemo" class="list-group col nested-sortable">
                            <div class="list-group-item" data-id="1">Titel 1</div>
                            <div class="list-group-item" data-id="2">Titel 2</div>
                            <div class="list-group-item" data-id="3">Titel3
                                <div class="list-group nested-sortable">
                                    <div class="list-group-item" data-id="4">Titel 4</div>
                                    <div class="list-group-item" data-id="5">Titel 5</div>
                                    <div class="list-group-item" data-id="6">Titel 6</div>
                                </div>
                            </div>
                            <div class="list-group-item" data-id="7">Titel 7</div>
                            <div class="list-group-item" data-id="8">Titel 8</div>
                            <div class="list-group-item" data-id="9">Titel 9</div>
                            <div class="list-group-item" data-id="10">Titel10
                                <div class="list-group nested-sortable">
                                    <div class="list-group-item" data-id="11">Titel 11</div>
                                    <div class="list-group-item" data-id="12">Titel 12</div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="col-md-5">
                        <form class="form-serialize" data-url="<?= base_url('cms/menu/save'); ?>">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label>Parent</label>
                                <select name="parent" class="form-control"
                                    onchange="toogleParent($(this).val(), 'master_menu');">
                                    <option value="1">Master Menu</option>
                                    <option value="0">Sub Menu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div id="master_menu" style="display:none;">
                                    <label>Menu</label>
                                    <select name="id_menu" class="form-control">
                                        <option value="">Pilih Master Menu</option>
                                        <?php foreach($menus as $row): ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['nama_menu']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_conten">Jenis Konten</label>
                                <select name="content_type" id="category_conten" class="form-control"
                                    onchange="toogleParent($(this).val(), 'master_link');">
                                    <option value="">Pilih Jenis Konten</option>
                                    <option value="1">Konten Berita</option>
                                    <option value="2">Link</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div id="master_link" style="display:none;">
                                    <label>Link</label>
                                    <input type="text" class="form-control" placeholder="Link Internal / External"
                                        name="link">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" class="form-control" placeholder="Nama Menu" name="nama_menu">
                            </div>

                            <div class="form-group">
                                <label>Publish</label> <br>
                                <label class="c-switch c-switch-pill c-switch-lg c-switch-success">
                                    <input name="status" class="c-switch-input" type="checkbox" value="1"><span
                                        class="c-switch-slider"></span>
                                </label>
                            </div>

                            <button class="btn btn-success mt-3 float-right">Simpan Menu</button>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
<?= $this->endSection('main'); ?>