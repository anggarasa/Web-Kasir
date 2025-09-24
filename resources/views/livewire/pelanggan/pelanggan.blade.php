<div>
    <div class="flex justify-between items-center mb-10">
        <div>
            <flux:heading size="xl">Customer</flux:heading>
            <flux:subheading>Customer account management.</flux:subheading>
        </div>

        <flux:modal.trigger name="crud-pelanggan">
            <flux:button icon="user-plus" variant="primary">Add Customer</flux:button>
        </flux:modal.trigger>
    </div>

    <!-- Filters Section -->
    <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100 dark:bg-zinc-900 dark:border-zinc-950">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Search orders" label="Search">
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" wire:click="$set('search', '')" variant="subtle" icon="x-mark"
                            class="-mr-1" />
                    </x-slot>
                </flux:input>
            </div>

            <div>
                <flux:input type="date" wire:model.live="searchDate" label="Date of Birth">
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" wire:click="$set('searchDate', '')" variant="subtle" icon="x-mark"
                            class="-mr-1" />
                    </x-slot>
                </flux:input>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white dark:bg-zinc-800 rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead class="bg-gray-50 dark:bg-zinc-700">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Nama
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Username
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        No HP
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Tanggal Lahir
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Alamat
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($pelanggans as $pelanggan)
                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        {{ $pelanggan->nama }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        {{ $pelanggan->username }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        {{ $pelanggan->no_hp }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        {{ Carbon\Carbon::parse($pelanggan->tgl_lahir)->format('d F Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                        {{ Str::limit($pelanggan->alamat, 20, '...') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <flux:button icon="pencil-square" wire:click="edit({{ $pelanggan }})" variant="primary" />
                            <flux:modal.trigger :name="'show-pelanggan-'.$pelanggan->id">
                                <flux:button icon="eye" class="mr-2" variant="filled" />
                            </flux:modal.trigger>
                            <flux:button icon="trash" wire:click="confirmDelete({{ $pelanggan->id }})"
                                variant="danger" />
                        </div>
                    </td>
                </tr>

                <!-- Modal Show Pelanggan -->
                <flux:modal :name="'show-pelanggan-'.$pelanggan->id" class="max-w-md w-full p-6 rounded-lg shadow-xl">
                    <div class="flex flex-col items-center">
                        <!-- Profile Picture -->
                        <div class="relative w-32 h-32 mb-4">
                            <div
                                class="bg-rose-100 rounded-full w-full h-full border-4 border-rose-500 flex items-center justify-center">
                                <span class="text-rose-600 font-bold text-5xl">
                                    {{ strtoupper(substr($pelanggan->nama, 0, 2)) }}
                                </span>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-accent-foreground">{{ $pelanggan->nama
                                }}</h2>
                            <p class="text-accent font-medium text-sm">{{ $pelanggan->username }}</p>
                        </div>

                        <div class="mt-6 w-full space-y-4">
                            <!-- Birth Date -->
                            <div class="flex items-center bg-gray-50 dark:bg-zinc-900 p-4 rounded-lg shadow-sm">
                                <i class="fa-solid fa-calendar-days text-xl text-rose-500 mr-4"></i>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-accent-foreground">Tanggal Lahir</p>
                                    <p class="font-medium text-gray-800 dark:text-zinc-400">
                                        {{ Carbon\Carbon::parse($pelanggan->tgl_lahir)->format('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-center bg-gray-50 dark:bg-zinc-900 p-4 rounded-lg shadow-sm">
                                <i class="fa-solid fa-phone text-xl text-rose-500 mr-4"></i>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-accent-foreground">No. Handphone</p>
                                    <p class="font-medium text-gray-800 dark:text-zinc-400">{{ $pelanggan->no_hp }}</p>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="flex items-center bg-gray-50 dark:bg-zinc-900 p-4 rounded-lg shadow-sm">
                                <i class="fa-solid fa-location-dot text-xl text-rose-500 mr-4"></i>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-accent-foreground">Alamat</p>
                                    <p class="font-medium text-gray-800 dark:text-zinc-400">{{ $pelanggan->alamat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </flux:modal>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-900 dark:text-gray-100">
                        No customer found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-3">
            {{ $pelanggans->links() }}
        </div>
    </div>

    <!-- Modal Create & Update Customer -->
    <flux:modal name="crud-pelanggan" @close="resetInput" variant="flyout" class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $form->pelanggan ? 'Edit' : 'Add' }} Customer</flux:heading>
            <flux:subheading>{{ $form->pelanggan ? 'Update this' : 'Create new' }} customer account.</flux:subheading>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Input Name -->
            <flux:input label="Name" wire:model="form.name" placeholder="Your name" />

            <!-- Input Username -->
            <flux:input label="Username" wire:model="form.username" placeholder="Username" />

            <!-- Input Tgl Lahir -->
            <flux:input label="Date of Birth" type="date" wire:model="form.tglLahir" placeholder="11-06-2006" />

            <!-- Input No hp -->
            <flux:input label="No Hp" type="number" wire:model="form.noHp" placeholder="08123456789" />

            <!-- Input Alamat -->
            <flux:textarea label="Alamat" wire:model="form.alamat" placeholder="Jl. Epres RT/RW 18/07 ..." />

            <!-- Submit Button -->
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
