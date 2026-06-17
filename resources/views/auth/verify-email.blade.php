<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        Terima kasih telah mendaftar! Sebelum memulai, verifikasi email Anda dengan mengklik tautan yang telah kami kirimkan. Jika tidak menerima email, kami akan kirimkan ulang.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-emerald">
            Tautan verifikasi baru telah dikirim ke email Anda.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">Kirim Ulang Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-400 hover:text-gold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold">Keluar</button>
        </form>
    </div>
</x-guest-layout>
