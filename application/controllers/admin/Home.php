<?php 
/**
  * 
  */
 class Home extends MY_Controller
 {
 	
 	function index()
 	{
 		//Lấy tong dat phong
 		$this->load->model('order_model');
 		$order_total=$this->order_model->get_total();
 		$this->data['order_total']=$order_total;
 		//doanh thu
 		$where=array(
 			'status'=>4
 		);
 		$amount_total=$this->order_model->get_sum('amount',$where);
 		$this->data['amount_total']=$amount_total;
 		//thong ke doanh thu ngay hom nay
        $today = get_date(now(),false);
        $time  = get_time_between($today);
        $where = array(
            'created <=' => $time['end'],
            'created >=' => $time['start'],
            'status' => 4);
        $amount_to_day = $this->order_model->get_sum('amount', $where);
        $this->data['amount_to_day'] = $amount_to_day;

        //tong thu theo thang nay
        $thangnay = get_date(now(),false);
        $time     = get_time_between($thangnay, '1');
        $where = array(
            'created <=' => $time['end'],
            'created >=' => $time['start'],
            'status' => 4);
        $amount_to_mon = $this->order_model->get_sum('amount', $where);
        $this->data['amount_to_mon'] = $amount_to_mon;
    
 		//lay tong phong
 		$this->load->model('hotel_model');
 		$hotel_total=$this->hotel_model->get_total();
 		$this->data['hotel_total']=$hotel_total;

 		//lay tong bai viet
 		$this->load->model('blog_model');
 		$blog_total=$this->blog_model->get_total();
 		$this->data['blog_total']=$blog_total;

 		//lay tong thanh vien
 		$this->load->model('user_model');
 		$user_total=$this->user_model->get_total();
 		$this->data['user_total']=$user_total;

 		//lay tong lien he
 		$this->load->model('contact_model');
 		$contact_total=$this->contact_model->get_total();
 		$this->data['contact_total']=$contact_total;

        //kiem tra co post du lieu len hay ko
        if($this->input->post())
        {
            $revenue_all=$this->order_model->get_list();

            for ($i=0; $i < count($revenue_all) ; $i++) { 
                $date[]=$revenue_all[$i]->created;
            }

            $input=array();
            $input['where']['status']=4;
            //lay du lieu 
            $created=$this->input->post('created');
            if($created)
            {
                $created = date_create($created);
                $created = date_timestamp_get($created);
                if($created>max($date))
                {
                    $this->session->set_flashdata('message', 'Ngày không hợp lệ');
                    redirect(admin_url('home'));
                }
                else
                {
                    $input['where']['created>=']=$created;
                }
            }
            $created_to=$this->input->post('created_to');
            if($created_to)
            {
                $created_to = date_create($created_to);
                $created_to = date_timestamp_get($created_to);
                 if($created_to<min($date))
                {
                    $this->session->set_flashdata('message', 'Ngày không hợp lệ');
                    redirect(admin_url('home'));
                }
                else
                {
                    $input['where']['created<=']=$created_to;
                }
            }

            $revenue=$this->order_model->get_list($input);
            $this->data['revenue']=$revenue;


            $total=$this->order_model->get_total($input);
            $this->data['total_revenue']=$total;

            


            for ($i=0; $i < count($revenue) ; $i++) { 
                $amount[]=$revenue[$i]->amount;
            }

            

            // if(strtotime($this->input->post('created'))>max($date))
            // {
            //     $this->session->set_flashdata('message', 'Ngày không hợp lệ');
            //     redirect(admin_url('home'));

            // }

            // if(strtotime($this->input->post('created_to'))<min($date))
            // {
            //     $this->session->set_flashdata('message', 'Ngày không hợp lệ');
            //     redirect(admin_url('home'));

            // }

            if($amount!=null)
            {
                $amount_revenue=array_sum($amount);
                $this->data['amount_revenue']=$amount_revenue;
            }



        }

        // lấy nội dung cũa biến message
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;

 		$this->data['temp'] = 'admin/home/index';
 		$this->load->view('admin/main',$this->data);
 	}


 } ?>