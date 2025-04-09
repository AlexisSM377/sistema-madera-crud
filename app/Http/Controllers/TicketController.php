<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query();

        // Filtrar por cliente o ID si se proporciona
        if ($request->filled('search')) {
            $search = $request->search;
    
            $query->where(function ($q) use ($search) {
                $q->where('cliente', 'like', '%' . $search . '%');
    
                // Solo buscar por ID si el valor es numérico
                if (is_numeric($search)) {
                    $q->orWhere('id', $search);
                }
            });
        }

        $tickets = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Ticket eliminado con éxito!',
            'text' => 'El ticket ha sido eliminado correctamente.',
        ]);
        return redirect()->route('admin.tickets.index');
    }
}