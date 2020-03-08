
<!DOCTYPE html>
<html lang="en">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="EhdzM7sV4oW63l3Fu0nJzFejkHNzCupVuUJL4Mrm">

    <title>TIPSMATE</title>

    <link rel="stylesheet" href="http://tipsmate.com/fireuikit/css/assets/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="http://tipsmate.com/fireuikit/css/assets/header.css">

    <link rel="icon" href="http://tipsmate.com/fireuikit/images/favicon.png">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" href="http://tipsmate.com/fireuikit/css/assets/howto.css">
    
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
	<meta name="twitter:card" content="player" />
	<meta name="twitter:site" content="@TwitterDev" />
	<meta name="twitter:title" content="Sample Player Card" />
	<meta name="twitter:description" content="This is a sample video. When you implement, make sure all links are secure." />
	<meta name="twitter:image" content="https://tipsmate.com/example.png" />
	<meta name="twitter:player" content="tipsmate.com/container.blade.php" />
	<meta name="twitter:player:width" content="480" />
	<meta name="twitter:player:height" content="480" />
</head>

<body class="container-fluid"  id = "how_to" >


   <div class="row ml-3 hd">
        <div class="col-md-1">
        </div>
        <div class="col-md-2 logo">
           <img id="logo" src="http://tipsmate.com/fireuikit/images/tipsmate_logo.png">
        </div>
        <div class="col-md-6 logo">
            <div class="main-menu">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="inactive" href="/askme" id="askme">ASK ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="active1" href="/howto" id="howto">HOW TO</a>
                    </li>
                                            <li class="nav-item">
                            <a class="inactive" href="/register" id="register">LOGOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="inactive" href="/login" id="register">
                                <img id="userimg" src="http://tipsmate.com/fireuikit/images/users/business_man.jpg" style="width: 30px;height: 30px" class="rounded-circle">
                                <a>John Doe</a>
                            </a>
                        </li>
                    
                </ul>
            </div>
        </div>
        <div class="col-md-1 logo">
            <div class="date" style="background:url(http://tipsmate.com/fireuikit/images/calendr.png) no-repeat center bottom">
                 <p id="date">20</p>
            </div>
        </div>
    </div>
   <div class="row ml-3 state">
       <div class="col-md-3">
           </div>
       <div class="col-md-6 sub-title">
           <p id="sub-title"><b>HOW TO</b></p>
       </div>
       <div class="col-md-3">
       </div>

   </div>
   <div class="row ml-3 py-lg-3 sub-menu-container">
       <div class="col-md-1">
       </div>
       <div class="col-md-2 category-title">
           <p id="category-title"> <b>CATEGORIES</b></p>
       </div>
       <div class="col-md-4 sub-menu">
               <ul class="nav">
        <li class="sub-menu article" id="sub-menu">
            <a class="inactive"  href="/howto/article" >ARTICLES</a>
        </li>
        <li class="sub-menu video" id="sub-menu">
            <a class="active1" href="/howto/video" >VIDEOS</a>
        </li>
    </ul>

       </div>
       

       <div class="col-md-2">

       </div>
   </div>
   <div class="row ml-3 sub-menu">
       <div class="col-md-1">
       </div>
       <div class="col-md-2">
                <div id="cat-all" roll="navigation" class="row">
        <ul class="none FW-400 MY-0 ml-3" id="categories">
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="1">
                      All Categories
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="2">
                      Arts Humanities
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="3">
                      Beauty &amp; Style
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="4">
                      Business &amp; Finance
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="5">
                      Cars &amp; Transportation
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="6">
                      Computers &amp; Internet
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="7">
                      Consumer Electronics
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="8">
                      Dining Out
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="9">
                      Education &amp; Reference
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="10">
                      Entertainment &amp; Music
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="11">
                      Environment
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="12">
                      Family &amp; Relationships
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="13">
                      Food &amp; Drink
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="14">
                      Games &amp; Recreation
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="15">
                      Health
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="16">
                      Home &amp; Garden
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="17">
                      Local Businesses
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="18">
                      News &amp; Events
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="19">
                      Pets
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="20">
                      Politics &amp; Government
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="21">
                      Pregnancy &amp; Parenting
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="22">
                      Science &amp; Mathematics
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="23">
                      Social Science
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="24">
                      Society &amp; Culture
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="25">
                      Sports
                  </li>
                </a>
                            <a class="none FW-400 MY-0 ml-3 categories" href="#">
                  <li class="FC_list" id="26">
                      Travel
                  </li>
                </a>
                   </ul>
    </div>
       </div>
       <div class="col-md-6 content">
               <div class="content-border">
        <div class="content-title">
           <h3>setting screen</h3>
        </div>
        <div class="content-detail">
            <h5>Cars & Transportation</h5>
        </div>
        <div class="content-detail">
            <h5>JuGuk Gang</h5>
        </div>
        <div class="conent-media">
            <video class="detail-view" controls >
                <source src="http://tipsmate.com/upload/2.mp4" type="video/mp4">
            </video>
        </div>
        <div class="content-detail">
            test!
        </div>
        
           <div class="content-share">
        <a
            href="https://twitter.com/share?url=http://tipsmate.com/howto/video/2"
            class="twitter-share-button"
            data-show-count="false">
            Tweet
        </a>
    </div>
    <script
        async src="https://platform.twitter.com/widgets.js"
        charset="utf-8">
    </script>
    </div>    

        <form action="http://tipsmate.com/article/comment" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="EhdzM7sV4oW63l3Fu0nJzFejkHNzCupVuUJL4Mrm">            <h3>Add your comment</h3>
            <div class="form-group">
                <input type="hidden" name="article_id" id="article_id" value="2">

                <textarea id="summernote" name="detail" class="form-control">
                </textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="send" id="send" class="btn btn-success">
                <input type="button" name="clear" id="clear" class="btn btn-danger pull-right" value="Clear">
            </div>
        </form>

               </div>
       <div class="col-md-1">
           <div class="google_ads">
                 <img src="http://tipsmate.com/fireuikit/images/google_ads.jfif">
           </div>
           <div class="google_ads">
               <img src="http://tipsmate.com/fireuikit/images/google_ads.jfif">
           </div>
       </div>
       <div class="col-md-1">
       </div>

   </div>





</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

    <script type="text/javascript">
         $(document).ready(function(){

         $('#userimg').popover({title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'><img src='http://tipsmate.com/fireuikit/images/user.png'/></div><div class='details ml-2'><span class='username mb-2'> John Doe</span><br><p class='useremail'>Superman@outlook.com </p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});
    });

    $('#userimg').popover({title: "<div class='m_dropdown_header'><div class='user_pic'><img src='http://tipsmate.com/fireuikit/images/user.png'></div><div class='details'><span> John Doe</span><p>Superman@outlook.com </p></div></div>", content: "<div class='dropdown_content'><a href='logout'>Logout</a></div>", html: true, placement: "bottom"});


    $('#userimg').popover({title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'><img src='http://tipsmate.com/fireuikit/images/user.png'/></div><div class='details ml-2'><span class='username mb-2'> John Doe</span><br><p class='useremail'>Superman@outlook.com </p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});



</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="http://tipsmate.com/fireuikit/js/jquery.magnific-popup.js"></script>

    <script src="http://tipsmate.com/fireuikit/js/mediagallery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(summernote).summernote({
                height: '100px',
                placeholder: "Input content here...",
                fontNames: ['Arial', 'Arial Black'],
            })
        });
        $(clear).on('click',function () {
            $(summernote).summernote('code',null);
        })

    </script>
</html>
