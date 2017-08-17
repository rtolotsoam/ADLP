<?php

class Group extends CI_Controller
{

    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        // Pour charger les models
        $this->load->model('fte_group', 'group');
        $this->load->model('fte_user', 'usr');
        $this->load->model('fte_categories', 'cats');

    }

    public function index()
    {

        $this->group();

    }

    public function group()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            /**
             * edition profil
             */
            if ($this->session->userdata('user')) {

                $user = $this->session->userdata('user');

                if (!empty($user)) {

                    foreach ($user as $val_user) {
                        $id_user              = $val_user->fte_user_id;
                        $data_user['id_user'] = $id_user;

                        $this->session->set_userdata('id_user', $id_user);

                        $data_user['matricule'] = $val_user->matricule;
                        $data_user['prenom']    = $val_user->prenom;
                        $data_user['pass']      = $val_user->pass;
                        $data_user['mail']      = $val_user->mail;
                    }

                    $this->session->unset_userdata('user');
                }
            } else {

                $user = $this->usr->liste_utilisateur_ById((int) $this->session->userdata('id_user'));

                if (!empty($user)) {

                    foreach ($user as $val_user) {
                        $id_user              = $val_user->fte_user_id;
                        $data_user['id_user'] = $id_user;

                        $data_user['matricule'] = $val_user->matricule;
                        $data_user['prenom']    = $val_user->prenom;
                        $data_user['pass']      = $val_user->pass;
                        $data_user['mail']      = $val_user->mail;
                    }

                }
            }

            /**
             * paramétre global js
             */

            // pour edition profil
            $var_url_modif_user_profil = "var url_modif_user_profil = " . "\"" . site_url("back/utilisateur/modifier_profil") . "\";";
            // accueil group
            $var_url_accueil = "var url_accueil = " . "\"" . site_url("back/group") . "\";";
            // pour ajouter groupe
            $var_url_ajout_group = "var url_ajout_group = " . "\"" . site_url("back/group/ajouter") . "\";";
            // pour afficher le poppup de modification d'un groupe
            $var_url_affiche_poppup_group = "var url_affiche_modif = " . "\"" . site_url("back/group/affiche_modif_group") . "\";";
            // pour modification du groupe
            $var_url_modif_group = "var url_modif_group = " . "\"" . site_url("back/group/modifier") . "\";";
            // pour afficher le poppup de modification d'un groupe
            $var_url_affiche_suppr_poppup_group = "var url_affiche_suppr = " . "\"" . site_url("back/group/affiche_suppr_group") . "\";";
            // pour la suppression d'un groupe
            $var_url_suppr_group = "var url_suppr_group = " . "\"" . site_url("back/group/supprimer") . "\";";
            // pour afficher le poppup montrant les détails d'un groupe
            $var_url_affiche_detail_poppup_group = "var url_affiche_detail = " . "\"" . site_url("back/group/affiche_detail") . "\";";
            // pour détaché catégorie ou utilisateur
            $var_url_det = "var url_det = " . "\"" . site_url("back/group/detacher") . "\";";
            //  Pour afficher modal rattaché catégorie
            $var_url_affiche_ratc = "var url_affiche_ratc = " . "\"" . site_url("back/group/afficher_ratc") . "\";";
            // pour rattaché catégorie ou utilisateur
            $var_url_rat = "var url_rat = " . "\"" . site_url("back/group/rattacher") . "\";";
            //  Pour afficher modal rattaché utilisateur
            $var_url_affiche_ratu = "var url_affiche_ratu = " . "\"" . site_url("back/group/afficher_ratu") . "\";";


            /**
             * paramétre passer au vue
             */

            $data['titre']  = 'GROUPES';
            $data['gest_g'] = $this->session->userdata('ges_g');
            $data['gest_u'] = $this->session->userdata('ges_u');
            $data['level']  = $level;
            $data['prenom'] = $this->session->userdata('prenom');

            $data['css'] = array('admin/module.admin.page.tables.min', 'admin/module.global');

            $data['js'] = array('js/global.js', 'js/group.js');

            $data['js_info'] = array(
                $var_url_modif_user_profil
                , $var_url_accueil
                , $var_url_ajout_group
                , $var_url_affiche_poppup_group
                , $var_url_modif_group
                , $var_url_affiche_suppr_poppup_group
                , $var_url_suppr_group
                , $var_url_affiche_detail_poppup_group
                , $var_url_det
                , $var_url_affiche_ratc
                , $var_url_rat
                , $var_url_affiche_ratu
            );

            /**
             *  les vues
             */

            $this->load->view('includes/header_tree.php', $data);
            $this->load->view('includes/menu_tree_horizental.php', $data);
            $this->load->view('back/group_view.php', $data);
            $this->load->view('back/ajout_group_view.php');
            $this->load->view('front/user_profil_view.php', $data_user);
            $this->load->view('includes/footer_tree.php');

        } else {
            redirect('login');
        }

    }

    public function ajouter()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $data_group = array('libelle_group' => $this->input->post('libelle'));

            $group = $this->group->ajouter_group($data_group);

            if ($group) {
                echo "success";
            } else {
                echo "erreur";
            }

        } else {
            redirect('login');
        }
    }

    /**
     *  Pour l'affichage du poppup de modification d'un groupe
     */

    public function affiche_modif_group()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id_group');

            $data['id_group'] = $id;

            $group = $this->group->list_group($id);

            $data['libelle_group'] = $group[0]->libelle_group;

            $poppup = $this->load->view('back/group_modif_view.php', $data, true);

            echo $poppup;

        } else {
            redirect('login');
        }
    }

    /**
     *  Pour modifier le groupe
     */

    public function modifier()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id');

            $data = array('libelle_group' => $this->input->post('libelle'));

            $res = $this->group->editer_group($id, $data);

            if ($res) {
                echo "success";
            } else {
                echo "erreur";
            }

        } else {
            redirect('login');
        }
    }

    /**
     *  Pour l'affichage d'un poppup d'avertissement de suppression d'un groupe
     */

    public function affiche_suppr_group()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id_group');

            $data['id_group'] = $id;

            $group = $this->group->list_group($id);

            $data['libelle_group'] = $group[0]->libelle_group;

            $poppup = $this->load->view('back/group_suppr_view.php', $data, true);

            echo $poppup;

        } else {
            redirect('login');
        }
    }

    /**
     *  Pour supprimer un groupe et ses rattachement
     */
    public function supprimer()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id');

            $data = array('flag' => 0);

            $res = $this->group->editer_group($id, $data);

            if ($res) {

                $data_group = array('id_group' => 0);

                $this->cats->editer_categories_group($id, $data_group);

                $this->usr->editer_user_group($id, $data_group);

                echo "success";
            } else {
                echo "erreur";
            }

        } else {
            redirect('login');
        }
    }

    /**
     *  Pour afficher les détails d'un groupe
     */
    public function affiche_detail()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id_group');

            $data['id_group'] = $id;

            $group = $this->group->list_group($id);

            $categories = $this->cats->liste_categories_by_idgroup($id);

            $users = $this->usr->liste_utilisateur_idgroup($id);

            $data['libelle_group'] = $group[0]->libelle_group;

            if (!empty($categories)) {

                $data['categories'] = $categories;
            }

            if (!empty($users)) {

                $data['users'] = $users;
            }

            $poppup = $this->load->view('back/group_detail_view.php', $data, true);

            echo $poppup;
        } else {
            redirect('login');
        }
    }
    /**
     *  Pour détaché utilisateur d'un groupe
     */
    public function detacher()
    {

        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id_group');

            if ($this->input->post('ajax') == "usr") {

                $usrs = $this->input->post('usrs');

                foreach ($usrs as $val_usr) {

                    $id_usr = (int) $val_usr;

                    $this->usr->editer_user($id_usr, array('id_group' => 0));
                }

                echo "success";

            }

            if ($this->input->post('ajax') == "cat") {

                $cats = $this->input->post('cats');

                foreach ($cats as $val_cat) {

                    $id_cat = (int) $val_cat;

                    $this->cats->editer_categories($id_cat, array('id_group' => 0));
                }

                echo "success";
            }



        } else {
            redirect('login');
        }

    }
    
    /**
     *  Pour afficher modal rattaché catégorie
     */

    public function afficher_ratc()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id_group');

            $data['id_group'] = $id;

            $group = $this->group->list_group($id);

            $categories = $this->cats->liste_categories_libre_group();

            $data['libelle_group'] = $group[0]->libelle_group;

            if (!empty($categories)) {

                $data['categories'] = $categories;
            }

            $poppup = $this->load->view('back/group_ratc_view.php', $data, true);

            echo $poppup;

        } else {
            redirect('login');
        }   
    }

    /**
     *  Pour rattaché catégorie
     */
    
    /**
     *  Pour détaché utilisateur d'un groupe
     */
    public function rattacher()
    {

        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id_group');

            if ($this->input->post('ajax') == "usr") {

                $usrs = $this->input->post('usrs');

                foreach ($usrs as $val_usr) {

                    $id_usr = (int) $val_usr;

                    $this->usr->editer_user($id_usr, array('id_group' => $id));
                }

                echo "success";

            }

            if ($this->input->post('ajax') == "cat") {

                $cats = $this->input->post('cats');

                foreach ($cats as $val_cat) {

                    $id_cat = (int) $val_cat;

                    $this->cats->editer_categories($id_cat, array('id_group' => $id));
                }

                echo "success";
            }



        } else {
            redirect('login');
        }

    }
    /**
     *  Pour rattaché utilisateur
     */
    public function afficher_ratu()
    {
        $level = $this->session->userdata('level');

        if ($this->session->userdata('loggin') && $level == 'admin') {

            $id = (int) $this->input->post('id_group');

            $data['id_group'] = $id;

            $group = $this->group->list_group($id);

            $users = $this->usr->liste_utilisateur_libre_group();

            $data['libelle_group'] = $group[0]->libelle_group;

            if (!empty($users)) {

                $data['users'] = $users;
            }

            $poppup = $this->load->view('back/group_ratu_view.php', $data, true);

            echo $poppup;

        } else {
            redirect('login');
        }   
    }

}
