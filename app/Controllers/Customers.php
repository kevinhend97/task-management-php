<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use \App\Models\ServersideModel;
use \App\Models\CustomerModel;

class Customers extends BaseController
{
	public function index()
	{
		$data['pages'] = "Customers";
        
        return view('customer/index', $data);
	}

	public function listdata()
    {
 
        $request = \Config\Services::request();

        $list_data = new ServersideModel();
        $where = ['is_active' => 1];
        //Column Order Harus Sesuai Urutan Kolom Pada Header Tabel di bagian View
        //Awali nama kolom tabel dengan nama tabel->tanda titik->nama kolom seperti pengguna.nama

        $column_order = array('timestamp','name','email', 'phone');
        $column_search = array('name');
        $order = array('name' => 'asc');
        $list = $list_data->get_datatables('customers', $column_order, $column_search, $order, $where);
        $data = array();
        $no = $request->getPost("start");

        foreach ($list as $lists) {
            $no++;
            $row    = array();
            $row[] = date('d/m/Y H:i:s', strtotime($lists->timestamp)). " WIB";
            $row[] = '<a href="javascript:void(0)" onclick="edit('.$lists->id.')">'.$lists->name."</a>";
            $row[] = $lists->email;
            $row[] = $lists->phone;
            $row[] = '<button type="button" onclick="edit(`'.$lists->id.'`)" class="btn btn-warning text-light"><i class="cil-pencil"></i></button><button type="button" onclick="destroy(`'.$lists->id.'`)" class="btn btn-danger text-light"><i class="cil-ban"></i></button>';
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $request->getPost("draw"),
            "recordsTotal" => $list_data->count_all('customers', $where),
            "recordsFiltered" => $list_data->count_filtered('customers', $column_order, $column_search, $order, $where),
            "data" => $data,
        );
 
        return json_encode($output);
    }

	public function store()
    {
        $customer = new CustomerModel();

		$data = [
			'id'		=> toString(32),
			'name'		=> $this->request->getPost('name'),
			'email'		=> $this->request->getPost('email'),
			'phone'		=> $this->request->getPost('phone')
		];

		$customer->insert($data);

		$response = [
			'success'   => true,
			'message'   => 'Data has been save' 
		];
        

        return $this->response->setJSON($response);
    }

    public function edit()
    {
        $customers = new CustomerModel();
        $customerId = $this->request->getPost('id');

        $customerDetail = $customers->select('id, name, email, phone')
        ->where(['id' => $customerId, 'is_active' => 1])->get()->getRow();

        if($customerDetail)
        {
            $arr['kamarApps']['status_code'] = 201;
            $arr['kamarApps']['success'] = true;
            $arr['kamarApps']['message'] = "Success get Data";
            $arr['kamarApps']['results'] = $customerDetail;
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
        $customers = new CustomerModel();

        $customerId = $this->request->getPost('id');

        $checkUsername = $customers->where('id', $customerId)->first();

        $data = [
			'name'		=> $this->request->getPost('name'),
			'email'		=> $this->request->getPost('email'),
			'phone'		=> $this->request->getPost('phone')
        ];

        $customers->set($data);
        $customers->where('id', $customerId);
        $customers->update();

        $response = [
            'success' => true,
            'message' => 'Data has been save'
        ];

        return $this->response->setJSON($response);
    }

	public function destroy()
    {
        $customers = new CustomerModel();

        $customerId = $this->request->getPost('id');
        
        $data = [
            'is_active'  => 0
        ];

        $customers->set($data);
        $customers->where('id', $customerId);
        $customers->update();

        $response = [
            'success' => true,
            'message' => 'Data has been deleted'
        ];
      

        return $this->response->setJSON($response);
    }

    public function listSelect()
    {
        $customer = new CustomerModel();

        $customerList =  $customer->select('id,name')
                        ->where(['is_active' => 1])
                        ->orderBy('name', 'ASC')->get()->getResult();   
        
        if($customerList)
        {
            foreach($customerList as $list)
            {
                $arr[] = array(
                    "id"   	    => $list->id,
                    "text"     	=> $list->name,
                );
            }
        }

        return $this->response->setJSON($arr);
    } 
}
