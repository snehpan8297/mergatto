
$(document).ready(function() {
 $("#tab_"+$_GET["title"]).addClass("active");
});

$(document).ready(function() {
  $_GET["offset"]=0;
  if(isset_and_not_empty($_GET["page"])){
    $_GET["offset"]=parseInt($_GET["page"])*5;
  }
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/blog/model/posts/model.php",
    data: {
      action: "list_posts",
      offset: $_GET["offset"]
    },
    error: function(data, textStatus, jqXHR) {
      show_notification("danger","Ha ocurrido un error en la conexión de internet",true);
    },
    success: function(response) {
      if(response.result){
        $_ajax["posts_list"]="";
        jQuery.each(response.data.posts,function($_key,$_post){
          $_ajax["posts_list"]+="<article>";
          $_ajax["posts_list"]+="  <header>";
          $_ajax["posts_list"]+="    <h1><a href='../blog/post/index.html?id_post="+$_post.id_post+"&page="+$_GET["page"]+"'>";
          $_ajax["posts_list"]+="         "+$_post.title+"";
          $_ajax["posts_list"]+="    </a></h1>";
          $_ajax["posts_list"]+="  </header>";
          $_ajax["posts_list"]+="  <div class='post-date'>";
          $_ajax["posts_list"]+="      "+timestamp_to_str($_post.created)+" | "+$_post.author+" ";
          $_ajax["posts_list"]+="  </div>	";

          $_str=$_post.header_content;
          $_str=$_str.replace("img ", "img class='img-responsive' ");

          $_ajax["posts_list"]+=" <a href='../blog/post/index.html?id_post="+$_post.id_post+"&page="+$_GET["page"]+"' class='div-link' ><div>"+$_str+"</div></a>";

          $_ajax["posts_list"]+="  </div>";
          $_ajax["posts_list"]+="</article>";
        });
        $_ajax["posts_list"]+="<div class='paging clearfix'>";
        if(response.data.has_previous_page){
          $_ajax["posts_list"]+="  <a class='btn btn-outline pull-left' href='../blog/index.html?page="+(parseInt($_GET["page"])-1)+"'><i class='icon-arrow-left2 left'></i><span>Anteriores</span><span class='hidden-xs'> Posts</span></a>";
        }
        if(response.data.has_next_page){
          $_ajax["posts_list"]+="  <a class='btn btn-outline pull-right' href='../blog/index.html?page="+(parseInt($_GET["page"])+1)+"'><span>Siguientes</span><span class='hidden-xs'> Posts</span><i class='icon-arrow-right2 right'></i></a>";
        }
        $_ajax["posts_list"]+="</div>";

        $_ajax["page"]=response.data.content;
        $("[data-ajax=posts-list]").html($_ajax["posts_list"]);
      }else{
        show_notification("danger","Ha ocurrido un error, vuelva a intentarlo más tarde ["+response.error_code+"]",true);
      }
    }
  });
});
