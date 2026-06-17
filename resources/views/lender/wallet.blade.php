<x-lender-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Dompet Saya</h1>
            <p class="text-gray-400 mt-1">Kelola saldo dan riwayat top up</p>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl p-8 text-center">
            <p class="text-sm text-gray-400 mb-2">Saldo Tersedia</p>
            <p class="text-4xl font-extrabold text-gold">Rp {{ number_format($balance ?? 0, 0, ',', '.') }}</p>
            <div class="mt-6" x-data="{ showForm: false }">
                <button @click="showForm = !showForm" class="px-6 py-3 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">
                    <span x-show="!showForm">+ Top Up Saldo</span>
                    <span x-show="showForm">Batal</span>
                </button>
                <form x-show="showForm" method="POST" action="{{ route('lender.wallet.topup') }}" class="max-w-md mx-auto mt-6 space-y-4" x-transition>
                    @csrf
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-300 mb-1 text-left">Jumlah Top Up (Rp)</label>
                        <input type="number" id="amount" name="amount" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" min="10000" required>
                        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                    </div>
                    <button type="submit" class="w-full px-6 py-2.5 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Ajukan Top Up</button>
                </form>
            </div>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">Riwayat Top Up</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Tanggal</th>
                            <th class="text-right py-3 px-4 font-medium">Jumlah</th>
                            <th class="text-left py-3 px-4 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topups ?? [] as $topup)
                            <tr class="border-b border-gray-800">
                                <td class="py-3 px-4 text-gray-400">{{ $topup->created_at ? $topup->created_at->format('d M Y H:i') : '-' }}</td>
                                <td class="py-3 px-4 text-right text-gray-200 font-semibold">Rp {{ number_format($topup->amount ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">
                                    @if($topup->status === 'pending')
                                        <span class="px-2 py-0.5 bg-yellow-900/50 text-yellow-400 text-xs rounded-full border border-yellow-600/50">Pending</span>
                                    @elseif($topup->status === 'approved')
                                        <span class="px-2 py-0.5 bg-emerald-900/50 text-emerald text-xs rounded-full border border-emerald-600/50">Disetujui</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-red-900/50 text-red-400 text-xs rounded-full border border-red-600/50">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-8 text-center text-gray-500">Belum ada riwayat top up</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-lender-layout>