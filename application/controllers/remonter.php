<?php

class Remonter extends CI_Controller
{

    public function __construct()
    {
        //  Obligatoire
        parent::__construct();
        $this->load->model('fte_remonter', 'rmnt');

    }

    public function index()
    {
        $this->remonter();
    }

    public function remonter()
    {

        date_default_timezone_set('Europe/Paris');
        $now = date('Y-m-d H:i:s');

        $ref_date   = date('Ymd');
        $ref_mat    = $this->session->userdata('mle');
        $ref_client = 'ADLP';

        $ref = $ref_client . '_' . $ref_mat . '_' . $ref_date;

        $ref_base = $this->rmnt->cpt_remonter($ref);

        if ($ref_base == 0) {
            $ref = $ref_client . '_' . $ref_mat . '_' . $ref_date;
        } else {

            $version = (int) $ref_base + 1;

            $ref = $ref_client . '_' . $ref_mat . '_' . $ref_date.'_V'.$version;
        }

        $remonter = pg_escape_string($this->input->post('remonter'));

        $data = array(
            'question' => $remonter
            , 'reference' => $ref
            , 'date_remontee' => $now,
        );

        $res = $this->rmnt->insert_remonter($data);

        if ($res) {
            echo 'success';
        } else {
            echo 'erreur';
        }

    }
}
