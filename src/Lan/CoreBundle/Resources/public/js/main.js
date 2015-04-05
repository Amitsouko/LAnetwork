$(function(){

    //notifications
    $.notify.defaults({globalPosition: 'bottom left'});
    $notifBag = $("#notification-bag");
    $notifBag.children().each(function(index){
        $(this).each(function(index){
            $.notify($(this).text(), $(this).data("name"));
        });
    });
    
});