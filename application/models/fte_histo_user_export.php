<?php 
class Fte_histo_user_export extends CI_Model
{
	protected $table     = 'vw_historique_export';
	protected $data_info = 'matricule, etapes, debut, fin, date_deb,date_fin,campagne_id,session_id';

	public function histo_user_export($matr,$date1,$date2)
	{
		$rq = $this->db->select($this->data_info)->from('vw_historique_export');
		if($matr !="" && $matr !="null" && $matr !="NULL") {
			$array_matr = explode(",",$matr); 
			$rq		    = $this->db->where_in('matricule', $array_matr);
		}
		if ($date1 !="" && $date2 !="") {
			$rq			= $this->db->where('date_deb >= ',$date1)
                    	   ->where('date_deb <= ',$date2);
			}

		$rq 			= $this->db->order_by('matricule','asc');
		$rq 			= $this->db->get();
		
		if( $rq->num_rows > 0 ){
				return $rq->result();
			}
	}
	
}