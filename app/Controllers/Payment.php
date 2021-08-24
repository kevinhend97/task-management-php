<?php

namespace App\Controllers;

use App\Controllers\BaseController;


use \App\Models\ServersideModel;
use \App\Models\PaymentModel;
use \App\Models\AssigmentModel;
use \App\Models\CustomerModel;


class Payment extends BaseController
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
	
		$payment = new PaymentModel();
		$assigment = new AssigmentModel();
		$customer = new CustomerModel();

		$checkAssigmentData = $assigment->where('id', $this->request->getPost('assigment'))->get()->getRow();
		$customerData = $customer->where('id',$checkAssigmentData->customer_id)->get()->getRow();


		$data = [
			"id"					=> toString(32),
			"assigment_id"			=> $this->request->getPost('assigment'),
			"customer_id"			=> $checkAssigmentData->customer_id,
			"payment"				=> $this->request->getPost('payment'),
			"notes"					=> $this->request->getPost('notes')
		];

		if($_FILES['upload']['name'])
		{
			$attachment = $this->upload();
		}
		else
		{
			$attachment = null;
		}

		if(is_array($attachment))
		{ 	
			// yosepogc@gmail.com
			$response = [
				'success'   => false,
				'message'   => $attachment['message_apps'] 
			];
		}
		else{
			$data['photo'] = $attachment;

			$payment->insert($data);

			$emailPlaceholder = array(
				"email"			=> $customerData->email,
				"aplikasi"		=> $checkAssigmentData->assigment,
				"pembayaran"	=> $this->request->getPost('payment'),
				"catatan"		=> $this->request->getPost('notes')
			);

			$this->email($emailPlaceholder);

			$response = [
				'success'   => true,
				'message'   => 'Data has been save' 
			];
		}
	
		return $this->response->setJSON($response);
		
	}

	public function email($data)
	{
	
        $email = \Config\Services::email();

        $email->setTo($data['email']);
        $email->setFrom("KamarApps', 'Do not reply' by KamarAdmin - Payments");
        
        $email->setSubject("Do not reply' by KamarAdmin - Payments");
        $email->setMessage("
			<table width='600'>
				<tbody>
					<tr>
						<td colspan='3'>
						Terima Kasih atas kepercayaan Anda kepada KamarApps dalam membangun impian anda.
						<br>
						Berikut merupakan informasi transaksi yang telah Anda lakukan:
						</td>
					</tr>
	
					<tr>
						<td colspan='3'>

						</td>
					</tr>

					<tr>	
						<td width='30%'>	Tanggal/Jam	</td>
						<td>	: </td>
						<td>".date('d/m/Y H:i:s')."</td>        

					</tr>
	
					<tr>
						<td>	Jenis Transaksi	</td>
						<td>	: </td>
						<td>Pembayaran Pembuatan Aplikasi</td>   
					</tr>

					<tr>
						<td>Aplikasi</td>
						<td>	: </td>
						<td>".$data['aplikasi']."</td>
					</tr>
		
		
					<tr>
						<td>	Jumlah		</td>
						<td>	: </td>
						<td>Rp. ".number_format($data['pembayaran'])."</td>
					</tr>

					<tr>
						<td>Catatan</td>
						<td>	: </td>
						<td>".$data['catatan']."</td>
					</tr>
		
					<tr>
						<td>	Status    	</td>
						<td>	: </td>
						<td>Berhasil	</td>
					</tr>
		
					<tr>

						<td colspan='3'>
							<br>
							Kami menyarankan Anda untuk menyimpan email ini sebagai referensi dari transaksi Anda. Semoga informasi ini bermanfaat bagi Anda.
							<br><br>	
							Hormat kami,
							<br><br>
							Kamar Apps
						</td>
					</tr>
				</tbody>
			</table>");

        if ($email->send()) 
		{
           return true;
        } 
		else 
		{
            $data = $email->printDebugger(['headers']);
            // print_r($data);

			echo json_encode(array("status" => 505, "message" => "Email was wrong or error", "errors" => $data));
			die();
        }
	}


	public function upload()
	{
		// check directory
		if(!file_exists(ROOTPATH.'/public/upload'))
        {
            mkdir(ROOTPATH.'/public/upload', 0777, true);
        }

		// make upload command
		// Check validation File
		if(!$this->validate([
			'upload'		=> [
				'rules'		=> 'uploaded[upload]|mime_in[upload,image/jpg,image/png,image/jpeg,application/pdf]|max_size[upload,2048]',
				'errors' 	=> [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
			]
		]))
		{

			$data = array(
                "status"            => 500,
                "message_error"     => "Internal Server Error",
                "message_apps"      => $this->validator->getError('upload')
            );
			// return $this->response->setJSON($data);
			return $data;
			die();
		}

		$attachment = $this->request->getFile('upload');
		$fileName = $attachment->getRandomName();
		$attachment->move('upload/',$fileName);

		return$fileName;
		// return $this->response->setJSON($fileName);
	}
}
