<x-layouts.app>
    <flux:breadcrumbs >
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.categorias.index')">Categorias</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="w-full max-w-2xl mx-auto mt-4 p-6 bg-white dark:bg-zinc-800 rounded-md shadow-md">
          <form action="{{ route('admin.categorias.update', $categoria)}}" method="POST" enctype="multipart/form-data">
    
                @csrf
                @method('PUT')
    
                <div class="mb-4">
                    <flux:input 
                        wire:model="nombre" 
                        label="Nombre de categoria" 
                        placeholder='Madera' 
                        value="{{old('nombre', $categoria->nombre)}}" 
                    />
                </div>
    
                <div class="mb-4">
                    <flux:input 
                        type="file" 
                        wire:model="imagen" 
                        label="Logo"
                        value="{{old('imagen', $categoria->imagen)}}" 
                    />
                </div>
                <div class="flex justify-end">
                    <flux:button 
                        variant="primary" 
                        type="submit" 
                        class="cursor-pointer"
                    >
                        Actualizar 
                    </flux:button>
                </div>
          </form>
</x-layouts.app>