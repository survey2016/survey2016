<?php if ( Auth::check() ){ ?>

<?php 

    $path = Request::path(); 
    $dashboard = $individual = $analytics = $tag = $taggers = $candidates = $voters = $users = $positions = $locations = $others = '';
    
    $active = 'active';
    switch ($path) {
        case 'dashboard'        : $dashboard = $active; break;
        // COMPANIES
        case 'tag'              : $tag = $active; break;        
        case 'candidates'       : $candidates = $active; break;
        case 'voters'           : $voters = $active; break;
        case 'taggers'          : $taggers = $active; break;
        case 'users'            : $users = $active; break;    
        case 'positions'        : $positions = $active; break;   
        case 'locations'        : $locations = $active; break;   
        case 'others'           : $others = $active; break;   
    }
?>

<aside id="aside" class="app-aside hidden-xs bg-dark">
          <div class="aside-wrap">
        <div class="navi-wrap">
          <!-- user -->
          <div class="clearfix hidden-xs text-center hide" id="aside-user">
            <div class="dropdown wrapper">
              <a href="app.page.profile">
                <span class="thumb-lg w-auto-folded avatar m-t-sm">
                  <?php 
                    $photo = 'img/bridge_small.jpg';
                    if( strlen(Session::get('photo'))>3 ){  
                      $photo = 'img/uploads/'.Session::get('photo');
                    }
                  ?>
                  <img src="<?php echo $photo; ?>" class="img-full" alt="...">
                </span>
              </a>
              <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                <span class="clear">
                  <span class="block m-t-sm">
                    <strong class="font-bold text-lt"><?php echo Session::get('user'); ?></strong> 
                    <b class="caret"></b>
                  </span>
                </span>
              </a>
              <!-- dropdown -->
              <ul class="dropdown-menu animated fadeInRight w hidden-folded">
                <li>
                  <a href="/settings"><i class="fa fa-cog"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="/logout"><i class="fa fa-power-off"></i> Logout</a>
                </li>
              </ul>
              <!-- / dropdown -->
            </div>
            <div class="line dk hidden-folded"></div>
          </div>
          <!-- / user -->

          <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav">
            <?php if(Session::get('userType')!='T'){ ?>
              <!-- <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>Dashboard</span>
              </li> -->
              <li class="<?php echo $dashboard; ?>"><a href="/dashboard"><i class="glyphicon glyphicon-stats"></i><span>Dashboard</span></a></li>
                <!-- <li class="<?php //echo $individual; ?>"><a href="/individual"><i class="fa fa-rss"></i><span>By Candidate</span></a></li>              -->
                
              <!-- <li class="line dk"></li> -->
              <!-- <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>Actions</span>
              </li> -->  
            <?php } ?>

                <li class="<?php echo $tag; ?>"><a href="/tag"><i class="fa fa-check-square-o"></i><span> Tag</span></a></li>
                                                                   
            
            <?php if(Session::get('userType')!='T'){ ?>
                <!-- <li class="<?php //echo $tag_summary; ?>"><a href="/tag-summary"><i class="fa fa-database"></i><span> Tag Summary</span></a></li> -->
              <li class="line dk"></li>              
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>Lists</span>
              </li>                
                <li class="<?php echo $candidates; ?>"><a href="/candidates"><i class="fa fa-star"></i><span> Candidates</span></a></li>
                <li class="<?php echo $voters; ?>"><a href="/voters"><i class="glyphicon glyphicon-heart"></i><span> Voters</span></a></li>
                <li class="<?php echo $taggers; ?>"><a href="/taggers"><i class="fa fa-tasks"></i><span> Taggers</span></a></li>
                <li class="<?php echo $users; ?>"><a href="/users"><i class="fa fa-user"></i><span> Users</span></a></li> 
              <li class="line dk"></li>
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>Settings</span>
              </li>                
                <li class="<?php echo $positions; ?>"><a href="positions"><i class="fa fa-star"></i><span> Positions</span></a></li>
                <li class="<?php echo $locations; ?>"><a href="locations"><i class="fa fa-map-marker"></i><span> Locations</span></a></li>                
                <li class="<?php echo $others; ?>"><a href="others"><i class="fa fa-cogs"></i><span> Others</span></a></li>  
            <?php } ?>
            </ul>
          </nav>
          <!-- nav -->


          <!-- aside footer -->
          <div class="wrapper m-t">
            <br><br><br><br><br>
            <!-- <div class="text-center-folded">
              <span class="pull-right pull-none-folded">60%</span>
              <span class="hidden-folded">Milestone</span>
            </div>
            <div class="progress progress-xxs m-t-sm dk">
              <div class="progress-bar progress-bar-info" style="width: 60%;">
              </div>
            </div>
            <div class="text-center-folded">
              <span class="pull-right pull-none-folded">35%</span>
              <span class="hidden-folded">Release</span>
            </div>
            <div class="progress progress-xxs m-t-sm dk">
              <div class="progress-bar progress-bar-primary" style="width: 35%;">
              </div>
            </div> -->
          </div>
          <!-- / aside footer -->
        </div>
      </div>
  </aside>
  <?php } ?>