//ici on gere les evenement swipe
/*$(document).on("pagecreate","#slide",function() {
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
 });*/


//login-----------------------------------
$("#login").click(function(event){
    let email=$("#email").val();
    let pass=$("#password").val();
    if(email=="" || pass==""){
        alert("Please fill the field to \n access to Fuego Dance");
        return false;
    }
    let server=localStorage.getItem("serverName");
    //console.log("identifiant:"+email+pass)
    $("#loader").fadeIn();
    $.getJSON(server+"getstudent/"+email+"/"+pass+"",function(data, statut){
        data=JSON.parse(data);
        alert(data);
        //console.log("voici la donnée:");
        //console.log(data);
        if(data.id){
            localStorage.setItem("user",JSON.stringify(data))
            Setting.loadPosts();
            $("#tunaweza_first").fadeOut();
        }
        else{
            alert("Your email address or your \n password is incorrect")
        }
        //console.log(data.login);
    })
    .done(function(){$("#loader").fadeOut()})
    .fail(function(xhr,statut,msg){
        alert("Please check your connexion \n because we can't etablish the connection with:"+server+"getstudent/"+email+"/"+pass+"");
    });
    
    //$("#tunaweza_first").fadeOut();
    event.preventDefault();

});
/*
* @function stopAllvideo
*va mettre fin à la lecture des toutes les vidéos en lectures lorsqu'on sort du menu whatNew
**/
function stopAllVideo(){
    vs=document.getElementsByTagName("video");
    //console.log(vs[0]);
    for(let i=0;i<vs.length;i++){
        vs[i].pause();
    }
}
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
    $("#"+el1).animate({"left":"-100%"});
}
function leftToRight(el1){
    $("#"+el1).animate({"left":"0%"});
}
$("#m1").click(function(){
    $("#tunaweza_fourth").css("zIndex",1);
    $("#tunaweza_third").css("zIndex",2)
    BACK_TO_MENU=1;
    rightToLeft("tunaweza_second");
});
$("#m2").click(function(){
    $("#tunaweza_content_fourth").load("about.html");
    $("#title").text("About Fuego Dance");
    $("#tunaweza_fourth").css("zIndex",2);
    $("#tunaweza_third").css("zIndex",1)
    BACK_TO_MENU=2;
    rightToLeft("tunaweza_second");
});
$("#m3").click(function(){
    $("#tunaweza_content_fourth").load("contact.html");
    $("#title").text("Get in Touch");
    $("#tunaweza_fourth").css("zIndex",2);
    $("#tunaweza_third").css("zIndex",1);
    BACK_TO_MENU=3
    rightToLeft("tunaweza_second");
});
$("#retour").click(function(){
    BACK_TO_MENU=0;
    stopAllVideo();
    leftToRight("tunaweza_second");

});
$("#retoure").click(function(){
    BACK_TO_MENU=0;
    leftToRight("tunaweza_second");
});

$("#visuel").click(function(){
    $(this).fadeOut();
});
///here are implemented the swipe event-----------------------
function loadTunawezaEvent(m){
    //console.log("je viens de clicker sur une image");
    let src=$(m).attr("src");
    //console.log(src);
    $("#visuel img").attr("src",src);
    //console.log("#visuel img sa source:"+$("#visuel img").attr("src"));
    $("#visuel").fadeIn();

}

/*
*here we handle when the user click on the back button
**/
function onLoad() {
    document.addEventListener("deviceready", onDeviceReady, false);
}
function onDeviceReady(){
    document.addEventListener("backbutton", onBackKeyDown, false);
}
function onBackKeyDown(e){
    e.preventDefault();
    alert("voulez vous quiter ?");
    if(BACK_TO_MENU!=0){
        BACK_TO_MENU=0;
        stopAllVideo();
        leftToRight("tunaweza_second");
    }
}


