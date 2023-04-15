<div class="this-place">
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li><a href="{{route('usuario.cadastro')}}">Usuário</a></li>
            <i class="fa fa-circle"></i>
            <li><span>Alterar Imagem</span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <h1 class="page-title">Usuário</h1>
    <div class="clearfix"></div>
    <div class="row area">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-body ">
                    <form class="validate" method="post" role="form"
                          action="{{ route('usuario.imagem_post',$usuario->id) }}"
                          enctype="multipart/form-data" id="form-image">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="files">Imagem</label>
                                <input id="photo" type="file" name="photo" class="input-file-edit"
                                       link-img="{{!empty($usuario->photo)? asset('storage/'.auth()->user()->photo) : ''}}"
                                       descricao-img="{{$usuario->nome}}"
                                       controller-img="usuario" img-id="{{$usuario->id}}"
                                       data-overwrite-initial="false">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <div class="progress" style="display: none;">
                                <div class="progress-bar progress-bar-striped active" role="progressbar"
                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                    <span class="percent">0% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="text-right">
                            <a href="{{ route('usuario.cadastro') }}" class="btn btn-default" data-dismiss="modal" listen="f">Cancelar</a>
                            <input type="submit" class="btn btn-primary" value="Salvar"
                                   onclick="return change_photo('form-image')">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
