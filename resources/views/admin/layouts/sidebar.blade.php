<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('dashboard') }}" class="brand-link">
        <img src="{{ asset('/assets/images/preloader.gif') }}" class="brand-image img-circle elevation-3">VijayHardwares
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item has-treeview {{ request()->segment(1) == 'dashboard' ? 'menu-open' : '' }}">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                  <li class="nav-item has-treeview {{ request()->segment(1) == 'profile' || request()->is('changepassword') ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Projects
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->segment(1) == 'addproject' ? 'menu-open' : '' }}">
                            <a href="{{ url('admin/addproject') }}"
                                class="nav-link {{ Request::is('addproject') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-clipboard"></i>
                                <p>Add Project</p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="{{ url('admin/projects/1') }}"
                                class="nav-link {{ request()->segment(1) == '1' ? 'active' : '' }}">
                                <i class="fa fa-ban nav-icon"></i>
                                <p>Upcoming Projects</p>
                            </a>
                        </li>                       
                        <li class="nav-item">
                            <a href="{{ url('admin/projects/2') }}"
                                class="nav-link {{ request()->segment(1) == '2' ? 'active' : '' }}">
                                <i class="fa fa-ban nav-icon"></i>
                                <p>Progress Projects</p>
                            </a>
                        </li>                       
                        <li class="nav-item">
                            <a href="{{ url('admin/projects/3') }}"
                                class="nav-link {{ request()->segment(1) == '3' ? 'active' : '' }}">
                                <i class="fa fa-ban nav-icon"></i>
                                <p>Completed Projects</p>
                            </a>
                        </li>
                    </ul>
                </li>
				
				<li class="nav-item has-treeview {{ request()->segment(2) == 'location' || request()->segment(2) == 'categorys' || request()->segment(2) == 'banners' || request()->segment(2) == 'subcategory' ? 'menu-open' : '' }}">
					<a href="#"
						class="nav-link {{ request()->segment(2) == 'location' || request()->segment(2) == 'categorys' || request()->segment(2) == 'banners' || request()->segment(2) == 'subcategory' ? 'active' : '' }}">
						<i class="nav-icon fas fa-cog"></i>
						<p>
							Setting
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('banners') }}"
								class="nav-link {{ request()->segment(2) == 'banners' ? 'active' : '' }}">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Banners</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('backup') }}"
								class="nav-link {{ request()->is('backup') ? 'active' : '' }}">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Backup</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('admin/category') }}"
								class="nav-link {{ request()->segment(2) == 'category' || request()->segment(2) == 'subcategory' ? 'active' : '' }}">

								<i class="far fa-dot-circle nav-icon"></i>
								<p>Category</p>
							</a>
						</li>
						
						
					</ul>
				</li>
                <li class="nav-item has-treeview {{ request()->segment(1) == 'profile' || request()->is('changepassword') ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{ Auth::user()->full_name }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->segment(1) == 'changepassword' ? 'menu-open' : '' }}">
                            <a href="{{ url('changepassword') }}"
                                class="nav-link {{ Request::is('changepassword') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-clipboard"></i>
                                <p>Changepassword</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/logout') }}"
                                class="nav-link {{ Request::is('logout') ? 'active' : '' }}">
                                <i class="fa fa-ban nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>