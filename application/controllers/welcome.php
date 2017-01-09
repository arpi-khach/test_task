<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
        $user=$this->input->cookie('user', TRUE);
        if(!$user){
            $this->load->helper('cookie');
            $cookie = array(
                'name'   => 'user',
                'value'  => time(),
                'expire' =>  30 * 24 *60 * 60,
                'secure' => false
            );
            $this->input->set_cookie($cookie);
        }

        $this->load->view('add_comment');
	}

    /**
     * @param $id
     */
    public function comment($id){
        $this->load->model('Comments');
        $result=$this->Comments->getById($id);

        $data['comments']=$result;
        $this->load->view('comments', $data);
    }

    public function saveComment(){
        if($this->input->post('submit') && !empty($this->input->post('description'))){
            $description=$this->input->post('description');
            $this->load->model('Comments');
            $result=$this->Comments->insertComment($description,$this->input->cookie('user', TRUE));
            if ($result){
                redirect(base_url("comments"));
            }
            redirect(base_url("comments"));
        }
        redirect(base_url("comments"));
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */