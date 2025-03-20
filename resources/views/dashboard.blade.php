<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-4xl font-semibold text-neutral-900 dark:text-neutral-200 text-center">
            Tarimas y Pallets México
        </h1>
        <span class="text-lg text-neutral-500 dark:text-neutral-400 text-center">
            Venta y Renta de pallets a medida
        </span>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="flex items-center justify-center w-full h-full flex-col gap-4">
                    <h1>
                        Crear una nueva categoria
                    </h1>
                    <a href="{{ route('admin.categorias.index') }}" >
                        <flux:button class="cursor-pointer flex items-center gap-2">
                            <flux:icon.tag />
                            Categorias
                        </flux:button>
                    </a>
                    
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

                <div class="flex items-center justify-center w-full h-full flex-col gap-4">
                    <h1>
                        Crear un nuevo producto
                    </h1>
                    <a href="{{ route('admin.productos.index') }}">
                        <flux:button class="cursor-pointer flex items-center gap-2">
                            <flux:icon.building-storefront />
                            Productos
                        </flux:button>

                    </a>
                    
                </div>
            </div>
            
        </div>
      
    </div>
</x-layouts.app>
