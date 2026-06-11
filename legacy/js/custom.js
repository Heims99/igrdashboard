$(function() {
    $("#Dash-framework").owlCarousel({
        items: 1,
        autoplay:true,
        smartSpeed:700,
        loop:true,
        autoplayHoverPause:true,
    });
});
/*Close Mobile Menu on click*/
$(function(){
    $(".navbar-collapse ul li a").on("click touch", function(){
        $(".navbar-toggle").click();
        
    });
    
});

/*Fremwork */
$(function(){
   $("Dash-framework").owlCarousel({
       items: 1,
       autoplay:true,
       smartSpeed:700,
       loop:true,
       autoplayHoverPause:true,
   });
});

/*smooth scroll*/

$(function(){
    $("a.smooth-scroll").click(function(Event){
        
        Event.preventDefault();
        /*get/return id like #about for #data g*/
        var section =$(this).attr("href")
        $("html,body").animate({
           scrollTop:$(section).offset().top - 40
        },1300);
        
    });
    
    
    
});