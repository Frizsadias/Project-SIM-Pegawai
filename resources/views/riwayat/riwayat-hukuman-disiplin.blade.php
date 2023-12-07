@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"> Riwayat Hukuman Disiplin</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Angka Kredit</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_angka_hukuman"><i
                                class="fa fa-plus"></i> Tambah Riwayat Angka Kredit</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('riwayat/hukumandisiplin/cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="kategori_hukuman" name="kategori_hukuman">
                                <option disabled selected value="">-- Pilih Kategori Hukuman --</option>
                                <option value="Penetapan">Penetapan</option>
                                <option value="Pengaktifan Kembali">Pengaktifan Kembali</option>
                            </select>
                            <label class="focus-label">Kategori Hukuman</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="tingkat_hukuman" name="tingkat_hukuman">
                                <option disabled selected value="">-- Pilih Tingkat Hukuman --</option>
                                <option value="Berat">Berat</option>
                                <option value="Ringat">Ringan</option>
                                <option value="Sedang">Sedang</option>
                            </select>
                            <label class="focus-label">Tingkat Hukuman</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="jenis_hukuman" name="jenis_hukuman">
                                <option disabled selected value="">-- Pilih Jenis Hukuman --</option>
                                <option value="Pembebasan Dari Jabatan">Pembebasan Dari Jabatan</option>
                                <option value="Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri">Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri</option>
                                <option value="Pemberhentian Tidak Dengan Hormat Sebagai PNS">Pemberhentian Tidak Dengan Hormat Sebagai PNS</option>
                            </select>
                            <label class="focus-label">Jenis Tingkat Hukuman</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                    </div>
                </div>
            </form>
            <!-- Search Filter -->

            {{-- message --}}
            {!! Toastr::message() !!}
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori Hukuman Disiplin</th>
                                    <th>Tingkat Hukuman</th>
                                    <th>Jenis Tingkat Hukuman</th>
                                    <th>Nomor SK Hukuman</th>
                                    <th>Tanggal SK Hukuman</th>
                                    <th>Nomor Peraturan</th>
                                    <th>Alasan Hukuman</th>
                                    <th>Masa Hukuman Tahun</th>
                                    <th>Masa Hukuman Bulan</th>
                                    <th>TMT Hukuman</th>
                                    <th>Keterangan</th>
                                    <th>Dokumen Hukuman Disiplin</th>
                                    <th>Dokumen SK Pengaktifan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatHD as $sqlHD => $result_hukuman_disiplin)
                                    <tr>
                                        <td><center>{{ ++$sqlHD }}</center></td>
                                        <td hidden class="id"><center>{{ $result_hukuman_disiplin->id }}</center></td>
                                        <td class="kategori_hukuman"><center>{{ $result_hukuman_disiplin->kategori_hukuman }}</center></td>
                                        <td class="tingkat_hukuman"><center>{{ $result_hukuman_disiplin->tingkat_hukuman }}</center></td>
                                        <td class="jenis_hukuman"><center>{{ $result_hukuman_disiplin->jenis_hukuman }}</center></td>
                                        <td class="no_sk_hukuman"><center>{{ $result_hukuman_disiplin->no_sk_hukuman }}</center></td>
                                        <td class="tanggal_sk_hukuman"><center>{{ $result_hukuman_disiplin->tanggal_sk_hukuman }}</center></td>
                                        <td class="no_peraturan"><center>{{ $result_hukuman_disiplin->no_peraturan }}</center></td>
                                        <td class="alasan"><center>{{ $result_hukuman_disiplin->alasan }}</center></td>
                                        <td class="masa_hukuman_tahun"><center>{{ $result_hukuman_disiplin->masa_hukuman_tahun }}</center></td>
                                        <td class="masa_hukuman_bulan"><center>{{ $result_hukuman_disiplin->masa_hukuman_bulan }}</center></td>
                                        <td class="tmt_hukuman"><center>{{ $result_hukuman_disiplin->tmt_hukuman }}</center></td>
                                        <td class="keterangan"><center>{{ $result_hukuman_disiplin->keterangan }}</center></td>
                                        <td class="dokumen_sk_hukuman"><center>
                                            <a href="{{ asset('assets/DokumenSKHukuman/' . $result_hukuman_disiplin->dokumen_sk_hukuman) }}" target="_blank">
                                                @if (pathinfo($result_hukuman_disiplin->dokumen_sk_hukuman, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_sk_hukuman">{{ $result_hukuman_disiplin->dokumen_sk_hukuman }}</td>
                                            </a></center></td>
                                        <td class="dokumen_sk_pengaktifan"><center>
                                            <a href="{{ asset('assets/DokumenSKPengaktifan/' . $result_hukuman_disiplin->dokumen_sk_pengaktifan) }}" target="_blank">
                                                @if (pathinfo($result_hukuman_disiplin->dokumen_sk_pengaktifan, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_sk_pengaktifan">{{ $result_hukuman_disiplin->dokumen_sk_pengaktifan }}</td>
                                            </a></center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_riwayat_hukuman" href="#"
                                                        data-toggle="modal" data-target="#edit_riwayat_hukuman"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_riwayat_hukuman" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_hukuman"><i
                                                            class="fa fa-trash-o m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Tambah Riwayat Hukuman Disiplin Modal -->
        <div id="add_riwayat_angka_hukuman" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Hukuman Disiplin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/hukumandisiplin/tambah-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="user_id"
                                            value="{{ Auth::user()->user_id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kategori Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <select class="select form-control" name="kategori_hukuman" required>
                                            <option disabled selected value="">-- Pilih Kategori Hukuman --</option>
                                            <option value="Penetapan">Penetapan</option>
                                            <option value="Pengaktifan Kembali">Pengaktifan Kembali</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <select class="select form-control" name="tingkat_hukuman" required>
                                            <option disabled selected value="">-- Pilih Tingkat Hukuman --</option>
                                            <option value="Berat">Berat</option>
                                            <option value="Ringan">Ringan</option>
                                            <option value="Sedang">Sedang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <select class="select form-control" name="jenis_hukuman" required>
                                            <option disabled selected value="">-- Pilih Jenis Hukuman --</option>
                                            <option value="Pembebasan Dari Jabatan">Pembebasan Dari Jabatan</option>
                                            <option value="Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri">Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri</option>
                                            <option value="Pemberhentian Tidak Dengan Hormat Sebagai PNS">Pemberhentian Tidak Dengan Hormat Sebagai PNS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_sk_hukuman" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Peraturan</label>
                                        <input class="form-control" type="text" name="no_peraturan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alasan</label>
                                        <select class="select form-control" name="alasan">
                                            <option disabled selected value="">-- Pilih Alasan --</option>
                                            <option value="Tidak Mengucapkan Sumpah/Janji PNS">Tidak Mengucapkan Sumpah/Janji PNS</option>
                                            <option value="Tidak Mengucapkan Sumpah/Janji Jabatan">Tidak Mengucapkan Sumpah/Janji Jabatan</option>
                                            <option value="Tidak Mentaati Segala Ketentuan Peraturan Perundang-undangan">Tidak Mentaati Segala Ketentuan Peraturan Perundang-undangan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_sk_hukuman" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Hukuman (Tahun)</label>
                                        <input class="form-control" type="text" name="masa_hukuman_tahun">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tmt_hukuman" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Hukuman (Bulan)</label>
                                        <input class="form-control" type="text" name="masa_hukuman_bulan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="keterangan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="dokumen_sk_hukuman" required>
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK Pengaktifan</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="dokumen_sk_pengaktifan">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Tambah Riwayat Hukuman Disiplin Modal -->

        <!-- Edit Riwayat Hukuman Disiplin Modal -->
        <div id="edit_riwayat_hukuman" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Hukuman Disiplin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/hukumandisiplin/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kategori Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <select class="form-control" name="kategori_hukuman" id="e_kategori_hukuman" required>
                                            <option disabled selected value="">-- Pilih Kategori Hukuman --</option>
                                            <option value="Penetapan">Penetapan</option>
                                            <option value="Pengaktifan Kembali">Pengaktifan Kembali</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <select class="form-control" name="tingkat_hukuman" id="e_tingkat_hukuman" required>
                                            <option disabled selected value="">-- Pilih Tingkat Hukuman --</option>
                                            <option value="Berat">Berat</option>
                                            <option value="Ringan">Ringan</option>
                                            <option value="Sedang">Sedang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <select class="form-control" name="jenis_hukuman" id="e_jenis_hukuman" required>
                                            <option disabled selected value="">-- Pilih Jenis Hukuman --</option>
                                            <option value="Pembebasan Dari Jabatan">Pembebasan Dari Jabatan</option>
                                            <option value="Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri">Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri</option>
                                            <option value="Pemberhentian Tidak Dengan Hormat Sebagai PNS">Pemberhentian Tidak Dengan Hormat Sebagai PNS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_sk_hukuman" id="e_no_sk_hukuman" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Peraturan</label>
                                        <input class="form-control" type="text" name="no_peraturan" id="e_no_peraturan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alasan</label>
                                        <select class="form-control" name="alasan" id="e_alasan">
                                            <option disabled selected value="">-- Pilih Alasan --</option>
                                            <option value="Tidak Mengucapkan Sumpah/Janji PNS">Tidak Mengucapkan Sumpah/Janji PNS</option>
                                            <option value="Tidak Mengucapkan Sumpah/Janji Jabatan">Tidak Mengucapkan Sumpah/Janji Jabatan</option>
                                            <option value="Tidak Mentaati Segala Ketentuan Peraturan Perundang-undangan">Tidak Mentaati Segala Ketentuan Peraturan Perundang-undangan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_sk_hukuman" id="e_tanggal_sk_hukuman" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Hukuman (Tahun)</label>
                                        <input class="form-control" type="text" name="masa_hukuman_tahun" id="e_masa_hukuman_tahun">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tmt_hukuman" id="e_tmt_hukuman" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Hukuman (Bulan)</label>
                                        <input class="form-control" type="text" name="masa_hukuman_bulan" id="e_masa_hukuman_bulan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="keterangan" id="e_keterangan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK Hukuman</label>
                                        <small class="text-danger">*</small>
                                        <input type="file" class="form-control" id="dokumen_sk_hukuman" name="dokumen_sk_hukuman">
                                        <input type="hidden" name="hidden_dokumen_sk_hukuman" id="e_dokumen_sk_hukuman" value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK Pengaktifan</label>
                                        <small class="text-danger">*</small>
                                        <input type="file" class="form-control" id="dokumen_sk_pengaktifan" name="dokumen_sk_pengaktifan">
                                        <input type="hidden" name="hidden_dokumen_sk_pengaktifan" id="e_dokumen_sk_pengaktifan" value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Riwayat Hukuman Disiplin Modal -->

        <!-- Delete Riwayat Hukuman Disiplin Modal -->
        <div class="modal custom-modal fade" id="delete_riwayat_hukuman" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Angka Kredit</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/hukumandisiplin/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_sk_hukuman" class="d_dokumen_sk_hukuman" value="">
                                <input type="hidden" name="dokumen_sk_pengaktifan" class="d_dokumen_sk_pengaktifan" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn btn-primary continue-btn submit-btn">Hapus</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                            class="btn btn-primary cancel-btn">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Riwayat Hukuman Disiplin Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/hukumandisiplin.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(".theSelect").select2();
        </script>

        <script>
            history.pushState({}, "", '/riwayat/hukuman/disiplin');
        </script>
        
    @endsection
@endsection
