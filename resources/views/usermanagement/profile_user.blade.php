@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profil</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- /Page Header -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#">
                                            <img alt="" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic pro-overview tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ Session::get('name') }}</h3>
                                                {{-- <h6 class="text-muted">{{ Session::get('department') }}</h6> --}}
                                                {{-- <small class="text-muted">{{ Session::get('position') }}</small> --}}
                                                <div class="staff-id">ID Pegawai : {{ Session::get('user_id') }}</div>
                                                <div class="small doj text-muted">Tanggal Bergabung : {{ \Carbon\Carbon::parse(Session::get('join_date'))->translatedFormat('l, j F Y || h:i A') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">E-mail :</div>
                                                    <div class="text">
                                                        <a href="mailto:{{ Session::get('email') }}">{{ Session::get('email') }}</a>
                                                    </div>
                                                </li>
                                                @if (!empty($information))
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Tanggal Lahir :</div>
                                                            <div class="text">{{ date('d F Y', strtotime($information->tgl_lahir)) }}</div>
                                                        @else
                                                            <div class="title">Tanggal Lahir :</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Alamat :</div>
                                                            <div class="text">{{ $information->alamat }}</div>
                                                        @else
                                                            <div class="title">Alamat :</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Jenis Kelamin :</div>
                                                            <div class="text">{{ $information->jk }}</div>
                                                        @else
                                                            <div class="title">Jenis Kelamin :</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $propeg->user_id)
                                                            <div class="title">Agama :</div>
                                                            <div class="text">{{ $propeg->agama }}</div>
                                                        @else
                                                            <div class="title">Agama :</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $propeg->user_id)
                                                            <div class="title">Pendidikan Terakhir :</div>
                                                            <div class="text">{{ $propeg->pendidikan_terakhir }}</div>
                                                        @else
                                                            <div class="title">Pendidikan Terakhir :</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $posjab->user_id)
                                                            <div class="title">Jabatan :</div>
                                                            <div class="text">{{ $posjab->jabatan }}</div>
                                                        @else
                                                            <div class="title">Jabatan :</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                @else
                                                    <li>
                                                        <div class="title">Tanggal Lahir :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Alamat :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Jenis Kelamin :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Agama :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Pendidikan Terakhir :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Jabatan :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit">
                                    <a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->
        @if (!empty($information))
            <!-- Profile Modal -->
            <div id="profile_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profil Informasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/information/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="image" name="images">
                                                <input type="hidden" name="hidden_image" id="e_image" value="{{ Auth::user()->avatar }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate" value="{{ $information->tgl_lahir }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $information->alamat }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="select" id="jk" name="jk">
                                                        <option value="Laki-Laki" {{ $information->jk === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                        <option value="Perempuan" {{ $information->jk === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="agama">Agama</label>
                                                    <select class="select" name="agama" id="agama">
                                                        <option value="" disabled selected>--- Pilih Agama ---</option>
                                                        @foreach($agamaOptions as $id => $namaAgama)
                                                            <option value="{{ $id }}" {{ $id == $propeg->agama ? 'selected' : '' }}>{{ $namaAgama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pendidikan Terakhir</label>
                                                    <select class="select" name="pendidikan_terakhir" id="pendidikan_terakhir">
                                                        <option value="" disabled selected>--- Pilih Pendidikan Terakhir ---</option>
                                                        @foreach($tingkatpendidikanOptions as $id => $namaTingkatPendidikan)
                                                            <option value="{{ $id }}" {{ $id == $propeg->pendidikan_terakhir ? 'selected' : '' }}>{{ $namaTingkatPendidikan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $posjab->jabatan }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Perbaharui</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Profile Modal -->
        @else
            <!-- Profile Modal -->
            <div id="profile_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profil Informasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/information/save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="upload" name="upload">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="select form-control" id="jk" name="jk">
                                                        <option selected disabled> --Pilih Jenis Kelamin --</option>
                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="agama">Agama</label>
                                                    <select class="select" name="agama" id="agama">
                                                        <option value="" disabled selected>--- Pilih Agama ---</option>
                                                        @foreach($agamaOptions as $id => $namaAgama)
                                                            <option value="{{ $id }}" {{ $id == $propeg->agama ? 'selected' : '' }}>{{ $namaAgama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pendidikan Terakhir</label>
                                                    <select class="select" name="pendidikan_terakhir" id="pendidikan_terakhir">
                                                        <option value="" disabled selected>--- Pilih Pendidikan Terakhir ---</option>
                                                        @foreach($tingkatpendidikanOptions as $id => $namaTingkatPendidikan)
                                                            <option value="{{ $id }}" {{ $id == $propeg->pendidikan_terakhir ? 'selected' : '' }}>{{ $namaTingkatPendidikan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input type="text" class="form-control" id="jabatan" name="jabatan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Perbaharui</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Profile Modal -->
        @endif
        <!-- /Page Content -->
    </div>
@section('script')
    <script>
        $('#validation').validate({
            rules: {
                name_primary: 'required',
                relationship_primary: 'required',
                phone_primary: 'required',
                phone_2_primary: 'required',
                name_secondary: 'required',
                relationship_secondary: 'required',
                phone_secondary: 'required',
                phone_2_secondary: 'required',
            },
            messages: {
                name_primary: 'Please input name primary',
                relationship_primary: 'Please input relationship primary',
                phone_primary: 'Please input phone primary',
                phone_2_primary: 'Please input phone 2 primary',
                name_secondary: 'Please input name secondary',
                relationship_secondary: 'Please input relationship secondary',
                phone_secondaryr: 'Please input phone secondary',
                phone_2_secondary: 'Please input phone 2 secondary',
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
@endsection
