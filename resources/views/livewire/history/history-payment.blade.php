<div>
    <div class="flex justify-between items-center mb-10">
        <div>
            <flux:heading size="xl">Payment History</flux:heading>
            <flux:subheading>Payment history management.</flux:subheading>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100 dark:bg-zinc-900 dark:border-zinc-950">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <flux:input icon="magnifying-glass" wire:model.live="searchCustomer" placeholder="Search customer"
                    label="Search Customer">
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" wire:click="$set('searchCustomer', '')" variant="subtle" icon="x-mark"
                            class="-mr-1" />
                    </x-slot>
                </flux:input>
            </div>

            <div>
                <flux:input icon="magnifying-glass" wire:model.live="searchCashier" placeholder="Search cashier"
                    label="Search Casheir">
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" wire:click="$set('searchCashier', '')" variant="subtle" icon="x-mark"
                            class="-mr-1" />
                    </x-slot>
                </flux:input>
            </div>

            <div>
                <flux:input type="date" wire:model.live="searchDate" label="Transaction Date">
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" wire:click="$set('searchDate', '')" variant="subtle" icon="x-mark"
                            class="-mr-1" />
                    </x-slot>
                </flux:input>
            </div>
        </div>
    </div>

    <!-- Transactions List -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md overflow-hidden">
        <div class="p-4 bg-gray-50 dark:bg-zinc-800 border-b border-gray-200 dark:border-zinc-700">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-zinc-100">Transaction List</h2>
        </div>

        <!-- Desktop View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            Date</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            Customer</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            Total</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            Cashier</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-700">
                    @if ($transaksions->isNotEmpty())
                    @foreach ($transaksions as $transaksi)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-zinc-100">#{{ $transaksi->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-zinc-100">{{ date('d F Y',
                            strtotime($transaksi->tgl_transaksi)) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-zinc-100">{{
                            $transaksi->pelanggan->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-rose-600 dark:text-rose-400">Rp{{
                            number_format($transaksi->total_harga,0,',','.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-zinc-100">{{
                            $transaksi->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <flux:modal.trigger :name="'detail-transaksi-'.$transaksi->id">
                                <button type="button" class="text-rose-400 hover:text-rose-500">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </flux:modal.trigger>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-zinc-400">No transactions
                            found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Mobile View -->
        <div class="md:hidden">
            @if ($transaksions->isNotEmpty())
            @foreach ($transaksions as $transaksi)
            <div
                class="p-4 border-b border-gray-200 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-900 dark:text-zinc-100">#{{ $transaksi->id }}</span>
                    <span class="text-sm text-gray-500 dark:text-zinc-400">{{ date('d F Y',
                        strtotime($transaksi->tgl_transaksi)) }}</span>
                </div>
                <div class="mb-2">
                    <span class="text-sm text-gray-500 dark:text-zinc-400">Pelanggan:</span>
                    <span class="ml-1 text-gray-900 dark:text-zinc-100">{{ $transaksi->pelanggan->nama }}</span>
                </div>
                <div class="mb-2">
                    <span class="text-sm text-gray-500 dark:text-zinc-400">Total:</span>
                    <span class="ml-1 font-medium text-rose-600 dark:text-rose-400">Rp{{
                        number_format($transaksi->total_harga,0,',','.') }}</span>
                </div>
                <div class="mb-2">
                    <span class="text-sm text-gray-500 dark:text-zinc-400">Kasir:</span>
                    <span class="ml-1 text-gray-900 dark:text-zinc-100">{{ $transaksi->user->name }}</span>
                </div>
                <button @click="viewDetails(transaction)"
                    class="mt-2 w-full py-2 bg-blue-50 dark:bg-rose-900 text-blue-600 dark:text-rose-300 rounded-md hover:bg-blue-100 dark:hover:bg-rose-800 transition flex items-center justify-center">
                    <i class="fas fa-eye mr-2"></i> Lihat Detail
                </button>
            </div>
            @endforeach
            @else
            <div class="p-6 text-center text-gray-500 dark:text-zinc-400">No transactions
                found</div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="p-4 bg-white dark:bg-zinc-900 border-t border-gray-200 dark:border-zinc-700">
            {{ $transaksions->links() }}
        </div>
    </div>

    <!-- modal detail transaksi -->
    @foreach ($transaksions as $transaksi)
    <flux:modal :name="'detail-transaksi-'.$transaksi->id" class="max-w-3xl w-full">
        <div class="space-y-6 p-6">
            <div>
                <flux:heading size="xl" class="text-rose-600 dark:text-rose-400">Transaction Details</flux:heading>
            </div>

            <div class="bg-gray-50 dark:bg-zinc-900 p-4 rounded-lg mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Transaction ID</p>
                        <p class="font-medium text-gray-900 dark:text-gray-200">#{{ $transaksi->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Date</p>
                        <p class="font-medium text-gray-900 dark:text-gray-200">
                            {{ date('d F Y', strtotime($transaksi->tgl_transaksi)) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Customer</p>
                        <p class="font-medium text-gray-900 dark:text-gray-200">{{ $transaksi->pelanggan->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Cashier</p>
                        <p class="font-medium text-gray-900 dark:text-gray-200">{{ $transaksi->user->name }}</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-zinc-900">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Product</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Price</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Amount</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($transaksi->detailTransaksis as $detail)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-200">{{
                                $detail->product->nama_produk }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-200">
                                Rp{{ number_format($detail->product->harga_produk,0,',','.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $detail->jumlah
                                }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-200">
                                Rp{{ number_format($detail->subtotal,0,',','.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 dark:bg-zinc-900">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-900 dark:text-gray-200">
                                Total Price:</td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900 dark:text-gray-200">
                                Rp{{ number_format($transaksi->total_harga,0,',','.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-900 dark:text-gray-200">
                                Total Payment:</td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-200">
                                Rp{{ number_format($transaksi->uang_diberikan,0,',','.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-900 dark:text-gray-200">
                                Change Money:</td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-200">
                                Rp{{ number_format($transaksi->kembalian,0,',','.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </flux:modal>
    @endforeach
</div>