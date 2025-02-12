
<x-layout>

    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('home') }}" text="Voltar">
        </x-buttons.icon>
    
        <div class="flex justify-between content-center flex-wrap my-[50px] gap-5">
            <h1 class="text-4xl font-light"> 
                OPERAÇÕES DE 
                <span class="font-bold">
                    VENDAS
                </span>
            </h1>
			
		<x-buttons.primary route="{{ route('sales.create') }}" text="Adicionar nova venda"></x-buttons.primary>
		
        </div>
    </div>
	
	<div class="w-fit m-auto text-dark-gray">
        @foreach ($sales as $sale)

        <div class="w-fit mb-5 flex p-5 bg-light-gray rounded-lg">
            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">#{{ $sale->id_venda }}</div>
			<div class="w-[200px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">Total: {{ number_format($sale->total_venda, 2, ',', '.') }}</div>

            <div class="w-fit text-orange">
                <a href="{{ route('sales.edit', ['sale' => $sale->id_venda]) }}" class="mr-5 hover:underline">Editar</a>
                <a href="{{ route('sales.show', ['sale' => $sale->id_venda]) }}" class="mr-5 hover:underline">Detalhar</a>
            </div>
        </div>

        @endforeach
    </div>

    <!-- message pode vir de BatchController show() -->
    @if (session()->has('message'))
        <div class="text-red-300">*{{ session()->get('message') }}</div>
    @endif


</x-layout>