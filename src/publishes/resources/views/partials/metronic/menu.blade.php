<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200" style="padding-top: 20px" id="ul-menu">
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <li class="sidebar-search-wrapper">
            <form class="sidebar-search" action="#" method="POST">
                <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                </a>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar..." id="search-menu">
                    <span class="input-group-btn">
                        <a href="javascript:void(0)" class="btn">
                            <i class="icon-magnifier"></i>
                        </a>
                    </span>
                </div>
            </form>
        </li>

        <li class="nav-item start " id="home">
            <a href="{{route('home')}}" class="nav-link">
                <i class="icon-home"></i>
                <span class="title">Início</span>

            </a>
        </li>


    @if(THelper::has_permission(['aux_tipo_usuario.index','tipo_usuario.gerenciar_permissoes','sis_usuario.index']))
            <li class="nav-item " id="sis_usuario.index-aux_tipo_usuario.index-tipo_usuario.gerenciar_permissoes">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Usuário</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @can('sis_usuario.index')
                        <li class="nav-item  ">
                            <a href="{{route('sis_usuario.index')}}" class="nav-link ">
                                <span class="title">Usuários</span>
                            </a>
                        </li>
                    @endcan
                    @can('aux_tipo_usuario.index')
                        <li class="nav-item  ">
                            <a href="{{route('aux_tipo_usuario.index')}}" class="nav-link ">
                                <span class="title">Tipos de usuário</span>
                            </a>
                        </li>
                    @endcan

                    @can('tipo_usuario.gerenciar_permissoes')
                        <li class="nav-item  ">
                            <a href="{{route('tipo_usuario.gerenciar_permissoes')}}" class="nav-link ">
                                <span class="title">Permissões</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endif

        {{--menu--}}
        
    </ul>
</div>

