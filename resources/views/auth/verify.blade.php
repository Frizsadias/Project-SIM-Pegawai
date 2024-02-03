<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <?php
                    $hour = date('G');
                    $minute = date('i');
                    $second = date('s');
                    $msg = ' Today is ' . date('l, M. d, Y.');
                    
                    if ($hour >= 0 && $hour <= 11 && $minute <= 59 && $second <= 59) {
                        $greet = 'Selamat Pagi,';
                    } elseif ($hour >= 12 && $hour <= 15 && $minute <= 59 && $second <= 59) {
                        $greet = 'Selamat Siang,';
                    } elseif ($hour >= 16 && $hour <= 17 && $minute <= 59 && $second <= 59) {
                        $greet = 'Selamat Sore,';
                    } elseif ($hour >= 18 && $hour <= 23 && $minute <= 59 && $second <= 59) {
                        $greet = 'Selamat Malam,';
                    }
                ?>

                <div class="card-header">{{ $greet }}</div><br>
                <div class="card-header">Anda mendapatkan email ini karena anda ingin melakukan penyetelan ulang sandi Aplikasi SILK. Untuk melanjutkan proses silahkan klik tautan berikut :</div>
                  <div class="card-body">
                   @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                           {{ __('A fresh verification link has been sent to your email address.') }}
                       </div>
                   @endif
                   <br>
                   <a href="{{ url('/ubah-kata-sandi/'.$token) }}">Klik Tautan Ini</a>
                   <br><br><br><br>
                   <p>atau URL dibawah ini :</p>
                   <a href="{{ url('/ubah-kata-sandi/'.$token) }}">{{ url('/ubah-kata-sandi/'.$token) }}</a>
                   <br><br><br><br>
                   <p>Jika tautan tidak berfungsi, harap akses alamat di atas menggunakan peramban web.</p>
                   <p>Jika anda tidak merasa meminta penyetelan ulang sandi, mungkin pengguna lain salah memasukkan email anda. Anda tidak perlu melakukan tindakan di atas dan bisa mengabaikan email ini dengan aman.</p><br><br><br>
                   <p>Hormat Kami,<br>
                   Admin Developer - Aplikasi SILK</p>
               </div>
           </div>
       </div>
   </div>
</div>
