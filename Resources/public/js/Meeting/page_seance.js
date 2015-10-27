$(document).ready(function(){
    $('.menu .item').tab();
    $('.ui.sticky')
        .sticky({
            scrollContext: '#example1',
            observeChanges: true,
            debug: false
        });
    $('.tag-popup').popup({title   : 'Tagging',content : 'Le tagging permet de reporter ou marquer un point du procès verbal'})
;
});
