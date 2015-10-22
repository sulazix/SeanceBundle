$('.connectTag').click(function(){
    var id = $(this).data('id');
    displayModaleConnectTag(id);
});


function displayModaleConnectTag(idItem){

    //on récupère les valeur du formulaire
    var data = {idItem:idItem};
    $.ajax({
        type: "POST",
        url: Routing.generate('_ajax_join_tag'),
        data: data,
        error: function(jqXHR, textStatus, errorThrown) {   },
        success: function(response) {

            $(response).modal('show');
            $('.ui.dropdown')
                .dropdown()
            ;

        }
    });
}
