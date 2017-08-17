<?php

class Tree extends CI_Controller
{

    /**
     * pour générer le menu avec du html
     * @var array
     */
    private $menu;

    /**
     * constructeur charge le modele fte_categories
     */
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();
        $this->load->model('fte_categories', 'cats');
        $this->load->model('fte_processus', 'procs');
        $this->load->model('fte_user', 'usr');
        $this->load->model('fte_notification', 'not');
    }

    /**
     * mise en forme url au lieu de : /front/tree/tree , le format est simplifier : /front/tree
     */

    public function index()
    {
        $this->tree();
    }

    /**
     * initialisation du partie front
     * @return view
     */
    public function tree()
    {

        if ($this->session->userdata('loggin')) {

            /** CODE **/

            /**
             * gestion menu gauche affiche niveau1 et niveau2
             *
             */
            
            $group = (int) $this->session->userdata('group');

            //var_dump($group);

            if($group == 0){
                $cat_niveau1 = $this->cats->liste_categories_by_niveau(1);
            }else{
                $cat_niveau1 = $this->cats->liste_categories_by_niveau_group($group ,1);
            }

            if (!empty($cat_niveau1)) {
                foreach ($cat_niveau1 as $val_cat_niveau1) {

                    $id_cat_niveau1      = (int) $val_cat_niveau1->fte_categories_id;
                    $libelle_cat_niveau1 = $val_cat_niveau1->libelle_categories;

                    $this->menu .= "<li class='sub-menu'>
			                      <a href='#' onclick='access_niveau1(" . $id_cat_niveau1 . ");'>
			                      	<span>
			                      		&nbsp;
			                      		&nbsp;
			                          	" . ascii_to_entities($libelle_cat_niveau1) . "
			                        </span>
			                      </a>";

                    $cat_niveau2 = $this->cats->liste_categories_by_parent_niveau($id_cat_niveau1, 2);
                    if (!empty($cat_niveau2)) {

                        $lst_cat_niveau2[$id_cat_niveau1] = $cat_niveau2;

                        $this->menu .= "<ul class='sub'>";

                        foreach ($cat_niveau2 as $val_cat_niveau2) {
                            $id_cat_niveau2      = (int) $val_cat_niveau2->fte_categories_id;
                            $libelle_cat_niveau2 = $val_cat_niveau2->libelle_categories;

                            $this->menu .= "<li>
				                            <a href='#' onclick='access_niveau2(" . $id_cat_niveau2 . "); return false;'>
				                            	<i class='fa fa-caret-right'></i>
				                              	" . ascii_to_entities($libelle_cat_niveau2) . "
				                            </a>
				                        </li>";
                        }

                        $this->menu .= "</ul>";
                    }

                    $this->menu .= "</li>";

                }
            }

            /**
             *
             */

            /**
             *gestion du user
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
             *
             */

            $notifications = $this->get_notification();

            /**
             * var js;
             */
            $var_jstree_js             = "var url_jstree = " . "\"" . site_url("jstree") . "\";";
            $var_tree_js               = "var url_tree = " . "\"" . site_url("front/tree") . "\";";
            $var_show_process_js       = "var url_show_process = " . "\"" . site_url("front/tree/show_process") . "\";";
            $var_js_pont               = "var pont = " . "\"" . site_url("front/pont") . "\";";
            $var_url_modif_user_profil = "var url_modif_user_profil = " . "\"" . site_url("back/utilisateur/modifier_profil") . "\";";
            $var_url_accueil           = "var url_accueil = " . "\"" . site_url("front/tree") . "\";";
            $var_acc_notification      = "var url_acc_notification = " . "\"" . site_url("front/tree/affiche_notification") . "\";";
            $var_marquer_notification  = "var url_marquer_notification = " . "\"" . site_url("front/tree/marquer_notification") . "\";";
            /**
             *
             */

            /** END CODE */

            /** PARAMETRE VUE **/
            if (isset($lst_cat_niveau2)) {
                $data['lst_cat_niveau2'] = $lst_cat_niveau2;
            }
            $data['menu']        = $this->menu;
            $data['cat_niveau1'] = $cat_niveau1;

            $data['level']  = $this->session->userdata('level');
            $data['prenom'] = $this->session->userdata('prenom');

            $data['css']     = array('admin/style_jstree');
            $data['js']      = array('js/tree-access.js', 'js/debut.js', 'js/back.js', 'js/users.js', 'js/notification.js');
            $data['js_info'] = array($var_jstree_js, $var_tree_js, $var_show_process_js, $var_js_pont, $var_url_modif_user_profil, $var_url_accueil, $var_acc_notification, $var_marquer_notification);

            $data['notifications'] = $notifications;
            $data['titre']         = "ACCUEIL";

            /** END PARAMETRE VUE **/

            /** APPEL VUE **/
            $this->load->view('includes/header_tree.php', $data);
            $this->load->view('includes/menu_tree_horizental.php', $data);
            $this->load->view('includes/menu_tree_vertical.php', $data);
            $this->load->view('front/tree_view.php');
            $this->load->view('front/user_profil_view.php', $data_user);
            //$this->load->view('includes/menu_tree_vertical_droit.php');
            $this->load->view('includes/footer_tree.php');
            /** END APPEL VUE **/

        } else {
            redirect('login');
        }
    }

    /**
     * creation du menu vertical de gauche
     * @param  [categorie] $cat_niveau [liste des catégorie dans la table fte_categories]
     * @return [menu]             [menu vertical avec les mises en forme htlm <li>]
     */
    public function create_menu_vertical($cat_niveau)
    {

        if (!empty($cat_niveau)) {

            foreach ($cat_niveau as $val_cat_niveau) {

                $id_cat_niveau      = (int) $val_cat_niveau->fte_categories_id;
                $libelle_cat_niveau = $val_cat_niveau->libelle_categories;
                $parent_cat_niveau  = (int) $val_cat_niveau->parent_id;
                $niveau             = (int) $val_cat_niveau->niveau;

                echo " =======> id : " . $id_cat_niveau . " , libelle : " . ascii_to_entities($libelle_cat_niveau) . " , niveau : " . $niveau . " , parent : " . $parent_cat_niveau . "<=============";
                echo "<br/>";

                $cat_niveau = $this->cats->liste_categories_by_parent($id_cat_niveau);

                $this->create_menu_vertical($cat_niveau);

            }

        }

    }

    /**
     * pour afficher id_traitement et id_processus
     * @return [int] [id_traitement,id_processus]
     */
    public function show_process()
    {

        $id = (int) $this->input->post('id');

        $categs = $this->cats->liste_categories_by_id($id);

        foreach ($categs as $val_cat) {

            $id_trait = (int) $val_cat->traitement_id;

            $first = $this->procs->liste_processus_first($id_trait);
        }

        echo $id_trait . "=>" . $first[0]->fte_process_id;
    }

    /**
     * [pour récupérer les notification dans la table notification_maj_consulte]
     * @return [html] [une menu]
     */
    public function get_notification()
    {

        if ($this->input->post('ajax') == "notifications") {

            $results_notifcation = $this->not->liste_notification_by_matricule($this->session->userdata('mle'));

            if (!empty($results_notifcation)) {

                $i    = 0;
                $menu = "";

                foreach ($results_notifcation as $notification) {
                    $i++;
                    if ($i == 5) {
                        break;
                    }

                    if ($notification->couleur == "danger") {

                        $date_creat = datetime_fr($notification->date_creation);

                        $main_menu = '
					      <li>
					        <a href="#" onclick="notification( ' . $notification->fte_notification_maj_id . ' ); return false;">
					          <span class="label label-danger"><i class="fa fa-bolt"></i></span>
					          		' . ascii_to_entities($notification->titre) . '.
					          <span class="small italic"> [ ' . $date_creat . ' ]</span>
					        </a>
					      </li>
                    	';
                    }

                    if ($notification->couleur == "info") {

                        $date_creat = datetime_fr($notification->date_creation);

                        $main_menu = '
					      <li>
					        <a href="#" onclick="notification( ' . $notification->fte_notification_maj_id . ' ); return false;">
					          <span class="label label-info"><i class="fa fa-bullhorn"></i></span>
					          		' . ascii_to_entities($notification->titre) . '.
					          <span class="small italic"> [ ' . $date_creat . ' ]</span>
					        </a>
					      </li>
                    	';
                    }

                    if ($notification->couleur == "warning") {

                        $date_creat = datetime_fr($notification->date_creation);

                        $main_menu = '
					      <li>
					        <a href="#" onclick="notification( ' . $notification->fte_notification_maj_id . ' ); return false;">
					          <span class="label label-warning"><i class="fa fa-bell"></i></span>
					          		' . ascii_to_entities($notification->titre) . '.
					          <span class="small italic"> [ ' . $date_creat . ' ]</span>
					        </a>
					      </li>
                    	';
                    }

                    $menu = $menu . "" . $main_menu;
                }

                echo $menu . "||" . count($results_notifcation);
            } else {
                echo "vide";
            }

        } else {

            $results_notifcation = $this->not->liste_notification_by_matricule($this->session->userdata('mle'));
            return $results_notifcation;
        }
    }

    /**
     * [afficher les notification]
     * @return [view] [retour view contenant le poppup]
     */
    public function affiche_notification()
    {

        if ($this->session->userdata('loggin') && $this->input->post('ajax') == "1") {

            /*********** pour affichage Notification ***************/

            $id_not = $this->input->post('id_not');

            $data['id_not'] = $id_not;

            $notifications = $this->not->liste_notification_by_id($id_not);

            $data['notifications'] = $notifications;

            $poppup = $this->load->view('front/poppup_notification_view.php', $data, true);

            echo $poppup;
            /************ END (pour affichage Notification) **************/

        } else {
            redirect('login');
        }
    }

    /**
     * [action du bouton marquer comme lu dans les notifications]
     * @return [action] [erreur s'il y a erreur]
     */
    public function marquer_notification()
    {

        if ($this->session->userdata('loggin') && $this->input->post('ajax') == "1") {

            $id_not = $this->input->post('id_not');

            $data_etat = array(
                'fte_notification_maj_id' => $id_not,
                'consulte'                => (int) $this->session->userdata('mle'),
            );

            $res = $this->not->ajouter_etat($data_etat);

            if (!$res) {
                echo "erreur";
            }

        } else {
            redirect('login');
        }

    }
}
