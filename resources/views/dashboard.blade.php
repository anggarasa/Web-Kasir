<x-layouts.app>
    <div class="flex justify-between items-center mb-10">
        <div>
            <flux:heading size="xl">Dashboard</flux:heading>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Users -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 dark:text-zinc-400 text-sm">Total Users</p>
                    @php
                    $users = App\Models\User::count();
                    $lastMonthUsers = App\Models\User::whereMonth('created_at', now()->subMonth())->count();

                    // Cek apakah $lastMonthUsers bernilai 0
                    if ($lastMonthUsers > 0) {
                    $percentageChange = ($users - $lastMonthUsers) / $lastMonthUsers * 100;
                    } else {
                    $percentageChange = 0; // Atau bisa juga diatur ke nilai default lainnya
                    }
                    @endphp
                    <p class="text-2xl font-bold">{{ $users }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
            @if ($percentageChange > 0)
            <p class="text-green-600 text-sm mt-2">
                <i class="fas fa-arrow-up"></i> {{ number_format($percentageChange, 2) }}% dari bulan lalu
            </p>
            @elseif ($percentageChange < 0) <p class="text-red-600 text-sm mt-2">
                <i class="fas fa-arrow-down"></i> {{ number_format(abs($percentageChange), 2) }}% dari bulan lalu
                </p>
                @else
                <p class="text-grey-500 text-sm mt-2">
                    <i class="fas fa-minus"></i> 0% dari bulan lalu
                </p>
                @endif
        </div>

        <!-- Total Pelanggan -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 dark:text-zinc-400 text-sm">Total Customer</p>
                    @php
                    $customers = App\Models\Pelanggan::count();
                    $lastMonthCustomers = App\Models\Pelanggan::whereMonth('created_at', now()->subMonth())->count();

                    if ($lastMonthCustomers > 0) {
                    $percentageChangeCustomers = ($customers - $lastMonthCustomers) / $lastMonthCustomers * 100;
                    } else {
                    $percentageChangeCustomers = 0;
                    }
                    @endphp
                    <p class="text-2xl font-bold">{{ $customers }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-user-friends text-green-600"></i>
                </div>
            </div>
            @if ($percentageChangeCustomers > 0)
            <p class="text-green-600 text-sm mt-2">
                <i class="fas fa-arrow-up"></i> {{ number_format($percentageChangeCustomers, 2) }}% dari bulan lalu
            </p>
            @elseif ($percentageChangeCustomers < 0) <p class="text-red-600 text-sm mt-2">
                <i class="fas fa-arrow-down"></i> {{ number_format(abs($percentageChangeCustomers), 2) }}% dari bulan
                lalu
                </p>
                @else
                <p class="text-grey-500 text-sm mt-2">
                    <i class="fas fa-minus"></i> 0% dari bulan lalu
                </p>
                @endif
        </div>

        <!-- Total Produk -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 dark:text-zinc-400 text-sm">Total Product</p>
                    @php
                    $products = App\Models\Product::count();
                    $lastMonthProducts = App\Models\Product::whereMonth('created_at', now()->subMonth())->count();

                    if ($lastMonthProducts > 0) {
                    $percentageChangeProducts = ($products - $lastMonthProducts) / $lastMonthProducts * 100;
                    } else {
                    $percentageChangeProducts = 0;
                    }
                    @endphp
                    <p class="text-2xl font-bold">{{ $products }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-box text-purple-600"></i>
                </div>
            </div>
            @if ($percentageChangeProducts > 0)
            <p class="text-green-600 text-sm mt-2">
                <i class="fas fa-arrow-up"></i> {{ number_format($percentageChangeProducts, 2) }}% dari bulan lalu
            </p>
            @elseif ($percentageChangeProducts < 0) <p class="text-red-600 text-sm mt-2">
                <i class="fas fa-arrow-down"></i> {{ number_format(abs($percentageChangeProducts), 2) }}% dari bulan
                lalu
                </p>
                @else
                <p class="text-grey-500 text-sm mt-2">
                    <i class="fas fa-minus"></i> 0% dari bulan lalu
                </p>
                @endif
        </div>

        <!-- Total Transaksi -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 dark:text-zinc-400 text-sm">Total Transaction</p>
                    @php
                    $transactions = App\Models\Transaksi::count();
                    $lastMonthTransactions = App\Models\Transaksi::whereMonth('created_at', now()->subMonth())->count();

                    if ($lastMonthTransactions > 0) {
                    $percentageChangeTransactions = ($transactions - $lastMonthTransactions) / $lastMonthTransactions *
                    100;
                    } else {
                    $percentageChangeTransactions = 0;
                    }
                    @endphp
                    <p class="text-2xl font-bold">{{ $transactions }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-receipt text-orange-600"></i>
                </div>
            </div>
            @if ($percentageChangeTransactions > 0)
            <p class="text-green-600 text-sm mt-2">
                <i class="fas fa-arrow-up"></i> {{ number_format($percentageChangeTransactions, 2) }}% dari bulan lalu
            </p>
            @elseif ($percentageChangeTransactions < 0) <p class="text-red-600 text-sm mt-2">
                <i class="fas fa-arrow-down"></i> {{ number_format(abs($percentageChangeTransactions), 2) }}% dari bulan
                lalu
                </p>
                @else
                <p class="text-grey-500 text-sm mt-2">
                    <i class="fas fa-minus"></i> 0% dari bulan lalu
                </p>
                @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="lg:col-span-2 bg-white dark:bg-zinc-900 rounded-lg shadow p-4">
            <h3 class="font-bold mb-4">New Transaction</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-600">
                    <thead>
                        <tr>
                            <th
                                class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                ID
                            </th>
                            <th
                                class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                Customer
                            </th>
                            <th
                                class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                Total
                            </th>
                            <th
                                class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                        @php
                        $transaksions = App\Models\Transaksi::latest()->take(6)->get();
                        @endphp
                        @foreach ($transaksions as $transaksi)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap text-sm">#{{ $transaksi->id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ $transaksi->pelanggan->nama }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm">Rp {{
                                number_format($transaksi->total_harga,0,',','.') }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm">{{ date('d F Y',
                                strtotime($transaksi->tgl_transaksi)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>