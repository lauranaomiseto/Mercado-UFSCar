<x-layout>
    
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('products') }}" text="Voltar">
        </x-buttons.icon>
    
        <div class="flex justify-between content-center flex-wrap my-[50px] gap-5">
            <h1 class="text-4xl font-light w-4/5 overflow-hidden whitespace-nowrap text-ellipsis"> 
                {{ $product->descricao }}
            </h1>
        
            <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                @csrf 
                @method('DELETE')

                <button class="m-auto px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange" type="submit">
                    Deletar
                </button>

            </form>
        </div>
    </div>

    <div class="max-w-[850px] w-4/5 m-auto">
        <p class="mb-[15px]">
            <strong>Código:</strong> #{{ $product->id }}
        </p>
        <p class="mb-[15px]">
            <strong>Descrição completa:</strong> {{ $product->descricao }}
        </p>
        <p class="mb-[15px]">
            <strong>Preço:</strong> R${{ number_format($product->preco, 2, ',', '') }}
        </p>
    </div>

</x-layout>