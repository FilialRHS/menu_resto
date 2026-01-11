<x-app-layout>
    <div class="bg-gray-50 min-h-screen pb-24 font-sans">
        <!-- Hero Section -->
        <div class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Menu Restoran</h1>
                    <p class="text-sm text-amber-600 font-medium tracking-wide uppercase mt-1">Pilih Salah Satu</p>
                </div>
                @if(session('success'))
                    <div class="text-sm text-green-600 bg-green-50 px-3 py-1 rounded-full border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($menus as $menu)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 relative" 
                         data-id="{{ $menu->id }}" 
                         data-price="{{ $menu->price }}">
                        
                        <!-- Admin Controls (Absolute) -->
                        @auth
                            @if(auth()->user()->isAdmin())
                                <div class="absolute top-2 right-2 z-20 flex gap-2">
                                    <a href="{{ route('menus.edit', $menu) }}" class="bg-white/90 p-2 rounded-full shadow-sm text-amber-500 hover:text-amber-600 transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        @endauth

                        <!-- Image Section -->
                        <div class="relative h-64 overflow-hidden">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            <!-- Price Badge -->
                            <div class="absolute bottom-4 left-4 text-white">
                                <span class="bg-amber-500/90 backdrop-blur-sm px-3 py-1 rounded-lg text-sm font-bold shadow-sm">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="mb-4">
                                <span class="text-xs font-bold text-amber-600 uppercase tracking-widest bg-amber-50 px-2 py-1 rounded-md">{{ $menu->category->name ?? 'Menu' }}</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2 group-hover:text-amber-600 transition-colors">{{ $menu->name }}</h3>
                                <p class="text-gray-500 text-sm mt-2 leading-relaxed line-clamp-2">{{ $menu->description }}</p>
                            </div>

                            <!-- Quantity Control -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-3 bg-gray-100 rounded-full p-1">
                                    <button onclick="updateQuantity({{ $menu->id }}, -1)" class="w-8 h-8 rounded-full bg-white text-gray-600 hover:text-red-500 shadow-sm flex items-center justify-center transition-all hover:scale-110 active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <span id="qty-{{ $menu->id }}" class="w-4 text-center font-bold text-gray-900">0</span>
                                    <button onclick="updateQuantity({{ $menu->id }}, 1)" class="w-8 h-8 rounded-full bg-white text-gray-600 hover:text-green-500 shadow-sm flex items-center justify-center transition-all hover:scale-110 active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Menu Belum Tersedia</h3>
                        <p class="text-gray-500">Silakan kembali lagi nanti untuk menu-menu spesial kami.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Floating Order Summary Bar -->
    <div id="order-bar" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.1)] transform translate-y-full transition-transform duration-500 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex flex-col">
                    <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">Estimasi Total</span>
                    <span class="text-2xl font-bold text-gray-900" id="total-price">Rp 0</span>
                </div>
                
                <button onclick="alert('Pesanan Diterima')" class="group bg-gray-900 hover:bg-black text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all flex items-center gap-3 transform hover:-translate-y-0.5">
                    <span>Pesan Sekarang</span>
                    <span id="total-items-badge" class="bg-amber-500 text-white text-xs font-bold px-2 py-0.5 rounded-full hidden">0</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        const cart = {};
        const orderBar = document.getElementById('order-bar');
        const totalPriceEl = document.getElementById('total-price');
        const totalItemsBadge = document.getElementById('total-items-badge');

        function updateQuantity(id, change) {
            // Initialize if not exists
            if (!cart[id]) cart[id] = 0;
            
            // Calculate new quantity
            const newQty = cart[id] + change;
            
            // Allow update if valid (>= 0)
            if (newQty >= 0) {
                cart[id] = newQty;
                
                // Update specific item counter
                const qtyElement = document.getElementById(`qty-${id}`);
                if (qtyElement) {
                    qtyElement.innerText = cart[id];
                    qtyElement.parentElement.classList.toggle('bg-amber-100', cart[id] > 0);
                    qtyElement.parentElement.classList.toggle('text-amber-700', cart[id] > 0);
                }

                updateTotal();
            }
        }

        function updateTotal() {
            let total = 0;
            let itemsCount = 0;

            // Iterate through cart
            for (const [id, qty] of Object.entries(cart)) {
                if (qty > 0) {
                    const priceEl = document.querySelector(`[data-id="${id}"]`);
                    if (priceEl) {
                        const price = parseFloat(priceEl.dataset.price);
                        total += price * qty;
                        itemsCount += qty;
                    }
                }
            }

            // Update Total Price Display
            totalPriceEl.innerText = 'Rp ' + total.toLocaleString('id-ID');

            // Toggle Order Bar visibility
            if (itemsCount > 0) {
                orderBar.classList.remove('translate-y-full');
                totalItemsBadge.classList.remove('hidden');
                totalItemsBadge.innerText = itemsCount;
            } else {
                orderBar.classList.add('translate-y-full');
                totalItemsBadge.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>
