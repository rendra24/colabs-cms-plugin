<?php

namespace App\Models\CMS;

use CodeIgniter\Model;

class Menu extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'cms_menu';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'nama_menu',
		'urutan',
		'slug',
		'content_type',
		'link',
		'status',
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function subMenu(){
		$builder  = $this->db->table('cms_menu a')
							 ->select('b.master_menu, b.nama_menu')
							 ->join('cms_menu b','a.master_menu = b.id','LEFT')
							 ->where('b.master_menu !=','0');
		return $builder->get();
	}
}