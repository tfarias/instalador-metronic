@extends('layouts.template')

@section('conteudo')
    <div class="this-place">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('home')}}">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Usuário</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false"> Ações
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="{{route('usuario.alterar_imagem',auth()->user()->id)}}" data-toggle="modal"
                               data-target="#modal">
                                <i class="fa fa-photo"></i> Alterar Imagem</a>
                        </li>
                        <li>
                            <a href="{{route('usuario.alterar_senha',auth()->user()->id)}}" data-toggle="modal"
                               data-target="#modal">
                                <i class="icon-shield"></i> Alterar Senha</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <h1 class="page-title"> Cadastro
            <small></small>
        </h1>

        <div class="row">
            <div class="col-md-12">
                <div class="profile-sidebar">
                    <div class="portlet light profile-sidebar-portlet ">
                        <div class="profile-userpic">
                            <img src="{{!empty(auth()->user()->photo)? asset('storage/'.auth()->user()->photo) : asset('img/profile_user.jpg')}}"
                                 class="img-responsive" alt="" id="user-image"></div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{ auth()->user()->primeiroNome }} </div>
                            <div class="profile-usertitle-job"> {{ auth()->user()->tipoUsuario->descricao }} </div>
                        </div>
                        <div class="profile-userbuttons">
                            <a href="{{route('usuario.alterar_imagem',auth()->user()->id)}}"
                               class="btn btn-circle green btn-sm" data-toggle="modal" data-target="#modal">
                                Alterar Imagem</a>
                            <a href="{{route('usuario.alterar_senha',auth()->user()->id)}}"
                               class="btn btn-circle red btn-sm" data-toggle="modal" data-target="#modal">
                                Alterar Senha</a>
                        </div>
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('home')}}">
                                        <i class="icon-home"></i> Home </a>
                                </li>

                                <li>
                                    <a href="page_user_profile_1_help.html">
                                        <i class="icon-info"></i> Ajuda </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="portlet light ">

                        <div>
                            <h4 class="profile-desc-title"> {{ auth()->user()->nome }}</h4>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-globe"></i>
                                <a href="#"> {{ auth()->user()->email }}</a>
                            </div>

                        </div>
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Dados da conta</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab">Dados Principais</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <form role="form" method="post" class="validate"
                                          action="{{route('usuario.alterar_cadastro',auth()->user()->id)}}">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="form-group">
                                                    <label class="control-label" for="nome">Nome</label>
                                                    <input type="text" name="nome" id="nome" class="form-control"
                                                           value="{{ auth()->user()->nome }}" placeholder="Nome">
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label" for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                           value="{{ auth()->user()->email }}" placeholder="email">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="telefone">Telefone</label>
                                                    <input type="text" name="telefone" id="telefone" class="form-control"
                                                           value="{{ auth()->user()->telefone }}" placeholder="Telefone" mask="phone">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="margiv-top-10">
                                            <input type="submit" class="btn green" value="Salvar"/>
                                            <a href="{{route('home')}}" class="btn default"> Cancel </a>
                                        </div>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
