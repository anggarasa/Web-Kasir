<div>
    <div class="flex justify-between items-center mb-10">
        <div>
            <flux:heading size="xl">Admin User</flux:heading>
            <flux:subheading>Admin user account management.</flux:subheading>
        </div>

        <flux:modal.trigger name="crud-admin">
            <flux:button icon="user-plus" variant="primary">Add Admin User</flux:button>
        </flux:modal.trigger>
    </div>

    <!-- Search Bar -->
    <div class="mb-10">
        <form wire:submit="searchUser" class="flex items-center">
            <flux:input icon="magnifying-glass" wire:model="search" placeholder="Search user admin">
                <x-slot name="iconTrailing">
                    <flux:button size="sm" variant="subtle" icon="x-mark" class="-mr-1"
                        wire:click="$set('search', '')" />
                </x-slot>
            </flux:input>
            <flux:button icon="magnifying-glass" type="submit" variant="primary" class="ml-4" />
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
            <thead class="bg-zinc-50 dark:bg-zinc-700">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">
                        User</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">
                        Email</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                {{-- @if ($users)
                @foreach ($users as $user) --}}
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                {{-- @if ($user->image)
                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/'. $user->image) }}"
                                    alt="{{ $user->name }}">
                                @else --}}
                                <div class="h-8 w-8 rounded-full bg-rose-100 flex items-center justify-center">
                                    <span class="text-rose-600 font-medium">AJ</span>
                                </div>
                                {{-- @endif --}}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                    Andre Junaedi
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-300">
                        andre.junaedi@klikbca.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <flux:button icon="pencil-square" variant="primary" class="mr-3" wire:click="edit()" />
                        <flux:button icon="user-minus" variant="danger" wire:click="confirmDeleteUser()" />
                    </td>
                </tr>
                {{-- @endforeach
                @else
                <td colspan="3" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">No users found</td>
                @endif --}}
            </tbody>
        </table>
        <div class="p-3">
            {{-- {{ $users->links() }} --}}
        </div>
    </div>

    <!-- Modal Create & Update Admin User -->
    <flux:modal name="crud-admin" variant="flyout" class="space-y-6">
        <div>
            <flux:heading size="lg">Add Admin User</flux:heading>
            <flux:subheading>Create new admin account.</flux:subheading>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Input File -->
            <flux:input type="file" wire:model="form.image" label="Foto" />
            <div wire:loading wire:target="form.image" class="mt-2 text-gray-500 flex justify-center items-center">
                <i class="fa-solid fa-circle-notch animate-spin text-xl mr-3"></i>
                <span>Mengunggah...</span>
            </div>
            {{-- @if ($form->image)
            <div wire:loading.remove wire:target="form.image" class="mt-4">
                <div class="w-32 h-32 overflow-hidden rounded-lg shadow-md">
                    <img src="{{ $form->image->temporaryUrl() }}" alt="Preview" class="w-full h-full object-cover" />
                </div>
            </div>
            @elseif ($form->oldImage)
            <!-- Jika tidak ada gambar baru, tampilkan gambar lama -->
            <div class="mt-4">
                <div class="w-32 h-32 overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('storage/' . $form->oldImage) }}" alt="Old Image"
                        class="w-full h-full object-cover" />
                </div>
            </div>
            @endif --}}

            <!-- Input Name -->
            <flux:input label="Name" wire:model="form.name" placeholder="Your name" />

            <!-- Input Email -->
            <flux:input label="Email" type="email" wire:model="form.email" placeholder="yourmail@example.com" />

            <!-- Input Password -->
            <flux:input label="Password" type="password" wire:model="form.password" placeholder="******" />

            <!-- Input Confirm Password -->
            <flux:input label="Confirm Password" type="password" wire:model="form.password_confirmation"
                placeholder="******" />

            <!-- Submit Button -->
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </form>
    </flux:modal>
</div>