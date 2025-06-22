@extends('layout.client')

@section('content')
<section class="section-contact padding-tb-100">
        <div class="container">
           
            <div class="lh-contact-touch" data-aos="fade-up" data-aos-duration="2000">
                <div class="row">
                @if (!empty($user))
                
                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card mt-n5">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                            @if ($user->avatar)
                                                <img class="rounded-circle avatar-xl img-thumbnail user-profile-imager object-fit-cover"
                                                    src="{{asset('storage/' . $user->avatar)}}"
                                                    alt="Avatar"/>
                                            @else
                                                <div class="bg-info-subtle rounded d-flex justify-content-center align-items-center fs-20"
                                                    style="width: 80px;height: 80px">
                                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>

                                        <h5 class="fs-16 mb-1"></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-0">Liên kết mạng xã hội </h5>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                <i class="ri-global-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="websiteInput" placeholder="www.facebook.com">
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-success">
                                                <i class="ri-dribbble-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="dribbleName" placeholder="Username">
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                <i class="ri-pinterest-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="pinterestName" placeholder="Username">
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i>Thông tin cá nhân 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form action="{{ route('profileUse.update', $user->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Họ và tên:</label>
                                                            <input type="text"
                                                                class="form-control  @error('name') is-invalid @enderror"
                                                                name="name" id="name" placeholder="Enter your name"
                                                                value="{{ old('name',$user->name ) }}">
                                                            @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="birth_date" class="form-label">Ngày sinh:</label>
                                                            <input type="date" name="birth_date"
                                                                class="form-control  @error('birth_date') is-invalid @enderror "
                                                                id="birth_date" placeholder="Enter your birth_date"
                                                                value="{{ old('birth_date',$user->birth_date ) }}">
                                                            @error('birth_date')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Số điện thoại:</label>
                                                            <input type="number"
                                                                class="form-control  @error('phone') is-invalid @enderror "
                                                                name="phone" id="phone" placeholder="Enter your phone number"
                                                                value="{{ old('phone',$user->phone ) }}">
                                                            @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email:</label>
                                                            <input type="email"
                                                                class="form-control  @error('email') is-invalid @enderror "
                                                                id="email" placeholder="Enter your email" name="email"
                                                                value="{{ old('email',$user->email ) }}" disabled>
                                                            @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="address" class="form-label">Địa chỉ:</label>
                                                            <input type="text"
                                                                class="form-control  @error('address') is-invalid @enderror "
                                                                placeholder="Enter your address" name="address"
                                                                id="address" value="{{ old('address', $user->address) }}">
                                                            @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="country"
                                                                class="form-label  @error('country') is-invalid @enderror">Thành phố:</label>
                                                            <input type="text" class="form-control" name="country"
                                                                id="country" placeholder="Enter your country"
                                                                value="{{ old('country', $user->country) }}"/>
                                                            @error('country')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>         
                                                    <div class="col-lg-6">
                                                        <div class="mb-3 pb-2">
                                                            <label class="form-label d-block">Giới tính:</label>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input @error('gender') is-invalid @enderror"
                                                                    type="radio"
                                                                    name="gender"
                                                                    id="gender_male"
                                                                    value="male"
                                                                    {{ old('gender',$user->gender) == 'male' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="gender_male">Nam</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input @error('gender') is-invalid @enderror"
                                                                    type="radio"
                                                                    name="gender"
                                                                    id="gender_female"
                                                                    value="female"
                                                                    {{ old('gender',$user->gender) == 'female' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="gender_female">Nữ</label>
                                                            </div>

                                                            @error('gender')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="avatar" class="form-label @error('avatar') is-invalid @enderror">Ảnh đại diện:</label>
                                                    
                                                            {{-- Upload ảnh mới --}}
                                                            <input type="file"
                                                                class="form-control @error('avatar') is-invalid @enderror"
                                                                name="avatar"
                                                                id="avatar"
                                                                accept="image/*">

                                                            @error('avatar')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-start">
                                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                    </div>
                 @endif
            </div>
            </div>
        </div>
    </section>
    
@endsection


