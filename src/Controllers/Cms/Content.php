<?php

namespace App\Controllers\Cms;

use App\Controllers\BaseController;

class Content extends BaseController
{
    public function __construct()
    {
        helper(['ckeditor']);
        $this->menuModel = model('CMS/Menu');
        $this->kontenModel = model('CMS/Content');
    }
    public function list()
    {
        $menu = $this->request->getGet('menu');
        $check_menu = $this->menuModel->where('slug', $menu)->first();


        if ($check_menu) {
            $data['menu'] = 'cms';
            $data['submenu'] = $menu;
            $data['data_menu'] = $check_menu;

            
            return view('cms/content/data', $data);
        } else {
            return redirect()->to(base_url('cms/menu'));
        }
    }
    public function data()
    {
        $id_menu = $this->request->getGet('menu');
        $model = $this->kontenModel;
        $data = $model->where('menu_id', $id_menu)->find();

        $gData['table']['title'] = 'No|Judul|Banner|Isi|Aksi';
        $gData['table']['data'] = 'no|title|thumbnail|description|action';
        $gData['data'] = $data;
        $gData['no'] = true;
        $gData['action'] = 'edit-href|delete';
        $gData['url']['edit-href'] = 'cms/content/form';
        $gData['url']['delete'] = 'cms/content/delete';
        $gData['helper']['thumbnail'] = ['formatImg', '{data}'];
        $data = jsonGenrateTables('success', $gData);
        return $this->respond($data);
    }
    public function form($id = null)
    {
        $menu = $this->request->getGet('menu');

        $model = $this->kontenModel;
        $modelKat = model('CMS/Category');
        $data = [];
        if ($id != null) {
            $data = $model->where('id', $id)->first();
            $check_menu = $this->menuModel->where('id', $data['menu_id'])->first();
            $data['data_menu'] = $check_menu;
            $data['categories'] = $modelKat->findAll();
        } else {
            $check_menu = $this->menuModel->where('id', $menu)->first();
            $data['data_menu'] = $check_menu;
            $data['categories'] = $modelKat->findAll();
            
        }
        return view('cms/content/_form', $data);
    }
    public function save()
    {
        $model = $this->kontenModel;
        $validation =  \Config\Services::validation();
        $post = $this->request->getPost();
        $slug = new \Cocur\Slugify\Slugify();

        if (!$this->validate($validation->getRuleGroup('cms_konten'))) {
            return $this->respond(jsonRes('validation_error', $validation->getErrors()));
        } else {
            $file = $this->request->getFile('file');
            $post['slug'] = $slug->slugify($post['title']);
            if ($file->getError() != 4) {
                @unlink('uploads/content/' . $post['old_file']);
                $newName = 'konten-' . date('YmdHis') . '.' . $file->guessExtension();
                $file->move('uploads/content/', $newName);
                $post['thumbnail'] = $newName;
            }
            $post['meta_title'] = $post['title'];
            $post['meta_description'] = strip_tags($post['keterangan']);
            $post['description'] = $post['keterangan'];
            $post['meta_keyword'] = $post['meta_keyword'];
            $post['status'] = 1;
            $model->save($post);
            return $this->respond(jsonRes('success'));
        }
    }
    public function delete($id)
    {
        $model = $this->kontenModel;
        $data = $model->where('id', $id)->first();
        @unlink('uploads/' . $data['file']);

        $model->delete($id);
        return $this->respond(jsonRes('success'));
    }
}