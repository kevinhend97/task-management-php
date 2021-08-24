<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use \App\Models\ServersideModel;
use \App\Models\AssigmentModel;

class Assigment extends BaseController
{

	public function index()
	{
		$data['pages'] = "Assigments";
        
        return view('assigment/index', $data);
	}

	public function listdata()
    {
 
        $request = \Config\Services::request();

        $list_data = new ServersideModel();
        $where = ['is_active' => 1];
        //Column Order Harus Sesuai Urutan Kolom Pada Header Tabel di bagian View
        //Awali nama kolom tabel dengan nama tabel->tanda titik->nama kolom seperti pengguna.nama

        $column_order = array('timestamp','assigment','pricing','payment', 'status','end_date');
        $column_search = array('assigment','pricing','payment', 'status','end_date');
        $order = array('timestamp' => 'desc');
        $list = $list_data->get_datatables('assigment', $column_order, $column_search, $order, $where);
        $data = array();
        $no = $request->getPost("start");

        foreach ($list as $lists) {
            $no++;
            $row    = array();
            $row[] = date('d/m/Y H:i:s', strtotime($lists->timestamp)). " WIB";
            $row[] = '<a href="'.base_url('assigment/view?id='.$lists->id).'">'.$lists->assigment."</a>";
            $row[] = 'Rp.'. number_format($lists->pricing);
            $row[] = 'Rp. '. number_format($lists->payment);
			$row[] = $lists->status == 'open' ? '<span class="badge badge-success">Open</span>' : '<span class="badge badge-danger">Close</span>';
			$row[] = date('D, d/m/Y', strtotime($lists->end_date));
            $row[] = '<button type="button" onclick="destroy(`'.$lists->id.'`)" class="btn btn-danger text-light"><i class="cil-ban"></i></button>';
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $request->getPost("draw"),
            "recordsTotal" => $list_data->count_all('assigment', $where),
            "recordsFiltered" => $list_data->count_filtered('assigment', $column_order, $column_search, $order, $where),
            "data" => $data,
        );
 
        return json_encode($output);
    }

	public function store()
    {
        $assigment = new AssigmentModel();

		$data = [
			'id'		    => toString(32),
			'customer_id'	=> $this->request->getPost('customer'),
			'assigment'		=> $this->request->getPost('assigment'),
			'description'		=> $this->request->getPost('description'),
			'status'		=> 'open',
			'pricing'		=> $this->request->getPost('price'),
			'end_date'		=> date('Y-m-d', strtotime($this->request->getPost('end')))
		];

		$assigment->insert($data);

		$response = [
			'success'   => true,
			'message'   => 'Data has been save' 
		];
        

        return $this->response->setJSON($response);
    }

	public function view()
	{
		$data = [
			'id'	=> $this->request->getGet('id'),
			'pages'	=> "Assigments"
		] ;
        
        return view('assigment/detail', $data);
	}

    public function edit()
    {
        $assigments = new AssigmentModel();
        $assigmentId = $this->request->getPost('id');

        $assigmentDetail = $assigments->select('id, assigment, customer_id, assigment, description, status, pricing, payment, is_active')
        ->where(['id' => $assigmentId, 'is_active' => 1])->get()->getRow();

        if($assigmentDetail)
        {
            $arr['kamarApps']['status_code'] = 201;
            $arr['kamarApps']['success'] = true;
            $arr['kamarApps']['message'] = "Success get Data";
            $arr['kamarApps']['results'] = $assigmentDetail;
        }
        else
        {
            $arr['kamarApps']['status_code'] = 404;
            $arr['kamarApps']['success'] = false;
            $arr['kamarApps']['message'] = "Data is not found";
        }

        return $this->response->setJSON($arr);
    } 

	public function update()
    {
        $assigments = new AssigmentModel();

        $assigmentId = $this->request->getPost('id');

        $checkAssigment = $assigments->where('id', $assigmentId)->first();

        $data = [
			'customer_id'		=> $this->request->getPost('customer'),
			'assigment'		=> $this->request->getPost('assigment'),
			'description'		=> $this->request->getPost('description'),
			'status'		=> 'open',
			'pricing'		=> $this->request->getPost('pricing'),
			'end_date'		=> date('Y-m-d', strtotime($this->request->getPost('end')))
        ];

        $assigments->set($data);
        $assigments->where('id', $assigmentId);
        $assigments->update();

        $response = [
            'success' => true,
            'message' => 'Data has been save'
        ];

        return $this->response->setJSON($response);
    }

	public function destroy()
    {
        $assigments = new AssigmentModel();

        $assigmentId = $this->request->getPost('id');
        
        $data = [
            'is_active'  => 0
        ];

        $assigments->set($data);
        $assigments->where('id', $assigmentId);
        $assigments->update();

        $response = [
            'success' => true,
            'message' => 'Data has been deleted'
        ];
      

        return $this->response->setJSON($response);
    }

    public function detail()
    {
        $id = $this->request->getGet('id');
        $query = $this->db->table('v_assigment')->where('id', $id)->get()->getRow();
        
        return $this->response->setJSON($query);
    }
}
