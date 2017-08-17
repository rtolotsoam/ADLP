<?php

// REPRESENTATION DE LA TABLE (fte_user)
/**
 *     Model concernant la table fte_access_group
 */

class Fte_group extends CI_Model
{
    //    table
    protected $table = 'fte_access_group';

    //    pour l'insertion group
    public function ajouter_group($data)
    {
        return $this->db->insert($this->table, $data);
    }

    //    pour lister un froupe
    public function list_group($id)
    {
        $rq = $this->db->select('*')
            ->from($this->table)
            ->where('fte_group_id', $id)
            ->where('flag', 1)
            ->get();

        if ($rq->num_rows > 0) {
            return $rq->result();
        }
        return false;
    }

    // pour modifier le groupe
    public function editer_group($id, $data)
    {
        return $this->db->where("fte_group_id", $id)
            ->update($this->table, $data);
    }

}
