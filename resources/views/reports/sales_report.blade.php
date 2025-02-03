<x-layout>

    <!-- Cabeçalho com botão de voltar -->
    <div class="max-w-[850px] w-4/5 m-auto my-[50px] border-b-2 border-orange">
        <x-buttons.icon route="{{ route('home') }}" text="Voltar">
        </x-buttons.icon>

        <h1 class="text-4xl font-light m-auto my-[50px]"> 
            RELATÓRIO DE <span class="font-bold">VENDAS</span>
        </h1>
        
        <!-- Formulário para filtrar por data -->
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


    @if(!$startDate || !$endDate || $endDate > $now)
        <!-- Mensagem de erro se alguma das datas for inválida -->
        <div class="max-w-[850px] w-4/5 m-auto my-[50px]">
            <p class="text-center text-red-500">As datas inseridas são inválidas. Verifique as datas e tente novamente.</p>
        </div>
    @elseif($startDate > $endDate )
        <!-- Mensagem de erro se a data inicial for maior que a final -->
        <div class="max-w-[850px] w-4/5 m-auto my-[50px]">
            <p class="text-center text-red-500">A data de início deve ser anterior ou igual à data de término.</p>
        </div>
    @else
        <!-- Exibir relatório se as datas forem válidas -->
        @if($sales->isNotEmpty())
            <div class="max-w-[850px] w-4/5 m-auto my-[20px]">
                <div class="flex justify-between mb-5">
                    <div>
                        <strong>Total de Vendas:</strong> {{ $totalVendas }}
                    </div>
                    <div>
                        <strong>Valor Total:</strong> R$ {{ number_format($valorTotalVendas, 2, ',', '.') }}
                    </div>
                </div>
            </div>

            <!-- Tabela de vendas -->
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
                                <td class="px-4 py-2 border text-center">R$ {{ number_format($sale->product->preco, 2, ',', '.') }}</td>
                                <td class="px-4 py-2 border text-center">R$ {{ number_format($sale->quantidade * $sale->product->preco, 2, ',', '.') }}</td>
                                <td class="px-4 py-2 border text-center">{{ $sale->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="max-w-[850px] w-4/5 m-auto my-[50px]">
                <p class="text-center">Nenhuma venda encontrada para o período selecionado.</p>
            </div>
        @endif
    @endif
</x-layout>
