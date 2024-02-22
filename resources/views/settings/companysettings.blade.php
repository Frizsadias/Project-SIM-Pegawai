@extends('layouts.settings')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Pengaturan Perusahaan</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    <form action="{{ route('pengaturan-perusahaan-save') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" name="id" value="1">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Perusahaan <span class="text-danger">*</span></label>
                                    @if (!empty($companySettings->company_name))
                                    <input class="form-control" type="text" name="company_name" value="{{ $companySettings->company_name }}">
                                    @else
                                    <input class="form-control" type="text" name="company_name" value="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Narahubung</label>
                                    @if (!empty($companySettings->contact_person))
                                    <input type="text" class="form-control" name="contact_person" value="{{ $companySettings->contact_person }}">
                                    @else
                                    <input type="text" class="form-control" name="contact_person" value="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    @if (!empty($companySettings->address))
                                    <input type="text" class="form-control" name="address" value="{{ $companySettings->address }}">
                                    @else
                                    <input type="text" class="form-control" name="address" value="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Negara</label>
                                    @if (!empty($companySettings->country))
                                    <input type="text" class="form-control" name="country" value="{{ $companySettings->country }}">
                                    @else
                                    <input type="text" class="form-control" name="country" value="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Kota/Kabupaten</label>
                                    @if (!empty($companySettings->city))
                                        <input type="text" class="form-control" name="city" value="{{ $companySettings->city }}">
                                    @else
                                        <input type="text" class="form-control" name="city">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    @if (!empty($companySettings->state_province))
                                        <input type="text" class="form-control" name="state_province" value="{{ $companySettings->state_province }}">
                                    @else
                                        <input type="text" class="form-control" name="state_province">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    @if (!empty($companySettings->postal_code))
                                        <input type="text" class="form-control" name="postal_code" value="{{ $companySettings->postal_code }}">
                                    @else
                                        <input type="text" class="form-control" name="postal_code">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    @if (!empty($companySettings->email))
                                        <input type="email" class="form-control" name="email" value="{{ $companySettings->email }}">
                                    @else
                                        <input type="email" class="form-control" name="email">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    @if (!empty($companySettings->phone_number))
                                        <input type="tel" class="form-control" name="phone_number" value="{{ $companySettings->phone_number }}">
                                    @else
                                        <input type="tel" class="form-control" name="phone_number">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    @if (!empty($companySettings->mobile_number))
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="tel" class="form-control" id="c_mobile_number_value" name="mobile_number" value="{{ $companySettings->mobile_number }}">
                                    </div>
                                    <small id="error_message-1" class="text-danger2"></small>
                                    @else
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="tel" class="form-control" id="c_mobile_number_value" name="mobile_number" value="">
                                    </div>
                                    <small id="error_message-1" class="text-danger2"></small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    @if (!empty($companySettings->fax))
                                    <input type="text" class="form-control" name="fax" value="{{ $companySettings->fax }}">
                                    @else
                                    <input type="text" class="form-control" name="fax" value="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Alamat Website</label>
                                    @if (!empty($companySettings->website_url))
                                    <input type="text" class="form-control" name="website_url" value="{{ $companySettings->website_url }}">
                                    @else
                                    <input type="text" class="form-control" name="website_url" value="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <script>
        var toggleBtn = document.getElementById("toggle_btn");
        var logoText = document.querySelector(".logo-text");

        toggleBtn.addEventListener("click", function() {
            if (logoText.style.display === "none") {
                logoText.style.display = "inline-block";
            } else {
                logoText.style.display = "none";
            }
        });
    </script>

    <script>
        document.getElementById('c_mobile_number_value').addEventListener('input', function(event) {
            var inputValue = event.target.value;
            
            // Jika angka pertama adalah 0
            if (inputValue.charAt(0) === '0') {
                document.getElementById('error_message-1').innerHTML = 'Gunakan format yang benar. Contoh: 812345678';
            } else {
                document.getElementById('error_message-1').innerHTML = '';
            }
        });
    </script>
    <!-- /Page Wrapper -->
@endsection