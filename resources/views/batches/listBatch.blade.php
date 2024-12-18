<x-layout>

    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('home') }}" text="Voltar">
        </x-buttons.icon>
    
        <div class="flex justify-between content-center flex-wrap my-[50px] gap-5">
            <h1 class="text-4xl font-light"> 
                GERENCIAMENTO DE 
                <span class="font-bold">
                    ESTOQUE
                </span>
            </h1>
        
            <x-buttons.primary route="{{ route('batches.create') }}" text="Adicionar novo lote">
            </x-buttons.primary>
        </div>
    </div>

    <!-- message pode vir de BatchController show() -->
    @if (session()->has('message'))
        <div class="text-red-300">*{{ session()->get('message') }}</div>
    @endif

    @if(!empty($batches)) 
    <div class="w-fit m-auto text-dark-gray">
        <p class="mb-[20px]">
            Lotes dentro da validade:
        </p>

        @foreach ($batches as $batch)

        <div class="w-fit mb-5 flex p-5 bg-light-gray rounded-lg">
            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">#{{ $batch->id_produto }}</div>

            <div class="w-[200px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">{{ $batch->product->descricao }}</div>

            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">L: {{ $batch->id }}</div>

            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">{{ $batch->validade }}</div>

            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">{{ $batch->quantidade }}</div>

            <div class="w-fit text-orange">
                <a href="{{ route('batches.edit', ['batch' => $batch->id]) }}" class="mr-5 hover:underline">Editar</a>
                <a href="{{ route('batches.show', ['batch' => $batch->id]) }}" class="hover:underline">Detalhar</a>
            </div>
        </div>

        @endforeach
    </div>
    @endif

    
    @if(!empty($expired_batches)) 
    <div class="w-fit m-auto mt-[50px] text-dark-gray">   
    <p class="mb-[20px]">
            Lotes fora da validade:
        </p>


        @foreach ($expired_batches as $expired_batch)

        <div class="w-fit mb-5 flex p-5 bg-light-gray rounded-lg">
            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">#{{ $expired_batch->id_produto }}</div>

            <div class="w-[200px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">{{ $expired_batch->product->descricao }}</div>

            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">L: {{ $expired_batch->id }}</div>

            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">{{ $expired_batch->validade }}</div>

            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">{{ $expired_batch->quantidade }}</div>

            <div class="w-fit text-orange">
                <a href="{{ route('batches.edit', ['batch' => $expired_batch->id]) }}" class="mr-5 hover:underline">Editar</a>
                <a href="{{ route('batches.show', ['batch' => $expired_batch->id]) }}" class="hover:underline">Detalhar</a>
            </div>
        </div>
        @endforeach
    </div>
    @endif


</x-layout>