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
                                            <img alt="" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}"
                                                alt="{{ Auth::user()->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic pro-overview tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ Session::get('name') }}</h3>
                                                <h6 class="text-muted">{{ Session::get('department') }}</h6>
                                                <small class="text-muted">{{ Session::get('position') }}</small>
                                                <div class="staff-id">User ID : {{ Session::get('user_id') }}</div>
                                                <div class="small doj text-muted">Tanggal Bergabung :
                                                    {{ Session::get('join_date') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Alamat E-mail:</div>
                                                    <div class="text"><a href="">{{ Session::get('email') }}</a>
                                                    </div>
                                                </li>
                                                @if (!empty($information))
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Tanggal Lahir:</div>
                                                            <div class="text">
                                                                {{ date('d F, Y', strtotime($information->birth_date)) }}
                                                            </div>
                                                        @else
                                                            <div class="title">Tanggal Lahir:</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Alamat:</div>
                                                            <div class="text">{{ $information->address }}</div>
                                                        @else
                                                            <div class="title">Alamat:</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Jenis Kelamin:</div>
                                                            <div class="text">{{ $information->gender }}</div>
                                                        @else
                                                            <div class="title">Jenis Kelamin:</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                @else
                                                    <li>
                                                        <div class="title">Tanggal Lahir:</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Alamat:</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Jenis Kelamin:</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon"
                                        href="#"><i class="fa fa-pencil"></i></a></div>
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
                            <form action="{{ route('profile/information/save') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block"
                                                src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}"
                                                alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="image" name="images">
                                                <input type="hidden" name="hidden_image" id="e_image"
                                                    value="{{ Auth::user()->avatar }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id"
                                                        name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email"
                                                        name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text"
                                                            id="birthDate" name="birthDate"
                                                            value="{{ $information->birth_date }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="select form-control" id="gender" name="gender">
                                                        <option value="{{ $information->gender }}"
                                                            {{ $information->gender == $information->gender ? 'selected' : '' }}>
                                                            {{ $information->gender }} </option>
                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $information->address }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Negara</label>
                                            <input type="text" class="form-control" id="" name="country"
                                                value="{{ $information->country }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" class="form-control" id="pin_code" name="pin_code"
                                                value="{{ $information->pin_code }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="text" class="form-control" id="phone_number"
                                                name="phone_number" value="{{ $information->phone_number }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jabatan <span class="text-danger">*</span></label>
                                            <select class="select" id="department" name="department">
                                                <option value="{{ $information->department }}"
                                                    {{ $information->department == $information->department ? 'selected' : '' }}>
                                                    {{ $information->department }} </option>
                                                <option value="Web Development">Web Development</option>
                                                <option value="IT Management">IT Management</option>
                                                <option value="Marketing">Marketing</option>
                                            </select>
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
            <!-- /Profile Modal -->
        @else
            <!-- Profile Modal -->
            <div id="profile_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profile Information</h5>
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
                                            <img class="inline-block"
                                                src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}"
                                                alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="upload" name="upload">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id"
                                                        name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email"
                                                        name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Birth Date</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text"
                                                            id="birthDate" name="birthDate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="select form-control" id="gender" name="gender">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" id="state" name="state">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" id="" name="country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pin Code</label>
                                            <input type="text" class="form-control" id="pin_code" name="pin_code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" id="phoneNumber"
                                                name="phone_number">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department <span class="text-danger">*</span></label>
                                            <select class="select" id="department" name="department">
                                                <option selected disabled>Select Department</option>
                                                <option value="Web Development">Web Development</option>
                                                <option value="IT Management">IT Management</option>
                                                <option value="Marketing">Marketing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Designation <span class="text-danger">*</span></label>

                                            <select class="select" id="" name="designation">
                                                <option selected disabled>Select Designation</option>
                                                <option value="Web Designer">Web Designer</option>
                                                <option value="Web Developer">Web Developer</option>
                                                <option value="Android Developer">Android Developer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Reports To <span class="text-danger">*</span></label>
                                            <select class="select" id="" name="reports_to">
                                                <option selected disabled>-- select --</option>
                                                @foreach ($user as $users)
                                                    <option value="{{ $users->name }}">{{ $users->name }}</option>
                                                @endforeach
                                            </select>
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
            <!-- /Profile Modal -->
        @endif

        @if (!empty($userInformation))
            <!-- Personal Info Modal -->
            <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Personal Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user/information/save') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" name="user_id"
                                    value="{{ Session::get('user_id') }}" readonly>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport No</label>
                                            <input type="text"
                                                class="form-control @error('passport_no') is-invalid @enderror"
                                                name="passport_no" value="{{ $userInformation->passport_no }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport Expiry Date</label>
                                            <div class="cal-icon">
                                                <input
                                                    class="form-control datetimepicker @error('passport_expiry_date') is-invalid @enderror"
                                                    type="text" name="passport_expiry_date"
                                                    value="{{ $userInformation->passport_expiry_date }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tel</label>
                                            <input class="form-control @error('tel') is-invalid @enderror" type="text"
                                                name="tel" value="{{ $userInformation->tel }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nationality <span class="text-danger">*</span></label>
                                            <input class="form-control @error('nationality') is-invalid @enderror"
                                                type="text" name="nationality"
                                                value="{{ $userInformation->nationality }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <div class="form-group">
                                                <input class="form-control @error('religion') is-invalid @enderror"
                                                    type="text" name="religion"
                                                    value="{{ $userInformation->religion }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marital status <span class="text-danger">*</span></label>
                                            <select
                                                class="select form-control @error('marital_status') is-invalid @enderror"
                                                name="marital_status">
                                                <option value="{{ $userInformation->marital_status }}"
                                                    {{ $userInformation->marital_status == $userInformation->marital_status ? 'selected' : '' }}>
                                                    {{ $userInformation->marital_status }} </option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employment of spouse</label>
                                            <input class="form-control @error('employment_of_spouse') is-invalid @enderror"
                                                type="text" name="employment_of_spouse"
                                                value="{{ $userInformation->employment_of_spouse }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. of children </label>
                                            <input class="form-control @error('children') is-invalid @enderror"
                                                type="text" name="children" value="{{ $userInformation->children }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Personal Info Modal -->
        @else
            <!-- Personal Info Modal -->
            <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Personal Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user/information/save') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" name="user_id"
                                    value="{{ Session::get('user_id') }}" readonly>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport No</label>
                                            <input type="text"
                                                class="form-control @error('passport_no') is-invalid @enderror"
                                                name="passport_no">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport Expiry Date</label>
                                            <div class="cal-icon">
                                                <input
                                                    class="form-control datetimepicker @error('passport_expiry_date') is-invalid @enderror"
                                                    type="text" name="passport_expiry_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tel</label>
                                            <input class="form-control @error('tel') is-invalid @enderror" type="text"
                                                name="tel">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nationality <span class="text-danger">*</span></label>
                                            <input class="form-control @error('nationality') is-invalid @enderror"
                                                type="text" name="nationality">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <div class="form-group">
                                                <input class="form-control @error('religion') is-invalid @enderror"
                                                    type="text" name="religion">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marital status <span class="text-danger">*</span></label>
                                            <select
                                                class="select form-control @error('marital_status') is-invalid @enderror"
                                                name="marital_status">
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employment of spouse</label>
                                            <input
                                                class="form-control @error('employment_of_spouse') is-invalid @enderror"
                                                type="text" name="employment_of_spouse">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. of children </label>
                                            <input class="form-control @error('children') is-invalid @enderror"
                                                type="text" name="children">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Personal Info Modal -->
        @endif

        <!-- Family Info Modal -->
        <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Family Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Family Member <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Family Info Modal -->

        <!-- Emergency Contact Modal -->
        <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="validation" action="{{ route('user/profile/emergency/contact/save') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id"
                                value="{{ Session::get('user_id') }}">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Primary Contact</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                @if (!empty($emergencyContact->name_primary))
                                                    <input type="text" class="form-control" name="name_primary"
                                                        value="{{ $emergencyContact->name_primary }}">
                                                @else
                                                    <input type="text" class="form-control" name="name_primary">
                                                @endif
                                                </li>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Relationship <span class="text-danger">*</span></label>
                                                @if (!empty($emergencyContact->relationship_primary))
                                                    <input type="text" class="form-control"
                                                        name="relationship_primary"
                                                        value="{{ $emergencyContact->relationship_primary }}">
                                                @else
                                                    <input type="text" class="form-control"
                                                        name="relationship_primary">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                @if (!empty($emergencyContact->phone_primary))
                                                    <input type="text" class="form-control" name="phone_primary"
                                                        value="{{ $emergencyContact->phone_primary }}">
                                                @else
                                                    <input type="text" class="form-control" name="phone_primary">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone 2</label>
                                                @if (!empty($emergencyContact->phone_2_primary))
                                                    <input type="text" class="form-control" name="phone_2_primary"
                                                        value="{{ $emergencyContact->phone_2_primary }}">
                                                @else
                                                    <input type="text" class="form-control" name="phone_2_primary">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Secondary Contact</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                @if (!empty($emergencyContact->name_secondary))
                                                    <input type="text" class="form-control" name="name_secondary"
                                                        value="{{ $emergencyContact->name_secondary }}">
                                                @else
                                                    <input type="text" class="form-control" name="name_secondary">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Relationship <span class="text-danger">*</span></label>
                                                @if (!empty($emergencyContact->relationship_secondary))
                                                    <input type="text" class="form-control"
                                                        name="relationship_secondary"
                                                        value="{{ $emergencyContact->relationship_secondary }}">
                                                @else
                                                    <input type="text" class="form-control"
                                                        name="relationship_secondary">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                @if (!empty($emergencyContact->phone_secondary))
                                                    <input type="text" class="form-control" name="phone_secondary"
                                                        value="{{ $emergencyContact->phone_secondary }}">
                                                @else
                                                    <input type="text" class="form-control" name="phone_secondary">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone 2</label>
                                                @if (!empty($emergencyContact->phone_2_secondary))
                                                    <input type="text" class="form-control" name="phone_2_secondary"
                                                        value="{{ $emergencyContact->phone_2_secondary }}">
                                                @else
                                                    <input type="text" class="form-control" name="phone_2_secondary">
                                                @endif
                                            </div>
                                        </div>
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
        <!-- /Emergency Contact Modal -->

        <!-- Education Modal -->
        <div id="education_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Education Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Oxford University"
                                                        class="form-control floating">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Computer Science"
                                                        class="form-control floating">
                                                    <label class="focus-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="01/06/2002"
                                                            class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="31/05/2006"
                                                            class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="BE Computer Science"
                                                        class="form-control floating">
                                                    <label class="focus-label">Degree</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Grade A" class="form-control floating">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Oxford University"
                                                        class="form-control floating">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Computer Science"
                                                        class="form-control floating">
                                                    <label class="focus-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="01/06/2002"
                                                            class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="31/05/2006"
                                                            class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="BE Computer Science"
                                                        class="form-control floating">
                                                    <label class="focus-label">Degree</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Grade A" class="form-control floating">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Education Modal -->

        <!-- Experience Modal -->
        <div id="experience_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Experience Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating"
                                                        value="Digital Devlopment Inc">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating"
                                                        value="United States">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating"
                                                        value="Web Developer">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker"
                                                            value="01/07/2007">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker"
                                                            value="08/06/2018">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating"
                                                        value="Digital Devlopment Inc">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating"
                                                        value="United States">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating"
                                                        value="Web Developer">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker"
                                                            value="01/07/2007">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker"
                                                            value="08/06/2018">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Experience Modal -->

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
