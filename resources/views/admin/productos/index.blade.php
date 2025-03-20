<x-layouts.app>
    <div class="flex items-center justify-between mb-4">

        <flux:breadcrumbs >
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.productos.index')">Productos</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
            <a href="{{ route('admin.productos.create') }}">Crear producto</a>
        </button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs dark:text-gray-100 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-40 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Producto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripcion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Precio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stock
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ancho
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Largo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Peso
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Imagen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Categoria
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 text-center">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $producto->id }}
                        </th>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->nombre }}
                        </td>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->descripcion }}
                        </td>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->precio }}
                        </td>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->stock }}
                        </td>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->ancho }}
                        </td>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->largo }}
                        </td>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->alto }}
                        </td>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->peso }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                @if($producto->imagen)
                                    <img src="{{ Storage::url('public/'.$producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}" class="w-10 h-10 rounded-full">
                                @else
                                    No image
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $producto->categoria->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-4">

                                <a 
                                    href="{{ route('admin.productos.show', $producto) }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded cursor-pointer flex items-center gap-2"
                                >
                                    <flux:icon name="eye" />
                                    Ver
                                </a>
                                <a 
                                    href="{{ route('admin.productos.edit', $producto) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer flex items-center gap-2"
                                >
                                    <flux:icon name="pencil" />
                                    Editar
                                </a>
                                <form 
                                    action="{{ route('admin.productos.destroy', $producto) }}" 
                                    method="POST"
                                    class="inline-block"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit"
                                        class="bg-red-500  hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer flex items-center gap-2">
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