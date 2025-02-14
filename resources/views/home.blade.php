<x-layout>
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">

        @php
            $roleLabel = match (Auth::user()->role) {
                'adm' => 'ADMINISTRADOR',
                'gestor' => 'GESTOR',
                'gerente' => 'GERENTE',
                'estoquista' => 'GESTOR',
                'operador' => 'OPERADOR',
                default => 'DESCONHECIDO',
                };
        @endphp

        <h1 class="w-fit text-4xl font-light m-auto my-[50px]"> 
            PAINEL DE <span class="font-bold">{{ $roleLabel }}</span>
        </h1>
    </div>

    <div class="m-auto max-w-[600px] flex flex-wrap gap-[30px]">

    @can('gestao-usuarios')
        <x-cards.feature text="Gestão de Usuários" route="{{ route('users') }}">
            <x-slot:icon>
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.75 26.25V23.75C3.75 22.4239 4.27678 21.1521 5.21447 20.2145C6.15215 19.2768 7.42392 18.75 8.75 18.75H13.75C15.0761 18.75 16.3479 19.2768 17.2855 20.2145C18.2232 21.1521 18.75 22.4239 18.75 23.75V26.25M20 3.9125C21.0755 4.18788 22.0288 4.81338 22.7095 5.69039C23.3903 6.5674 23.7598 7.64604 23.7598 8.75625C23.7598 9.86646 23.3903 10.9451 22.7095 11.8221C22.0288 12.6991 21.0755 13.3246 20 13.6M26.25 26.25V23.75C26.2437 22.6464 25.8724 21.576 25.1941 20.7055C24.5158 19.835 23.5685 19.2134 22.5 18.9375M6.25 8.75C6.25 10.0761 6.77678 11.3479 7.71447 12.2855C8.65215 13.2232 9.92392 13.75 11.25 13.75C12.5761 13.75 13.8479 13.2232 14.7855 12.2855C15.7232 11.3479 16.25 10.0761 16.25 8.75C16.25 7.42392 15.7232 6.15215 14.7855 5.21447C13.8479 4.27678 12.5761 3.75 11.25 3.75C9.92392 3.75 8.65215 4.27678 7.71447 5.21447C6.77678 6.15215 6.25 7.42392 6.25 8.75Z" stroke="#DB5A0F" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
    
            </x-slot:icon>
        </x-cards.feature>
    @endcan
    
    @can('gestao-produtos')
        <x-cards.feature text="Gestão de Produtos" route="{{ route('products') }}">
            <x-slot:icon>
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M27.5 3.75H2.5V11.25H3.75V25C3.75 25.663 4.01339 26.2989 4.48223 26.7678C4.95107 27.2366 5.58696 27.5 6.25 27.5H23.75C24.413 27.5 25.0489 27.2366 25.5178 26.7678C25.9866 26.2989 26.25 25.663 26.25 25V11.25H27.5V3.75ZM5 6.25H25V8.75H5V6.25ZM23.75 25H6.25V11.25H23.75V25ZM11.25 13.75H18.75C18.75 14.413 18.4866 15.0489 18.0178 15.5178C17.5489 15.9866 16.913 16.25 16.25 16.25H13.75C13.087 16.25 12.4511 15.9866 11.9822 15.5178C11.5134 15.0489 11.25 14.413 11.25 13.75Z" fill="#DB5A0F"/>
                </svg>
            </x-slot:icon>
        </x-cards.feature>
    @endcan

    @can('gestao-estoque')    
        <x-cards.feature text="Gestão de Estoque" route="{{ route('batches') }}">
            <x-slot:icon>
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 16.775H7.4V16.875V18.75V18.85H7.5H13.125H13.225V18.75V16.875V16.775H13.125H7.5ZM7.5 20.525H7.4V20.625V22.5V22.6H7.5H16.875H16.975V22.5V20.625V20.525H16.875H7.5Z" fill="#DB5A0F" stroke="#DB5A0F" stroke-width="0.2"/>
                    <path d="M24.3751 3.65H24.375L5.625 3.65L5.62485 3.65C5.10133 3.65078 4.59947 3.8591 4.22929 4.22929C3.8591 4.59947 3.65078 5.10133 3.65 5.62485V5.625L3.65 24.375L3.65 24.3751C3.65078 24.8987 3.8591 25.4005 4.22929 25.7707C4.59947 26.1409 5.10133 26.3492 5.62485 26.35H5.625H24.375H24.3751C24.8987 26.3492 25.4005 26.1409 25.7707 25.7707C26.1409 25.4005 26.3492 24.8987 26.35 24.3751V24.375V5.625V5.62485C26.3492 5.10133 26.1409 4.59947 25.7707 4.22929C25.4005 3.8591 24.8987 3.65078 24.3751 3.65ZM18.85 5.725H24.275L24.2759 24.275H5.725V5.725H11.15V11.25V11.35H11.25H18.75H18.85V11.25V5.725ZM16.775 5.725V9.275H13.225V5.725H16.775Z" fill="#DB5A0F" stroke="#DB5A0F" stroke-width="0.2"/>
                </svg>
            </x-slot:icon>
        </x-cards.feature>
    @endcan
    

    @can('emissao-relatorios')
        <x-cards.feature text="Emissão de relatórios" route="{{ route('report') }}">
            <x-slot:icon>
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.375 16.725H9.225V16.875V18.75V18.9H9.375H16.875H17.025V18.75V16.875V16.725H16.875H9.375ZM9.375 12.0375H9.225V12.1875V14.0625V14.2125H9.375H20.625H20.775V14.0625V12.1875V12.0375H20.625H9.375ZM9.375 21.4125H9.225V21.5625V23.4375V23.5875H9.375H14.0625H14.2125V23.4375V21.5625V21.4125H14.0625H9.375Z" fill="#DB5A0F" stroke="#DB5A0F" stroke-width="0.3"/>
                    <path d="M20.775 9.375V6.7125H23.2875V26.1H6.7125V6.7125H9.225V9.375V9.525H9.375H20.625H20.775V9.375ZM23.4375 4.5375H20.775V3.75C20.775 3.21294 20.5617 2.69787 20.1819 2.31811C19.8021 1.93835 19.2871 1.725 18.75 1.725H11.25C10.7129 1.725 10.1979 1.93835 9.81811 2.31811C9.43835 2.69787 9.225 3.21294 9.225 3.75V4.5375H6.5625C6.02544 4.5375 5.51037 4.75085 5.13061 5.13061C4.75085 5.51037 4.5375 6.02544 4.5375 6.5625V26.25C4.5375 26.7871 4.75085 27.3021 5.13061 27.6819C5.51037 28.0617 6.02544 28.275 6.5625 28.275H23.4375C23.9746 28.275 24.4896 28.0617 24.8694 27.6819C25.2492 27.3021 25.4625 26.7871 25.4625 26.25V6.5625C25.4625 6.02544 25.2492 5.51037 24.8694 5.13061C24.4896 4.75085 23.9746 4.5375 23.4375 4.5375ZM11.4 3.9H18.6V7.35H11.4V3.9Z" fill="#DB5A0F" stroke="#DB5A0F" stroke-width="0.3"/>
                </svg>
            </x-slot:icon>
        </x-cards.feature>
    @endcan

    @can('operacao-vendas')
        <x-cards.feature text="Operação de vendas" route="{{ route('sales') }}">
            <x-slot:icon>
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.625 8.75L15 2.5L4.375 8.75V21.25L15 27.5L25.625 21.25V8.75Z" stroke="#DB5A0F" stroke-width="2.3" stroke-linejoin="round"/>
                    <path d="M15 13.75V18.75M20 11.25V18.75M10 16.25V18.75" stroke="#DB5A0F" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </x-slot:icon>
        </x-cards.feature>
    @endcan
    </div>
</x-layout>