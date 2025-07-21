<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Caracteristica;
use App\Models\Categoria;
use App\Models\Marca;
use App\Services\ActivityLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

use Throwable;

class marcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       function __construct()
    {
        $this->middleware('permission:ver-marca|crear-marca|editar-marca|eliminar-marca', ['only' => ['index']]);
        $this->middleware('permission:crear-marca', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-marca', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-marca', ['only' => ['destroy']]);
    }
    public function index()
    {
        $marcas = Marca::with('caracteristica')->latest()->get(); //obtengo los datos de cat y carac para mostrar en la tabla
        return view ('marca.index',['marcas'=> $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarcaRequest $request)
    {
        //con esto al momento de crear categoria los datos nombre y descripcion quedan en la tabla de 
        // caracteristica pero se toma ese id para crear la nueva categoria 
       try {
            DB::beginTransaction();//Inicia una transacción de base de datos.si algo falla dentro del `try`, **nada se guarda**.
            $caracteristica= Caracteristica::create($request->validated()); //Crea una nueva Caracteristica usando los datos validados del formulario.
            $caracteristica->marca()->create([ // Usa la **relación entre Caracteristica y Categoria** para crear una nueva `Categoria`.
                'caracteristica_id'=> $caracteristica->id
            ]);
            DB::commit();
       } catch (Exception $e) {
            DB::rollback();
       }

       return redirect()->route('marcas.index')->with('success',' Marca registrada');
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
    public function edit(Marca $marca)
    {
        return view ('marca.edit',['marca'=> $marca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarcaRequest $request, Marca $marca)
    {
        Caracteristica::where('id',$marca->caracteristica->id)
        ->update($request->validated());
        return redirect()->route('marcas.index')->with('success',' Marca actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message='';
        $marca= Marca::find($id);
        if($marca->caracteristica->estado ==1){
            Caracteristica::where('id',$marca->caracteristica->id)
            ->update([
             'estado'=>0
            ]);
            $message ='Marca eliminada';
        }else {
            Caracteristica::where('id',$marca->caracteristica->id)
            ->update([
                'estado'=>1
            ]);
            $message ='Marca restaurada';
        }
        

        return redirect()->route('marcas.index')->with('success',$message);
    }
}
