<x-layout>
    
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('users') }}" text="Voltar">
        </x-buttons.icon>

        <h1 class="w-fit text-4xl font-light m-auto my-[50px]"> 
            CADASTRO DE <span class="font-bold">USUÁRIO</span>
        </h1>
    </div>

    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" class="w-fit m-auto">
        @csrf
        @method('PUT')

        @if (session()->has('message'))
            <div class="text-red-300">*{{ session()->get('message') }}</div>
        @endif

        @error('name')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic type="text" label="Nome:" name="name" value="{{ $user->name }}" placeholder="">
        </x-inputs>

        @error('email')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic type="text" label="Email:" name="email" value="{{ $user->email }}" placeholder="">
        </x-inputs>

        @error('password')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror
        <x-inputs.basic type="password" label="Senha:" name="password" value="{{ $user->password }}" placeholder="">
        </x-inputs>

        @error('permission')
            <div class="text-red-300 max-w-[295px]">{{ $message }}</div>
        @enderror

        <label for="papeis">Permissão:</label>
        <div id="papeis" class="flex flex-col mb-[25px]">
            <div class="mt-[5px]">
                <input type="radio" id="a" name="permission" value="A">
                <label for="a">Tipo A</label>
            </div>
    
            <div class="mt-[5px]">
                <input type="radio"  id="b" name="permission" value="B">
                <label for="b">Tipo B</label>
            </div>

            <div class="mt-[5px]">
                <input type="radio" id="c" name="permission" value="C">
                <label for="c">Tipo C</label>
            </div>    
        </div>

        <button class="m-auto px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange"
        type="submit">Salvar</button>

    </form>

</x-layout>