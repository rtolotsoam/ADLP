<?php 
class Fte_notification extends CI_Model
{
	
	protected $table = 'fte_notification_maj';
	protected $table_etat = 'fte_notification_maj_consulte';

	public function liste_notification()
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('active', 1)
						->order_by('date_creation', 'desc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_notification_by_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('fte_notification_maj_id', $id)
						->where('active', 1)
						->order_by('date_creation', 'desc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function ajouter_notification($data_notification) {
		return $this->db->insert($this->table, $data_notification);
	}

	public function ajouter_etat($data_etat) {
		return $this->db->insert($this->table_etat, $data_etat);
	}


	public function liste_notification_by_matricule($matricule){

		$rq = $this->db->query("
                                SELECT
                                    *
                                FROM
                                    ".$this->table."
                                WHERE
                                    FTE_NOTIFICATION_MAJ_ID NOT IN  (
                                        SELECT
                                            FTE_NOTIFICATION_MAJ_ID
                                        FROM
                                            ".$this->table_etat."
                                        WHERE
                                            CONSULTE    =   ".$matricule."
                                    )
                                ORDER BY
                                    DATE_CREATION   DESC")
                                ;

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


		
}
