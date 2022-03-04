<?php

namespace App\Controllers\Cms;
use Cocur\Slugify\Slugify;
use App\Controllers\BaseController;


class Menu extends BaseController
{
    public function __construct()
    {
        $this->loadModel = model('CMS/Menu');
    }
    public function index()
    {
        $data['menu'] = 'cms';
        $data['submenu'] = 'menu';

        $model = $this->loadModel;
        $data['menus'] = $model->orderBy('urutan','ASC')->findAll();
        


        return view('cms/menu/data', $data);
    }

    public function save_menu(){
        if($post = $this->request->getPost()){
            $model = $this->loadModel;
            $no = 1;
            foreach($post['id_menu'] as $row){
                
                $data['id'] = $row;
                $data['urutan'] = $no;
                $data['status'] = 1;

                $model->save($data);

                $no++;
            }
        }
    }
    public function data()
    {
        $model = $this->loadModel;
        $data = $model->where('id >', '2')->findAll();

        $gData['table']['title'] = 'No|Nama|Banner|keterangan|Aksi';
        $gData['table']['data'] = 'no|nama|img|keterangan|action';
        $gData['data'] = $data;
        $gData['no'] = true;
        $gData['action'] = 'edit|delete';
        $gData['url']['edit'] = 'cms/menu/form';
        $gData['url']['delete'] = 'cms/menu/delete';
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
        return view('cms/menu/_form', $data);
    }
    public function save()
    {
        $model = $this->loadModel;
        $SubModel = model('CMS/SubMenu');
        $validation =  \Config\Services::validation();
        $post = $this->request->getPost();
        $slug = new Slugify();

        if (!$this->validate($validation->getRuleGroup('cms_menu'))) {
            return $this->respond(jsonRes('validation_error', $validation->getErrors()));
        } else {
            if($post['parent'] == 1){
                if($post['id_menu'] != ''){
                    $post['id'] = $post['id_menu'];
                }else{
                    $last = $model->selectMax('urutan')->first();
                    $post['urutan'] = $last['urutan'] + 1;
                }
                
                $post['slug'] = $slug->slugify($post['nama_menu']);
                $post['status'] = 1;

                $model->save($post);
            }else{
                $last = $SubModel->selectMax('urutan')->where('menu_id', $post['id_menu'])->first();
                $post['slug'] = $slug->slugify($post['nama_menu']);
                $post['menu_id'] = $post['id_menu'];
                $post['urutan'] = $last['urutan'] + 1;
                $post['status'] = 1;
                $post['nama_sub'] = $post['nama_menu'];

                $SubModel->save($post);
            }
            
            
            return $this->respond(jsonRes('success'));
        }
    }

    public function get_menu()
    {
        if($post = $this->request->getVar()){
            $model = $this->loadModel;
            $id = $post['value'];
            $data = $model->where('id', $id)->first();
            
            echo json_encode($data);
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