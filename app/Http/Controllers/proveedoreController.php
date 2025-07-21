<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Http\Requests\StorePersonasRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Models\Proveedore;
use App\Http\Requests\UpdateProveedoreRequest;


class proveedoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   function __construct()
    {
        $this->middleware('permission:ver-proveedore|crear-proveedore|editar-proveedore|eliminar-proveedore', ['only' => ['index']]);
        $this->middleware('permission:crear-proveedore', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-proveedore', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-proveedore', ['only' => ['destroy']]);
    }
    public function index()
    {
        $proveedores = Proveedore::with('persona.documento')->get();
        return view ('proveedore.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos= Documento::all();
       return view ('proveedore.create',compact('documentos'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonasRequest $request)
    {
         try {
            DB::beginTransaction();
            $persona = Persona::create($request->validated());
            $persona->proveedore()->create([
                'persona_id'=> $persona->id
            ]);
            DB::commit();

            return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Error al crear al Proveedor', ['error' => $e->getMessage()]);
            return redirect()->route('proveedores.index')->with('error', 'Ups, algo falló');
        }
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
    public function edit(Proveedore $proveedore)
    {   
        $proveedore->load('persona.documento');
        $documentos = Documento::all();
        return view('proveedore.edit', compact('proveedore', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedoreRequest $request, Proveedore $proveedore)
    {
       try {
        DB::beginTransaction();
        Persona::where('id',$proveedore->persona->id)
        ->update($request->validated());
        DB::commit();
       } catch (Exception $e) {
            DB::rollBack();
       }
       return redirect()->route('proveedores.index')->with('success','proveedor editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $persona = Persona::findOrfail($id);
            if ($persona->estado==1) {
                Persona::where('id',$persona->id)
                ->update([
                    'estado'=>0
                ]);
                $message = 'Proveedor eliminado';
           }else {
            Persona::where('id',$persona->id)
            ->update([
                'estado'=>1
            ]);
             $message = 'Proveedor restaurado';
           }
           return redirect()->route('proveedores.index')->with('success',$message);
    }

        
}
