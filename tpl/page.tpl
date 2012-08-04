<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{TITLE}Магазин постельного белья Art Bedroom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{DESCRIPTION}">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="{bp}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{bp}/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="{bp}/css/docs.css" rel="stylesheet">
    <link href="{bp}/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet">    
    <link href="{bp}/css/style.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="{bp}/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" hrhttps://github.com/twitter/bootstrap.gitef="{bp}/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{bp}/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{bp}/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{bp}/ico/apple-touch-icon-57-precomposed.png">
    <script src="{bp}/js/jquery-1.7.2.min.js"></script>
    <script src="{bp}/js/bootstrap.min.js"></script>
    <script src="{bp}/js/menu.js"></script>
    <script src="{bp}/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script src="{bp}/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script src="{bp}/fancybox/jquery.easing-1.3.pack.js"></script>    
    <script src="{bp}/js/gallery.js"></script>
    <script src="{bp}/js/search.js"></script>
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">
    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>          
          <div class="nav-collapse collapse">            
            <ul class="nav">
              <li>
                <a class="brand" href="/">Art bedroom</a>
              </li>
              <li class="divider-vertical"></li>
              <li class="dropdown{CATALOG_ACTIVE}" id="catalog">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Каталог <b class="caret"></b></a>
                {CATALOG}
              </li>              
              <li class="{PAYMENT_ACTIVE}">
                <a href="/payment">Оплата и доставка</a>
              </li>
              <li class="{CONTACTS_ACTIVE}">
                <a href="/contacts">Контакты</a>
              </li>
            </ul>
          </div>          
          <form class="navbar-search pull-right" id="search-form" action="/search" method="post">
            <input type="text" id="search" name="q" class="search-query span3" placeholder="Поиск">
          </form>          
        </div>
      </div>
    </div>

    <div class="container container-fluid">   
      {CONTENT}      
    </div>  

    <div class="hidden">
      <div id="fancy-title">        
          <table cellspacing="0" cellpadding="0" id="fancybox-title-float-wrap">
            <tbody>
              <tr>
                <td id="fancybox-title-float-left"></td>
                <td id="fancybox-title-float-main">
                  <a href="/product/(ID)">(TITLE)</a>
                </td>
                <td id="fancybox-title-float-right"></td>
              </tr>
            </tbody>
          </table>
      </div>  
    </div>
  </body>
</html>