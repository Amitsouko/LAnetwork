$(function(){

    //notifications
    $.notify.defaults({globalPosition: 'bottom left',autoHideDelay: 10000});
    $notifBag = $("#notification-bag");
    $notifBag.children().each(function(index){
        $(this).each(function(index){
            $.notify($(this).text(), $(this).data("name"));
        });
    });
    
});