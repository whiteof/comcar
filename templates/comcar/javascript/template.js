jQuery(function($){
    $(window).load(function() {
        function resizeItems() {
            
            //match wcatalog items' height
            var wcat_max_height = 0;
            $('.wcatalog-category').removeAttr('style');
            $('.wcatalog-category').each(function(){
                if($(this).height() > wcat_max_height) wcat_max_height = $(this).height();
            });
            $('.wcatalog-category').height(wcat_max_height);

            //match wcatalog items' height
            var wcat_max_height = 0;
            $('.wcatalog-product').removeAttr('style');
            $('.wcatalog-product').each(function(){
                if($(this).height() > wcat_max_height) wcat_max_height = $(this).height();
            });
            $('.wcatalog-product').height(wcat_max_height);
            
        }
        resizeItems();
        $(window).resize(function() {
            resizeItems();
        }).trigger("resize");
        
    });
});
