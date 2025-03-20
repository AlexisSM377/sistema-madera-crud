<x-layouts.app>
    <flux:breadcrumbs >
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.productos.index')">Productos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Nuevo Producto</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="w-full max-w-2xl mx-auto mt-4 p-6 bg-white dark:bg-zinc-800 rounded-md shadow-md gap-4">
        <form action="{{ route('admin.productos.store')}}" method="POST" enctype="multipart/form-data" >

            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <flux:input wire:model="nombre" label="Nombre de Producto" placeholder='Producto' />
                </div>
    
                <div class="mb-4">
                    <flux:textarea wire:model="descripcion" label="Descripcion" placeholder="Descripcion del producto" />
                </div>
    
                <div class="mb-4">
                    <flux:input wire:model="precio" label="Precio" placeholder='Precio del producto' />
                </div>
    
                <div class="mb-4">
                    <flux:input wire:model="stock" label="Stock" placeholder='Stock del producto' />
                </div>
    
                <div class="mb-4">
                    <flux:input wire:model="ancho" label="Ancho" placeholder='Ancho del producto' />
                </div>
    
                <div class="mb-4">
                    <flux:input wire:model="largo" label="Largo" placeholder='Largo del producto' />
                </div>
    
                <div class="mb-4">
                    <flux:input wire:model="alto" label="Alto" placeholder='Alto del producto' />
                </div>
    
                <div class="mb-4">
                    <flux:input wire:model="peso" label="Peso" placeholder='Peso del producto' />
    
                </div>
    
                <div class="mb-4">
                    <flux:select wire:model="categoria_id" label="Categoria">
                        <option value="">Seleccione una categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </flux:select>
                </div>
    
                <div class="mb-4">
                    <flux:input type="file" wire:model="imagen" label="Logo"/>
                </div>

            </div>

            <div class="flex justify-end">
                <flux:button variant="primary" type="submit" class="cursor-pointer">
                    Guardar
                </flux:button>
            </div>

        </form>
   </div>
</x-layouts.app>
