{{-- filepath: resources/views/punto-venta/index.blade.php --}}
<x-layouts.app>
    <div class="flex items-center justify-between mb-4">

        <flux:breadcrumbs >
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.punto-venta.index')">Punto de Venta</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="w-full max-w-3xl mx-auto mt-4 p-6 bg-white dark:bg-zinc-800 rounded-md shadow-md gap-4">

        <h2>
            Generar Ticket de Venta
        </h2>

        <p class="mb-4 opacity-50">Selecciona los productos y la cantidad para generar un ticket de venta.</p>

        <form action="{{ route('admin.punto-venta.store') }}" method="POST">
            @csrf
            
            <div>
                <flux:input wire:model="cliente" label="Nombre del Cliente:" placeholder='Mariana' />
                {{-- <label for="cliente">Nombre del Cliente:</label>
                <input type="text" name="cliente" id="cliente" class="border rounded p-2"> --}}
            </div>
    
            <div class="py-4">
                <h3 class="text-xl">Productos</h3>
                <p class="opacity-50">Lista de productos</p>
                @foreach ($productos as $producto)
                    <div class="flex flex-col mt-4">
                        <div class="flex items-center gap-2 mb-2 bg-gray-600 p-2 rounded-md">

                            <input 
                                type="checkbox" 
                                name="productos[{{ $producto->id }}][id]" 
                                value="{{ $producto->id }}"
                                class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:ring-2"
                                onchange="toggleCantidadInput(this, {{ $producto->id }})"
                            >
                            {{ $producto->nombre }} - ${{ $producto->precio }}
                        </div>

                        <input 
                            type="number" 
                            name="productos[{{ $producto->id }}][cantidad]" 
                            id="cantidad-{{ $producto->id }}"
                            placeholder="Cantidad" 
                            min="1" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            disabled
                        >
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit" class="cursor-pointer">
                    Generar Ticket
                </flux:button>
            </div>
        </form>
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

            function toggleCantidadInput(checkbox, id) {
                const cantidadInput = document.getElementById(`cantidad-${id}`);
                cantidadInput.disabled = !checkbox.checked;
                if (!checkbox.checked) {
                    cantidadInput.value = ''; // Clear the input if unchecked
                }
            }
        </script>
    @endpush
</x-layouts.app>