$(document).ready(function(){
    /*$active.addClass('active');*/
    $('.dynamic-square').height($('.dynamic-square').width());
});

$('.alert').on('click',function(){
    $(this).css({'display':'none'});
});

$(window).resize(function(){
    $('.dynamic-square').height($('.dynamic-square').width());
});

$('#uevf-collapse-toggle').on('click',function(){
    $target =$('#' + $(this).attr('target'));
    console.log($target);
    if($target.height() > 0){
        $target.css({'max-height':'0'})
    }else{
    $target.css({'max-height':'600px','height':'auto'});
    }
});
