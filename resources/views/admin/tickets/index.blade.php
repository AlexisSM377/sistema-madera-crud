{{-- filepath: resources/views/tickets/index.blade.php --}}
<x-layouts.app>
    <div class="flex items-center justify-between mb-4">

        <flux:breadcrumbs >
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.tickets.index')">Ticket</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <h1 class="text-3xl font-bold mb-4">Tickets</h1>

    <form action="{{ route('admin.tickets.index') }}" method="GET" class="mb-4">
        <flux:input
            wire:model="search" 
            label="Buscar por ID o Cliente" 
            placeholder='Buscar por ID o Cliente' 
            class="mb-4"
        />
    </form>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300">
            <thead class="text-xs dark:text-gray-100 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-40 ">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Cliente</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                    <th scope="col" class="px-6 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4">{{ $ticket->id }}</td>
                        <td class="px-6 py-4">{{ $ticket->cliente }}</td>
                        <td class="px-6 py-4">${{ $ticket->total }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end space-x-4">

                                <a 
                                    href="{{ route('admin.tickets.show', $ticket) }}" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded cursor-pointer flex items-center gap-2"
                                >
                                    <flux:icon name="eye" />
                                    Ver
                                </a>
                                <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500  hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer flex items-center gap-2">
                                        <flux:icon name="trash" />
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
    @push('js')
    <script>

        form = document.querySelectorAll('.inline-block');
        form.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault()
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, elimínalo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit()
                    }
                })
            })
        })
    </script>
@endpush

</x-layouts.app>