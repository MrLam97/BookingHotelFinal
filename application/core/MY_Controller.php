<?php 
/**
* 
*/
class MY_Controller extends CI_Controller
{
	// Biến gửi dữ liệu sang view
	public $data=array();

	function __construct()
	{
		// kế thừa từ CI_Controller
		parent::__construct();

		$controller =  $this->uri->segment(1);
		switch ($controller) {
			case 'admin':
				// Xử lý các dữ liệu khi truy cập vào trang admin 
				$this->load->helper('admin');
				$this->_check_login();

				$admin_id=$this->session->userdata('admin_id');
				$this->load->model('admin_model');
				$admin_info=$this->admin_model->get_info($admin_id);
				$this->data['admin_info']=$admin_info;
				break;
			
			default:
				// Xử lý các dữ liệu ở trang ngoài
				//Lấy danh sách loại phòng
		 		$this->load->model('room_type_model');
		 		$type_list=$this->room_type_model->get_list();
		 		$this->data['type_list']=$type_list;

		 		//Kiểm đã đăng nhập chưa
		 		$user_id_login = $this->session->userdata('user_id_login');

		 		$this->data['user_id_login']=$user_id_login;
		 		if($user_id_login)
		 		{
		 			$this->load->model('user_model');
		 			$user_info = $this->user_model->get_info($user_id_login);
		 			$this->data['user_info']=$user_info;
		 			
		 		}
				break;
		}
	}
	/*
	* Kiểm tra trạng thái đăng nhập của admin
	*/
	private function _check_login()
	{
		$controller = $this->uri->rsegment('1');
		$controller = strtolower($controller);

		$login =$this->session->userdata('login');
		//chưa đăng nhập và truy vào controller khác
		if(!$login && $controller != 'login')
		{
			redirect(admin_url('login'));
		}
		//nếu đã đăng nhập thì ko cho phép trở về trang login nua
		if($login && $controller == 'login')
		{
			redirect(admin_url('home'));
		}
	} 
}
 ?>