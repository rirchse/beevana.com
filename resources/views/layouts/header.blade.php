<?php $user = Auth::user(); ?>
  <header class="main-header">
    <!-- Logo -->
    <a href="/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{asset('/img/logo-sq.png')}}" width="50"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{asset('/img/logo-w.png')}}" class="img-responsive"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{-- 4 --}}</span>
            </a>
            
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="">
                      <i class="fa fa-circle-o text-aqua"></i> 
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="/view_notifications">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/img/{{$user->image?'user/'. $user->image:'avatar.png'}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ $user->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('/img/avatar.png')}}" class="img-circle" alt="User Image">
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/user/{{Auth::id()}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/img/{{$user->image?'user/'. $user->image:'avatar.png'}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="text-align:right">
          <p>{{ $user->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i>
            
            {{ Auth::user()->authRole()->name }}

          </a><br>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <br>
      <ul class="sidebar-menu" data-widget="tree">
        {{-- <li class="header">MAIN NAVIGATION</li> --}}
        <li class="">
          <a href="/home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('sale.create') }}"><i class="fa fa-pencil"></i> Place An Order</a></li>
            <li><a href="{{ route('sale.index') }}"><i class="fa fa-list"></i> View All Orders</a></li>
            <li><a href="/sale/All/Daily"><i class="fa fa-calendar"></i> View Daily Orders</a></li>
            <li><a href="/sale/New/view"><i class="fa fa-circle-o"></i> New  Orders</a></li>
            <li><a href="/sale/Confirmed/view"><i class="fa fa-circle-o"></i> Confirmed Orders</a></li>
            <li><a href="/sale/Completed/view"><i class="fa fa-circle-o"></i> Completed Orders</a></li>
            <li><a href="/sale/Cancelled/view"><i class="fa fa-circle-o"></i> Cancelled Orders</a></li>
            <li><a href="/return"><i class="fa fa-undo"></i> Returned Orders</a></li>
          </ul>
        </li>
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Payments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/payment"><i class="fa fa-circle-o"></i> View Payments</a></li>
            <li><a href="/payment/bKash/view"><i class="fa fa-circle-o"></i>bKash Payments</a></li>
            <li><a href="/payment/Rocket/view"><i class="fa fa-circle-o"></i> Rocket Payments</a></li>
            <li><a href="/payment/Nagad/view"><i class="fa fa-circle-o"></i>Nagad Payments</a></li>
            <li><a href="/payment/Cash/view"><i class="fa fa-circle-o"></i>Cash Payments</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('customer.index')}}"><i class="fa fa-circle-o"></i> View Customers</a></li>            
          </ul>
        </li>

        @if(Auth::user()->authorizeRoles(['SuperAdmin', 'Admin']))

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i> <span>Accounts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.create') }}"><i class="fa fa-user-plus"></i> Create User</a></li>
            <li><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> View Users</a></li>
          </ul>
        </li>

        @endif

        <li class="treeview">
          <a href="#">
            <i class="fa fa-gear"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.show', $user->id) }}"><i class="fa fa-user"></i> Update Profile</a></li>
            <li><a href="/change_password"><i class="fa fa-lock"></i> Change Password</a></li>
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  <div class="alert-section" style="">
    <div class="clearfix"></div>
    @include('partials.messages')
   
    <div class="clearfix"></div>
  </div>