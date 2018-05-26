var $item = $('.carousel-item'); 
var $wHeight = $(window).height();
$item.eq(0).addClass('active');
$item.height($wHeight); 
$item.addClass('full-screen');

$('.carousel img').each(function() {
  var $src = $(this).attr('src');
  var $color = $(this).attr('data-color');
  $(this).parent().css({
    'background-image' : 'url(' + $src + ')',
    'background-color' : $color
  });
  $(this).remove();
});

$(window).on('resize', function (){
  $wHeight = $(window).height();
  $item.height($wHeight);
});

$('.carousel').carousel({
  interval: 6000,
  pause: "false"
});

$(document).ready(function() {
    $('.pop_title').click(function() {
        var drop_number = $(this).parent().find('.drop > div').length;
        if($(this).parent().find('.drop').css('display') == 'none')
        {
            $(this).parent().find('.drop').css('display', 'block');
            $(this).css({'background-color': 'rgb(121,38,108)', 'color': '#FFFFFF'});
            $(this).parent().find('.drop').animate({'height': drop_number*50+"px"}, 300);
            $(this).parent().find('.drop').find('div').animate({'margin': '20px auto', 'box-shadow': '20px auto'}, 300);
        }
        else if($(this).parent().find('.drop').css('display') == 'block')
        {
            $(this).delay(300).queue(function(next){ 
                $(this).parent().find('.drop').css('display', 'none'); 
                next(); 
            });
            $(this).css({'background-color': '#FFFFFF', 'color': '#000000'});
            $(this).parent().find('.drop').animate({'height': '0px'}, 300);
            $(this).parent().find('.drop').find('div').animate({'margin': '20px auto'}, 300);
        }
    });
});
