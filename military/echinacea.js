$(document).ready(function() {
    
    $('.subtitle').click(function() {
        if($(this).next('.article').css('display') == 'none')
        {
            $(this).next('.article').css({'display': 'block'});
            //$(this).next('.article').animate({'height': ''}, 500);
            $(this).delay(500).queue(function(next){ 
                $(this).next('.article').css({'height': ''});
                next(); 
            });
            $(this).find('i').toggleClass('fa fa-chevron-down', false);
            $(this).find('i').toggleClass('fa fa-chevron-up', true);
        }
        else if($(this).next('.article').css('display') == 'block')
        {
            //$(this).next('.article').animate({'height': ''}, 500);
            $(this).find('i').toggleClass('fa fa-chevron-up', false);
            $(this).find('i').toggleClass('fa fa-chevron-down', true);
            $(this).next('.article').css({'display': 'none'});
        }
    });
});