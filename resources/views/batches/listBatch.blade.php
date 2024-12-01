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


    <div class="w-fit m-auto text-dark-gray">
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


</x-layout>