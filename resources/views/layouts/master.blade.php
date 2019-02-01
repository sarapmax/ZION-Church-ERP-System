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
                {{--<img src="{{ asset('images/logo.png') }}" class="navbar-brand-img  mx-auto" alt="...">--}}
                <strong>Zion System</strong>
            </a>

            <div class="navbar-user d-md-none">
                <div class="dropdown">
                    <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle align-self-center" width="40px" height="40px"  src="{{ auth()->user()->profile_image_path }}" alt="{{ Auth::user()->fullname }}">
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

                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge">
                        <input type="search" class="form-control form-control-rounded form-control-prepended"
                               placeholder="Search" aria-label="Search">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fe fe-search"></span>
                            </div>
                        </div>
                    </div>
                </form>

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
                            <i class="fe fe-home"></i> ระบบฐานข้อมูลสมาชิก
                        </a>
                        <div class="collapse {{ setActive('membership') ? 'show' : '' }}" id="sidebarMembership">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('membership.church.index') }}"
                                       class="nav-link {{ setActive('membership/church') ? 'active' : '' }}">
                                        คริสตจักร
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('membership.cell.index') }}"
                                       class="nav-link {{ setActive('membership/cell') ? 'active' : '' }}">
                                        กลุ่มแคร์
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('membership.member.index') }}"
                                       class="nav-link {{ setActive('membership/member') ? 'active' : '' }}">
                                        ข้อมูลสมาชิก
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">

        {{--Topbar--}}
        <nav class="navbar navbar-expand-md navbar-light d-none d-md-flex" id="topbar">
            <div class="container-fluid">


                <!-- User -->
                <div class="navbar-user ml-auto">
                    <!-- Dropdown -->
                    <div class="dropdown">

                        <!-- Toggle -->
                        <a href="#" class="dropdown-toggle d-flex" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{--<div class="avatar avatar-sm">--}}
                            {{--<span class="avatar-title rounded-circle">ZS</span>--}}
                            {{--</div>--}}
                            <img class="rounded-circle align-self-center" width="40px" height="40px" src="{{ auth()->user()->profile_image_path }}" alt="{{ Auth::user()->fullname }}">
                            <div class="d-flex flex-column align-items-center ml-3 text-secondary">
                                <div>{{ Auth::user()->fullname }}</div>
                                <small class="mr-auto">{{ Auth::user()->administrative_status_name }}</small>
                            </div>
                            <i class="text-secondary fe fe-chevron-down ml-2"></i>
                        </a>


                        <!-- Menu -->
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
