<x-layout>
    
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('products') }}" text="Voltar">
        </x-buttons.icon>

        <h1 class="w-fit text-4xl font-light m-auto my-[50px]"> 
            ATUALIZAÇÃO DE <span class="font-bold">PRODUTO</span>
        </h1>
    </div>

    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" class="w-fit m-auto">
        @csrf 
        @method('PUT')


        <!-- message vem do envio manual no controlador -->
        @if (session()->has('message'))
            <div class="text-red-300">*{{ session()->get('message') }}</div>
        @endif

        <!-- error vem de validate() -->
        @error('descricao')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic label="Descrição:" name="descricao" value="{{ $product->descricao }}" placeholder="">
        </x-inputs>

        @error('preco')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic label="Preço unitário:" name="preco" value="{{ $product->preco }}" placeholder="">
        </x-inputs>

        <button class="m-auto px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange"
        type="submit">Salvar</button>

    </form>

</x-layout>