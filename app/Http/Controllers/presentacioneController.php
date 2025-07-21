<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\StorePresentacioneRequest;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Http\Requests\UpdatePresentacioneRequest;
use App\Models\Caracteristica;
use App\Models\Categoria;
use App\Models\Presentacione;
use App\Services\ActivityLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

use Throwable;

class presentacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-presentacione|crear-presentacione|editar-presentacione|eliminar-presentacione', ['only' => ['index']]);
        $this->middleware('permission:crear-presentacione', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-presentacione', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-presentacione', ['only' => ['destroy']]);
    } 
    public function index()
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get(); //obtengo los datos de cat y carac para mostrar en la tabla
        return view ('presentacione.index',['presentaciones'=> $presentaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('presentacione.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentacioneRequest $request)
    {
        //con esto al momento de crear categoria los datos nombre y descripcion quedan en la tabla de 
        // caracteristica pero se toma ese id para crear la nueva categoria 
       try {
            DB::beginTransaction();//Inicia una transacción de base de datos.si algo falla dentro del `try`, **nada se guarda**.
            $caracteristica= Caracteristica::create($request->validated()); //Crea una nueva Caracteristica usando los datos validados del formulario.
            $caracteristica->presentacione()->create([ // Usa la **relación entre Caracteristica y Categoria** para crear una nueva `Categoria`.
                'caracteristica_id'=> $caracteristica->id
            ]);
            DB::commit();
       } catch (Exception $e) {
            DB::rollback();
       }

       return redirect()->route('presentaciones.index')->with('success',' Presentacion registrada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presentacione $presentacione)
    {
        return view ('presentacione.edit',['presentacione'=> $presentacione]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacioneRequest $request, Presentacione $presentacione)
    {
        Caracteristica::where('id',$presentacione->caracteristica->id)
        ->update($request->validated());
        return redirect()->route('presentaciones.index')->with('success',' Presentacion actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message='';
        $presentacione= Presentacione::find($id);
        if($presentacione->caracteristica->estado ==1){
            Caracteristica::where('id',$presentacione->caracteristica->id)
            ->update([
             'estado'=>0
            ]);
            $message ='Presentacion eliminada';
        }else {
            Caracteristica::where('id',$presentacione->caracteristica->id)
            ->update([
                'estado'=>1
            ]);
            $message ='Presentacione restaurada';
        }
        

        return redirect()->route('presentaciones.index')->with('success',$message);
    }
}
