<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
            @foreach(config('menu-system') as $menu)
                @if (sectionMenuIsVisible($menu['section']))
                    {{-- Section: $menu['section']['name'] --}}
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ $menu['section']['name'] }}</span>
                        </div>
                    </div>
                    @foreach($menu['section']['modules'] as $module)
                        {{-- (Validar si el módulo tiene ruta principal, y de ser así validar si existe) o pasará si no tiene ruta principal  --}}
                        @if(
                            ($module['urlName'] && Route::has($module['urlName'])) ||
                            !$module['urlName']
                        )
                            {{-- Validar si la persona tiene algún permiso del módulo, si no tiene dejará pasar por si existen rutas que no se requieran permisos --}}
                            @canany($module['canany'])
                                {{-- Module: $module['name'] --}}
                                <div
                                    @if(!$module['urlName']) data-kt-menu-trigger="click" @endif
                                    class="menu-item @if(!$module['urlName']) 'menu-accordion' @endif"
                                    >
                                    <a href="{{ $module['urlName'] ? route($module['urlName']) : '#' }}" class="menu-link {{ active($module['active']) }}">
                                        <span class="menu-icon">
                                            <i class="{{ $module['icon'] }}"></i>
                                        </span>
                                        <span class="menu-title">{{ $module['name'] }}</span>
                                        @if(!$module['urlName'])
                                            <span class="menu-arrow"></span>
                                        @endif
                                    </a>
                                    @if(count($module['submodules']))
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            @foreach ($module['submodules'] as $submodule)
                                                {{-- Submodule: $submodule['name'] --}}
                                                @if(Route::has($submodule['urlName']))
                                                    <div class="menu-item">
                                                        <a class="menu-link {{ active($submodule['active']) }}" href="{{ route($submodule['urlName']) }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">{{ $submodule['name'] }}</span>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endcanany
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
    <!--end::Aside Menu-->
</div>
