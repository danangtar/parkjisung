<?php
class Parkir_Model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

	public function nfclogin($data)
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_nfclogin('$data')");
        return $query->result();
	}
    
	public function nfclogout($data)
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_nfclogout('$data')");
        return $query->result();
	}
    
    public function nfcreg($data)
	{
        $this->db->reconnect();
        $idpeng = $data['idpeng'];
        $idnfc = $data['idnfc'];
        $query = $this->db->query("CALL sp_nfcreg('$idpeng', '$idnfc')");
        return $query->result();
	}
    
    public function nfcshowlogin()
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_showlogin()");
        return $query->result();
	}
    
    public function nfcshowlogout()
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_showlogout()");
        return $query->result();
	}
    
    public function cekvacant()
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_showvacant()");
        return $query->result();
	}
    
    public function vacanton($data)
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_vacanton('$data')");
        return $query->result();
	}
    
    public function vacantoff($data)
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_vacantoff('$data')");
        return $query->result();
	}
    
    public function bookspot($data)
	{
        $this->db->reconnect();
        $spot = $data['spot'];
        $id = $data['id'];
        $query = $this->db->query("CALL sp_bookspot('$spot', '$id')");
        return $query->result();
	}
    
    public function settagihan()
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_settagihan()");
	}
    
    public function setkeluar($data)
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_setkeluar('$data')");
        return $query->result();
	}
    
    public function savecost($data)
	{
        $this->db->reconnect();
        $biaya = $data['biaya'];
        $idtag = $data['idtag'];
        $query = $this->db->query("CALL sp_savecost('$biaya', '$idtag')");
	}
    
    public function showcredit($data)
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_showcredit('$data')");
        return $query->result();
	}
    
    public function jenispeng($data)
	{
        $this->db->reconnect();
        $query = $this->db->query("CALL sp_jenispeng('$data')");
        return $query->result();
	}
    
    public function bayar($data)
	{
        $this->db->reconnect();
        $idpeng = $data['idpeng'];
        $idtag  = $data['idtag'];
        $tagihan  = $data['tagihan'];
        
        $query = $this->db->query("CALL sp_bayar('$idpeng', '$idtag', '$tagihan')");
        return $query->result();
	}
    
    public function bayarlangganan($data)
	{
        $this->db->reconnect();
        $idpeng = $data['idpeng'];
        $idtag  = $data['idtag'];
        $tagihan  = $data['tagihan'];
        
        $query = $this->db->query("CALL sp_bayarlangganan('$idpeng', '$idtag', '$tagihan')");
        return $query->result();
	}
}