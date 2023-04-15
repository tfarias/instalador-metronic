<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <script>var SITE_PATH = "{{  request()->root() }}";</script>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.assets.metronic.styles')

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{route('home')}}">
                    @if(file_exists(asset('img/logo2.png')))
                        <img src="{{asset('img/logo2.png')}}" alt="" class="logo-default">
                    @else
                        <h3>{{env('APP_NAME')}}</h3>
                    @endif
                </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:void(0);" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true" aria-expanded="false">
                            <img src="{{!empty(auth()->user()->photo)? asset('storage/'.auth()->user()->photo) : asset('img/profile_user.jpg')}}"
                                 alt="" class="img-responsive img-circle">
                            <span class="username username-hide-on-mobile"> {{ !empty(auth()->user()) ? auth()->user()->primeironome :'' }} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{route('usuario.cadastro')}}">
                                    <i class="icon-user"></i> Meu cadastro</a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-sign-out"></i> Sair
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-quick-sidebar-toggler">

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="page-container">
        <div class="page-sidebar-wrapper">
            @include('partials.metronic.menu')
        </div>
        <div class="page-content-wrapper">
            <div class="page-content">
                @include('flash::message')

                @yield('conteudo')

                <id id="form-delete"></id>
            </div>
            <div class="page-footer">
                <div class="page-footer-inner"> 2014 - {{date('Y')}} ©
                </div>
                <div class="scroll-to-top" style="display: block;">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modals -->
@include('partials.metronic.modal.default')
@include('partials.metronic.modal.xs')
@include('partials.metronic.modal.lg')
<!-- [END] Modals -->

@include('partials.assets.metronic.scripts')
@yield('page-script')

</body>
</html>
