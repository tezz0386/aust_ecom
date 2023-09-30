<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
      <div class="user-panel mt-1 pb-2 mb-3 d-flex align-items-center">
        <div class="image mt-0 pt-0 mb-0 pb-0">
          <img src="https://mofaga.gov.np/images/site_logo.png" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="" class="d-block" style="line-height:20px;">
            {{auth()->user()->name}}
            <br><small style="font-size:70%;">{{auth()->user()->roleName()}}</small>
          </a>
        </div>
      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="" class="nav-link {{request()->is('home') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        Admin Dashboard
                    </p>
                </a>
            </li>

            @if(auth()->user()->can('Edit User') || auth()->user()->can('View User') || auth()->user()->can('Create User') || auth()->user()->can('Delete User'))
              <li class="nav-item {{request()->is('user*') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Use Management
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                  @if(auth()->user()->can('View User'))
                    <li class="nav-item">
                      <a href="{{route('user.index')}}" class="nav-link {{request()->is('user') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>User List</p>
                      </a>
                    </li>
                  @endif

                  @if(auth()->user()->can('Create User'))
                    <li class="nav-item">
                      <a href="{{route('user.create')}}" class="nav-link {{request()->is('user/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Add User</p>
                      </a>
                    </li>
                  @endif
                </ul>
              </li>
            @endif



            @if(auth()->user()->can('Edit Role') || auth()->user()->can('View Role') || auth()->user()->can('Create Role') || auth()->user()->can('Delete Role'))
              <li class="nav-item {{request()->is('role*') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                      Role Management
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                  @if(auth()->user()->can('View Role'))
                    <li class="nav-item">
                      <a href="{{route('role.index')}}" class="nav-link {{request()->is('role') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Role List</p>
                      </a>
                    </li>
                  @endif

                  @if(auth()->user()->can('Create Role'))
                    <li class="nav-item">
                      <a href="{{route('role.create')}}" class="nav-link {{request()->is('role/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Add Role</p>
                      </a>
                    </li>
                  @endif
                </ul>
              </li>
            @endif


        </ul>
      </nav>
    </div>
  </aside>