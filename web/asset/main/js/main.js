$(document).ready(function(){
    $('.alert').on('click',function(){
        $(this).css({'display':'none'});
    });

    $active.addClass('active');

    $('.dynamic-square').height($('.dynamic-square').width());
});

$(window).resize(function(){
    $('.dynamic-square').height($('.dynamic-square').width());
});
