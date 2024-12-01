<x-layout>
    
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('batches') }}" text="Voltar">
        </x-buttons.icon>

        <h1 class="w-fit text-4xl font-light m-auto my-[50px]"> 
            REGISTRO DE <span class="font-bold">LOTE</span>
        </h1>
    </div>

    <form action="{{ route('batches.store') }}" method="POST" class="w-fit m-auto">
        @csrf

        @error('id_produto')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <label for="id_produto">Produto:</label><br>
        <select name="id_produto" class="w-[295px] bg-light-gray px-[15px] py-[10px] rounded-[5px] mt-[5px] mb-[25px] text-medium-gray">
            <option selected value="" class="overflow-hidden whitespace-nowrap text-ellipsis">#COD: Descrição</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" class="overflow-hidden whitespace-nowrap text-ellipsis">#{{ $product->id }}: {{ $product->descricao }}</option>
            @endforeach
        </select><br>

        @error('quantidade')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic type="number" label="Quantidade:" name="quantidade" value="" placeholder="10">
        </x-inputs>

        @error('validade')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic type="date" label="Validade:" name="validade" value="" placeholder="">
        </x-inputs>

        <button class="m-auto px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange"
        type="submit">Registrar</button>

    </form>

</x-layout>