<x-layouts.app>
    <!-- Header Section with Greeting -->
    <div class="relative overflow-hidden bg-gradient-to-r from-rose-500 to-rose-600 dark:from-zinc-700 dark:to-zinc-800 rounded-2xl p-6 mb-8 shadow-xl transition-all duration-300">
        <div class="absolute right-0 top-0 w-48 h-48 opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-full h-full text-white">
                <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.035-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.035.84-1.875 1.875-1.875h.75c1.035 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75c-1.035 0-1.875-.84-1.875-1.875V8.625zM3 13.125c0-1.035.84-1.875 1.875-1.875h.75c1.035 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75C3.84 21.75 3 20.91 3 19.875v-6.75z" />
            </svg>
        </div>
        <div class="relative z-10">
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 bg-white/20 dark:bg-zinc-600/30 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-chart-line text-white/90"></i>
                </div>
                <div>
                    <h1 class="text-white text-2xl md:text-3xl font-bold mb-1">Welcome to R.A Mart Dashboard</h1>
                    <p class="text-rose-100 dark:text-zinc-300 text-sm md:text-base flex items-center">
                        <i class="fas fa-calendar-day mr-2 opacity-75"></i>
                        {{ date('l, d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
            @php
                // Total keseluruhan user saat ini
                $users = App\Models\User::count();
                // Total user hingga akhir bulan lalu
                $totalLastMonth = App\Models\User::where('created_at', '<', now()->startOfMonth())->count();
                // Hitung persentase perubahan
                if ($totalLastMonth > 0) {
                    $percentageChange = (($users - $totalLastMonth) / $totalLastMonth) * 100;
                } else {
                    $percentageChange = $users > 0 ? 100 : 0;
                }
            @endphp

            <div class="border-b border-gray-100 dark:border-zinc-700 p-5">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-14 rounded-full bg-rose-100 dark:bg-zinc-700 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 group-hover:bg-rose-200 dark:group-hover:bg-zinc-600">
                        <i class="fas fa-users text-rose-600 dark:text-rose-400 text-xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800 dark:text-white transition-all">{{ $users }}</p>
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Users</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                @if ($percentageChange > 0)
                    <div class="flex items-center text-green-600 dark:text-green-400">
                        <i class="fas fa-arrow-up mr-1 text-xs"></i>
                        <span class="text-sm font-medium">{{ number_format($percentageChange, 1) }}% dari bulan lalu</span>
                    </div>
                @elseif ($percentageChange < 0)
                    <div class="flex items-center text-rose-600 dark:text-rose-400">
                        <i class="fas fa-arrow-down mr-1 text-xs"></i>
                        <span class="text-sm font-medium">{{ number_format(abs($percentageChange), 1) }}% dari bulan lalu</span>
                    </div>
                @else
                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-minus mr-1 text-xs"></i>
                        <span class="text-sm font-medium">0% dari bulan lalu</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Total Customer Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
            @php
                // Total keseluruhan customer saat ini
                $customers = App\Models\Pelanggan::count();
                // Total customer hingga akhir bulan lalu
                $customersLastMonthEnd = App\Models\Pelanggan::where('created_at', '<', now()->startOfMonth())->count();
                // Hitung persentase perubahan
                if ($customersLastMonthEnd > 0) {
                    $percentageChangeCustomers = (($customers - $customersLastMonthEnd) / $customersLastMonthEnd) * 100;
                } else {
                    $percentageChangeCustomers = $customers > 0 ? 100 : 0;
                }
            @endphp

            <div class="border-b border-gray-100 dark:border-zinc-700 p-5">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-14 rounded-full bg-rose-100 dark:bg-zinc-700 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 group-hover:bg-rose-200 dark:group-hover:bg-zinc-600">
                        <i class="fas fa-user-friends text-rose-600 dark:text-rose-400 text-xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $customers }}</p>
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Customers</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                @if ($percentageChangeCustomers > 0)
                    <div class="flex items-center text-green-600 dark:text-green-400">
                        <i class="fas fa-arrow-up mr-1 text-xs"></i>
                        <span class="text-sm font-medium">{{ number_format($percentageChangeCustomers, 1) }}% dari bulan lalu</span>
                    </div>
                @elseif ($percentageChangeCustomers < 0)
                    <div class="flex items-center text-rose-600 dark:text-rose-400">
                        <i class="fas fa-arrow-down mr-1 text-xs"></i>
                        <span class="text-sm font-medium">{{ number_format(abs($percentageChangeCustomers), 1) }}% dari bulan lalu</span>
                    </div>
                @else
                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-minus mr-1 text-xs"></i>
                        <span class="text-sm font-medium">0% dari bulan lalu</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Total Product Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
            @php
                // Total keseluruhan product saat ini
                $products = App\Models\Product::count();
                // Total product hingga akhir bulan lalu
                $productsLastMonthEnd = App\Models\Product::where('created_at', '<', now()->startOfMonth())->count();
                // Hitung persentase perubahan
                if ($productsLastMonthEnd > 0) {
                    $percentageChangeProducts = (($products - $productsLastMonthEnd) / $productsLastMonthEnd) * 100;
                } else {
                    $percentageChangeProducts = $products > 0 ? 100 : 0;
                }
            @endphp

            <div class="border-b border-gray-100 dark:border-zinc-700 p-5">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-14 rounded-full bg-rose-100 dark:bg-zinc-700 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 group-hover:bg-rose-200 dark:group-hover:bg-zinc-600">
                        <i class="fas fa-box text-rose-600 dark:text-rose-400 text-xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $products }}</p>
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Products</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                @if ($percentageChangeProducts > 0)
                    <div class="flex items-center text-green-600 dark:text-green-400">
                        <i class="fas fa-arrow-up mr-1 text-xs"></i>
                        <span class="text-sm font-medium">{{ number_format($percentageChangeProducts, 1) }}% dari bulan lalu</span>
                    </div>
                @elseif ($percentageChangeProducts < 0)
                    <div class="flex items-center text-rose-600 dark:text-rose-400">
                        <i class="fas fa-arrow-down mr-1 text-xs"></i>
                        <span class="text-sm font-medium">{{ number_format(abs($percentageChangeProducts), 1) }}% dari bulan lalu</span>
                    </div>
                @else
                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-minus mr-1 text-xs"></i>
                        <span class="text-sm font-medium">0% dari bulan lalu</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Total Transaction Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
            @php
                // Total keseluruhan transaksi saat ini
                $transactions = App\Models\Transaksi::count();
                // Total transaksi hingga akhir bulan lalu
                $transactionsLastMonthEnd = App\Models\Transaksi::where('created_at', '<', now()->startOfMonth())->count();
                // Hitung persentase perubahan
                if ($transactionsLastMonthEnd > 0) {
                    $percentageChangeTransactions = (($transactions - $transactionsLastMonthEnd) / $transactionsLastMonthEnd) * 100;
                } else {
                    $percentageChangeTransactions = $transactions > 0 ? 100 : 0;
                }
            @endphp

            <div class="border-b border-gray-100 dark:border-zinc-700 p-5">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-14 rounded-full bg-rose-100 dark:bg-zinc-700 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 group-hover:bg-rose-200 dark:group-hover:bg-zinc-600">
                        <i class="fas fa-receipt text-rose-600 dark:text-rose-400 text-xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $transactions }}</p>
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Transactions</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                @if ($percentageChangeTransactions > 0)
                    <div class="flex items-center text-green-600 dark:text-green-400">
                        <i class="fas fa-arrow-up mr-1 text-xs"></i>
                        <span class="text-sm font-medium">{{ number_format($percentageChangeTransactions, 1) }}% dari bulan lalu</span>
                    </div>
                @elseif ($percentageChangeTransactions < 0)
                    <div class="flex items-center text-rose-600 dark:text-rose-400">
                        <i class="fas fa-arrow-down mr-1 text-xs"></i>
                        <span class="text-sm font-medium">{{ number_format(abs($percentageChangeTransactions), 1) }}% dari bulan lalu</span>
                    </div>
                @else
                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-minus mr-1 text-xs"></i>
                        <span class="text-sm font-medium">0% dari bulan lalu</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table Section -->
    <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-md overflow-hidden mb-8 transition-all duration-300 hover:shadow-lg">
        <div class="flex justify-between items-center p-6 border-b border-gray-100 dark:border-zinc-700">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white flex items-center">
                <i class="fas fa-chart-line text-rose-500 dark:text-rose-400 mr-3"></i>
                Recent Transactions
            </h2>
            <a href="#" class="text-rose-600 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300 text-sm font-medium flex items-center transition-colors">
                View All
                <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="bg-rose-50 dark:bg-zinc-700/50">
                    <th class="px-6 py-4 text-left text-xs font-semibold text-rose-600 dark:text-rose-300 uppercase tracking-wider rounded-tl-lg">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-rose-600 dark:text-rose-300 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-rose-600 dark:text-rose-300 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-rose-600 dark:text-rose-300 uppercase tracking-wider rounded-tr-lg">Date</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                @php
                    $transaksions = App\Models\Transaksi::latest()->take(6)->get();
                @endphp

                @foreach ($transaksions as $index => $transaksi)
                    <tr class="{{ $index % 2 == 0 ? 'bg-white dark:bg-zinc-800' : 'bg-rose-50/30 dark:bg-zinc-750' }} hover:bg-rose-50 dark:hover:bg-zinc-700/50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            <span class="bg-rose-100 dark:bg-zinc-700 text-rose-700 dark:text-rose-300 px-2.5 py-1 rounded-full text-xs">#{{ $transaksi->id }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 flex-shrink-0 bg-rose-100 dark:bg-zinc-700 rounded-full flex items-center justify-center mr-3">
                                    <span class="font-semibold text-rose-600 dark:text-rose-400">{{ strtoupper(substr($transaksi->pelanggan->nama, 0, 1)) }}</span>
                                </div>
                                <div class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $transaksi->pelanggan->nama }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Rp {{ number_format($transaksi->total_harga,0,',','.') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <i class="fas fa-calendar-day mr-2 text-gray-400 dark:text-gray-500"></i>
                            {{ date('d F Y', strtotime($transaksi->tgl_transaksi)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Additional UI Components -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Quick Actions -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-md p-6 transition-all duration-300 hover:shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-bolt text-rose-500 dark:text-rose-400 mr-2"></i>
                Quick Actions
            </h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center p-4 rounded-xl bg-rose-50 dark:bg-zinc-700/50 hover:bg-rose-100 dark:hover:bg-zinc-700 transition-all duration-200 group">
                    <div class="w-12 h-12 rounded-full bg-rose-200 dark:bg-zinc-600 flex items-center justify-center mr-4 group-hover:bg-rose-300 dark:group-hover:bg-zinc-500 transition-colors duration-200">
                        <i class="fas fa-plus text-rose-600 dark:text-rose-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 dark:text-white group-hover:text-rose-700 dark:group-hover:text-rose-300 transition-colors">New Transaction</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Create a new sales transaction</p>
                    </div>
                </a>

                <a href="#" class="flex items-center p-4 rounded-xl bg-rose-50 dark:bg-zinc-700/50 hover:bg-rose-100 dark:hover:bg-zinc-700 transition-all duration-200 group">
                    <div class="w-12 h-12 rounded-full bg-rose-200 dark:bg-zinc-600 flex items-center justify-center mr-4 group-hover:bg-rose-300 dark:group-hover:bg-zinc-500 transition-colors duration-200">
                        <i class="fas fa-user-plus text-rose-600 dark:text-rose-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 dark:text-white group-hover:text-rose-700 dark:group-hover:text-rose-300 transition-colors">Add Customer</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Register a new customer</p>
                    </div>
                </a>

                <a href="#" class="flex items-center p-4 rounded-xl bg-rose-50 dark:bg-zinc-700/50 hover:bg-rose-100 dark:hover:bg-zinc-700 transition-all duration-200 group">
                    <div class="w-12 h-12 rounded-full bg-rose-200 dark:bg-zinc-600 flex items-center justify-center mr-4 group-hover:bg-rose-300 dark:group-hover:bg-zinc-500 transition-colors duration-200">
                        <i class="fas fa-box-open text-rose-600 dark:text-rose-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 dark:text-white group-hover:text-rose-700 dark:group-hover:text-rose-300 transition-colors">Add Product</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Create a new product</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Customers -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-md p-6 md:col-span-2 transition-all duration-300 hover:shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                    <i class="fas fa-users text-rose-500 dark:text-rose-400 mr-2"></i>
                    Recent Customers
                </h3>
                <a href="#" class="text-rose-600 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300 text-sm font-medium flex items-center transition-colors">
                    View All
                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            @php
                $recentCustomers = App\Models\Pelanggan::latest()->take(5)->get();
            @endphp

            <div class="space-y-2">
                @foreach($recentCustomers as $customer)
                    <div class="flex items-center justify-between p-4 rounded-xl hover:bg-rose-50 dark:hover:bg-zinc-700/50 transition-all duration-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-rose-100 dark:bg-zinc-700 flex items-center justify-center mr-4 overflow-hidden">
                                <span class="font-semibold text-rose-600 dark:text-rose-400 text-lg">{{ strtoupper(substr($customer->nama, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">{{ $customer->nama }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                    <i class="fas fa-calendar-alt mr-1 opacity-75"></i>
                                    Joined: {{ $customer->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="text-rose-600 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300 transition-colors p-2 rounded-full hover:bg-rose-100 dark:hover:bg-zinc-600">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
