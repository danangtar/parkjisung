<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parkir extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
    public function __construct()
    {
            parent::__construct();
            $this->load->model('Parkir_Model');
    }
    
	public function index()
	{
        if($this->ceklogin()) {
            $data['title'] = ucfirst("Welcome");
            $this->load->view('parkir/templates/header', $data);
            $this->load->view('parkir/index');
            $this->load->view('parkir/templates/footer');
        }
		
	}

	public function login()
	{
		$data['title'] = ucfirst("Please Scan Your Card");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/login');
        $this->load->view('parkir/templates/footer');
	}

	public function pilih()
	{
		$data['title'] = ucfirst("Please Choose Your Spot");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/parkiran');
	}

	public function silahkan()
	{
		$data['title'] = ucfirst("Happy Parking");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/silahkan');
        $this->load->view('parkir/templates/footer');
	}

	public function logout()
	{
		$data['title'] = ucfirst("Please Scan Your Card");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/logout');
        $this->load->view('parkir/templates/footer');
	}

	public function tagihan()
	{
		$data['title'] = ucfirst("Please Scan Your Card");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/tagihan');
        $this->load->view('parkir/templates/footer');
	}

	public function goodbye()
	{
		$data['title'] = ucfirst("Thank You. Goodbye");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/goodbye');
        $this->load->view('parkir/templates/footer');
	}

	public function nfclogin()
	{
		$idnfc = $this->input->post('idnfc');
        $query = $this->Parkir_Model->nfclogin($idnfc);
		
	}
    
    public function nfclogout()
	{
		$idnfc = $this->input->post('idnfc');
        $query = $this->Parkir_Model->nfclogout($idnfc);
		
	}
    
    public function ceklogin()
	{
        $query = $this->Parkir_Model->nfcshowlogin();
//        var_dump($query);
        
        
//        print_r($query);
        
        $time = strtotime($query[0]->WAKTUMASUK);
        
        $curtime = strtotime('-1 minutes');

//        echo $time;
//        echo "\n";
//        echo $curtime;
        
        if($time > $curtime) {     //1800 seconds
            $this->pilih();
        }
        else return true;
	}
    
    public function ceklogout()
	{
        $query = $this->Parkir_Model->nfcshowlogout();
		
	}
}
