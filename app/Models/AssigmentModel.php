<?php

namespace App\Models;

use CodeIgniter\Model;

class AssigmentModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'assigment';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = ['id','assigment','customer_id','description','status','pricing','payment','end_date','is_active'];
}
