<x-layout>

    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('home') }}" text="Voltar">
        </x-buttons.icon>
    
        <div class="flex justify-between content-center flex-wrap my-[50px] gap-5">
            <h1 class="text-4xl font-light"> 
                GERENCIAMENTO DE 
                <span class="font-bold">
                    PRODUTO
                </span>
            </h1>
        
            <x-buttons.primary route="{{ route('products.create') }}" text="Adicionar novo produto">
            </x-buttons.primary>
        </div>
    </div>


    <div class="w-fit m-auto text-dark-gray">
        @foreach ($products as $product)

        <div class="w-fit mb-5 flex p-5 bg-light-gray rounded-lg">
            <div class="w-[100px] mr-5">#{{ $product->id }}</div>
            
            <div class="w-[200px] mr-5">{{ $product->descricao }}</div>

            <div class="w-[100px] mr-5">{{ $product->preco }}</div>

            <div class="w-fit text-orange">
                <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="mr-5 hover:underline">Editar</a>
                <a href="{{ route('products.show', ['product' => $product->id]) }}" class="hover:underline">Detalhar</a>
            </div>
        </div>

        @endforeach
    </div>


</x-layout>