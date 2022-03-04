<?php

namespace App\Controllers\Cms;

use App\Controllers\BaseController;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->loadModel = model('CMS/Category');
    }
    public function list()
    {
        $data['menu'] = 'cms';
        $data['submenu'] = 'kategori';

        return view('cms/kategori/data', $data);
    }

    public function data()
    {
        $model = $this->loadModel;
        $data = $model->findAll();

        $gData['table']['title'] = 'No|Nama Kategori|Status|Aksi';
        $gData['table']['data'] = 'no|nama|status|action';
        $gData['data'] = $data;
        $gData['no'] = true;
        $gData['action'] = 'edit|delete';
        $gData['url']['edit'] = 'cms/newsblog/form';
        $gData['url']['delete'] = 'cms/newsblog/delete';
        $gData['helper']['status'] = ['formatStatus', 'default|{data}'];
        $data = jsonGenrateTables('success', $gData);
        return $this->respond($data);
    }

    public function form($id = null)
    {
        $model = $this->loadModel;
        $data = [];
        if ($id != null) {
            $data = $model->where('id', $id)->first();
        }
        return view('cms/kategori/_form', $data);
    }

    public function save()
    {
        $model = $this->loadModel;
        $post = $this->request->getPost();
        $validation =  \Config\Services::validation();

        if (!$this->validate($validation->getRuleGroup('cms_category'))) {
            return $this->respond(jsonRes('validation_error', $validation->getErrors()));
        } else {

            $model->save($post);

            return $this->respond(jsonRes('success'));
        }
    }
}