<x-layouts.app>
    <flux:breadcrumbs >
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.productos.index')">Productos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="#">
            {{ $producto->nombre }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="w-full max-w-3xl mx-auto mt-4 p-6 bg-white dark:bg-zinc-800 rounded-md shadow-md">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white text-center uppercase py-8">
                {{ $producto->nombre }}
            </h1>
            <div class="grid grid-cols-2 gap-4 ">
                <p class="break-words">
                    <strong>Descripcion:</strong> {{ $producto->descripcion }}
                </p>
                <p>
                    <strong>Precio:</strong> {{ $producto->precio }}
                </p>
                <p>
                    <strong>Stock:</strong> {{ $producto->stock }}
    
                </p>
                <p>
                    <strong>Ancho:</strong> {{ $producto->ancho }}
                </p>
                <p>
                    <strong>Largo:</strong> {{ $producto->largo }}
                </p>
                <p>
                    <strong>Alto:</strong> {{ $producto->alto }}
                </p>
                <p>
                    <strong>Peso:</strong> {{ $producto->peso }}
                </p>
                <p>
                    <strong>Categoria:</strong> {{ $producto->categoria->nombre }}
                </p>
            </div>
        </div>

        <div class="mb-4">
            <div class="flex items center justify-center">
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}" class="w-full h-auto rounded-sm">
                @else
                    No image
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>