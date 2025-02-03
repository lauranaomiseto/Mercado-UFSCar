<x-layout>

    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('home') }}" text="Voltar">
        </x-buttons.icon>
    
        <div class="flex justify-between content-center flex-wrap my-[50px] gap-5">
            <h1 class="text-4xl font-light"> 
                GERENCIAMENTO DE 
                <span class="font-bold">
                    USUÁRIOS
                </span>
            </h1>
        
            <x-buttons.primary route="{{ route('users.create') }}" text="Cadastrar novo usuário">
            </x-buttons.primary>
        </div>
    </div>


    <div class="w-fit m-auto text-dark-gray">
        @foreach ($users as $user)

        <div class="w-fit mb-5 flex p-5 bg-light-gray rounded-lg">
            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">#{{ $user->id }}</div>
            
            <div class="w-[200px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">{{ $user->email }}</div>

            <div class="w-[100px] mr-5 overflow-hidden whitespace-nowrap text-ellipsis">{{ $user->permission }}</div>

            <div class="w-fit text-orange">
                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="mr-5 hover:underline">Editar</a>
                <a href="{{ route('users.show', ['user' => $user->id]) }}" class="hover:underline">Detalhar</a>
            </div>
        </div>

        @endforeach
    </div>


</x-layout>