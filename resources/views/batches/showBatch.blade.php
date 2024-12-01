<x-layout>
    
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('batches') }}" text="Voltar">
        </x-buttons.icon>
    
        <div class="flex justify-between content-center flex-wrap my-[50px] gap-5">
            <h1 class="text-4xl font-light w-4/5 overflow-hidden whitespace-nowrap text-ellipsis"> 
                [L: {{ $batch->id }}] {{ $product->descricao }}
            </h1>
        
            <form action="{{ route('batches.destroy', ['batch' => $batch->id]) }}" method="POST">
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
            <strong>Código do produto:</strong> #{{ $batch->id_produto }}
        </p>
        <p class="mb-[15px]">
            <strong>Descrição do produto:</strong> {{ $product->descricao }}
        </p>
        <p class="mb-[15px]">
            <strong>Lote:</strong> {{ $batch->id }}
        </p>
        <p class="mb-[15px]">
            <strong>Quantidade:</strong> {{ $batch->quantidade }}
        </p>
        <p class="mb-[15px]">
            <strong>Validade:</strong> {{ $batch->validade }}
        </p>
    </div>

</x-layout>