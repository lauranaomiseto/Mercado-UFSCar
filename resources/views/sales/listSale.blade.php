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
        
            <x-buttons.primary route="" text="Adicionar nova venda">
            </x-buttons.primary>
        </div>
    </div>

    <!-- message pode vir de BatchController show() -->
    @if (session()->has('message'))
        <div class="text-red-300">*{{ session()->get('message') }}</div>
    @endif


</x-layout>