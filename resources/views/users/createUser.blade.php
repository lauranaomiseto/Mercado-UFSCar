<x-layout>
    
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('users') }}" text="Voltar">
        </x-buttons.icon>

        <h1 class="w-fit text-4xl font-light m-auto my-[50px]"> 
            CADASTRO DE <span class="font-bold">USUÁRIO</span>
        </h1>
    </div>

    <form action="{{ route('users.store') }}" method="POST" class="w-fit m-auto">
        @csrf

        @error('name')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic type="text" label="Nome:" name="name" value="" placeholder="usuario@exemplo.com">
        </x-inputs>

        @error('email')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic type="text" label="Email:" name="email" value="" placeholder="usuario@exemplo.com">
        </x-inputs>

        @error('password')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic type="password" label="Senha:" name="password" value="" placeholder="abcDEF123#@!">
        </x-inputs>

        @error('role')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror

        <label for="papeis">Papel:</label>
        <div id="papeis" class="flex flex-col mb-[25px]">
            <div class="mt-[5px]">
                <input type="radio" id="gestor" name="role" value="gestor">
                <label for="gestor">Gestor de suprimentos</label>
            </div>
    
            <div class="mt-[5px]">
                <input type="radio"  id="estoquista" name="role" value="estoquista">
                <label for="estoquista">Estoquista</label>
            </div>

            <div class="mt-[5px]">
                <input type="radio" id="operador" name="role" value="operador">
                <label for="operador">Operador de caixa</label>
            </div> 

            <div class="mt-[5px]">
                <input type="radio" id="gerente" name="role" value="gerente">
                <label for="gerente">Gerente</label>
            </div>     
                       <div class="mt-[5px]">
                <input type="radio" id="adm" name="role" value="adm">
                <label for="adm">Administrador</label>
            </div>    
        </div>

        <button class="m-auto px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange"
        type="submit">Adicionar</button>

    </form>

</x-layout>