<?php

namespace App\Controllers\Cms;

use App\Controllers\BaseController;

class Setting extends BaseController
{
    public function __construct()
    {
        $this->loadModel = model('CMS/Setting');
    }
    public function index()
    {
        $data['menu'] = 'cms';
        $data['submenu'] = 'about';
        $data['data'] = $this->loadModel->findAll();
        return view('cms/setting/form', $data);
    }
    public function save()
    {
        $post = $this->request->getPost();
        foreach ($post['id'] as $key => $item) {
            $saving['id'] = $post['id'][$key];
            $saving['value'] = $post['data'][$key];
            $saving['status'] = $post['flag'][$key];
            
            $this->loadModel->save($saving);
        }
        return $this->respond(jsonRes('success'));
    }
}