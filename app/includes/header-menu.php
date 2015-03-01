<header id="header" class="app-header navbar" role="menu">
          <!-- navbar header -->
  <div class="navbar-header bg-dark">
    <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
      <i class="glyphicon glyphicon-cog"></i>
    </button>
    <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
      <i class="glyphicon glyphicon-align-justify"></i>
    </button>
    <!-- brand -->
    <a href="/" class="navbar-brand text-lt">
      <!-- <i class="fa fa-btc"></i> -->      
      
      <!-- <img src="<?php //echo asset('img/logoWhite.png'); ?>" alt="." > -->
      <i class="fa fa-comments text-warning"></i>
      <span class="hidden-folded m-l-xs" style="font-size: 16px;">
        <i style="font-size: 20px;">e</i><span style="color:#23b7e5;">SURVEY</span>
      </span>
      
    </a>
    <!-- / brand -->
  </div>
  <!-- / navbar header -->

  <?php if ( Auth::check() ){ ?>
  <!-- navbar collapse -->
  <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
    <!-- buttons -->
    <div class="nav navbar-nav hidden-xs">
      <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
        <i class="fa fa-dedent fa-fw text"></i>
        <i class="fa fa-indent fa-fw text-active"></i>
      </a>
      <!-- <a href="#" class="btn no-shadow navbar-btn" ui-toggle="show" target="#aside-user">
        <i class="icon-user fa-fw"></i>
      </a> -->
    </div>
    <!-- / buttons -->

    
    <!-- search form -->
    <!-- <form class="navbar-form navbar-form-sm navbar-left shift" role="search" action="/search" method="GET">
      <div class="form-group">
        <div class="input-group">          
          <input type="text" class="form-control input-sm bg-light no-border rounded padder" id="q" name="q" maxlength='10' required placeholder="Search...">
          <input type="hidden" id="availableNames" value="0">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </div>
    </form> -->
    <!-- / search form -->

    
    <!-- nabar right -->
    <ul class="nav navbar-nav navbar-right">      
      <li class="dropdown">
        
        <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
          <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
            <?php 
              $photo = 'img/bridge_small.jpg';
              if( strlen(Session::get('photo'))>3 ){ 
                $photo = 'img/uploads/'.Session::get('photo');
              }
            ?>
            <img src="<?php echo asset($photo); ?>" alt="...">
            <i class="on md b-white bottom"></i>
          </span>
          <span class="hidden-sm hidden-md"><?php echo Session::get('user'); ?></span> <b class="caret"></b>
        </a>
        <!-- dropdown -->
        <ul class="dropdown-menu animated fadeInRight w">
      
          <li>
            <a href="/settings">
              <i class="fa fa-cog"></i>
              <span>Settings</span>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="/logout"><i class="fa fa-power-off"></i> Logout</a>
          </li>
        </ul>
        <!-- / dropdown -->
      </li>
    </ul>
    <!-- / navbar right -->
  </div>

  <?php } ?>
  <!-- / navbar collapse -->
</header>