<?php

namespace App\Http\Controllers;

use App\Models\TipoRota;
use App\Repositories\TipoRotaRepository;
use App\Relatorios\TipoRotaListagem;
use App\Forms\TipoRotaForm;
use Kris\LaravelFormBuilder\Form;
use Illuminate\Http\Request;

class TipoRotaController extends Controller
{

    private $listagem;
    private $repository;

    public function __construct(TipoRotaRepository $repository, TipoRotaListagem $listagem)
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
        return view('tipo_rota.index', compact('dados', 'filtros'));
    }

    /**
         * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $form = \FormBuilder::create(TipoRotaForm::class,[
            'url'=>route('tipo_rota.store'),
            'method'=>'POST'
        ]);

        return view('tipo_rota.create',compact('form'));

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
          $form = \FormBuilder::create(TipoRotaForm::class);
          if(!$form->isValid()){
              return redirect()
                  ->back()
                  ->withErrors($form->getErrors())
                  ->withInput();
          }
          $data = $form->getFieldValues();
          $this->repository->create($data);

            flash('TipoRota criado(a) com sucesso!', 'success');

          return redirect()->route('tipo_rota.index');
      }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Models\TipoRota $tipo_rota
        * @return \Illuminate\Http\Response
        */
       public function edit(TipoRota $tipo_rota)
       {
           $form = \FormBuilder::create(TipoRotaForm::class,[
               'url'=>route('tipo_rota.update',['tipo_rota' => $tipo_rota->id]),
               'method'=>'PUT',
               'model' => $tipo_rota
           ]);

           return view('tipo_rota.edit',compact('form'));
       }


    /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\User  $tipo_rota
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            /** @var Form $form */
            $form = \FormBuilder::create(TipoRotaForm::class,[
                'data' => ['id' => $id]
            ]);
            if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
            $data = array_except($form->getFieldValues(),['role','password']);
            $this->repository->update($data,$id);
            flash('TipoRota alterado com sucesso!!', 'success');
            return redirect()->route('tipo_rota.index');
        }


     /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\TipoRota $user
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $this->repository->delete($id);
            flash('TipoRota deletado com sucesso!!', 'success');

             return redirect()->route('tipo_rota.index');
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

        $find = TipoRota::where('nome','like','%' . $termo . '%');
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
        $tipo_rota = TipoRota::find($id);
         $res = ['nome'=>'selecione','id'=>null];
           if(!empty($tipo_rota)){
             $res = ['nome'=>$tipo_rota->nome,'id'=>$tipo_rota->id];
           }
           return response()->json($res);
     }
}
