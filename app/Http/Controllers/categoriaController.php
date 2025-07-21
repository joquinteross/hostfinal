<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Caracteristica;
use App\Models\Categoria;
use App\Services\ActivityLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

use Throwable;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-categoria|crear-categoria|editar-categoria|eliminar-categoria', ['only' => ['index']]);
        $this->middleware('permission:crear-categoria', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-categoria', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-categoria', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categorias = Categoria::with('caracteristica')->latest()->get(); //obtengo los datos de cat y carac para mostrar en la tabla
        return view ('categoria.index',['categorias'=> $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        //con esto al momento de crear categoria los datos nombre y descripcion quedan en la tabla de 
        // caracteristica pero se toma ese id para crear la nueva categoria 
       try {
            DB::beginTransaction();//Inicia una transacción de base de datos.si algo falla dentro del `try`, **nada se guarda**.
            $caracteristica= Caracteristica::create($request->validated()); //Crea una nueva Caracteristica usando los datos validados del formulario.
            $caracteristica->categoria()->create([ // Usa la **relación entre Caracteristica y Categoria** para crear una nueva `Categoria`.
                'caracteristica_id'=> $caracteristica->id
            ]);
            DB::commit();
       } catch (Exception $e) {
            DB::rollback();
       }

       return redirect()->route('categorias.index')->with('success',' Categoria registrada');
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
    public function edit(Categoria $categoria)
    {
        return view ('categoria.edit',['categoria'=> $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        Caracteristica::where('id',$categoria->caracteristica->id)
        ->update($request->validated());
        return redirect()->route('categorias.index')->with('success',' Categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message='';
        $categoria= Categoria::find($id);
        if($categoria->caracteristica->estado ==1){
            Caracteristica::where('id',$categoria->caracteristica->id)
            ->update([
             'estado'=>0
            ]);
            $message ='Categoria eliminada';
        }else {
            Caracteristica::where('id',$categoria->caracteristica->id)
            ->update([
                'estado'=>1
            ]);
            $message ='Categoria restaurada';
        }
        

        return redirect()->route('categorias.index')->with('success',$message);
    }
}
