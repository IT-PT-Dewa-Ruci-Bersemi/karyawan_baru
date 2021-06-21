<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_dashboard') }}"><img src="{{ asset('components/images/Logo PT.png') }}" width="35" />PT Dewa Ruci Bersemi</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_dashboard') }}"><img src="{{ asset('components/images/Logo PT.png') }}" width="35" /></a>
        </div>
        <ul class="sidebar-menu">
            @foreach($master_nav as $masterNav)
                @if($masterNav->navigation()->whereIn('id', $__role->get('permission'))->count())
                    <li class="menu-header">{{ $masterNav->name }}</li>
                    @foreach($masterNav->navigation()->whereIn('id', $__role->get('permission'))->get() as $nav)
                        @php
                            $__treeAvailable  = $nav->subNav()->whereIn('id', $__role->get('permission'))->count();
                            $__active         = $nav->name === $__role->get('current_page')->name || ($__role->get('parent_page') ? $nav->id == $__role->get('parent_page')->id : 0) ? true : false;
                        @endphp
                        @if(!$__treeAvailable)
                            <li>
                                <a class="nav-link {{ $__active ? 'active' : '' }}" href="{{ ($nav->route != '' || $nav->route != null) ? route($nav->route) : "#" }}">
                                    @if($nav->image)
                                        <i class="fal {{ $nav->image }}"></i>
                                    @endif
                                    <span style="font-size:12px;">&nbsp;{{ $nav->menu }}</span>
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown {{ $__active ? 'active' : '' }}">
                                <a href="#" class="nav-link has-dropdown">
                                    @if($nav->image)
                                        <i class="fal {{ $nav->image }}"></i>
                                    @endif
                                    <span style="font-size:12px;">&nbsp;{{ $nav->menu }}</span>
                                </a>

                                <ul class="dropdown-menu">
                                    @foreach($nav->subNav()->whereIn('id', $__role->get('permission'))->get() as $subNav)
                                    <li>
                                        <a class="nav-link {{ $subNav->name == $__role->get('current_page')->name ? 'active ' : '' }}" href="{{route($subNav->route)}}">
                                            @if($subNav->image)
                                                <i class="fal {{ $subNav->image }}"></i>
                                            @endif
                                            <span style="font-size:12px;">&nbsp;{{ $subNav->menu }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </aside>
</div>