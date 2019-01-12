<!DOCTYPE html>
<html>
<head>
    <title>ZION SYSTEM</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body class="menu-position-side menu-side-left full-screen">
<div class="all-wrapper solid-bg-all">
    <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
            <div class="mm-logo-buttons-w">
                <a class="mm-logo" href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}"><span> ZION SYSTEM</span></a>
                <div class="mm-buttons">
                    <div class="content-panel-open">
                        <div class="os-icon os-icon-grid-circles"></div>
                    </div>
                    <div class="mobile-menu-trigger">
                        <div class="os-icon os-icon-hamburger-menu-1"></div>
                    </div>
                </div>
            </div>
            <div class="menu-and-user">
                <div class="logged-user-w">
                    <div class="avatar-w icon-lg">
                        <i class="os-icon os-icon-user-male-circle"></i>
                    </div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">
                            {{ Auth::user()->fullname }}
                        </div>
                        <div class="logged-user-role">
                            {{ Auth::user()->administrative_role->getKey() }}
                        </div>
                    </div>
                </div>

                <!--------------------
                START - Mobile Menu List
                -------------------->
                <ul class="main-menu">
                    <li class="selected">
                        <a href="{{ route('member.church.index') }}">
                            <div class="icon-w">
                                <div class="fas fa-church"></div>
                            </div>
                            <span>คริสตจักร</span>
                        </a>
                    </li>
                    <li class="selected">
                        <a href="{{ route('member.cell.index') }}">
                            <div class="icon-w">
                                <div class="fas fas-place-of-worship"></div>
                            </div>
                            <span>กลุ่มแคร์</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <div class="icon-w">
                                <div class="fas fa-users"></div>
                            </div>
                            <span>ข้อมูลสมาชิก</span>
                        </a>
                    </li>
                </ul>
                <!--------------------
                END - Mobile Menu List
                -------------------->
            </div>
        </div>
        <!--------------------
        END - Mobile Menu
        -------------------->
        <!--------------------
        START - Main Menu
        -------------------->
        <div class="menu-w color-scheme-light menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
            <div class="logo-w">
                <a class="logo" href="{{ url('/') }}">
                    <div class="logo-element"></div>
                    <div class="logo-label">
                        ZION SYSTEM
                    </div>
                </a>
            </div>
            <div class="logged-user-w avatar-inline">
                <div class="logged-user-i">
                    <div class="avatar-w icon-lg">
                        <i class="os-icon os-icon-user-male-circle"></i>
                    </div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">
                            {{ Auth::user()->fullname }}
                        </div>
                        <div class="logged-user-role">
                            {{ Auth::user()->administrative_role->getKey() }}
                        </div>
                    </div>
                    <div class="logged-user-toggler-arrow">
                        <div class="os-icon os-icon-chevron-down"></div>
                    </div>
                    <div class="logged-user-menu color-style-bright">
                        <div class="logged-user-avatar-info">
                            <div class="avatar-w icon-lg text-white">
                                <i class="os-icon os-icon-user-male-circle"></i>
                            </div>
                            <div class="logged-user-info-w">
                                <div class="logged-user-name">
                                    {{ Auth::user()->fullname }}
                                </div>
                                <div class="logged-user-role">
                                    {{ Auth::user()->administrative_role->getKey() }}
                                </div>
                            </div>
                        </div>
                        <div class="bg-icon">
                            <i class="os-icon os-icon-wallet-loaded"></i>
                        </div>
                        <ul>
                            <li>
                                @include('partials.logout')
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h1 class="menu-page-header">
                Page Header
            </h1>
            <ul class="main-menu">
                <li class="sub-header">
                    <span>ระบบฐานข้อมูลสมาชิก</span>
                </li>
                <li>
                    <a href="{{ route('member.church.index') }}">
                        <div class="icon-w">
                            <div class="fas fa-church"></div>
                        </div>
                        <span>คริสตจักร</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('member.cell.index') }}">
                        <div class="icon-w">
                            <div class="fas fa-place-of-worship"></div>
                        </div>
                        <span>กลุ่มแคร์</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <div class="icon-w">
                            <div class="fas fa-users"></div>
                        </div>
                        <span>ข้อมูลสมาชิก</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">
            <!--------------------
             START - Top Bar
             -------------------->
            <div class="top-bar color-scheme-transparent">
                <!--------------------
                START - Top Menu Controls
                -------------------->
                <div class="top-menu-controls">
                    <!--------------------
                    START - User avatar and menu in secondary top menu
                    -------------------->
                    <div class="logged-user-w">
                        <div class="logged-user-i">
                            <div class="avatar-w">
                                <i class="os-icon os-icon-user-male-circle"></i> {{ Auth::user()->fullname }}
                            </div>
                            <div class="logged-user-menu color-style-bright">
                                <div class="logged-user-avatar-info">
                                    <div class="avatar-w text-white icon-lg">
                                        <i class="os-icon os-icon-user-male-circle"></i>
                                    </div>
                                    <div class="logged-user-info-w">
                                        <div class="logged-user-name">
                                            {{ Auth::user()->fullname }}
                                        </div>
                                        <div class="logged-user-role">
                                            {{ Auth::user()->administrative_role->getKey() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-icon">
                                    <i class="os-icon os-icon-wallet-loaded"></i>
                                </div>
                                <ul>
                                    <li>
                                        @include('partials.logout')
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--------------------
                    END - User avatar and menu in secondary top menu
                    -------------------->
                </div>
                <!--------------------
                END - Top Menu Controls
                -------------------->
            </div>
            <!--------------------
            END - Top Bar
            -------------------->
            <!--------------------
            START - Breadcrumbs
            -------------------->
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span>Dashboard</span>
                </li>
            </ul>
            <!--------------------
            END - Breadcrumbs
            -------------------->
            <div class="content-i">
                <div class="content-box" id="app">
                    @include('partials.flash-message')

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>

@yield('scripts')
</body>
</html>
