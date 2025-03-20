<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class CategoriaController extends Controller
{

    use WithFileUploads;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'desc')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // $imagenPath = null;

        // if($request->imagen){
        //     $imagenPath = 'categorias/' .uniqid(). '.' .$request->imagen->extension();
        //     $request->imagen->storeAs('public', $imagenPath);
        // }
    
        $imagenPath = $request->imagen->store('categorias', 'public');
    
        Categoria::create([
            'nombre' => $request->nombre,
            'imagen' => $imagenPath,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria creada con éxito!',
            'text' => 'La categoria se ha creado correctamente.'
        ]);
    
        return redirect()->route('admin.categorias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('categorias', 'public');
            $categoria->imagen = $imagenPath;
        }
        $categoria->nombre = $request->nombre;
        $categoria->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria actualizada con éxito!',
            'text' => 'La categoria se ha actualizado correctamente.'
        ]);
    
        return redirect()->route('admin.categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        if ($categoria->imagen) {
            Storage::disk('public')->delete($categoria->imagen);
        }

        $categoria->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria eliminada con éxito!',
            'text' => 'La categoria se ha eliminado correctamente.'
        ]);
    
        return redirect()->route('admin.categorias.index');
    }
}
