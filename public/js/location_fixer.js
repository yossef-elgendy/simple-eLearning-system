$(document).ready(function (){


    $(".navbar-nav li a.nav-link-hover").each(function (index){
        if($(this).attr('href')=== window.location.href)
        {
            $(this).removeClass('nav-link-hover');
            $(this).addClass('nav-link-hover-active').addClass('active');
        }
        else
        {
            $(this).removeClass('nav-link-hover-active').removeClass('active');
            $(this).addClass('nav-link-hover');
        }
    });

});
