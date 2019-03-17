<?php /**
 * 
 */
class Contact extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
	}

	function form()
	{
		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Họ tên','required');
 			$this->form_validation->set_rules('email','Email','valid_email|required');
 			$this->form_validation->set_rules('title','Tiêu đề','required');
 			$this->form_validation->set_rules('phone','Điện thoại','numeric|required');
 			$this->form_validation->set_rules('message','Tin nhắn','required');	
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{

 				$data=array(
 					'name'=>$this->input->post('name'),
 					'email'=>$this->input->post('email'),
 					'title'=>$this->input->post('title'),
 					'created'=>time(),
 					'phone'=>$this->input->post('phone'),
					'content'=>$this->input->post('message'),


 				);

 				if($this->contact_model->create($data))
 				{
 					$this->session->set_flashdata('message', 'Gửi tin nhắn thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Gửi tin nhắn thất bại');
 				}
 				//chuyển đến trang danh sách QTV
 				redirect(base_url());


 			}
 		}

		$data['title'] = 'Liên hệ';
 		$data['temp'] = 'site/contact/form';
 		$this->load->view('site/layout',$data);
	}
} ?>