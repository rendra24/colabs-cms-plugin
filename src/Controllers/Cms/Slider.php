<?php

namespace App\Controllers\Cms;

use App\Controllers\BaseController;

class Slider extends BaseController
{
    public function __construct()
    {
        $this->loadModel = model('CmsSliderModel');
    }
    public function index()
    {
        $data['menu'] = 'cms';
        $data['submenu'] = 'slider';
        return view('cms/slider/data', $data);
    }
    public function data()
    {
        $model = $this->loadModel;
        $data = $model->findAll();

        $gData['table']['title'] = 'No|Judul|Gambar|Aksi';
        $gData['table']['data'] = 'no|judul|img|action';
        $gData['data'] = $data;
        $gData['no'] = true;
        $gData['action'] = 'edit|delete';
        $gData['url']['edit'] = 'cms/slider/form';
        $gData['url']['delete'] = 'cms/slider/delete';
        $gData['helper']['img'] = ['formatImg', '{data}'];
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
        return view('cms/slider/_form', $data);
    }
    public function save()
    {
        $model = $this->loadModel;
        $validation =  \Config\Services::validation();
        $post = $this->request->getPost();
        $slug = new \Cocur\Slugify\Slugify();

        if (!$this->validate($validation->getRuleGroup('cms_slider'))) {
            return $this->respond(jsonRes('validation_error', $validation->getErrors()));
        } else {
            $file = $this->request->getFile('img');
            $post['slug'] = $slug->slugify($post['judul']);
            if ($file->getError() != 4) {
                @unlink('uploads/' . $post['old_img']);
                $newName = 'slider-' . date('YmdHis') . '.' . $file->guessExtension();
                $file->move('uploads/', $newName);
                $post['img'] = $newName;
            }
            $model->save($post);
            return $this->respond(jsonRes('success'));
        }
    }
    public function delete($id)
    {
        $model = $this->loadModel;
        $data = $model->where('id', $id)->first();
        @unlink('uploads/' . $data['img']);

        $model->delete($id);
        return $this->respond(jsonRes('success'));
    }
}
