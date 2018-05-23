<div class="page-sidebar-wrapper">
  <!-- BEGIN SIDEBAR -->
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        @foreach($sidebar_menu as $menu)
            @switch($menu->type)
                @case(0)
                    <li class="heading">
                        <h3 class="uppercase">{{  $menu->object->text }}</h3>
                    </li>
                @break

                @case(1)
                    @if( $menu->object->subs && $menu->object->subs->count() > 0 )
                      <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                          <i class="{{ $menu->object->icon }}"></i>
                          <span class="title">{{ $menu->object->text }}</span>
                          <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                          @foreach( $menu->object->subs as $subs )
                            @if( $subs->subs && $subs->subs->count() > 0 )
                              <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                  <span class="title">{{ $subs->text }}</span>
                                  <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                  @foreach( $subs->subs as $subs )
                                  <li class="nav-item ">
                                    <a href="{{ url( $subs->route ) }}" class="nav-link"> {{ $subs->text }} </a>
                                  </li>
                                  @endforeach
                                </ul>
                              </li>
                            @else
                            <li class="nav-item">
                              <a href="{{ url( $subs->route ) }}" class="nav-link">
                                <span class="title">{{ $subs->text }}</span>
                              </a>
                            </li>
                            @endif
                          @endforeach
                        </ul>
                      </li>
                    @else
                      <li class="nav-item">
                        <a href="{{ url( $menu->object->route ) }}" class="nav-link nav-toggle">
                          <i class="{{ $menu->object->icon }}"></i>
                          <span class="title">{{ $menu->object->text }}</span>
                        </a>
                      </li>
                    @endif
                @break
            @endswitch
        @endforeach
    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
  <!-- END SIDEBAR -->
</div>