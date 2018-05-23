$(document).ready(function() {
    $('.dropdown').on('show.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200);
    });
    $('.dropdown').on('hide.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
    });
    // var mql = window.matchMedia("screen and (max-width:768px)")
    // mediaqueryresponse(mql)
    // mql.addListener(mediaqueryresponse)
});

// function mediaqueryresponse(mql){
    // if (!mql.matches){
        // $('.member_content').hover(function(){
            // $(this).find('.spanout').stop(true, true).animate({width: '100%'}, 300);
            // $(this).find('.spanout').css({display: 'block'});
            // $(this).find('td').css({boxShadow: '0px 10px 3px -10px #791F6C'});
            // $(this).find('.spanout table').stop(true, true).animate({color: '#000000', fontSize: '2rem'}, 300);
        // }, function(){
            // $(this).find('.spanout').stop(true, true).animate({width: '0%', }, 300);
            // $(this).find('td').css({boxShadow: '0px 10px 3px -10px transparent'});
            // $(this).find('.spanout table').stop(true, true).animate({color: 'transparent', fontSize: '0rem'}, 300);
            
        // });
    // }
    // else{
        // $('.member_content').hover(function(){
            
        // }, function(){
            
        // });
    // }
// }


