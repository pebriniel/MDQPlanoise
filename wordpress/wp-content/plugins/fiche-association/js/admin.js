(function($){
$(document).ready(function(){

    $('.customaddmedia').click(function(e){
        var $el = $(this).parent();
        e.preventDefault();
        console.log('test');

        var uploader = wp.media({
            title : 'Envoyer une image',
            button : {
                text : 'Choisir un fichier'
            },
            multiple: true
        })
        .on('select', function(){
            var selection = uploader.state().get('selection');

            var attachment = selection.first().toJSON();
            $('input', $el).val(attachment.url);
            $('img', $el).attr('src', attachment.url);

            // var attachments = [];
            // selection.map( function(attachment){
            //     attachment = attachment.toJSON();
            //     attachments.push(attachment.url);
            // })
            $('input', $el).val(attachments.join(','));

        })
        .open();
    })



})
})(jQuery);