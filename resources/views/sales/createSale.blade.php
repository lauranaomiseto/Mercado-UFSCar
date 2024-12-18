

<x-layout>
	
    <form class="w-fit m-auto" id="items-container">
        @csrf

        @error('id_produto')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
		
        <label>Produto:</label>
        <input type="text" id="produto" min="1" value="1">
		
		<label>Quantidade:</label>
        <input type="number" id="quantidade" min="1" value="1">
		
		<button type="button" id="add-item" class="m-auto px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange">Registrar</button>
    </form>
	
	<script>
    let itemIndex = 1;
	
	const prods = @json($products);
	console.log(prods);
	
    document.getElementById('add-item').addEventListener('click', () => {
        const container = document.getElementById('items-container');
		const produto = document.getElementById('produto');
		const quantidade = document.getElementById('quantidade');
        const newItem = document.createElement('div');
        newItem.classList.add('item');
        newItem.innerHTML = `
			<input type="hidden" value="${produto.value}">
            <input type="hidden" value="${quantidade.value}">
        `;
		container.appendChild(newItem);
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
	
	
	<div class="w-fit m-auto text-dark-gray" id="produtos">
		
	</div>

</x-layout>


