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

                <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" width="100%">
                    <tbody>
                        <tr>
                            <td>
                                <!-- Row 1: Header -->
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" width="600">
                                                    <tbody>
                                                        <tr>
                                                            <!-- Column 1: Image -->
                                                            <td class="column column-1" width="33.333333333333336%">
                                                                <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" width="100%">
                                                                    <tr>
                                                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                            <div align="left" class="alignment">
                                                                                <div style="max-width: 80px;"><img src="{{ URL::to('assets/images/Logo_RSUD_Caruban.png') }}" alt="I'm an image" style="display: block; height: auto; border: 0; width: 100%;" title="I'm an image" width="80"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <!-- Column 2: Text -->
                                                            <td class="column column-2" width="66.66666666666667%">
                                                                <table border="0" cellpadding="10" cellspacing="0" class="text_block block-1" role="presentation" width="100%">
                                                                    <tr>
                                                                        <td class="pad">
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #555555;">
                                                                                    <p style="margin: 0; font-size: 16px; margin-left: 33px;"><em><strong>{{ $greet }}</strong></em></p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Row 2: Main Content -->
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" width="600">
                                                    <tbody>
                                                        <tr>
                                                            <td class="column column-1" width="100%">
                                                                <table border="0" cellpadding="10" cellspacing="0" class="text_block block-1" role="presentation" width="100%">
                                                                    <tr>
                                                                        <td class="pad">
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #555555;">
                                                                                    <p style="margin: 0; text-align: center;">Anda mendapatkan email ini karena anda ingin melakukan penyetelan ulang sandi Aplikasi SILK. Untuk melanjutkan proses silahkan klik tautan berikut :</p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table border="0" cellpadding="10" cellspacing="0" class="button_block block-2" role="presentation" width="100%">
                                                                    <tr>
                                                                        <td class="pad">
                                                                            <div align="center" class="alignment">
                                                                                @if (session('resent'))
                                                                                    <div class="alert alert-success" role="alert">
                                                                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                                                                    </div>
                                                                                @endif
                                                                                <a href="{{ url('/ubah-kata-sandi/'.$token) }}" style="text-decoration:none;display:inline-block;color:#ffffff;border-radius:4px;width:auto;padding:5px 20px;font-family:Arial, Helvetica, sans-serif;font-size:14px;text-align:center;" target="_blank"><img src="{{ URL::to('assets/images/Tombol_Tautan.png') }}"></img></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Row 3: Additional Info -->
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" width="600">
                                                    <tbody>
                                                        <tr>
                                                            <td class="column column-1" width="100%">
                                                                <table border="0" cellpadding="10" cellspacing="0" class="text_block block-1" role="presentation" width="100%">
                                                                    <tr>
                                                                        <td class="pad">
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #555555;">
                                                                                    <p style="margin: 0; text-align: center;">atau URL dibawah ini :</p>
                                                                                    <p style="margin: 0; text-align: center;"><a href="{{ url('/ubah-kata-sandi/'.$token) }}" style="text-decoration: underline; color: #a280ff;">{{ url('/ubah-kata-sandi/'.$token) }}</a></p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table><br><br>
                                                                <!-- Spacer -->
                                                                <div style="height:40px;font-size:1px;"> </div>
                                                                <!-- Image -->
                                                                <table border="0" cellpadding="0" cellspacing="0" class="image_block block-3" role="presentation" width="100%">
                                                                    <tr>
                                                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                            <div align="center" class="alignment">
                                                                                <div class="fullWidth" style="max-width: 570px;"><img alt="I'm an image" src="{{ URL::to('assets/images/Logo_RS_Email.png') }}" style="display: block; height: auto; border: 0; width: 100%;" title="I'm an image" width="570"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table><br><br>
                                                                <!-- Spacer -->
                                                                <div style="height:40px;font-size:1px;"> </div>
                                                                <!-- Additional Info -->
                                                                <table border="0" cellpadding="10" cellspacing="0" class="text_block block-5" role="presentation" width="100%">
                                                                    <tr>
                                                                        <td class="pad">
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #555555;">
                                                                                    <p style="margin: 0; font-size: 12px; text-align: center;">Jika tautan tidak berfungsi, harap akses alamat di atas menggunakan peramban web.<br>Jika anda tidak merasa meminta penyetelan ulang sandi, mungkin pengguna lain salah memasukkan email anda. Anda tidak perlu melakukan tindakan di atas dan bisa mengabaikan email ini dengan aman.</p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table><br><br>
                                                                <!-- Spacer -->
                                                                <div style="height:40px;font-size:1px;"> </div>
                                                                <table border="0" cellpadding="10" cellspacing="0" class="text_block block-6" role="presentation" width="100%">
                                                                    <tr>
                                                                        <td class="pad">
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #555555;">
                                                                                    <p style="margin: 0; font-size: 12px; text-align: right;">Hormat Kami,<br>Admin Developer - Aplikasi SILK</p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!-- Spacer -->
                                                                <div style="height:60px;font-size:1px;"> </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
           </div>
       </div>
   </div>
</div>