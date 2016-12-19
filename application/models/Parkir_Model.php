<?php
class Parkir_Model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_loc_all()
	{
		$this->db->reconnect();
        $query = $this->db->query("CALL sp_getlocall()");
        return $query->result();
	}

	public function get_loc($data)
	{
		$this->db->reconnect();
		$user = $data;
	    $query = $this->db->query("CALL sp_getloc('$user')");
	    return $query->result();
	}

	public function get_mark()
	{
        $query = $this->db->query("CALL sp_getmark()");
        return $query->result();
	}

	public function add_user($data)
	{
		$user = $data['username'];
        $pass = $data['password'];
        $query = $this->db->query("CALL sp_adduser('$user','$pass')");

	}

	public function add_loc($data)
	{
		$user = $data['username'];
        $lat = $data['latitude'];
        $long = $data['longitude'];
        $acc = $data['acc'];
        $query = $this->db->query("CALL sp_addloc('$user','$lat', '$long','$acc')");

	}

	public function nfclogin($data)
	{
        $query = $this->db->query("CALL sp_nfclogin('$data')");
        return $query->result();
	}
    
	public function nfclogout($data)
	{
        $query = $this->db->query("CALL sp_nfclogout('$data')");
        return $query->result();
	}
    
    public function nfcshowlogin()
	{
        $query = $this->db->query("CALL sp_showlogin()");
        return $query->result();
	}
    
    public function nfcshowlogout()
	{
        $query = $this->db->query("CALL sp_showlogout()");
        return $query->result();
	}
}