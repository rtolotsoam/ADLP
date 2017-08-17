<?php 
class Fte_categories extends CI_Model
{
	
	protected $table = 'fte_categories';


	public function liste_categories()
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function search($id, $critere)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('categories_id', $id)
						->where('flag', 1)
						->where('traitement_id !=', 0)
						->ilike('libelle_categories', $critere)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_categories_tree($id)
	{
		$rq = $this->db->select("
			fte_categories_id as id, 
			libelle_categories as text, 
			parent_id,
			(CASE 
				WHEN  traitement_id = 0 THEN 'jstree-default jstree-folder'
				ELSE 'jstree-default jstree-file'
			END) AS icon
		")
						->from($this->table)
						->where('root_id', $id)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('fte_categories_id', $id)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_premier()
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('flag', 1)
						->where('niveau', 1)
						->order_by('fte_categories_id', 'asc')
						->limit(1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_traitement_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('traitement_id', $id)
						->where('flag', 1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_niveau($niveau)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('niveau', $niveau)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_niveau_group($id, $niveau)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('id_group', $id)
						->where('niveau', $niveau)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_categories_by_parent($parent)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('parent_id', $parent)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_categories_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('categories_id', $id)
						->where('flag', 1)
						->where('niveau', 2)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_categories_by_root_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('root_id', $id)
						->where('flag', 1)
						->where('niveau', 2)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function ajouter_sous_categories($data)
	{
		
		$this->db->insert($this->table, $data);
    	return $this->db->insert_id();
    	
	}


	public function editer_categories($id, $data) {
		return $this->db->where('fte_categories_id', $id)
						->update($this->table, $data);
	}

	public function editer_categories_group($id, $data) {
		return $this->db->where("id_group", $id)
						->update($this->table, $data);
	}

	public function liste_categories_by_categories_id_niveau($id, $niveau)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('categories_id', $id)
						->where('flag', 1)
						->where('niveau', $niveau)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function max_niveau()
	{
		$rq = $this->db->select('MAX(niveau)')
						->from($this->table)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_categories_by_root_id_niveau($id, $niveau)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('root_id', $id)
						->where('flag', 1)
						->where('niveau', $niveau)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	/**
	 * pour prendre les fils du parent dans le niveua indiquer
	 * @param  [int] $parent [parent_id]
	 * @param  [int] $niveau [niveau]
	 * @return [array]         [table fte_categories]
	 */
	public function liste_categories_by_parent_niveau($parent, $niveau)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('parent_id', $parent)
						->where('niveau', $niveau)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	/**
	 * [liste categorie par id_group]
	 * @param  [type: int] $id [description: id_group]
	 * @return [type: array]     [description: liste catégorie]
	 */
	public function liste_categories_by_idgroup($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('id_group', $id)
						->where('flag', 1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	/**
	 * [liste categorie niveau 1 avec id_group 0]
	 * @param  [type: int] $id [description: id_group ]
	 * @return [type : groupe]     [description : liste des groupe niveau 1 id_group :0]
	 */
	public function liste_categories_libre_group()
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('id_group', 0)
						->where('niveau', 1)
						->where('flag', 1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function editer_categories_withroot_id($id, $data) {
		return $this->db->where("root_id", $id)
						->update($this->table, $data);
	}

	public function editer_categories_withparent_id($id, $data) {
		return $this->db->where("parent_id", $id)
						->update($this->table, $data);
	}


	public function get_niveau($id)
	{
		$rq = $this->db->select('niveau')
						->from($this->table)
						->where('fte_categories_id', $id)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}
		
}