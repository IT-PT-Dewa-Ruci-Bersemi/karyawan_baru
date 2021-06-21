<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 11/04/19
 * Time: 16.26
 */
?>
<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="far fa-mask"></i></a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Super Menu</div>
        <div class="dropdown-list-content dropdown-list-icons">
            <a href="{{ route('_core_apps_master_navigation') }}" class="dropdown-item dropdown-item-unread">
                <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                </div>
                <div class="dropdown-item-desc pt-2">
                    <h6>Master Navigation</h6>
                </div>
            </a>
            {{--<a href="{{ route('_core_apps_docs') }}" class="dropdown-item">--}}
                {{--<div class="dropdown-item-icon bg-info text-white">--}}
                    {{--<i class="fas fa-bell"></i>--}}
                {{--</div>--}}
                {{--<div class="dropdown-item-desc">--}}
                    {{--Documentation--}}
                    {{--<div class="time text-primary font-italic">Admin Console</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        </div>
        <div class="dropdown-footer text-center">
            <a href="{{ route('_core') }}">View All <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</li>