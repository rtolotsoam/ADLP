<?php

/**
 *     Pour inserer les remontées à la base de données remontee_client
 *
 */
class Fte_remonter extends CI_Model
{

    protected $table = 'remontee';

    public function __construct()
    {
        parent::__construct();
        $this->rmnt = $this->load->database('remonter', true);
    }

    public function insert_remonter($data)
    {

        $this->rmnt->insert($this->table, $data);
        return $this->rmnt->insert_id();

    }

    public function cpt_remonter($ref)
    {
    	$this->rmnt->from($this->table)
			->where('reference ilike \''.$ref.'%\'', null, false);
						

		return $this->rmnt->count_all_results();
    }
}
