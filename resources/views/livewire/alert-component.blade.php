<div>
    <!-- Alerta com Tailwind e Alpine.js -->
    @if ($message)
        <div
            id="order-alert"
            x-data="{ showAlert: true }"
            x-show="showAlert"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-x-10"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-10"
            class="fixed top-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg flex items-center justify-between opacity-100"
        >
            <span class="font-semibold">{{ $message }}</span>
            <button
                class="text-white text-xl ml-4 hover:text-gray-300"
                @click="showAlert = false"
            >
                ×
            </button>
        </div>

        <!-- Temporizador para fechar o alerta após 5 segundos -->
        <script>
            setTimeout(() => {
                Livewire.emit('hideAlert');
            }, 5000); // Alerta desaparece após 5 segundos
        </script>
    @endif
</div>


