<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layouts.header_custom_top')
    @include('admin.layouts.header_scripts')
    @include('admin.layouts.header_custom_bottom')
    <title>FXC</title>
</head>
<body>
<div class="containerBox">
    <header>
        <nav class="navbar">
            <div class="navbar-header d-flex justify-content-center align-items-center">
                <a class="navbar-brand" href="{{route("admin.home")}}">
                    <img src="{{ asset('assets/admiko/images/logo.png') }}">
                </a>
            </div>
            <div class="sidebar">
                <div class="sidebar-user">
                    <a href="{{route("admin.myaccount")}}">
                        <img src="{{auth()->user()->image}}" class="img-fluid">
                    </a>
                    <div class="sidebar-user-name">{{auth()->user()->name}}</div>
                    <div class="sidebar-user-email">{{auth()->user()->email}}</div>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <div class="menu-title">
                            <div>Menu</div>
                        </div>
                    </li>
                    <li class="nav-item page{{ $admiko_data['sideBarActive'] === "home" ? " active" : "" }}">
                        <a class="nav-link" href="{{route("admin.home")}}"><i class="fas fa-home fa-fw"></i>{{ trans('admiko.home') }}</a>
                    </li>
                    @include('admin.custom_sidebar_top')
                    {{--!!! To prevent overwriting please add your links into custom_sidebar!!!--}}
                    @include('admin.admiko_sidebar')
                    {{--!!! To prevent overwriting please add your links into custom_sidebar!!!--}}
                    @include('admin.custom_sidebar_bottom')

                    <li class="nav-item myaccount{{ $admiko_data['sideBarActive'] === "myaccount" ? " active" : "" }}">
                        <a class="nav-link" href="{{route("admin.myaccount")}}"><i class="fas fa-user fa-fw"></i>{{ trans('admiko.myaccount') }}</a>
                    </li>
                    <li class="nav-item logout">
                        <a class="nav-link" href="{{route("admin.logout")}}"><i class="fas fa-power-off fa-fw"></i>{{ trans('admiko.logout') }}</a>
                    </li>
                    @include('admin.layouts.admiko_developer_sidebar')
                </ul>
            </div>
        </nav>
        <footer>
            <a href="" target="_blank">&copy; {{date("Y")}} Powered by Fx Cobra</a>
        </footer>
    </header>
    <div class="main">
        <div class="mainBoxHeader">
            <nav class="navbar navbar-expand">
                <a class="sidebar-toggle d-flex me-2" href="#">
                    <i class="fas fa-bars fa-fw"></i>
                </a>
                @if(count(config('admiko_global_search'))>0 || count(config('admiko_global_search_custom'))>0)
                    <div class="admikoGlobalSearch">
                        <input name="search" type="text" placeholder="{{ trans('admiko.search') }}" autocomplete="off">
                        <div class="admikoGlobalSearchResults"></div>
                    </div>
                @endif
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item navbar-user d-flex flex-row">
                        <div>
                            <div class="sidebar-user-name">{{auth()->user()->name}}</div>
                            <div class="sidebar-user-email">{{auth()->user()->email}}</div>
                        </div>
                        <a class="nav-link" href="{{route("admin.myaccount")}}">
                            <img src="{{auth()->user()->image}}" class="img-fluid rounded-circle">
                        </a>
                    </li>
                    <li class="nav-item myaccount{{ $admiko_data['sideBarActive'] === "myaccount" ? " active" : "" }}">
                        <a class="nav-link" href="{{route("admin.myaccount")}}" title="{{ trans('admiko.myaccount') }}"><i class="fas fa-user fa-fw"></i></a>
                    </li>
                    <li class="nav-item logout">
                        <a class="nav-link" href="{{route("admin.logout")}}" title="{{ trans('admiko.logout') }}"><i class="fas fa-power-off fa-fw"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="mainBoxBreadcrumb">
            <div class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("admin.home")}}"><i class="fas fa-home"></i>{{ trans('admiko.home') }}</a></li>
                @yield('breadcrumbs')
            </div>
        </div>
        <div class="mainBoxTitle">
            @yield('pageTitle')
        </div>
        <div class="mainBoxInfo">@yield('pageInfo')</div>

        <div class="mainBoxBackBtn">
            @yield('backBtn')
        </div>
        <div class="mainBoxContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.layouts.footer_custom_top')
@include('admin.layouts.footer_scripts')
@include('admin.layouts.footer_custom_bottom')
</body>
</html>