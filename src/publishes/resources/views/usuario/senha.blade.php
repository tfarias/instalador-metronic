@extends('layouts.modal')
@section('conteudo')
<div class="this-place">
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li><a href="{{route('sis_usuario.index')}}">Usuário</a></li>
            <i class="fa fa-circle"></i>
            <li><span>Alterar Senha</span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <h1 class="page-title">Usuário</h1>
    <div class="clearfix"></div>
    <div class="row area">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-body ">
                    <form class="" method="post" role="form" action="{{ route('usuario.salvar_senha',$usuario->id) }}"  id="form-senha">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="password">Senha</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Senha" is="firstPass">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="password_confirm">Confirmação</label>
                                <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Senha" is="secondPass">
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="text-right">
                            <a href="{{ route('sis_usuario.index') }}" class="btn btn-default" data-dismiss="modal" listen="f">Cancelar</a>
                            <input type="submit" class="btn btn-primary" value="Salvar"
                                   onclick="return change_senha('form-senha')">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
