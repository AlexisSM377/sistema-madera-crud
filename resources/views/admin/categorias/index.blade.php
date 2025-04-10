<x-layouts.app>
    <div class="flex items-center justify-between mb-4">

        <flux:breadcrumbs >
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.categorias.index')">Categorias</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
            <a href="{{ route('admin.categorias.create') }}">Crear categoria</a>
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
                        Nombre Categoria
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Imagen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 text-center">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $categoria->id }}
                        </th>
                        <td class="px-6 py-4 dark:text-white font-bold">
                            {{ $categoria->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">

                                @if($categoria->imagen)
                                    <img src="{{Storage::url('public/'.$categoria->imagen)}}" alt="Imagen de {{ $categoria->nombre }}" class="w-10 h-10 rounded-full">
                                @else
                                    No image
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-4">

                                <a 
                                    href="{{ route('admin.categorias.show', $categoria) }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded cursor-pointer flex items-center gap-2"
                                >
                                    <flux:icon name="eye" />
                                    Ver
                                </a>
                                <a 
                                    href="{{ route('admin.categorias.edit', $categoria) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer flex items-center gap-2"
                                >
                                    <flux:icon name="pencil" />
                                    Editar
                                </a>
                                <form 
                                    action="{{ route('admin.categorias.destroy', $categoria) }}" 
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