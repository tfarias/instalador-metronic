<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Models\Rota;
use App\Repositories\RotaRepository;
use App\Relatorios\RotaListagem;
use App\Forms\RotaForm;
use Kris\LaravelFormBuilder\Form;
use Illuminate\Http\Request;

class RotaController extends Controller
{

    private $listagem;
    private $repository;

    public function __construct(RotaRepository $repository, RotaListagem $listagem)
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
        return view('rota.index', compact('dados', 'filtros'));
    }

    /**
         * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $form = \FormBuilder::create(RotaForm::class,[
            'url'=>route('rota.store'),
            'method'=>'POST'
        ]);

        return view('rota.create',compact('form'));

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
          $form = \FormBuilder::create(RotaForm::class);
          if(!$form->isValid()){
              return redirect()
                  ->back()
                  ->withErrors($form->getErrors())
                  ->withInput();
          }
          $data = $form->getFieldValues();
          $this->repository->create($data);
          flash('Rota cadastrada com sucesso!!', 'success');

          return redirect()->route('rota.index');
      }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  \LaravelMetronic\Models\Rota $rota
        * @return \Illuminate\Http\Response
        */
       public function edit(Rota $rota)
       {
           $form = \FormBuilder::create(RotaForm::class,[
               'url'=>route('rota.update',['rota' => $rota->id]),
               'method'=>'PUT',
               'model' => $rota
           ]);

           return view('rota.edit',compact('form'));
       }


    /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \LaravelMetronic\Models\User  $rota
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            /** @var Form $form */
            $form = \FormBuilder::create(RotaForm::class,[
                'data' => ['id' => $id]
            ]);
            if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
            $data = Arr::except($form->getFieldValues(),['role','password']);
            $this->repository->update($data,$id);
            flash('Rota alterada com sucesso!!', 'success');

            return redirect()->route('rota.index');
        }


     /**
         * Remove the specified resource from storage.
         *
         * @param  \LaravelMetronic\Models\Rota $user
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $this->repository->delete($id);
            flash('Rota deletada com sucesso!!', 'success');
            return redirect()->route('rota.index');
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

        $find = Rota::where('nome','like','%' . $termo . '%');
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
        $rota = Rota::find($id);
         $res = ['nome'=>'selecione','id'=>null];
           if(!empty($rota)){
             $res = ['nome'=>$rota->nome,'id'=>$rota->id];
           }
           return response()->json($res);
     }
}
