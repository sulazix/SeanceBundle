$(document).ready(function(){
    $('.menu .item').tab();
    $('.ui.sticky')
        .sticky({
            context: '#example1',
            offset: 100
        });
    $('.tag-popup').popup({title   : 'Tagging',content : 'Le tagging permet de reporter ou marquer un point du procès verbal'})
;
});
