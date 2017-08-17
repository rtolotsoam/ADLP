/**
 * Pour ajouter un groupe dans la table fte_access_group
 */
function ajout_group() {
    var libelle_group = $('#group').val();
    if (typeof libelle_group != null && libelle_group != '') {
        var form_data = {
            libelle: libelle_group
        };
        $.ajax({
            url: url_ajout_group,
            type: 'POST',
            data: form_data,
            success: function(data) {
                if (data == 'erreur') {
                    $('#message_error').html('<div class="alert alert-danger" align="center">Veillez réessayer ulterieurement !</div>');
                } else {
                    window.location.href = url_accueil;
                }
            }
        });
    } else {
        $('#libelle_group_error').html('<div class="alert alert-danger" align="center">Le champ libelle est obligatoire !</div>');
    }
}
/**
 * 	Pour afficher le poppup de modification d'un groupe
 */
function group_modifier(id) {
    var form_data = {
        id_group: id
    };
    $.ajax({
        url: url_affiche_modif,
        type: 'POST',
        data: form_data,
        success: function(data) {
            //TRAITEMENT DES ERREURS
            if (data == 'erreur') {
                $('#msg_error_modif').removeClass('hidden');
            } else {
                $('#msg_error_modif').addClass('hidden');
                $("#poppup_modif").html(data);
                $("#modifier-group-" + id).modal();
            }
        }
    });
}
/**
 * 	Pour modifier le libelle du groupe
 */
function modifier_group(id) {
    var libelle_group = $('#group_' + id).val();
    if (typeof libelle_group != null && libelle_group != '') {
        var form_data = {
            id: id,
            libelle: libelle_group
        };
        $.ajax({
            url: url_modif_group,
            type: 'POST',
            data: form_data,
            success: function(data) {
                if (data == 'erreur') {
                    $('#message_error_' + id).html('<div class="alert alert-danger" align="center">Veillez réessayer ultérieurement !</div>');
                } else {
                    window.location.href = url_accueil;
                }
            }
        });
    } else {
        $('#libelle_group_error_' + id).html('<div class="alert alert-danger" align="center">Le champ libelle est obligatoire !</div>');
    }
}
/**
 * 	Pour afficher le poppup de suppression d'un groupe
 */
function group_suppr(id) {
    var form_data = {
        id_group: id
    };
    $.ajax({
        url: url_affiche_suppr,
        type: 'POST',
        data: form_data,
        success: function(data) {
            //TRAITEMENT DES ERREURS
            if (data == 'erreur') {
                $('#msg_error_modif').removeClass('hidden');
            } else {
                $('#msg_error_modif').addClass('hidden');
                $("#poppup_suppr").html(data);
                $("#supprimer-group-" + id).modal();
            }
        }
    });
}
/**
 * 	Pour supprimer le groupe
 */
function supprimer_group(id) {
    var form_data = {
        id: id
    };
    $.ajax({
        url: url_suppr_group,
        type: 'POST',
        data: form_data,
        success: function(data) {
            if (data == 'erreur') {
                $('#message_error_' + id).html('<div class="alert alert-danger" align="center">Veillez réessayer ultérieurement !</div>');
            } else {
                window.location.href = url_accueil;
            }
        }
    });
}
/**
 * 	Pour afficher le poppup montrant le détail d'un groupe
 */
function group_detail(id) {
    var form_data = {
        id_group: id
    };
    $.ajax({
        url: url_affiche_detail,
        type: 'POST',
        data: form_data,
        success: function(data) {
            //TRAITEMENT DES ERREURS
            if (data == 'erreur') {
                $('#msg_error_modif').removeClass('hidden');
            } else {
                $('#msg_error_modif').addClass('hidden');
                $("#poppup_detail").html(data);
                $("#detail-group-" + id).modal();
            }
        }
    });
}
/**
 * 	Pour fermer le modal détail
 */
function detail_group(id) {
    $("#detail-group-" + id).modal('hide');
    $("#detail-group-" + id).on('hidden.bs.modal', function() {
        $("#poppup_detail").empty();
    });
}
/**
 * 	Pour détaché des catégories à un groupe
 */
