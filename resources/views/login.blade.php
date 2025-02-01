<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="h-screen w-screen flex items-center">
        <form action="{{ route('login.store') }}" method="post"
        class="m-auto w-fit h-fit px-[105px] py-[75px] flex flex-col items-center bg-light-gray rounded-lg">
            @csrf

            <p class="text-center pb-[25px]">
                Faça login para acessar o sistema:
            </p>

            @error('error')
            <div class="text-red-300 w-[250px] mb-[10px]">{{ $message }}</div>
            @enderror

            @error('email')
            <div class="text-red-300 w-[250px] mb-[10px]">{{ $message }}</div>
            @enderror
            <div class="w-[250px] py-2.5 pl-2.5 flex item-center font-light border-b-2 border-orange bg-white mb-[25px]">
                <div class="mr-4">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.8333 17.5V15.8333C15.8333 14.9493 15.4821 14.1014 14.857 13.4763C14.2319 12.8512 13.384 12.5 12.5 12.5H7.49996C6.6159 12.5 5.76806 12.8512 5.14294 13.4763C4.51782 14.1014 4.16663 14.9493 4.16663 15.8333V17.5" stroke="#DB5A0F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.99996 9.16667C11.8409 9.16667 13.3333 7.67428 13.3333 5.83333C13.3333 3.99238 11.8409 2.5 9.99996 2.5C8.15901 2.5 6.66663 3.99238 6.66663 5.83333C6.66663 7.67428 8.15901 9.16667 9.99996 9.16667Z" stroke="#DB5A0F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <input type="text" placeholder="Email" name="email"
                class="placeholder-dark-gray w-full focus:outline-none">
            </div>

            @error('password')
            <div class="text-red-300 w-[250px] mb-[10px]">{{ $message }}</div>
            @enderror
            <div class="w-[250px] py-2.5 pl-2.5 flex item-center font-light border-b-2 border-orange bg-white mb-[25px]">
                <div class="mr-4">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 14.1667C9.55801 14.1667 9.13409 13.9911 8.82153 13.6785C8.50897 13.366 8.33337 12.942 8.33337 12.5C8.33337 11.575 9.07504 10.8333 10 10.8333C10.4421 10.8333 10.866 11.0089 11.1786 11.3215C11.4911 11.6341 11.6667 12.058 11.6667 12.5C11.6667 12.942 11.4911 13.366 11.1786 13.6785C10.866 13.9911 10.4421 14.1667 10 14.1667ZM15 16.6667V8.33334H5.00004V16.6667H15ZM15 6.66668C15.4421 6.66668 15.866 6.84227 16.1786 7.15483C16.4911 7.46739 16.6667 7.89132 16.6667 8.33334V16.6667C16.6667 17.1087 16.4911 17.5326 16.1786 17.8452C15.866 18.1577 15.4421 18.3333 15 18.3333H5.00004C4.55801 18.3333 4.13409 18.1577 3.82153 17.8452C3.50897 17.5326 3.33337 17.1087 3.33337 16.6667V8.33334C3.33337 7.40834 4.07504 6.66668 5.00004 6.66668H5.83337V5.00001C5.83337 3.89494 6.27236 2.83513 7.05376 2.05373C7.83516 1.27233 8.89497 0.833344 10 0.833344C10.5472 0.833344 11.089 0.941118 11.5946 1.15051C12.1001 1.35991 12.5594 1.66682 12.9463 2.05373C13.3332 2.44064 13.6401 2.89997 13.8495 3.4055C14.0589 3.91102 14.1667 4.45284 14.1667 5.00001V6.66668H15ZM10 2.50001C9.337 2.50001 8.70111 2.7634 8.23227 3.23224C7.76343 3.70108 7.50004 4.33697 7.50004 5.00001V6.66668H12.5V5.00001C12.5 4.33697 12.2366 3.70108 11.7678 3.23224C11.299 2.7634 10.6631 2.50001 10 2.50001Z" fill="#DB5A0F"/>
                    </svg>
                </div>
                <input type="password" placeholder="Senha" name="password"
                class="placeholder-dark-gray w-full focus:outline-none">
            </div>

            <button class="px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange"
            type="submit">Login</button>
        </form>
    </div>
    
</body>
</html>

    
