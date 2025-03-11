<div>
    <div class="flex justify-between items-center mb-10">
        <div>
            <flux:heading size="xl">Product</flux:heading>
            <flux:subheading>Product management.</flux:subheading>
        </div>

        <flux:modal.trigger name="crud-product">
            <flux:button icon="plus" variant="primary">Add Product</flux:button>
        </flux:modal.trigger>
    </div>

    <!-- Search Bar -->
    <div class="mb-10">
        <form wire:submit="searchProduct" class="flex items-center">
            <flux:input icon="magnifying-glass" wire:model="search" placeholder="Search product, price, stok">
                <x-slot name="iconTrailing">
                    <flux:button size="sm" variant="subtle" icon="x-mark" class="-mr-1"
                        wire:click="$set('search', '')" />
                </x-slot>
            </flux:input>
            <flux:button icon="magnifying-glass" type="submit" variant="primary" class="ml-4" />
        </form>
    </div>

    <!-- Table Product -->
    <div class="overflow-x-auto bg-white dark:bg-zinc-800 rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead class="bg-gray-50 dark:bg-zinc-700">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        No
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Product
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Price
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Stok
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($products as $index => $product)
                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        {{ $products->firstItem() + $index }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        {{ $product->nama_produk }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        Rp {{ number_format($product->harga_produk,0,',','.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        {{ $product->stok }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <flux:button icon="pencil-square" wire:click="edit({{ $product }})" variant="primary" />
                            <flux:button icon="trash" wire:click="confirmDelete({{ $product->id }})" variant="danger" />
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-900 dark:text-gray-100">
                        No product found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-3">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Modal Create & Update Customer -->
    <flux:modal name="crud-product" variant="flyout" @close="resetInput" class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $form->product ? 'Edit' : 'Add' }} Product</flux:heading>
            <flux:subheading>{{ $form->product ? 'Update this' : 'Create new' }} product.</flux:subheading>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Input Name -->
            <flux:input label="Product Name" wire:model="form.name" placeholder="Product name" />

            <!-- Input Username -->
            <flux:input label="Price" type="number" wire:model="form.price" placeholder="Rp." />

            <!-- Input Tgl Lahir -->
            <flux:input label="Stok" type="number" wire:model="form.stok" placeholder="0" />

            <!-- Submit Button -->
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </form>
    </flux:modal>
</div>