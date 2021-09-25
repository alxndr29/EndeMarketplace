<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


use Illuminate\Support\Facades\DB;
use App\Produk;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::info('Cronjob berhasil dijalankan');
            $data = DB::table('transaksi')
                // ->where('status_transaksi', '=', 'MenungguPembayaran')
                ->where('status_transaksi', '=', 'MenungguKonfirmasi')
                ->select('transaksi.idtransaksi', 'transaksi.status_transaksi', DB::raw('HOUR(TIMEDIFF(transaksi.timeout_at, NOW() )) as timeout'))
                ->get();
            foreach ($data as $value) {
                if ($value->timeout == 0) {
                    DB::beginTransaction();
                    try {
                        DB::table('transaksi')->where('idtransaksi', $value->idtransaksi)->update([
                            'status_transaksi' => "Batal"
                        ]);
                        $detailTransaksi = DB::table('detailtransaksi')->where('transaksi_idtransaksi', $value->idtransaksi)->get();
                        foreach ($detailTransaksi as $value1) {
                            $produk = Produk::find($value1->produk_idproduk);
                            if ($produk->stok == 0) {
                                $produk->status = "Aktif";
                            }
                            $produk->stok = $produk->stok + $value1->jumlah;
                            $produk->save();
                        }
                        $user = DB::table('transaksi')
                            ->join('users', 'users.iduser', '=', 'transaksi.users_iduser')
                            ->where('transaksi.idtransaksi', '=', $value->idtransaksi)
                            ->select('users.*')
                            ->first();
                        $pesan =  "Hallo " . $user->name . " Pesanan anda dengan nomor transaksi " . $value->idtransaksi . " " . " Telah dibatalkan karena telah melewati batas waktu" . ' klik link berikut untuk melihat status transaksi anda! ' . url('/user/transaksi/index');
                        DB::commit();
                        if ($user->notif_email == 1) {
                            try {
                                $details = [
                                    'title' => '',
                                    'body' => $pesan
                                ];
                                \Mail::to($user->email)->send(new \App\Mail\CheckoutMail($details));
                            } catch (\Exception $b) { }
                        }
                        if ($user->notif_wa == 1) {
                            try {
                                $result = file_get_contents("https://sambi.wablas.com/api/send-message?token=qTfb6jdlzQ9sWE50NM2p9kDIO7x4OjrTY3mIuusw3ec5ZCcPICJcgU8NfOzPdY6b&phone=" . $user->telepon . "&message=" . $pesan);
                            } catch (\Exception $a) { }
                        }
                        Log::info('Transaksi ' . $value->idtransaksi . 'Sisa waktu 0 dibatalkan');
                    } catch (\Exception $e) {
                        DB::rollback();
                        return $e->getMessage();
                    }
                } else {
                    Log::info('Transaksi ' . $value->idtransaksi . 'Sisa waktu ' . $value->timeout . ' Jam');
                }
            }
        })->everyTwoMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
