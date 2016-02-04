jQuery(function($){
    $(window).load(function() {
        $('.modal .send-request').click(function(){
            var modal = $(this).closest('.modal');
            //$(this).closest('.modal').modal('hide');
            modal.find('.submit-initial').hide(200, function(){
                modal.find('.submit-loading').show(100, function(){
                    modal.find('.submit-loading').animate({opacity: 1.0}, 500, function(){
                        var posting = $.post($('.wcatalog-order-form').attr('data-url'), $('.wcatalog-order-form').serialize());
                        posting.done(function(data){
                            modal.find('.submit-loading').hide(100, function(){
                                modal.find('.submit-result').show(300);
                            });
                        });
                    });
                });
                
            });
        });
    });
});
