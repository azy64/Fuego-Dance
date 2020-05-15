localStorage.setItem("serverName","http://fuegodance.com.au/public/");
localStorage.setItem("lastPost","");
localStorage.setItem("contentElement","tunaweza_content");
Setting={};
Setting.loadTunawezaEvent=function(){
    
    $(".bulle-container img").click(function(){
        console.log("je viens de clicker sur une image");
        let src=$(this).attr("src");
        $("#visuel img").attr("src",src);
        $("#visuel img").fadeIn();
    });
}
Setting.getLastPostLoaded=function(posts){
    let el=posts[0];
    for(post in posts){
        if(el.id<post.id)
            el=post;
    }
    localStorage.setItem("lastPost",JSON.stringify(el));
    return el;
}
Setting.getNewPost=function(){
    let last=localStorage.getItem("lastPost")
    last=JSON.parse(last);
    let id =last.id;
    //console.log(last);
    $.getJSON(localStorage.getItem("serverName")+"getPostsAfter/"+id,function(posts,status){
        console.log("ici commence la tache pour recuperer les nouveaux posts")
        //console.log(posts);
        if(posts.length>0){
            //console.log("=================================");
            //console.log(posts);
            Setting.getLastPostLoaded(posts);
            let contenu=Setting.envelopePost(posts);
            let cnt=localStorage.getItem("contentElement");
            $("#"+welcome).fadeIn();
            $("#"+cnt).prepend(contenu);

        }
    })
}
Setting.Welcome=function(){
  let w=' <div class="alert alert-success" role="alert" id="welcome">'+
  '<h4 class="alert-heading">Welcome to fuegoDance!</h4>'+
  '<p>FuegoDance is an application that helps you to get fit through the dance.</p>'+
  '<hr>'+
 '<p class="mb-0">Welcome to the new and old students!!!</p>'+
'</div>';
return w;
}
Setting.envelopePost=function(posts){
    let messages="";
    //console.log("la fonction envelopePost");
    //console.log(posts);
    for(post in posts){
        console.log("le type :"+posts[post].type);
        if(posts[post].type=="text"){
            messages+='<div class="bulle-container" id="'+posts[post].id+'">'+
            
            '<p>'+posts[post].contents+'</p>'+
            posts[post].date+
          '</div>';
          
        }
        if(posts[post].type=="image"){
            messages+='<div class="bulle-container text-center" id="'+posts[post].id+'">'+
            '<img onclick="loadTunawezaEvent(this)" src="'+posts[post].contents+'" width="100%" class="img-rounded">'+
            posts[post].date+
          '</div>';
        }
        if(posts[post].type=="video"){
            messages+='<div class="bulle-container text-center" id="'+posts[post].id+'">'+
            '<video controls width="100%">'+

            '<source src="'+posts[post].contents+'">'+
        
            //<source src="/media/examples/flower.mp4" type="video/mp4">
        
            "Sorry, your browser doesn't support embedded videos."+
        '</video>'+
        posts[post].date+
          '</div>';
        }
        console.log(messages);
    }
    return messages;
}
Setting.loadPosts=function(){
    $.getJSON(localStorage.getItem("serverName")+"getPost",function(posts,status){
        console.log("voici les postes:");
        console.log(posts);
        //console.log("voici le dernier post:");
        
        if(posts.length>0){
            //console.log(Setting.getLastPostLoaded(posts));
            Setting.getLastPostLoaded(posts);
            let contenu=Setting.envelopePost(posts);
            //console.log("voici les messages:"+contenu);
            let cnt=localStorage.getItem("contentElement");
            let w=Setting.Welcome();
            console.log("we are loading the new messages...");
            $("#"+cnt).append(contenu);
            $("#"+cnt).prepend(w);
            setInterval(Setting.getNewPost,20000);

        }
    });
}