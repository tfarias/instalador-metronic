@extends('layouts.template')

@section('scripts')
    @parent
    <script src="{{ asset('templates/default/gerenciar_permissoes.js') }}"></script>
@stop

@section('conteudo')
    <form action="{{ route('tipo_usuario.gerenciar_permissoes.post') }}" method="POST" class="form-filter"
          name="salvar-permissoes">
        <div class="lista">
            <div class="panel-body">
                <h3>Gerenciar Permissões</h3>
                <div class="alert alert-info">
                    Não esqueça de clicar em <strong>Salvar</strong> no fim do formulário para persistir as alterações.
                </div>
                <hr>
                <select name="id_tipo_usuario" id="id_tipo_usuario" class="form-control" is="required">
                    <option value=""></option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->descricao }}</option>
                    @endforeach
                </select>
                <small>Escolha acima o grupo que deseja gerenciar as permissões.</small>

                <div class="row hide" id="carregando">
                    <p>Carregando...</p>
                </div>

                <div class="hide well" style="margin-top: 50px;" id="listagem">
                    @foreach($rotas as $tipo => $lista)
                        <div class="ibox-content">
                            <h4>{{ $tipo }}</h4>
                            <small>
                                <a class="permitir-todos" href="javascript:void(0);"><i class="fa fa-check"></i>
                                    Permitir todos</a>
                            </small>
                            <ul class="todo-list m-t ui-sortable">
                                @foreach($lista as $permissao)
                                    <li class="rota" style="cursor:pointer;">
                                        <div class="icheckbox_square-green" style="position: relative;">
                                            <input type="checkbox" name="rotas[]" value="{{ $permissao->id }}"
                                                   id="rota-{{ $permissao->id }}" class="i-checks"
                                                   style="position: absolute;">
                                        </div>
                                        <span style="margin-left: 25px;"
                                              class="m-l-xs">{{ $permissao->descricao }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="ibox-content">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-spin fa-spinner hide"></i> <span>Salvar</span>
                                </button>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection