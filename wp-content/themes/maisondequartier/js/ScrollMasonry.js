jQuery( document ).ready( function( $ ) {
    /* Masonry + Infinite Scroll */
    var $container = $('#grid-container');
    $container.imagesLoaded(function () {
        $container.masonry({
            itemSelector: '.post'
        });
    });
    $('#grid-container').masonry({
        itemSelector: '.post',
        columnWidth: 258
    });
    $container.infinitescroll({
        navSelector: '#page-nav',
        nextSelector: '#page-nav a',
        itemSelector: '.post',
        loading: {
            msgText: 'Chargement des contenus...',
            finishedMsg: 'Aucun contenu à charger.',
            img: 'http://i.imgur.com/6RMhx.gif'
        }
    }, function (newElements) {
        var $newElems = $(newElements).css({
            opacity: 0
        });
        $newElems.imagesLoaded(function () {
            $newElems.animate({
                opacity: 1
            });
            $container.masonry('appended', $newElems, true);
        });
    });
    $(window).unbind('.infscr');
    jQuery("#page-nav a").click(function () {
        jQuery('#grid-container').infinitescroll('retrieve');
        return false;
    });
    $(document).ajaxError(function (e, xhr, opt) {
        if (xhr.status == 404) $('#page-nav a').remove();
    });
});
