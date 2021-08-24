<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'payment';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['id','assigment_id','customer_id','payment','notes','upload'];

}
