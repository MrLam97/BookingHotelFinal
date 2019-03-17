<?php 
/**
  * 
  */
 class Admin extends MY_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin_model');
 	}

 	//Lấy danh sách admin
 	function index()
 	{
 		$input = array();
 		$list = $this->admin_model->get_list($input);
 		$this->data['list'] = $list;

 		$total = $this->admin_model->get_total();
		$this->data['total'] = $total;

		// lấy nội dung cũa biến message
 		$message=$this->session->flashdata('message');
 		$this->data['message']=$message;

 		$this->data['temp'] = 'admin/admin/index';
 		$this->load->view('admin/main',$this->data);
 	}


 	/*
 	* Kiểm username đã tồn tại chưa
 	*/
 	function check_username()
 	{
 		$username=$this->input->post('username');
 		$where=array('username'=>$username);
 		//kiểm tra username đã tồn tại chưa
 		if($this->admin_model->check_exists($where))
 		{
 			// trả về thông báo lỗi
 			$this->form_validation->set_message(__FUNCTION__,'Tài khoản đã tồn tại');
 			return false;
 		}
 		return true;
 	}

 	// Thêm mới admin
 	function add()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Tên','required|min_length[8]');
 			$this->form_validation->set_rules('username','Tài khoản','required|callback_check_username');
 			$this->form_validation->set_rules('password','Mật khẩu','required|min_length[8]');
 			$this->form_validation->set_rules('Repassword','Nhập lại mật khẩu','matches[password]');
 			$this->form_validation->set_rules('email','Email','valid_email|required');
 			$this->form_validation->set_rules('phone','Điện thoại','numeric|required|min_length[10]|max_length[10]');
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				//Thêm vào CSDL
 				$name = $this->input->post('name');
 				$username = $this->input->post('username');
 				$password = $this->input->post('password');
 				$email = $this->input->post('email');
 				$phone = $this->input->post('phone');

 				$data=array(
 					'name'=>$name,
 					'username'=>$username,
 					'password'=>md5($password),
 					'email'=>$email,
 					'phone'=>$phone
 				);

 				if($this->admin_model->create($data))
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
 				}
 				//chuyển đến trang danh sách QTV
 				redirect(admin_url('admin'));

 			}
 		}

 		$this->data['temp'] = 'admin/admin/add';
 		$this->load->view('admin/main',$this->data);
 	}


 	//Chỉnh sửa thông tin thành viên
 	function edit()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');
 		//Lấy id admin cần chỉnh sữa
 		$id = $this->uri->rsegment(3);
 		$id = intval($id);

 		//Lấy thông tin của admin
 		$info = $this->admin_model->get_info($id);
 		if(!$info)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này');
 			redirect(admin_url('admin'));
 		}

 		$this->data['info']=$info;

 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Tên','min_length[8]');
 			$this->form_validation->set_rules('email','Email','valid_email');
 			$this->form_validation->set_rules('phone','Điện thoại','numeric|min_length[10]|max_length[10]');
 			

 			$password=$this->input->post('password');
 			if($password)
 			{
 				$this->form_validation->set_rules('password', 'Mật khẩu', 'min_length[6]');
 				$this->form_validation->set_rules('re-password', 'Nhập lại mật khẩu', 'matches[password]');
 			}

 			if ($this->form_validation->run()) {
 				//Thêm vào csdl
 				$name=$this->input->post('name');
 				$email = $this->input->post('email');
 				$phone = $this->input->post('phone');

 				$data=array(
 					'name'=>$name,
 					'email'=>$email,
 					'phone'=>$phone
 				);
 				//nếu thay đổi mật khẩu thì mới gắn csdl
 				if($password)
 				{
 					$data['password']=md5($password);
 				}
 				
 				if($this->admin_model->update($id,$data))// thực hiện update
 				{
 					// nội dung thông báo
 					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
 				}
 				//chuyển tới trang danh sách quản trị viên
 				redirect(admin_url('admin'));
 			} else {
 				# code...
 			}
 		}


 		$this->data['temp']='admin/admin/edit';
 		$this->load->view('admin/main', $this->data);
 	}


 	//xóa 1 quan tri vien
 	function delete()
 	{
 		//Lấy id admin cần chỉnh sữa
 		$id = $this->uri->rsegment(3);
 		$id = intval($id);

 		//Lấy thông tin của admin
 		$info = $this->admin_model->get_info($id);
 		if(!$info)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này');
 			redirect(admin_url('admin'));
 		}
 		//thực hiện xóa
 		$this->admin_model->delete($id);

 		$this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
 		redirect(admin_url('admin'));
 	}

 	// thực hiện đăng xuất
 	function logout()
 	{
 		if($this->session->userdata('login'))
 		{
 			$this->session->unset_userdata('login');
 		}
 		redirect(admin_url('login'));
 	}
 	
 	
 } ?>