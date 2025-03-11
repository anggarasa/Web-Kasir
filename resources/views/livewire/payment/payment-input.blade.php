<div>
    <div class="flex justify-between items-center mb-10">
        <div>
            <flux:heading size="xl">Payment Input</flux:heading>
            <flux:subheading>Payment input system.</flux:subheading>
        </div>
    </div>

    <!-- Customer Selection -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 dark:bg-zinc-900">
        <h2 class="text-xl font-semibold mb-4">Customer Information</h2>

        @if ($customer)
        <div class="flex flex-wrap items-center gap-4">
            <div>
                <div class="font-medium">{{ $customer->nama }}</div>
                <div class="text-sm text-gray-600 dark:text-zinc-400">{{ $customer->username }}</div>
            </div>
            <button type="button" wire:click="resetCustomer" class="text-red-500 hover:text-red-600 cursor-pointer">
                Change Customer
            </button>
        </div>
        @else
        <flux:modal.trigger name="select-customer">
            <flux:button variant="primary">Select Customer</flux:button>
        </flux:modal.trigger>

        <!-- modal select customer -->
        <flux:modal name="select-customer" class="max-w-lg w-full">
            <div class="space-y-6">
                <div>
                    <flux:heading size="xl" class="text-gray-900 dark:text-gray-200">Select Customer</flux:heading>
                </div>

                <flux:input icon="magnifying-glass" placeholder="Search customers" wire:model.live="search"
                    class="w-full">
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" variant="subtle" wire:click="resetSearch" icon="x-mark" class="-mr-1" />
                    </x-slot>
                </flux:input>

                <div class="max-h-60 overflow-y-auto divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($customers as $pelanggan)
                    <div wire:click="setCustomer({{ $pelanggan->id }})"
                        class="p-3 hover:bg-gray-100 dark:hover:bg-zinc-900 cursor-pointer rounded transition duration-150 ease-in-out">
                        <div class="font-medium text-gray-900 dark:text-gray-200">{{ $pelanggan->nama }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ $pelanggan->username }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </flux:modal>
        @endif
    </div>

    <!-- Product Selection -->
    @if ($customer)
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 dark:bg-zinc-900">
        <h2 class="text-xl font-semibold mb-4">Product Selection</h2>

        <!-- Product Search -->
        <div class="mb-6">
            <div class="relative">
                <flux:input icon="magnifying-glass" placeholder="Search products" wire:model.live="searchProduk">
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" variant="subtle" wire:click="resetProductSearch" icon="x-mark"
                            class="-mr-1" />
                    </x-slot>
                </flux:input>

                @if($searchProduk && count($products) > 0)
                <div
                    class="absolute left-0 right-0 mt-2 bg-white border rounded-lg shadow-lg z-10 max-h-60 overflow-y-auto dark:bg-zinc-800 dark:border-zinc-700">
                    @foreach ($products as $product)
                    <div wire:click="addProduct({{ $product->id }})"
                        class="p-3 hover:bg-gray-100 dark:hover:bg-zinc-700 cursor-pointer">
                        <div class="flex justify-between items-center">
                            <div class="font-medium">{{ $product->nama_produk }}</div>
                            <div class="text-gray-600 dark:text-zinc-400">Rp {{ number_format($product->harga_produk, 0,
                                ',', '.') }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- Selected Products -->
        <div class="space-y-4">
            @if(count($selectedProducts) > 0)
            @foreach($selectedProducts as $index => $product)
            <div class="flex flex-wrap items-center gap-4 p-4 border rounded dark:border-zinc-700">
                <div class="flex-grow">
                    <div class="font-medium">{{ $product['nama'] }}</div>
                    <div class="text-gray-600 dark:text-zinc-400">Rp {{ number_format($product['harga'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm text-gray-600 dark:text-zinc-400">Quantity:</label>
                    <input type="number" wire:model="productQuantities.{{ $product['id'] }}"
                        wire:change="updateQuantity({{ $product['id'] }}, $event.target.value)" min="1"
                        class="w-20 px-2 py-1 border rounded dark:bg-zinc-800 dark:border-zinc-700">
                </div>
                <button wire:click="removeProduct({{ $product['id'] }})" class="text-red-500 hover:text-red-600">
                    Remove
                </button>
            </div>
            @endforeach

            <!-- Total Price -->
            <div class="mt-6 p-4 bg-gray-50 dark:bg-zinc-800 rounded-lg">
                <div class="flex justify-between items-center font-semibold">
                    <span>Total:</span>
                    <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Total Payment -->
            <div class="mt-6 p-4 bg-gray-50 dark:bg-zinc-800 rounded-lg">
                <div
                    class="flex flex-col md:flex-row justify-between items-center font-semibold space-y-2 md:space-y-0 md:space-x-2">
                    <span>Total Payment:</span>
                    <flux:input type="number" placeholder="Rp." wire:model.live="totalPayment"
                        class="w-full md:w-48 px-3 py-2" />
                </div>
            </div>

            <!-- Change money -->
            <div class="mt-6 p-4 bg-gray-50 dark:bg-zinc-800 rounded-lg">
                <div class="flex justify-between items-center font-semibold">
                    <span>Change Money:</span>
                    <span>Rp {{ number_format($changeAmount, 0, ',', '.') }}</span>
                </div>
            </div>

            <flux:button variant="primary" wire:click="save">Complete Payment</flux:button>
            @else
            <div class="text-center py-4 text-gray-500 dark:text-zinc-400">
                No products selected yet. Search and select products above.
            </div>
            @endif
        </div>
    </div>
    @endif
</div>