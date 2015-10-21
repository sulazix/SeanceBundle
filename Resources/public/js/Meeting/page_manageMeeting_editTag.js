$('.editTag').click(function(){
    var id = $(this).data('id');
    displayModaleConnectTag(id);
});

$('.addTag').click(function(){
    displayModaleConnectTag(null);
});
function displayModaleConnectTag(idTag){

    //on récupère les valeur du formulaire
    var data = {idTag:idTag};
    $.ajax({
        type: "POST",
        url: Routing.generate('_ajax_edit_tag'),
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
