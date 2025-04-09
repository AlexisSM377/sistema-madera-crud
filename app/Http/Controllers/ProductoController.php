<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::orderBy('id', 'desc')->get();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ancho' => 'required|string',
            'largo' => 'required|string',
            'alto' => 'required|string',
            'peso' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $imagenPath = $request->file('imagen') ? $request->file('imagen')->store('productos', 'public') : null;

        Producto::create($request->except('imagen') + ['imagen' => $imagenPath]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Producto creado con éxito!',
            'text' => 'El prodcuto se ha creado correctamente.'
        ]);
    
        return redirect()->route('admin.productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ancho' => 'required|numeric',
            'largo' => 'required|numeric',
            'alto' => 'required|numeric',
            'peso' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $imagenPath;
        }
        $producto->update($request->except('imagen'));

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Producto actualizado con éxito!',
            'text' => 'El producto se ha actualizado correctamente.'
        ]);

        return redirect()->route('admin.productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }
        
        $producto->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Producto eliminado con éxito!',
            'text' => 'El producto se ha eliminado correctamente.'
        ]);
        return redirect()->route('admin.productos.index');
    }
}
