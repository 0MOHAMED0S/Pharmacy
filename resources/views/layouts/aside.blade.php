<aside class="left-sidebar" data-sidebarbg="skin5">
    <center><h5>{{Auth::guard('pharmacy')->user()->name}}</a></h5></center>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('home')}}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Home</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('profile.index')}}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Profile</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Medicinies
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('medicines.index')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                    class="hide-menu"> All Medicinies </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('medicines.create')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span
                                    class="hide-menu"> Add Medicine </span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
