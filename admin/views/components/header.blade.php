<!-- Page Header Start-->
<div class="page-main-header">
   <div class="main-header-right row">
      <div class="main-header-left col-auto px-0 d-lg-none">
         <div class="logo-wrapper"><a href="index.html"><img src="@asset('logo.png')" alt=""></a></div>
      </div>
      <div class="vertical-mobile-sidebar col-auto ps-3 d-none"><i class="fa fa-bars sidebar-bar"></i></div>
      <div class="mobile-sidebar col-auto ps-0 d-block">
         <div class="media-body switch-sm">
            <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
         </div>
      </div>
      <div class="nav-right col p-0">
         <ul class="nav-menus">
            <li>
               <form class="form-inline search-form" action="#" method="get">
                  <div class="form-group me-0">
                     <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                           <input class="Typeahead-input form-control-plaintext" id="demo-input" type="text" name="q" placeholder="Search...">
                           <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                        </div>
                        <div class="Typeahead-menu"></div>
                     </div>
                  </div>
               </form>
            </li>

            <li class="onhover-dropdown"><i data-feather="bell"></i><span class="dot"></span>
               <ul class="notification-dropdown onhover-show-div">
                  <li>Notification <span class="badge rounded-pill badge-primary pull-right">{{ count(auth()->user()->unreadNotifications) }}</span></li>
                  @forelse (auth()->user()->unreadNotifications as $item)
                  <li>
                     <div class="media">
                        <div class="media-body">
                           <h6 class="mt-0"><span><i class="shopping-color" data-feather="shopping-bag"></i></span>Your order ready for Ship..!<small class="pull-right">9:00 AM</small></h6>
                           <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                        </div>
                     </div>
                  </li>
                  @empty

                  @endforelse
                  <li class="bg-light txt-dark"><a href="{{ route('admin.inbox') }}">All</a> notification</li>
               </ul>
            </li>
            <li class="onhover-dropdown">
               <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle" src="../assets/images/dashboard/user.png" alt="{{ auth()->user()->name }}">
                  <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>
               </div>
               <ul class="profile-dropdown onhover-show-div p-20">
                  <li><a href="{{ route('admin.edit') }}"><i data-feather="user"></i>Edit Profile</a></li>
                  <li><a href="{{ route('admin.inbox') }}"><i data-feather="mail"></i>Inbox</a></li>
                  <li><a href="{{ route('admin.logout') }}"><i data-feather="log-out"></i>Logout</a></li>
               </ul>
            </li>
         </ul>
         <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
      </div>
      <script id="result-template" type="text/x-handlebars-template">
         <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar">
               {{ request()->user()->avatar ?? '' }}
            </div>
            <div class="ProfileCard-details">
               <div class="ProfileCard-realName">{{ request()->user()->username ?? '' }}</div>
            </div>
         </div>
      </script>

   </div>
</div>
<!-- Page Header Ends -->
