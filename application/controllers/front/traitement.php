<?php

class Traitement extends CI_Controller
{
    /**
     * tableau pour contenir le filariane
     * @var [array]
     */
    public $fil_ariane = array();

    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('fte_processus', 'procs');
        $this->load->model('fte_action', 'acts');
        $this->load->model('fte_historique', 'hist');
        $this->load->model('fte_traitement', 'trtm');
        $this->load->model('fte_categories', 'cats');
    }

    public function index()
    {

        $this->traitement();

    }

    public function traitement()
    {

        if ($this->session->userdata('loggin') && $this->session->userdata('traitement_id')) {

            //var_dump($this->agent->referrer());

            //** CODE **
            $level         = $this->session->userdata('level');
            $id_traitement = $this->session->userdata('traitement_id');

            $sous_cat = $this->cats->liste_categories_by_traitement_id($id_traitement);


            $traitement = $sous_cat[0]->libelle_categories;


            $this->create_filariane($sous_cat);


            $bind_processus = $this->procs->liste_processus($id_traitement);

            $act = array();

            $var_js = "var tp= [];";
            // $var_fct_js  = "";
            $deb = true;

            if (!empty($bind_processus)) {
                foreach ($bind_processus as $proc) {

                    if ($deb) {
                        $deb = false;
                        $var_js .= "var first_proc = $proc->fte_process_id;";
                        $deb_proc = $proc->fte_process_id;
                    }

                    $temp  = $this->acts->liste_action($proc->fte_process_id);
                    $ascii = ascii_to_entities($proc->libelle);
                    $var_js .= "tp[$proc->fte_process_id] = \"$ascii\";";
                    //$var_fct_js               .= "fct_".$proc->fte_process_id."();";
                    $act[$proc->fte_process_id] = $temp;

                }

            }

            $var_js_control = "var s_url_acc = " . "\"" . site_url("front/historique") . "\";";

            // FONCTION JS DANS LES TABLES
            $temp_js_action = $this->acts->liste_js_action($id_traitement);
            $temp_js_trait  = $this->trtm->liste_js($this->session->userdata('traitement_id'));
            //** END CODE **

            //var_dump($consigne);

            //** PARAMETRE VUE **
            $data['titre']   = 'TRAITEMENT';
            $data['css']     = array('admin/module.admin.page.form_wizards.min', 'admin/module.global');
            $data['js']      = array('js/global.js', 'js/back.js', 'js/convertir.js', 'js/traitement_proccess.js');
            $data['js_info'] = array($var_js, $var_js_control);
            $data['level']   = $level;


            if (!empty($this->fil_ariane)) {
                $data['menu'] = array_reverse($this->fil_ariane);
            }

            

            if (!empty($bind_processus)) {
                $data['lst_proc'] = $bind_processus;
                $data['lst_act']  = $act;
                $data['deb_proc'] = $deb_proc;
            }

            if (gettype($temp_js_action) != "boolean") {
                $data['infos_js_action'] = $temp_js_action;
            }

            if (gettype($temp_js_trait) != "boolean") {
                $data_tr["infos_js_traitement"] = $temp_js_trait;
            }


            if (!empty($traitement)) {
                $data['menu1'] = $traitement;
            }
            //** END PARAMETRE VUE **

            //** APPEL VUE **
            $this->load->view('includes/header_tree_traitement.php', $data);
            $this->load->view('includes/menu_tree_horizental_traitement.php', $data);
            $this->load->view('includes/menu_tree_vertical_traitement.php', $data);
            $this->load->view('front/traitement_tree_view.php', $data);
            $this->load->view('includes/footer_tree.php');

            /*if (gettype($temp_js_action)!="boolean") {

            $this->load->view('front/fct_js_view.php',$data);
            $this->load->view('front/fct_jscreation_view.php',$data);
            }

            if (gettype($temp_js_trait)!="boolean") {
            $this->load->view('front/fct_jstraitement_view.php',$data_tr);
            }

            $this->load->view('includes/js.php');*/

            //** END APPEL VUE **
        } else {
            redirect('login');
        }

    }

    public function deviation()
    {
        if ($this->session->userdata('loggin') && $this->session->userdata('traitement_id') && $this->session->userdata('connection_id')) {

            $rq = $this->hist->ajouter_historique(0, $this->session->userdata('connection_id'), -2, $this->session->userdata('mle'));

            if ($rq != false) {
                $this->session->unset_userdata('connection_id');
                $this->session->unset_userdata('traitement_id');
            }

            $level = $this->session->userdata('level');

            if ($level == "admin") {
                redirect('back/accueil_admin/normal');
            } else {
                redirect('front/tree');
            }

        } else {
            redirect('login');
        }
    }

    /**
     * creation d'un fil ariane
     * @param  [categorie] $cat_niveau [liste des catégorie dans la table fte_categories]
     * @return [menu]             [menu vertical avec les mises en forme htlm <li>]
     */
    public function create_filariane($cat_niveau)
    {

        if (!empty($cat_niveau)) {

            foreach ($cat_niveau as $val_cat_niveau) {

                $id_cat_niveau      = (int) $val_cat_niveau->fte_categories_id;
                $libelle_cat_niveau = $val_cat_niveau->libelle_categories;
                $parent_cat_niveau  = (int) $val_cat_niveau->parent_id;
                $niveau             = (int) $val_cat_niveau->niveau;



                    array_push($this->fil_ariane , ascii_to_entities($libelle_cat_niveau));

                    $cat_niveau = $this->cats->liste_categories_by_id($parent_cat_niveau);

                    $this->create_filariane($cat_niveau);



            }

        }

    }

}
