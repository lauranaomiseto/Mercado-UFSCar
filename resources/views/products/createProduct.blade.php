<x-layout>
    
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('products') }}" text="Voltar">
        </x-buttons.icon>

        <h1 class="w-fit text-4xl font-light m-auto my-[50px]"> 
            CADASTRO DE <span class="font-bold">PRODUTO</span>
        </h1>
    </div>

    <form action="{{ route('products.store') }}" method="POST" class="w-fit m-auto">
        @csrf

        @error('descricao')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic label="Descrição:" name="descricao" value="" placeholder="Nome do produto">
        </x-inputs>

        @error('preco')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic label="Preço unitário:" name="preco" value="" placeholder="12.34">
        </x-inputs>

        <button class="m-auto px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange"
        type="submit">Adicionar</button>

    </form>

</x-layout>