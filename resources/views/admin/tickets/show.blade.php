{{-- filepath: resources/views/tickets/show.blade.php --}}
<x-layouts.app>
    <flux:breadcrumbs >
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.tickets.index')">Ticket</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="w-full max-w-5xl mx-auto mt-4 p-6 bg-white dark:bg-zinc-800 rounded-md shadow-md py-2">

        <h1 class="text-2xl font-bold mb-4">Ticket #{{ $ticket->id }}</h1>
    
        <p><strong>Cliente:</strong> {{ $ticket->cliente }}</p>
        <p><strong>Total:</strong> ${{ $ticket->total }}</p>
        <h2 class="text-xl font-bold mt-4">Productos</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left rtl:text-right text-gray-400 dark:text-gray-400 mt-3">
                <thead class="text-xs dark:text-gray-100 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-40 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">Producto</th>
                        <th scope="col" class="px-6 py-3">Cantidad</th>
                        <th scope="col" class="px-6 py-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ticket->productos as $producto)
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">{{ $producto->nombre }}</td>
                            <td class="px-6 py-4">{{ $producto->pivot->cantidad }}</td>
                            <td class="px-6 py-4">${{ $producto->pivot->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="py-4 flex justify-end">

            <a 
                href="{{ Storage::url($ticket->pdf_path) }}" 
                target="_blank" 
                class="bg-blue-500 text-white p-2 rounded mt-4 inline-block"
            >
                Descargar PDF
            </a>
        </div>
    </div>


</x-layouts.app>