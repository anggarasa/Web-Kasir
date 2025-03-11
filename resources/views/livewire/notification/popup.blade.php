<div>
    <div x-data="{
        isVisible: @entangle('isVisible'),
        type: @entangle('type'),
        message: @entangle('message'),
        autoClose() {
            if (this.type === 'success' || this.type === 'error') {
                setTimeout(() => { 
                    this.isVisible = false; 
                }, 3000);
            }
        }
    }" x-show="isVisible" x-init="$watch('isVisible', value => { if (value) autoClose(); })"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50">

        <div :class="{
            'bg-white dark:bg-zinc-900 border-green-500': type === 'success',
            'bg-white dark:bg-zinc-900 border-red-500': type === 'error',
            'bg-white dark:bg-zinc-900 border-yellow-500': type === 'warning',
            'bg-white dark:bg-zinc-900 border-blue-500': type === 'info'
        }" class="min-w-[300px] max-w-md border-l-4 rounded-lg shadow-lg p-4">

            <div class="flex items-start">
                <!-- Icon -->
                <div class="flex-shrink-0">
                    <template x-if="type === 'success'">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </template>
                    <template x-if="type === 'warning'">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </template>
                    <template x-if="type === 'info'">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </template>
                </div>

                <!-- Content -->
                <div class="ml-3 w-full">
                    <p x-text="message" class="text-sm font-medium"></p>
                </div>

                <!-- Close button -->
                <div class="ml-auto pl-3">
                    <button @click="$wire.close()" class="text-gray-400 hover:text-zinc-700 focus:outline-none">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Action buttons for warning and info -->
            <template x-if="type === 'warning' || type === 'info'">
                <div class="mt-3 flex justify-end space-x-2">
                    <button @click="$wire.executeAction()" class="px-3 py-1 text-white rounded-md transition" :class="{
                            'bg-yellow-500 hover:bg-yellow-600': type === 'warning',
                            'bg-blue-500 hover:bg-blue-600': type === 'info'
                        }">
                        OK
                    </button>
                </div>
            </template>
        </div>
    </div>
</div>