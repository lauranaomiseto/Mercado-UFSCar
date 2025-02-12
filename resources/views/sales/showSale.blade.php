<x-layout>
    
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('sales') }}" text="Voltar">
        </x-buttons.icon>
    
        <div class="flex justify-between content-center flex-wrap my-[50px] gap-5">
            <h1 class="text-4xl font-light w-4/5 overflow-hidden whitespace-nowrap text-ellipsis"> 
                #{{ $sale->id_venda }}
            </h1>
        
            <form action="{{ route('sales.destroy', ['sale' => $sale->id_venda]) }}" method="POST">
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
            <strong>Código da venda:</strong> #{{ $sale->id_venda }}
        </p>
        <p class="mb-[15px]">
            <strong>Quantidade de produtos:</strong> {{ $sale->total_quantidade }}
        </p>
		<p class="mb-[15px]">
            <strong>Total:</strong> {{ number_format($sale->total_venda, 2, ',', '.') }}
        </p>
    </div>
	
	<div class="col-span-2 space-y-4">
		<div class="w-fit m-auto text-dark-gray mt-8" id="produtos">
			<!-- Cabeçalho da tabela -->
			<div class="flex items-center p-5 bg-gray-300 rounded-t-lg font-bold">
				<div class="w-[150px] mr-5">Código</div>
				<div class="w-[150px] mr-5">Descrição</div>
				<div class="w-[150px] mr-5">Preço</div>
				<div class="w-[150px] mr-5">Quantidade</div>
				<div class="w-[150px] mr-5">Total</div> <!-- Added the Total column -->
			</div>
			
			@foreach ($products_bought as $product)
			<div class="w-fit mb-5 flex p-5 bg-light-gray rounded-lg">
				<div class="w-[150px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis font-semibold">
					{{ $product->id_produto }}
				</div>
				
				<div class="w-[150px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis font-semibold">
					{{ $product->descricao }}
				</div>

				<div class="w-[150px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis font-semibold">
					{{ number_format($product->preco, 2, ',', '') }}
				</div>

				<div class="w-[150px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis font-semibold">
					{{ $product->quantidade }}
				</div>

				<div class="w-[150px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis font-semibold">
					{{ number_format($product->preco * $product->quantidade, 2, ',', '') }} <!-- Calculated total -->
				</div>
			</div>
			@endforeach
		</div>
	</div>
</x-layout>






