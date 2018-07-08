<aside class="left-side sidebar-offcanvas">
    <section class="sidebar ">
        <div class="page-sidebar  sidebar-nav">
            <div class="nav_icons">
                <ul class="sidebar_threeicons">
                    <li>
                        <a href="#">
                            <i class="livicon" data-name="hammer" title="Form Builder 1" data-loop="true" data-color="#42aaca" data-hc="#42aaca" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="livicon" data-name="list-ul" title="Form Builder 2" data-loop="true" data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="livicon" data-name="vector-square" title="Button Builder" data-loop="true" data-color="#f6bb42" data-hc="#f6bb42" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="livicon" data-name="new-window" title="Page Builder" data-loop="true" data-color="#37bc9b" data-hc="#37bc9b" data-s="25"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu" id="menu">
                <li>
                    <a href="#">
                        <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                        <span class="title">Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="#">
                        <i class="livicon" data-name="users" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                        <span class="title">Users</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('users.index')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="{{route('users.invite')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Add New User
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU --> </div>
    </section>
    <!-- /.sidebar --> 
</aside>