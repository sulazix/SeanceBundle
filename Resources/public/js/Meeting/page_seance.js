$(document).ready(function(){
    $('.menu .item').tab();
    $('.ui.sticky')
        .sticky({
            context: '#stickyContext',
            offset: 100
        });
    $('.tag-popup').popup({title   : 'Tagging',content : 'Le tagging permet de reporter ou marquer un point du procès verbal'})
;
});
