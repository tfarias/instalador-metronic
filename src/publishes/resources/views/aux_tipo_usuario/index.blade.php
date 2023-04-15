@extends('layouts.template')
@section('conteudo')
    <div class="this-place">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>Tipo de Usuarios</li>
                <i class="fa fa-chevron-right"></i>
                <li>
                    <span>Lista</span>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <h1 class="page-title">Tipo de Usuarios</h1>
        <div class="clearfix"></div>
        <div class="row area">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">Filtros</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form action="{{ route('aux_tipo_usuario.index') }}" method="get" class="form-filter">
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="descricao">Descrição</label>
                                <input type="text" name="descricao" id="descricao" class="form-control"
                                       value="{{ isset($aux_tipo_usuario) ? $aux_tipo_usuario->descricao : '' }}"
                                       placeholder="Descricao">
                            </div>

                            <div class="col-md-4 pull-right">
                                <div class="text-right">
                                    @include('partials.botao_limpar', ['url' => route('aux_tipo_usuario.index')])
                                    @include('partials.botao_imprimir_relatorio')
                                    @include('partials.botao_novo', ['route' => 'aux_tipo_usuario.create'])
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-green bold uppercase">Tipo de Usuarios</span>
                        </div>
                    </div>
                    <div class="portlet-body ">
                        <div class="clearfix">
                            {!! Table::withContents($dados->items())->hover()
                                       ->callback('Ações',function ($field,$dado){
                                            return Button::success('<i class="fa fa-pencil-square-o"></i>')->asLinkTo(route('aux_tipo_usuario.edit',['aux_tipo_usuario'=>$dado->id]))->addAttributes(['class'=>'btn-xs']). ' '.
                                                   Button::danger('<i class="fa fa-trash-o"></i>')->asLinkTo(route('aux_tipo_usuario.destroy',['aux_tipo_usuario'=>$dado->id]))->addAttributes(['class'=>'btn-xs confirma-acao','data-texto'=>'Deseja mesmo excluir este registro?']);
                                       })
                           !!}
                        </div>
                        {!! $dados->appends(request()->all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection