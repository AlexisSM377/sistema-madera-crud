<x-layouts.app>
    <flux:breadcrumbs >
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.categorias.index')">Categorias</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="#">
            {{ $categoria->nombre }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="w-full max-w-2xl mx-auto mt-4 p-6 bg-white dark:bg-zinc-800 rounded-md shadow-md">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white text-center uppercase">
                {{ $categoria->nombre }}
            </h1>
        </div>

        <div class="mb-4">
            <div class="flex items-center justify-center">
                @if($categoria->imagen)
                    <img src="{{Storage::url('public/'.$categoria->imagen)}}" alt="Imagen de {{ $categoria->nombre }}" class="w-full h-auto rounded-sm">
                @else
                    No image
                @endif
            </div>
        </div>

</x-layouts.app>