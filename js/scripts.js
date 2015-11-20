jQuery(document).foundation();

jQuery(document).ready(function($) {
    
    var adjustMenu = function() {        
        var isMagellan = ($('[data-magellan-expedition-clone]').length > 0) ? true : false;
        var isSmall = ($(window).width() <= 640) ? true : false;
        var topBar = $('[data-magellan-expedition] .top-bar-section');
        var titleArea = $('[data-magellan-expedition] .title-area .name');
        if (isSmall) {
            titleArea.show();
            if (topBar.hasClass('right')) { 
                topBar.removeClass('right');
            }
        }
        else {
            if (isMagellan) {
                titleArea.show();
                topBar.addClass('right');
            }
            else {
                titleArea.hide();
                topBar.removeClass('right');
            }
        }
    }
    
    adjustMenu();
    $(document).scroll(function() {        
        //$(document).foundation('magellan-expedition', 'reflow');
        adjustMenu();
    });
    $(window).resize(function() {
        //$(document).foundation('magellan-expedition', 'reflow');
        adjustMenu();
    });
});
