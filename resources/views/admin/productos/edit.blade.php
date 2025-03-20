<x-layouts.app>
    <flux:breadcrumbs >
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.productos.index')">Productos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="w-full max-w-2xl mx-auto mt-4 p-6 bg-white dark:bg-zinc-800 rounded-md shadow-md">
          <form action="{{ route('admin.productos.update', $producto)}}" method="POST" enctype="multipart/form-data">
    
                @csrf
                @method('PUT')
    
                <div class="mb-4">
                    <flux:input 
                        wire:model="nombre" 
                        label="Nombre de producto" 
                        placeholder='Madera' 
                        value="{{old('nombre', $producto->nombre)}}" 
                    />
                </div>
    
                <div class="mb-4">
                    <flux:input 
                        wire:model="descripcion" 
                        label="Descripcion" 
                        placeholder='Descripcion del producto' 
                        value="{{old('descripcion', $producto->descripcion)}}" 
                    />
                </div>
    
                <div class="mb-4">
                    <flux:input 
                        wire:model="precio" 
                        label="Precio" 
                        placeholder='100.00' 
                        value="{{old('precio', $producto->precio)}}" 
                    />
                </div>

                <div class="mb-4">
                    <flux:input 
                        wire:model="stock"
                        label="Stock"
                        placeholder='100'
                        value="{{old('stock', $producto->stock)}}"
                    />
                </div>

                <div class="mb-4">
                    <flux:input 
                        wire:model="ancho" 
                        label="Ancho" 
                        placeholder='100' 
                        value="{{old('ancho', $producto->ancho)}}" 
                    />
                </div>
    
                <div class="mb-4">
                    <flux:input 
                        wire:model="largo" 
                        label="Largo" 
                        placeholder='100' 
                        value="{{old('largo', $producto->largo)}}" 
                    />
                </div>
    
                <div class="mb-4">
                    <flux:input 
                        wire:model="alto" 
                        label="Alto" 
                        placeholder='100' 
                        value="{{old('alto', $producto->alto)}}" 
                    />
                </div>
    
                <div class="mb-4">
                    <flux:input 
                        wire:model="peso" 
                        label="Peso" 
                        placeholder='100' 
                        value="{{old('peso', $producto->peso)}}" 
                    />
                </div>

                <div class="mb-4">
                    <flux:select 
                        wire:model="categoria_id" 
                        label="Categoria"
                    >
                        <option value="">Seleccione una categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" 
                                {{ $categoria->id == old('categoria_id', $producto->categoria_id) ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </flux:select>
                </div>

                <div class="mb-4">
                    <flux:input 
                        type="file" 
                        wire:model="imagen" 
                        label="Logo"
                        value="{{old('imagen', $producto->imagen)}}" 
                    />
                </div>

                @if ($producto->imagen)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagen actual</label>
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto" class="w-32 h-32 object-cover mt-2 rounded-md">
                    </div>
                @endif

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
    </div>

    
                

</x-layouts.app>