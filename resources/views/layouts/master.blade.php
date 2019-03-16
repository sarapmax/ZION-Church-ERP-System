<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>ZION SYSTEM</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
    {{--Sidebar--}}
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark" id="sidebar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
                    aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                ZION SYSTEM
            </a>

            <div class="navbar-user d-md-none">
                <div class="dropdown">
                    <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm">
                            <img class="avatar-img rounded-circle" width="30px" src="{{ auth()->user()->profile_image_path }}" alt="{{ Auth::user()->fullname }}">
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="" class="dropdown-item">ข้อมูลส่วนตัวของฉัน</a>
                        <hr class="dropdown-divider">
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ออกจากระบบ</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <hr class="navbar-divider my-3 d-none d-md-block">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fe fe-monitor"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarMembership" data-toggle="collapse" role="button"
                           aria-expanded="{{ setActive('membership') ? 'true' : 'false' }}"
                           aria-controls="sidebarMembership">
                            <i class="fe fe-users"></i> ระบบฐานข้อมูลสมาชิก
                        </a>
                        <div class="collapse {{ setActive('membership') ? 'show' : '' }}" id="sidebarMembership">
                            <ul class="nav nav-sm flex-column">
                                @if (Auth::user()->can('manage-church-structure'))
                                <li class="nav-item">
                                    <a href="{{ route('membership.church.index') }}"
                                       class="nav-link {{ setActive('membership/church') ? 'active' : '' }}">
                                        คริสตจักร
                                    </a>
                                </li>
                                    <li class="nav-item">
                                        <a href="{{ route('membership.area.index') }}"
                                           class="nav-link {{ setActive('membership/area') ? 'active' : '' }}">
                                            หน่วย
                                        </a>
                                    </li>
                                <li class="nav-item">
                                    <a href="{{ route('membership.cell.index') }}"
                                       class="nav-link {{ setActive('membership/cell') ? 'active' : '' }}">
                                        กลุ่มแคร์
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('membership.member.index') }}"
                                       class="nav-link {{ setActive('membership/member') ? 'active' : '' }}">
                                        ข้อมูลสมาชิก
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @if (Auth::user()->can('manage-church-finance'))
                        <a class="nav-link" href="#sidebarFinance" data-toggle="collapse" role="button"
                           aria-expanded="{{ setActive('finance') ? 'true' : 'false' }}"
                           aria-controls="sidebarMembership">
                            <i class="fe fe-dollar-sign"></i> ระบบการเงิน
                        </a>
                        <div class="collapse {{ setActive('finance') ? 'show' : '' }}" id="sidebarFinance">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('finance.service-round.index') }}"
                                       class="nav-link {{ setActive('finance/service-round') ? 'active' : '' }}">
                                        รอบนมัสการ
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('finance.offering.index') }}"
                                       class="nav-link {{ setActive('finance/offering') ? 'active' : '' }}">
                                        บันทึกเงินถวาย
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <nav class="navbar navbar-expand-md navbar-light d-none d-md-flex" id="topbar">
            <div class="container-fluid">
                <div class="navbar-user ml-auto">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle d-flex" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-xs">
                                <img class="avatar-img rounded-circle" src="{{ auth()->user()->profile_image_path }}" alt="{{ Auth::user()->fullname }}">
                            </div>
                            <div class="d-flex flex-column align-items-center justify-content-center ml-3 text-secondary">
                                <div>{{ Auth::user()->fullname }}</div>
                            </div>
                            <i class="text-secondary fe fe-chevron-down ml-2 d-flex flex-column align-items-center justify-content-center"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item">ข้อมูลส่วนตัวของฉัน</a>
                            <hr class="dropdown-divider">
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ออกจากระบบ</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        {{--Main content--}}
        <div class="container-fluid" id="app">
            @yield('breadcrumbs')

            @include('layouts.flash-message')

            @yield('content')
        </div>

    </div>

    <div class="page-loading-spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
