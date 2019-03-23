<?php /**
 * 
 */
class Hotel extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		//load model
		$this->load->model('hotel_model');
	}

	// danh sách phòng theo loại
	function room_type()
	{
		//Lấy id của loại
		$id = $this->uri->rsegment(3);
		$id = intval($id);
		//Lấy thông tin của loại
		$this->load->model('room_type_model');
		$room_type=$this->room_type_model->get_info($id);
		if(!$room_type)
		{
			redirect();
		}
		$this->data['room_type']=$room_type;
		$input = array();
		$input['where']=array('type_id'=>$id);
		//Lấy danh sách phòng theo loại
		//lấy số luong danh sach phong
 		$total = $this->hotel_model->get_total($input);
		$this->data['total'] = $total;

 		//load thu vien phan trang
 		$this->load->library('pagination');
 		
 		$config['base_url'] = base_url('hotel/room_type/'.$id); //link hien thi ra danh sach phong
 		$config['total_rows'] = $total; //tong số luong danh sach phong
 		$config['per_page'] = 8; //so luong hien thi tren 1 trang
 		$config['uri_segment'] = 4;
 		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
 		//khoi tao cau hinh phan trang
 		$this->pagination->initialize($config);
 		
 		// echo $this->pagination->create_links();
 		$segment=$this->uri->segment(4);
 		$segment=intval($segment);
 		$input['limit']=array($config['per_page'],$segment);
 		
 		//Lấy danh sách phòng
 		$list = $this->hotel_model->get_list($input);
 		$this->data['list']=$list;

 		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();

 		//Hiển thị view
 		$this->data['provinces']=$provinces;
 		$this->data['wards']=$wards;
 		$this->data['title']='Danh sách phòng';
 		$this->data['temp']='site/hotel/room_type';
		$this->load->view('site/layout', $this->data);
	}

	//Xem chi tiết phòng
	function view()
	{
		//lay id phong 
		$id=$this->uri->rsegment(3);
		$hotel=$this->hotel_model->get_info($id);
		if(!$hotel) redirect();
		$this->data['hotel']=$hotel;

		//Lay ngay nhan, ngay tra, giá, số ngày
		$date_from=$this->uri->rsegment(4);
		$date_to=$this->uri->rsegment(5);
		$price=$this->uri->rsegment(6);
		$days=$this->uri->rsegment(7);

		$this->data['date_from']=$date_from;

		$this->data['date_to']=$date_to;

		$this->data['price']=$price;
		$this->data['days']=$days;
		// pre($days);
		//lấy thông tin loai phong
		$this->load->model('room_type_model');
		$room_type=$this->room_type_model->get_info($hotel->type_id);
		$this->data['room_type']=$room_type;
		

		//cập nhật lượt xem
		$data=array();
		$data['view']=$hotel->view + 1;
		$this->hotel_model->update($id,$data);
		
	

		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();
 		$this->data['provinces']=$provinces;
 		$this->data['wards']=$wards;

 		//Lấy danh sách bài viết
 		$this->load->model('blog_model');
 		$input=array();
 		$input['limit'] = array('3' ,'0');
 		$blog_list=$this->blog_model->get_list($input);
 		$this->data['blog_list']=$blog_list;

 		$input=array();
		$this->db->group_by('hotel.type_id'); 
		$type_qty=$this->hotel_model->get_relative('room_type.id,room_type.name,count(type_id) as qty','(room_type inner join hotel on room_type.id = hotel.type_id)',$input);
		$this->data['type_qty']=$type_qty;

 		$message=$this->session->flashdata('message');
        $this->data['message']=$message;
        
		$this->data['title']='Chi tiết phòng';
		$this->data['temp']='site/hotel/view';
		$this->load->view('site/layout', $this->data);
	}

	// tìm kiếm
	function search()
	{
		if($this->uri->segment(3)==1)
 		{
 			//lấy du lieu tu autocomplete
			$key = $this->input->get('term');
		}else{
			$key = $this->input->get('key-search');
		}

		$this->data['key']=trim($key);
		$input=array();
		$input['like'] =array('name',$key);
		$list = $this->hotel_model->get_list($input);
		$this->data['list']=$list;

		$total = $this->hotel_model->get_total($input);
		$this->data['total']=$total;

		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();
 		$this->data['provinces']=$provinces;
 		$this->data['wards']=$wards;

 		if($this->uri->segment(3)==1)
 		{
 			// xu ly autocomplete
 			$result=array();
 			foreach ($list as $row) {
 				$item=array();
 				$item['id']=$row->id;
 				$item['label']=$row->name;
 				$item['value']=$row->name;
 				$result[] = $item;

 			}
 			//du lieu tra ve json
 			die(json_encode($result));
 		}else{

			$this->data['title']='Tìm kiếm phòng';
			$this->data['temp']='site/hotel/search';
			$this->load->view('site/layout', $this->data);
 		}

	}

	function search_more()
	{
		$today=getdate();
		$date_from=$this->input->get('date_from');
		if($date_from)
		{
			$date_from = date_create($date_from);
			$date_from = date_timestamp_get($date_from);
			$this->data['date_from']=$date_from;
		}
		else
		{
	
			$date_from=mktime(0,0,0,$today['mon'],$today['mday'],$today['year']);
			// $date_from=get_date($date_from,true);
			$this->data['date_from']=$date_from;
		}
		
		$date_to=$this->input->get('date_to');
		if($date_to)
		{
			$date_to = date_create($date_to);
			$date_to = date_timestamp_get($date_to);
			$this->data['date_to']=$date_to;
		}
		else
		{
			$date_to=mktime(0,0,0,$today['mon'],$today['mday']+1,$today['year']);
			// $date_to=get_date($date_to,true);
			$this->data['date_to']=$date_to;
		}

		$time=time();
		$days = ($date_to - $date_from) / (60 * 60 * 24);
		$this->data['days']=$days;
		

		if($date_from<$time || $days<=0){
			$this->session->set_flashdata('message', 'Kiểm tra ngày trả phải sau ngày nhận và ngày nhận phải sau thời điểm hiện tại');
			redirect();
		}
		if($days>0)
		{
			if($days>30)
			{
				$this->session->set_flashdata('message', 'Không thuê quá 30 ngày');
				redirect();
			}
		}
		

		$room_type=$this->input->get('room_type');
		$provinces=$this->input->get('provinces');
		$price_from=str_replace(',', '', $this->input->get('price_from'));
		$price_from=intval($price_from);
		$price_to=str_replace(',', '', $this->input->get('price_to'));
		$price_to=intval($price_to);

		$room_type_data="";
		$provinces_data="";
		$price_to_data="";
		$price_from_data="";
		if($room_type)
		{
			$room_type_data=' and type_id =' .$room_type;
		}
		if($provinces)
		{
			$provinces_data=' and provinces =' .$provinces;
		}
		if($price_to)
		{
			$price_to_data=' and price <=' .$price_to;
		}
		if($price_from)
		{
			$price_from_data=' and price >=' .$price_from;
		}

		
		$dk='status = 2 '. $room_type_data .$provinces_data .$price_to_data .$price_from_data .' AND id not in( select hotel_id from transaction where (check_in <= '.$date_from.' AND check_out >= '.$date_from.') or (check_in <= '.$date_to.' AND check_out >= '.$date_to.') )';
		$input['where']=$dk;
		$total = $this->hotel_model->get_total($input);

		$this->data['total'] = $total;

		$list=$this->hotel_model->get_list($input);	
		$this->data['list']=$list;


		

		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();
 		$this->data['provinces']=$provinces;
 		$this->data['wards']=$wards;

		$this->data['title']='Tìm kiếm';
		$this->data['temp']='site/hotel/search_more';
		$this->load->view('site/layout', $this->data);
		
	}

	function room_list()
	{
		//lấy danh sách  tên hotel

		$this->db->group_by('name'); 
		$hotel_list=$this->hotel_model->get_relative('name,count(name) as total','hotel');
		$this->data['hotel_list']=$hotel_list;

		$this->data['title']='Danh sách khách sạn';
		$this->data['temp']='site/hotel/room_list';
		$this->load->view('site/layout', $this->data);
	}

	function list_view()
	{
		$name=$this->uri->rsegment(3);
		$input=array();
		$input['where']['alias']=$name;
		$total=$this->hotel_model->get_total($input);
		$this->data['total']=$total;

		//load thu vien phan trang
 		$this->load->library('pagination');
 		
 		$config['base_url'] = base_url('hotel/list_view/'.$name); //link hien thi ra danh sach phong
 		$config['total_rows'] = $total; //tong số luong danh sach phong
 		$config['per_page'] = 8; //so luong hien thi tren 1 trang
 		$config['uri_segment'] = 4;
 		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
 		//khoi tao cau hinh phan trang
 		$this->pagination->initialize($config);
 		
 		// echo $this->pagination->create_links();
 		$segment=$this->uri->segment(4);
 		$segment=intval($segment);
 		$input['limit']=array($config['per_page'],$segment);

		$list=$this->hotel_model->get_list($input);
		$this->data['list']=$list;


		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();
 		$this->data['provinces']=$provinces;
 		$this->data['wards']=$wards;

		$this->data['title']='Danh sách phòng';
		$this->data['temp']='site/hotel/list_view';
		$this->load->view('site/layout', $this->data);
	}


} ?>