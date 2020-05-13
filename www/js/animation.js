//ici on gere les evenement swipe
$(document).on("pagecreate","#slide",function() {
    console.log("je suis la");
    $("#c1").on("swipeleft",function(){
        $("#roule").animate({marginLeft: "33%"}, 100);
        $("#slide").animate({marginLeft: "-100%"}, 100);
        //console.log("je suis la");
    });

    $("#c2").on("swipeleft",function(){
        $("#roule").animate({marginLeft: (33.2*2)+"%"}, 100);
        $("#slide").animate({marginLeft: (-100*2)+"%"}, 100);
        console.log("je suis pas là");
    });

    $("#c2").on("swiperight",function(){
        $("#roule").animate({marginLeft: "0px"}, 100);
        $("#slide").animate({marginLeft: "0px"}, 100);
        console.log("je suis rentré");
    });

    $("#c3").on("swiperight",function(){
        $("#roule").animate({marginLeft: "33%"}, 100);
        $("#slide").animate({marginLeft: "-100%"}, 100);
        console.log("je rentre");
    });
 });


//login-----------------------------------
$("#login").click(function(event){
    let email=$("#email").val();
    let pass=$("#password").val();
    let server=localStorage.getItem("serverName");
    console.log("identifiant:"+email+pass)
    $.getJSON(server+"getstudent/"+email+"/"+pass+"",function(data, statut){
        data=JSON.parse(data);
        if(data!=null){
            localStorage.setItem("user",JSON.stringify(data))
            Setting.loadPosts();
            $("#tunaweza_first").fadeOut();
        }
        console.log(data.login);
    });
    
    //$("#tunaweza_first").fadeOut();
    event.preventDefault();

});
//------------------------------------
//var d=$("#nb").width()/3;
$("#menu1").click(function(event){
    //alert($(this).width());
    $("#roule").animate({marginLeft: "0px"}, 100);
    $("#slide").animate({marginLeft: "0px"}, 100);
    event.preventDefault();
});

$("#menu2").click(function(event){
    $("#roule").animate({marginLeft: "33%"}, 100);
    $("#slide").animate({marginLeft: "-100%"}, 100);
    event.preventDefault();
});
$("#menu3").click(function(event){
    $("#roule").animate({marginLeft: (33.2*2)+"%"}, 100);
    $("#slide").animate({marginLeft: (-100*2)+"%"}, 100);
    event.preventDefault();
});

function rightToLeft(el1){
    $("#"+el1).animate({"left":"-2px"});
}
function leftToRight(el1){
    $("#"+el1).animate({"left":"100%"});
}
///here are implemented the swipe event-----------------------




