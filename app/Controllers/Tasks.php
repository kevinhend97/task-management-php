<?php

namespace App\Controllers;

use App\Controllers\BaseController;


use \App\Models\ServersideModel;
use \App\Models\TaskModel;


class Tasks extends BaseController
{

	public function listdata($id)
    {
 
        $request = \Config\Services::request();

        $list_data = new ServersideModel();
        $where = ['is_active' => 1];
        //Column Order Harus Sesuai Urutan Kolom Pada Header Tabel di bagian View
        //Awali nama kolom tabel dengan nama tabel->tanda titik->nama kolom seperti pengguna.nama

        $column_order = array('timestamp','name', 'status');
        $column_search = array('name', 'status');
        $order = array('status' => 'asc');
        $list = $list_data->get_datatables('tasks', $column_order, $column_search, $order, $where);
        $data = array();
        $no = $request->getPost("start");

        foreach ($list as $lists) {
            $no++;
            $row    = array();
            $row[] = '<input type="checkbox" name="id[]" value="'.$lists->id.'">';
            $row[] = $lists->name;
            $row[] = '<button type="button" class="btn btn-sm '.($lists->status == "doing" ? "btn-success" : ($lists->status == "start" ? "btn-info" : "btn btn-danger")) .' text-light">'.ucwords($lists->status).'</button>';
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $request->getPost("draw"),
            "recordsTotal" => $list_data->count_all('tasks', $where),
            "recordsFiltered" => $list_data->count_filtered('tasks', $column_order, $column_search, $order, $where),
            "data" => $data,
        );
 
        return json_encode($output);
    }

	public function store()
    {
        $task = new TaskModel();

		$data = [
			'id'		        => toString(32),
			'name'		        => $this->request->getPost('task'),
			'assigment_id'		=> $this->request->getPost('assigment')
		];

		$task->insert($data);

		$response = [
			'success'   => true,
			'message'   => 'Data has been save' 
		];
        

        return $this->response->setJSON($response);
    }


    public function edit()
    {
        $tasks = new TaskModel();
        $taskId = $this->request->getPost('id');

        $taskDetail = $tasks->select('id, name, assigment_id, status')
        ->where(['id' => $taskId, 'is_active' => 1])->get()->getRow();

        if($taskDetail)
        {
            $arr['kamarApps']['status_code'] = 201;
            $arr['kamarApps']['success'] = true;
            $arr['kamarApps']['message'] = "Success get Data";
            $arr['kamarApps']['results'] = $taskDetail;
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
        $tasks = new TaskModel();

        $taskId = $this->request->getPost('id');

        $checktask = $tasks->where('id', $taskId)->first();

        $data = [
			'customer_id'		=> $this->request->getPost('customer'),
			'task'		=> $this->request->getPost('task'),
			'description'		=> $this->request->getPost('description'),
			'status'		=> 'open',
			'pricing'		=> $this->request->getPost('pricing'),
			'end_date'		=> date('Y-m-d', strtotime($this->request->getPost('end')))
        ];

        $tasks->set($data);
        $tasks->where('id', $taskId);
        $tasks->update();

        $response = [
            'success' => true,
            'message' => 'Data has been save'
        ];

        return $this->response->setJSON($response);
    }

	public function destroy()
    {
        $tasks = new TaskModel();

        $taskId = $this->request->getPost('id');
        
        $data = [
            'is_active'  => 0
        ];

        $tasks->set($data);
        $tasks->where('id', $taskId);
        $tasks->update();

        $response = [
            'success' => true,
            'message' => 'Data has been deleted'
        ];
      

        return $this->response->setJSON($response);
    }
}
