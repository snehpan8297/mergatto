
$(document).ready(function() {
 $("#tab_"+$_GET["title"]).addClass("active");
});

$(document).ready(function() {
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/blog/model/posts/model.php",
    data: {
      action: "get_posts",
      id_post: $_GET["id_post"]
    },
    error: function(data, textStatus, jqXHR) {
      show_notification("danger","Ha ocurrido un error en la conexión de internet",true);
    },
    success: function(response) {
      if(response.result){
        $_ajax["post-title-link"]="<a href='../../blog/post/index.html?id_post="+response.data.id_post+"'>"+response.data.title+"</a>";
        $("[data-ajax=post-title-link]").html($_ajax["post-title-link"]);

        $_ajax["post-created"]=timestamp_to_str(response.data.created);
        $("[data-ajax=post-created]").html($_ajax["post-created"]);

        $_ajax["post-author"]=response.data.author;
        $("[data-ajax=post-author]").html($_ajax["post-author"]);

        $_str=response.data.content;
        $_str=$_str.replace(/img/g, "img class='max-full-width' ");

        $_ajax["post-content"]=$_str;
        $("[data-ajax=post-content]").html($_ajax["post-content"]);


        $_ajax["post-tags"]="";
        if(isset_and_not_empty(response.data.tags)){
          jQuery.each(response.data.tags,function($_key,$_tag){
            $_ajax["post-tags"]+=" "+$_tag.title;
          });
        }
        $("[data-ajax=post-tags]").html($_ajax["post-tags"]);
        $_ajax["post-share"]="";
        $("[data-ajax=post-share]").html($_ajax["post-share"]);

        $_ajax["blog-link"]="<a class='btn btn-outline' href='../../blog/index.html?page=0?page="+$_GET["page"]+"'><i class='icon-arrow-left2 left'></i><span>Listado</span><span class='hidden-xs'> Posts</span></a>";
        $("[data-ajax=blog-link]").html($_ajax["blog-link"]);

      }else{
        show_notification("danger","Ha ocurrido un error, vuelva a intentarlo más tarde ["+response.error_code+"]",true);
      }
    }
  });
});
