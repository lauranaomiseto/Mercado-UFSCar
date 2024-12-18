<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <!-- Barra fixa -->
    <div class="bg-gray-100 shadow-md fixed top-0 left-0 right-0 z-10 h-40 flex items-center">
        <form id="items-container" class="flex items-center space-x-6 px-8 max-w-6xl mx-auto w-full">
            @csrf
            @error('id_produto')
                <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
            @enderror
            
            <div class="relative w-2/3">
                <span class="absolute left-4 top-4 text-orange-500 text-2xl font-bold">#</span>
                <input type="text" id="produto" placeholder="código do produto" class="border border-gray-300 rounded pl-12 pr-6 py-4 text-lg w-full focus:outline-orange-500"/>
            </div>
            
            <!-- Campo de Quantidade -->
            <input type="number" id="quantidade" value="1" min="1" class="border border-gray-300 rounded w-24 px-4 py-4 text-lg text-center"/>
            <button type="button" id="add-item" class="border border-orange-500 text-orange-500 px-8 py-4 text-lg rounded hover:bg-orange-500 hover:text-white transition"> Adicionar </button>
        </form>
    </div>

	<form action="{{ route('sales.store') }}" method="POST" id="products_to_store">
		@csrf
		<div class="mt-48 grid grid-cols-3 gap-6">
			<div class="col-span-2 space-y-4">
				<div class="w-fit m-auto text-dark-gray mt-8" id="produtos">
				</div>
			</div>

			<div class="p-10">
				<div class="space-y-6">
					<div>
						<span class="text-gray-600 text-lg">Total:</span>
						<p class="text-4xl font-bold text-gray-800">123,45</p>
						<hr class="border-t-2 border-orange-500 mt-2">
					</div>

					<button type="submit" class="w-full py-2 bg-orange-500 text-white rounded font-semibold hover:bg-orange-600">
						Finalizar
					</button>

					<a href="#" class="flex items-center text-orange-500 hover:underline">
						← Voltar
					</a>
				</div>
			</div>
		</div>
	</form>
	
	<script>
		let itemIndex = 0;
		
		const prods = @json($products);
		console.log(prods);
		
		document.getElementById('add-item').addEventListener('click', () => {
			const container = document.getElementById('products_to_store');
			const produto = document.getElementById('produto');
			const quantidade = document.getElementById('quantidade');
			const newItem = document.createElement('div');
			newItem.classList.add('item');
			
			const input1 = document.createElement('input');
			input1.type = "hidden";
			input1.name = "product_ids_"+itemIndex;
			input1.value = produto.value;
			
			const input2 = document.createElement('input');
			input2.type = "hidden";
			input2.name = "quantitys_"+itemIndex;
			input2.value = quantidade.value;

			container.appendChild(input1);
			container.appendChild(input2);
			
			itemIndex++;
			
			const produtos = document.getElementById('produtos');
			const newCard = document.createElement('div');
			newCard.innerHTML = `
				<div class="w-fit mb-5 flex p-5 bg-light-gray rounded-lg">
					<div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">#${produto.value}</div>
				</div>
			`;

			produtos.appendChild(newCard);
		});
	</script>
</x-layout>
