<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PuntoVentaController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('admin.punto-venta.index', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Filtrar productos seleccionados con cantidad válida
        $productosSeleccionados = collect($request->productos)->filter(function ($producto) {
            return isset($producto['id']) && isset($producto['cantidad']) && $producto['cantidad'] > 0;
        });

        if ($productosSeleccionados->isEmpty()) {
            return back()->withErrors(['productos' => 'Debe seleccionar al menos un producto con una cantidad válida.']);
        }

        $total = $productosSeleccionados->sum(function ($producto) {
            $productoModel = Producto::find($producto['id']);
            return $productoModel->precio * $producto['cantidad'];
        });

        // Crear el ticket
        $ticket = Ticket::create([
            'cliente' => $request->cliente,
            'total' => $total,
            'pdf_path' => '', // Se actualizará después de generar el PDF
        ]);

        // Asociar productos al ticket
        foreach ($productosSeleccionados as $producto) {
            $productoModel = Producto::find($producto['id']);
            $ticket->productos()->attach($productoModel, [
                'cantidad' => $producto['cantidad'],
                'subtotal' => $productoModel->precio * $producto['cantidad'],
            ]);
        }

        // Generar el PDF
        $pdf = Pdf::loadView('admin.punto-venta.ticket', compact('ticket'));
        $pdfPath = "tickets/ticket_{$ticket->id}.pdf";
        Storage::disk('public')->put($pdfPath, $pdf->output());
        $pdfUrl = Storage::url($pdfPath); // Generar la URL pública

        // Actualizar la ruta del PDF en el ticket
        $ticket->update(['pdf_path' => $pdfUrl]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Ticket creado con éxito!',
            'text' => 'El ticket se ha creado correctamente.'
        ]);

        return redirect()->route('admin.tickets.index');
    }
}