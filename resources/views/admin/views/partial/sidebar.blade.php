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
                <a href="/home" class="nav-link {{request()->is('home') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        Admin Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
              <a href="{{route('product.index')}}" class="nav-link {{request()->is('product') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                      Products
                  </p>
              </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>