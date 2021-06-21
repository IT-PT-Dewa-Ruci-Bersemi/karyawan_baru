<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 23/02/2018
 * Time: 11:18
 */
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            @foreach($docs as $nav)
                <li class="{{ ($nav->permalink === $detail->permalink || $nav->findChildren($detail->permalink)) ? 'active' : '' }}{{ $nav->children(1)->count() ? " treeview" : "" }}">
                    <a href=" {{ $nav->children(1)->count() ? "#" : route('admin_system_docs_detail', $nav->permalink) }}">
                        <span>{{ $nav->menu }}</span>
                        @if($nav->children(1)->count())<i class="fa fa-angle-left pull-right"></i>@endif
                    </a>
                    @if($nav->children(1)->count())
                        <ul class="treeview-menu">
                            @foreach($nav->children(1)->get() as $subNav)
                                <li class="{{ $subNav->permalink === $detail->permalink ? 'active ' : '' }}">
                                    <a href="{{ route('admin_system_docs_detail', $subNav->permalink) }}">
                                        <span>{{ $subNav->menu }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
