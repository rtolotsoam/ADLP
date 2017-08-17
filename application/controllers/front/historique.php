<?php


class Historique extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        // APPELER LES MODEL
        $this->load->model('fte_historique','hist');
        $this->load->model('fte_historique_view','vhist');
        $this->load->model('fte_processus','proc');
        $this->load->model('fte_traitement','trait');
        $this->load->model('fte_histo_user','histo_user');
        $this->load->model('fte_user','usr');
        

    }

    

    public function index()
    {

        $this->historique();

    }

    // AFFICHER HISTORIQUE
    public function historique()
    {
        if($this->session->userdata('loggin') && $this->session->userdata('mle')){
			
            // CODE
            $col          = 'fte_historique.matricule,initcap(fte_user.prenom)';
           
            $level        = $this->session->userdata('level');
            $data_histo   = $this->histo_user->liste_user_in_histo($col); 
            
            /**
             * gestion historique user ou admin
             * 
             */
            if($level == "user"){
                $donnees = $this->vhist->liste_historique_vwByMle($this->session->userdata('mle'));

            }else if($level == "admin"){
                $donnees    = $this->vhist->liste_historique_vw();   
               
            }
             $data['histo_user'] = $data_histo; 
             /**
              * 
              */



            /**
             *gestion du user 
             */
            if($this->session->userdata('user')){

                $user = $this->session->userdata('user');


                if(!empty($user)){

                    foreach ($user as $val_user) {
                        $id_user                = $val_user->fte_user_id;
                        $data_user['id_user']   = $id_user;
                        
                        $this->session->set_userdata('id_user', $id_user);
                        
                        $data_user['matricule'] = $val_user->matricule;
                        $data_user['prenom']    = $val_user->prenom;
                        $data_user['pass']      = $val_user->pass;
                        $data_user['mail']      = $val_user->mail; 
                    }

                    $this->session->unset_userdata('user');
                }
            }else{

                $user = $this->usr->liste_utilisateur_ById((int) $this->session->userdata('id_user'));

                if(!empty($user)){

                    foreach ($user as $val_user) {
                        $id_user                = $val_user->fte_user_id;
                        $data_user['id_user']   = $id_user;
                        
                        $data_user['matricule'] = $val_user->matricule;
                        $data_user['prenom']    = $val_user->prenom;
                        $data_user['pass']      = $val_user->pass;
                        $data_user['mail']      = $val_user->mail;
                    }

                }
            }
            /**
             * 
             */
            

            $var_url_modif_user_profil = "var url_modif_user_profil = "."\"".site_url("back/utilisateur/modifier_profil")."\";";
            $var_url_accueil           = "var url_accueil = "."\"".site_url("front/historique")."\";";
             
            // END CODE

            // PARAMETRE VUE
            $data['titre']      = 'HISTORIQUES';
            $data['css']        = array('admin/module.admin.page.tables.min','admin/module.global');
            $data['data_table'] = $donnees;
            $data['level']      = $level;
            $data['gest_g']     = $this->session->userdata('ges_g');
            $data['gest_u']     = $this->session->userdata('ges_u');
            $data['prenom']     = $this->session->userdata('prenom');
            
            $data['js']         = array('js/back.js','js/users.js');
            $data['js_info']    = array($var_url_modif_user_profil, $var_url_accueil);
            // END PARAMETRE VUE

            // APPEL VUE
            $this->load->view('includes/header_tree.php', $data);
            $this->load->view('includes/menu_tree_horizental.php', $data);
            $this->load->view('front/historique_tree_view.php', $data);
            $this->load->view('front/user_profil_view.php', $data_user);
            //$this->load->view('includes/menu_tree_vertical_droit.php');
            $this->load->view('includes/footer_tree.php');
            //$this->load->view('includes/js.php');
            // END APPEL VUE
        }else{
            redirect('login');
        }

    }

    // ANNULER ACTION PRECEDENT
    public function last_action()
    {
        if($this->session->userdata('loggin')){


            $dern       = 0;
            $data_dern  = "Aucune action";
            $js_chrono  = "";
            $js_chrono2 = "";
            
            //try {
                $i = 0;  
                $dern0 = $this->hist->last_historique($this->session->userdata('connection_id'));//[0]->process_id;
                $test = 0;
                if ($dern0) {
                    while($test <= 0){                        
                            if( $dern0[$i]->flag == 0){
                                $i++;
                            }else{
                                $dern = $dern0[$i]->process_id;
                                $test = 2;
                            }
                        
                    }
                }
                //echo "dern :".json_encode($dern);
                $data_dern0  = $this->proc->get_processus_by_id($dern);//[0]->alias;
                if ($data_dern0) {
                    $data_dern  = ascii_to_entities($data_dern0[0]->alias);    
                }
                $acts = $this->hist->liste_historique($this->session->userdata('connection_id'));
                $js_chrono  = "";
                $js_chrono2 = "";
                
                if(!empty($acts)){
                    foreach ($acts as $i_histo) {
                        $js_chrono  .= "$i_histo->process_id;";
                        $js_chrono2 .= "$i_histo->flag;";
                    }
                }
                
            //}
            //catch (Exception $e) {}
            $ret = array(
                "last_action"   => $data_dern
                ,"last_id"      => $dern
                ,"enchainement" => $js_chrono
                ,"etat"         => $js_chrono2
            );
            echo json_encode($ret);
        }else{
            redirect('login');
        }
    }
    

    // AJOUTER HISTORIQUE
    public function hstaj($id= -1)
    {
        if($this->session->userdata('loggin')){
            $ret = -1;
            
            if ($id==-1) {
                $ret = 0;
            }
            else {
                $this->hist->ajouter_historique($id,$this->session->userdata('connection_id'), 1, $this->session->userdata('mle'));
                $ret = 1;
            }
            echo $ret;
        }else{
            redirect('login');
        }
    }


    // ABORDER HISTORIQUE
    public function hstab()
    {
        if($this->session->userdata('loggin')){

            $ret = -1;
            try {
                
                $res = $this->hist->abort_historique($this->session->userdata('connection_id'));
                if (!$res) {}
                else {
                    $ret = $res[0]->process_id;
                }
                
            }
            catch (Exception $e) {}
            $jsret = array ("last_process" => (int)$ret);
            echo json_encode ($jsret);

        }else{
            redirect('login');
        }
    }

}