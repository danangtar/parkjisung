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
            $this->scan();
        }
		
	}
    
    public function keluar()
	{
        if($this->ceklogout()) {
            $this->scan();
        }
		
	}

	public function scan()
	{
		$data['title'] = ucfirst("Please Scan Your Card");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/scan');
        $this->load->view('parkir/templates/footer');
	}

	public function pilih($user)
	{
        $vacant = $this->cekvacant();
        $data = array(
                'title'         => ucfirst("Please Choose Your Spot"),
                'user'          => $user,
                'vacant'        => $vacant
         );
		$data['title'] = ucfirst("Please Choose Your Spot");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/parkiran');
	}
    
    public function tagihan($user)
	{
        $tagihan = $this->hitungtagihan($user);
        
		$data['title'] = ucfirst("Please Scan Your Card");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/tagihan');
        $this->load->view('parkir/templates/footer');
	}

	public function silahkan()
	{
		$data['title'] = ucfirst("Happy Parking");
        $data['ucapan'] = ucfirst("Silahkan :)");
		$this->load->view('parkir/templates/header', $data);
        $this->load->view('parkir/silahkan');
        $this->load->view('parkir/templates/footer');
	}

	public function goodbye()
	{
		$data['title'] = ucfirst("Thank You. Goodbye");
        $data['ucapan'] = ucfirst("Thank You :)");
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

        $time = strtotime($query[0]->WAKTUMASUK);
        
        $curtime = strtotime('-5 seconds');

        if($time > $curtime) {     //1800 seconds
            $this->pilih($query[0]->IDPENGGUNA);
        }
        else return true;
	}
    
    public function ceklogout()
	{
        $query = $this->Parkir_Model->nfcshowlogout();
		
        $time = strtotime($query[0]->WAKTUKELUAR);
        
        $curtime = strtotime('-5 seconds');

        if($time > $curtime) {     //1800 seconds
            $this->tagihan($query[0]->IDPENGGUNA);
        }
        else return true;
	}
    
    public function cekvacant()
	{
        $query = $this->Parkir_Model->cekvacant();
        return $query;
		
	}
    
    public function bookspot()
	{
        $data = array(
                'spot' => $this->input->post('spot'), 
                'id' => $this->input->post('id')
        );

        $query = $this->Parkir_Model->bookspot($data);
        $query = $this->Parkir_Model->vacantoff($data['spot']);
        $query = $this->Parkir_Model->settagihan();
        $this->silahkan();
	}
    
    public function hitungtagihan($data)
	{
        $query = $this->Parkir_Model->setkeluar($data);
        $query = $this->Parkir_Model->hitungtagihan($data);
        return $query;
		
	}
}
