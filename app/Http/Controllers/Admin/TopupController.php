<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topup;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TopupController extends Controller
{
    public function index(): View
    {
        $topups = Topup::with('lender', 'admin')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->latest()
            ->paginate(15);

        return view('admin.topups.index', compact('topups'));
    }

    public function approve(Topup $topup): RedirectResponse
    {
        if ($topup->status !== 'pending') {
            return redirect()->route('admin.topups.index')
                ->with('error', 'Topup sudah diproses sebelumnya.');
        }

        $topup->update([
            'status' => 'approved',
            'admin_id' => auth()->id(),
        ]);

        $wallet = $topup->lender->lenderWallet;
        if ($wallet) {
            $wallet->increment('balance', $topup->amount);
        }

        return redirect()->route('admin.topups.index')
            ->with('success', 'Topup berhasil disetujui.');
    }

    public function reject(Topup $topup): RedirectResponse
    {
        if ($topup->status !== 'pending') {
            return redirect()->route('admin.topups.index')
                ->with('error', 'Topup sudah diproses sebelumnya.');
        }

        $topup->update([
            'status' => 'rejected',
            'admin_id' => auth()->id(),
        ]);

        return redirect()->route('admin.topups.index')
            ->with('success', 'Topup berhasil ditolak.');
    }
}
