<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tasks';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['id','name','assigment_id','status','is_active'];
}