function detc(id) {
    var cats = $('#detail_cat_' + id).val();
    $('#error_cat_' + id).empty();
    $('#error_usr_' + id).empty();
    if (cats != null) {
        $("#detail-group-" + id).modal('toggle');
        $("#detail-group-" + id).on('hidden.bs.modal', function() {
            $("#poppup_detail").empty();
        });
        var form_data = {
            id_group: id,
            ajax: 'cat',
            cats: cats
        };
        $.ajax({
            url: url_det,
            type: 'POST',
            data: form_data,
            success: function(data) {
                //TRAITEMENT DES ERREURS
                if (data == 'erreur') {
                    $('#msg_error_modif').removeClass('hidden');
                } else {
                    $('#msg_error_modif').addClass('hidden');
                    group_detail(id);
                }
            }
        });
    } else {
        $('#error_usr_' + id).empty();
        $('#error_cat_' + id).html('<div class="alert alert-danger" align="center">Merci de sélectionner la catégorie(s) !</div>');
    }
}
/**
 * 	Pour détaché des utilisateur à un groupe
 */
function detu(id) {
    var usrs = $('#detail_usr_' + id).val();
    $('#error_usr_' + id).empty();
    $('#error_cat_' + id).empty();
    if (usrs != null) {
        $("#detail-group-" + id).modal('toggle');
        $("#detail-group-" + id).on('hidden.bs.modal', function() {
            $("#poppup_detail").empty();
        });
        var form_data = {
            id_group: id,
            ajax: 'usr',
            usrs: usrs
        };
        $.ajax({
            url: url_det,
            type: 'POST',
            data: form_data,
            success: function(data) {
                //TRAITEMENT DES ERREURS
                if (data == 'erreur') {
                    $('#msg_error_modif').removeClass('hidden');
                } else {
                    $('#msg_error_modif').addClass('hidden');
                    group_detail(id);
                }
            }
        });
    } else {
        $('#error_cat_' + id).empty();
        $('#error_usr_' + id).html('<div class="alert alert-danger" align="center">Merci de sélectionner l\'utilisateur(s) !</div>');
    }
}
/**
 * 	Modal pour rattachée catégorie
 */
function group_ratc(id) {
    var form_data = {
        id_group: id
    };
    $.ajax({
        url: url_affiche_ratc,
        type: 'POST',
        data: form_data,
        success: function(data) {
            //TRAITEMENT DES ERREURS
            if (data == 'erreur') {
                $('#msg_error_modif').removeClass('hidden');
            } else {
                $('#msg_error_modif').addClass('hidden');
                $("#poppup_ratc").html(data);
                $("#ratc-group-" + id).modal();
            }
        }
    });
}
/**
 * 	Pour rattaché catégorie groupe
 */
function ratc_group(id) {
    var cats = $('#list_cat_' + id).val();
    $('#error_ratc_' + id).empty();
    if (cats != null) {
        var form_data = {
            id_group: id,
            ajax: 'cat',
            cats: cats
        };
        $.ajax({
            url: url_rat,
            type: 'POST',
            data: form_data,
            success: function(data) {
                //TRAITEMENT DES ERREURS
                if (data == 'erreur') {
                    $('#msg_error_modif').removeClass('hidden');
                } else {
                    window.location.href = url_accueil;
                }
            }
        });
    } else {
        $('#error_ratc_' + id).html('<div class="alert alert-danger" align="center">Merci de sélectionner la catégorie(s) !</div>');
    }
}
/**
 * 	Pour afficher modal rattaché utilisateur
 */
function group_ratu(id) {
    var form_data = {
        id_group: id
    };
    $.ajax({
        url: url_affiche_ratu,
        type: 'POST',
        data: form_data,
        success: function(data) {
            //TRAITEMENT DES ERREURS
            if (data == 'erreur') {
                $('#msg_error_modif').removeClass('hidden');
            } else {
                $('#msg_error_modif').addClass('hidden');
                $("#poppup_ratu").html(data);
                $("#ratu-group-" + id).modal();
            }
        }
    });
}

/**
 * 	Pour rattaché utlisateur groupe
 */
function ratu_group(id) {

	var usrs = $('#list_usr_'+id).val();
	$('#error_ratu_' + id).empty();
    if (usrs != null) {
        var form_data = {
            id_group: id,
            ajax: 'usr',
            usrs: usrs
        };
        $.ajax({
            url: url_rat,
            type: 'POST',
            data: form_data,
            success: function(data) {
                //TRAITEMENT DES ERREURS
                if (data == 'erreur') {
                    $('#msg_error_modif').removeClass('hidden');
                } else {
                    window.location.href = url_accueil;
                }
            }
        });
    } else {
        $('#error_ratu_' + id).html('<div class="alert alert-danger" align="center">Merci de sélectionner l\'utilisateur(s) !</div>');
    }

}