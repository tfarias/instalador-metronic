<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Models\SisUsuario;
use App\Repositories\SisUsuarioRepository;
use App\Relatorios\SisUsuarioListagem;
use App\Forms\SisUsuarioForm;
use Kris\LaravelFormBuilder\Form;
use Illuminate\Http\Request;

class SisUsuarioController extends Controller
{

    private $listagem;
    private $repository;

    public function __construct(SisUsuarioRepository $repository, SisUsuarioListagem $listagem)
    {
        $this->listagem = $listagem;
        $this->repository = $repository;

    }

    /**
     * Lista todos os registros do sistema.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $filtros = request()->all();
        if (isset($filtros['acao']) && $filtros['acao'] == 'imprimir') {
            return $this->listagem->exportar($filtros);
        }
        $dados = $this->listagem->gerar($filtros);
        return view('sis_usuario.index', compact('dados', 'filtros'));
    }

    /**
         * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $form = \FormBuilder::create(SisUsuarioForm::class,[
            'url'=>route('sis_usuario.store'),
            'method'=>'POST'
        ]);

        return view('sis_usuario.create',compact('form'));

    }


   /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
          /** @var Form $form */
          $form = \FormBuilder::create(SisUsuarioForm::class);
          if(!$form->isValid()){
              return redirect()
                  ->back()
                  ->withErrors($form->getErrors())
                  ->withInput();
          }
          $data = $form->getFieldValues();
          $this->repository->create($data);

          flash('Usuário cadastrado com sucesso!!', 'success');

          return redirect()->route('sis_usuario.index');
      }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Models\SisUsuario $sis_usuario
        * @return \Illuminate\Http\Response
        */
       public function edit(SisUsuario $sis_usuario)
       {
           $form = \FormBuilder::create(SisUsuarioForm::class,[
               'url'=>route('sis_usuario.update',['sis_usuario' => $sis_usuario->id]),
               'method'=>'PUT',
               'model' => $sis_usuario
           ]);

           return view('sis_usuario.edit',compact('form'));
       }


    /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\User  $sis_usuario
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, SisUsuario $sis_usuario)
        {
            /** @var Form $form */
            $form = \FormBuilder::create(SisUsuarioForm::class,[
                'data' => ['id' => $sis_usuario->id],
                'model' => $sis_usuario
            ]);
            if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
            $data = Arr::except($form->getFieldValues(),['role','password']);
            $this->repository->update($data,$sis_usuario->id);
            flash('Usuário alterado com sucesso!!', 'success');

            return redirect()->route('sis_usuario.index');
        }


     /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\SisUsuario $user
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $this->repository->delete($id);
            flash('Usuário deletado com sucesso!!', 'success');

             return redirect()->route('sis_usuario.index');
        }

    /**
     * Filtra um registro para os campos select2.
     *
     * @param
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fill()
    {
        $request = request()->all();

        $termo = $request['termo'];
        $size = $request['size'];
        $page = (!isset($request['page']) || $request['page'] < 1) ? 1 : $request['page'];

        if (!isset($termo))
            $termo = '';
        if (!isset($size) || $size < 1)
            $size = 10;

        $find = SisUsuario::where('nome','like','%' . $termo . '%');
        $count = $find->count();
        $ret["more"] = (($size * ($page - 1)) >= (int)$count) ? false : true;
        $ret["total"] = $count;
        $ret["dados"] = array();
        $find->limit($size);
        $find->offset($size * ($page - 1));
        $find->orderBy('nome','asc');
        $result = $find->get();
        foreach ($result as $d) {
            $ret["dados"][] = array('id' => $d->id, 'text' => $d->nome);
        }
        return response()->json($ret);
    }

     /**
         * Filtra um registro pelo id para atualizar os campos select2.
         *
         * @param int @id
         *
         * @return \Illuminate\Http\RedirectResponse
     */
     public function getedit($id)
     {
        $sis_usuario = SisUsuario::find($id);
         $res = ['nome'=>'selecione','id'=>null];
           if(!empty($sis_usuario)){
             $res = ['nome'=>$sis_usuario->nome,'id'=>$sis_usuario->id];
           }
           return response()->json($res);
     }


    public function detalhes(SisUsuario $usuario)
    {
        return view('sis_usuario.detalhe', compact('usuario'));
    }

}
