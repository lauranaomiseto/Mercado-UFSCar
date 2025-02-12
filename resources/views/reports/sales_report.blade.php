<x-layout>
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('home') }}" text="Voltar"></x-buttons.icon>
        <h1 class="text-4xl font-light m-auto my-[50px]">RELATÓRIO DE <span class="font-bold">VENDAS</span></h1>

        <form action="{{ route('report') }}" method="GET" class="my-5">
            <div class="flex gap-4">
                <div>
                    <label for="start_date" class="block">Data de Início:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label for="end_date" class="block">Data de Término:</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <button type="submit" class="mt-6 px-4 py-2 bg-orange text-white rounded">Filtrar</button>
                </div>
            </div>
        </form>
    </div>

    @if($startDate && $endDate && $startDate <= $endDate && $endDate <= $now)
        <h2 class="text-2xl font-bold mt-10 text-center">Tabela de Vendas</h2>
        <div class="max-w-[850px] w-4/5 m-auto my-[50px]">
            <table class="min-w-full table-auto">
                <thead class="bg-orange text-white">
                    <tr>
                        <th class="px-4 py-2 border">ID Produto</th>
                        <th class="px-4 py-2 border">Quantidade</th>
                        <th class="px-4 py-2 border">Preço Unitário</th>
                        <th class="px-4 py-2 border">Total</th>
                        <th class="px-4 py-2 border">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr class="odd:bg-gray-100 even:bg-white">
                            <td class="px-4 py-2 border text-center">{{ $sale->id_produto }}</td>
                            <td class="px-4 py-2 border text-center">{{ $sale->quantidade }}</td>
                            <td class="px-4 py-2 border text-center">R$ {{ number_format($sale->preco, 2, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-center">R$ {{ number_format($sale->quantidade * $sale->preco, 2, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-center">{{ $sale->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h2 class="text-2xl font-bold mt-10 text-center">Controle de Estoque</h2>
    <div class="max-w-[850px] w-4/5 m-auto my-[50px]">
        <table class="min-w-full table-auto">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-4 py-2 border">ID Produto</th>
                    <th class="px-4 py-2 border">Nome</th>
                    <th class="px-4 py-2 border">Quantidade Disponível</th>
                    <th class="px-4 py-2 border">Validade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estoque as $produto)
                    <tr class="odd:bg-gray-100 even:bg-white">
                        <td class="px-4 py-2 border text-center">{{ $produto->id_produto }}</td>
                        <td class="px-4 py-2 border text-center">{{ $produto->descricao }}</td>
                        <td class="px-4 py-2 border text-center">{{ $produto->quantidade }}</td>
                        <td class="px-4 py-2 border text-center">{{ $produto->validade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2 class="text-2xl font-bold mt-10 text-center">Produtos Mais Vendidos</h2>
    <div class="max-w-[850px] w-4/5 m-auto my-[50px]">
        <table class="min-w-full table-auto bg-gray-200">
            <thead class="bg-gray-500 text-white">
                <tr>
                    <th class="px-4 py-2 border">ID Produto</th>
                    <th class="px-4 py-2 border">Descrição</th>
                    <th class="px-4 py-2 border">Total Vendido</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtosMaisVendidos as $produto)
                    <tr class="odd:bg-gray-100 even:bg-white">
                        <td class="px-4 py-2 border text-center">{{ $produto->id_produto }}</td>
                        <td class="px-4 py-2 border text-center">{{ $produto->descricao }}</td>
                        <td class="px-4 py-2 border text-center">{{ $produto->total_vendido }} unidades</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
