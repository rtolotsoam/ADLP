function access_niveau1(id) {

    var panel_id = "panel"+id;
    
    var parents  = $('.pan-head').parents('.pan');

    for (var i = 0; i < parents.length ; i++) {
    		
            var id_panel = parents[i].id;
            
            panel        = "#"+id_panel;
            
            var row      = $(panel).parents('div');
            
            var row_id   = "#"+row[0].id;
            
            //console.log(row_id);
            
            $(row_id).addClass('col-md-6');
            
            $(panel).removeClass("hidden");

    		if(id_panel != panel_id){

    			if(!$(panel).hasClass("hidden")){

    				$(row_id).removeClass('col-md-6');
    				$(panel).addClass("hidden");
    			}
    		
    		}else{

    			$(row_id).removeClass('col-md-6').addClass('col-md-12');
    		}

    }

	
	
}


function access_niveau2(id){

    var id_tree = "tree-container-"+id;
    
    console.log(id_tree);
    
    var obj     = $.jstree.reference('#'+id_tree);
    
    var trees   = $('.all-jstree');

    for (var i = 0; i < trees.length; i++) {

            var tree_id = trees[i].id;
            
            $.jstree.reference('#'+tree_id).close_all();
            
        if(id_tree != tree_id){
            
            $.jstree.reference('#'+tree_id).close_all();
        }   
    }

    obj.open_all();

}