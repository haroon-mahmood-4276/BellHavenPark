@extends('layout.layout')

@section('title', 'App Settings')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">App Settings</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">App Settings</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content-body">
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-row">
                        <!-- general -->
                        <li class="nav-item">
                            <a class="nav-link active" id="account-pill-general" data-bs-toggle="pill"
                                href="#account-vertical-general" aria-expanded="true">
                                <i data-feather="user" class="font-medium-3 me-1"></i>
                                <span class="fw-bold">General</span>
                            </a>
                        </li>
                        {{-- <!-- change password --> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" id="account-pill-password" data-bs-toggle="pill" href="#account-vertical-password" aria-expanded="false"> --}}
                        {{-- <i data-feather="lock" class="font-medium-3 me-1"></i> --}}
                        {{-- <span class="fw-bold">Change Password</span> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        {{-- <!-- information --> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" id="account-pill-info" data-bs-toggle="pill" href="#account-vertical-info" aria-expanded="false"> --}}
                        {{-- <i data-feather="info" class="font-medium-3 me-1"></i> --}}
                        {{-- <span class="fw-bold">Information</span> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        {{-- <!-- social --> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" id="account-pill-social" data-bs-toggle="pill" href="#account-vertical-social" aria-expanded="false"> --}}
                        {{-- <i data-feather="link" class="font-medium-3 me-1"></i> --}}
                        {{-- <span class="fw-bold">Social</span> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        {{-- <!-- notification --> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" id="account-pill-notifications" data-bs-toggle="pill" href="#account-vertical-notifications" aria-expanded="false"> --}}
                        {{-- <i data-feather="bell" class="font-medium-3 me-1"></i> --}}
                        {{-- <span class="fw-bold">Notifications</span> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                    </ul>
                </div>
                <!--/ left menu section -->

                <!-- right content section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- general tab -->
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                    aria-labelledby="account-pill-general" aria-expanded="true">
                                    <!-- header section -->
                                    {{-- <div class="d-flex"> --}}
                                    {{-- <a href="#" class="me-25"> --}}
                                    {{-- <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" id="account-upload-img" class="rounded me-50" alt="profile image" height="80" width="80" /> --}}
                                    {{-- </a> --}}
                                    {{-- <!-- upload and reset button --> --}}
                                    {{-- <div class="mt-75 ms-1"> --}}
                                    {{-- <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label> --}}
                                    {{-- <input type="file" id="account-upload" hidden accept="image/*" /> --}}
                                    {{-- <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button> --}}
                                    {{-- <p>Allowed JPG, GIF or PNG. Max size of 800kB</p> --}}
                                    {{-- </div> --}}
                                    {{-- <!--/ upload and reset button --> --}}
                                    {{-- </div> --}}
                                    <!--/ header section -->
                                    <!-- form -->
                                    <form class="validate-form mt-2" action="{{ route('settings.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-1">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <div class="mb-1">
                                                    <label class="form-label" style="font-size: 15px"
                                                        for="site_name">Site
                                                        Name *</label>
                                                    <div class="input-group input-group-merge mb-1">
                                                        <span
                                                            class="input-group-text @error('site_name') border-danger @enderror">
                                                            <i class="@error('site_name') text-danger @enderror"
                                                                data-feather="type"></i>
                                                        </span>
                                                        <input type="text" id="site_name"
                                                            class="form-control form-control-lg @error('site_name') is-invalid border-top-danger border-bottom-danger border-end-danger text-danger @enderror"
                                                            name="site_name" placeholder="Site Name"
                                                            value="{{ getSettings('site_name') }}" />
                                                    </div>
                                                    @error('site_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="reset" class="btn btn-relief-outline-danger me-1">
                                                    <i data-feather='x-circle' class="me-25"></i>
                                                    <span>Reset</span>
                                                </button>
                                                <button type="submit" class="btn btn-relief-outline-primary">
                                                    <i data-feather='check-circle' class="me-25"></i>
                                                    <span>Save</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->
                                </div>
                                <!--/ general tab -->

                                {{-- <!-- change password --> --}}
                                {{-- <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false"> --}}
                                {{-- <!-- form --> --}}
                                {{-- <form class="validate-form"> --}}
                                {{-- <div class="row"> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-old-password">Old Password</label> --}}
                                {{-- <div class="input-group form-password-toggle input-group-merge"> --}}
                                {{-- <input type="password" class="form-control" id="account-old-password" name="password" placeholder="Old Password" /> --}}
                                {{-- <div class="input-group-text cursor-pointer"> --}}
                                {{-- <i data-feather="eye"></i> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="row"> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-new-password">New Password</label> --}}
                                {{-- <div class="input-group form-password-toggle input-group-merge"> --}}
                                {{-- <input type="password" id="account-new-password" name="new-password" class="form-control" placeholder="New Password" /> --}}
                                {{-- <div class="input-group-text cursor-pointer"> --}}
                                {{-- <i data-feather="eye"></i> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-retype-new-password">Retype New Password</label> --}}
                                {{-- <div class="input-group form-password-toggle input-group-merge"> --}}
                                {{-- <input type="password" class="form-control" id="account-retype-new-password" name="confirm-new-password" placeholder="New Password" /> --}}
                                {{-- <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12"> --}}
                                {{-- <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button> --}}
                                {{-- <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </form> --}}
                                {{-- <!--/ form --> --}}
                                {{-- </div> --}}
                                {{-- <!--/ change password --> --}}

                                {{-- <!-- information --> --}}
                                {{-- <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false"> --}}
                                {{-- <!-- form --> --}}
                                {{-- <form class="validate-form"> --}}
                                {{-- <div class="row"> --}}
                                {{-- <div class="col-12"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="accountTextarea">Bio</label> --}}
                                {{-- <textarea class="form-control" id="accountTextarea" rows="4" placeholder="Your Bio data here..."></textarea> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-birth-date">Birth date</label> --}}
                                {{-- <input type="text" class="form-control flatpickr" placeholder="Birth date" id="account-birth-date" name="dob" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="accountSelect">Country</label> --}}
                                {{-- <select class="form-select" id="accountSelect"> --}}
                                {{-- <option>USA</option> --}}
                                {{-- <option>India</option> --}}
                                {{-- <option>Canada</option> --}}
                                {{-- </select> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-website">Website</label> --}}
                                {{-- <input type="text" class="form-control" name="website" id="account-website" placeholder="Website address" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-phone">Phone</label> --}}
                                {{-- <input type="text" class="form-control" id="account-phone" placeholder="Phone number" value="(+656) 254 2568" name="phone" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12"> --}}
                                {{-- <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button> --}}
                                {{-- <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </form> --}}
                                {{-- <!--/ form --> --}}
                                {{-- </div> --}}
                                {{-- <!--/ information --> --}}

                                {{-- <!-- social --> --}}
                                {{-- <div class="tab-pane fade" id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false"> --}}
                                {{-- <!-- form --> --}}
                                {{-- <form class="validate-form"> --}}
                                {{-- <div class="row"> --}}
                                {{-- <!-- social header --> --}}
                                {{-- <div class="col-12"> --}}
                                {{-- <div class="d-flex align-items-center mb-2"> --}}
                                {{-- <i data-feather="link" class="font-medium-3"></i> --}}
                                {{-- <h4 class="mb-0 ms-75">Social Links</h4> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <!-- twitter link input --> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-twitter">Twitter</label> --}}
                                {{-- <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <!-- facebook link input --> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-facebook">Facebook</label> --}}
                                {{-- <input type="text" id="account-facebook" class="form-control" placeholder="Add link" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <!-- google plus input --> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-google">Google+</label> --}}
                                {{-- <input type="text" id="account-google" class="form-control" placeholder="Add link" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <!-- linkedin link input --> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-linkedin">LinkedIn</label> --}}
                                {{-- <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <!-- instagram link input --> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-instagram">Instagram</label> --}}
                                {{-- <input type="text" id="account-instagram" class="form-control" placeholder="Add link" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <!-- Quora link input --> --}}
                                {{-- <div class="col-12 col-sm-6"> --}}
                                {{-- <div class="mb-1"> --}}
                                {{-- <label class="form-label" for="account-quora">Quora</label> --}}
                                {{-- <input type="text" id="account-quora" class="form-control" placeholder="Add link" /> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}

                                {{-- <!-- divider --> --}}
                                {{-- <div class="col-12"> --}}
                                {{-- <hr class="my-2" /> --}}
                                {{-- </div> --}}

                                {{-- <div class="col-12 mt-1"> --}}
                                {{-- <!-- profile connection header --> --}}
                                {{-- <div class="d-flex align-items-center mb-3"> --}}
                                {{-- <i data-feather="user" class="font-medium-3"></i> --}}
                                {{-- <h4 class="mb-0 ms-75">Profile Connections</h4> --}}
                                {{-- </div> --}}

                                {{-- <div class="row"> --}}
                                {{-- <!-- twitter user --> --}}
                                {{-- <div class="col-6 col-md-3 text-center mb-1"> --}}
                                {{-- <p class="fw-bold">Your Twitter</p> --}}
                                {{-- <div class="avatar mb-1"> --}}
                                {{-- <span class="avatar-content"> --}}
                                {{-- <img src="../../../app-assets/images/avatars/11-small.png" alt="avatar img" width="40" height="40" /> --}}
                                {{-- </span> --}}
                                {{-- </div> --}}
                                {{-- <p class="mb-0">@johndoe</p> --}}
                                {{-- <a href="#">Disconnect</a> --}}
                                {{-- </div> --}}
                                {{-- <!-- facebook button --> --}}
                                {{-- <div class="col-6 col-md-3 text-center mb-1"> --}}
                                {{-- <p class="fw-bold mb-2">Your Facebook</p> --}}
                                {{-- <button class="btn btn-outline-primary">Connect</button> --}}
                                {{-- </div> --}}
                                {{-- <!-- google user --> --}}
                                {{-- <div class="col-6 col-md-3 text-center mb-1"> --}}
                                {{-- <p class="fw-bold">Your Google</p> --}}
                                {{-- <div class="avatar mb-1"> --}}
                                {{-- <span class="avatar-content"> --}}
                                {{-- <img src="../../../app-assets/images/avatars/3-small.png" alt="avatar img" width="40" height="40" /> --}}
                                {{-- </span> --}}
                                {{-- </div> --}}
                                {{-- <p class="mb-0">@luraweber</p> --}}
                                {{-- <a href="#">Disconnect</a> --}}
                                {{-- </div> --}}
                                {{-- <!-- github button --> --}}
                                {{-- <div class="col-6 col-md-3 text-center mb-2"> --}}
                                {{-- <p class="fw-bold mb-1">Your GitHub</p> --}}
                                {{-- <button class="btn btn-outline-primary">Connect</button> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12"> --}}
                                {{-- <!-- submit and cancel button --> --}}
                                {{-- <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button> --}}
                                {{-- <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </form> --}}
                                {{-- <!--/ form --> --}}
                                {{-- </div> --}}
                                {{-- <!--/ social --> --}}

                                {{-- <!-- notifications --> --}}
                                {{-- <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false"> --}}
                                {{-- <div class="row"> --}}
                                {{-- <h6 class="section-label mb-2">Activity</h6> --}}
                                {{-- <div class="col-12 mb-2"> --}}
                                {{-- <div class="form-check form-switch"> --}}
                                {{-- <input type="checkbox" class="form-check-input" checked id="accountSwitch1" /> --}}
                                {{-- <label class="form-check-label" for="accountSwitch1"> --}}
                                {{-- Email me when someone comments onmy article --}}
                                {{-- </label> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 mb-2"> --}}
                                {{-- <div class="form-check form-switch"> --}}
                                {{-- <input type="checkbox" class="form-check-input" checked id="accountSwitch2" /> --}}
                                {{-- <label class="form-check-label" for="accountSwitch2"> --}}
                                {{-- Email me when someone answers on my form --}}
                                {{-- </label> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 mb-2"> --}}
                                {{-- <div class="form-check form-switch"> --}}
                                {{-- <input type="checkbox" class="form-check-input" id="accountSwitch3" /> --}}
                                {{-- <label class="form-check-label" for="accountSwitch3">Email me hen someone follows me</label> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <h6 class="section-label mt-2">Application</h6> --}}
                                {{-- <div class="col-12 mt-1 mb-2"> --}}
                                {{-- <div class="form-check form-switch"> --}}
                                {{-- <input type="checkbox" class="form-check-input" checked id="accountSwitch4" /> --}}
                                {{-- <label class="form-check-label" for="accountSwitch4">News and announcements</label> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 mb-2"> --}}
                                {{-- <div class="form-check form-switch"> --}}
                                {{-- <input type="checkbox" class="form-check-input" checked id="accountSwitch6" /> --}}
                                {{-- <label class="form-check-label" for="accountSwitch6">Weekly product updates</label> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12 mb-75"> --}}
                                {{-- <div class="form-check form-switch"> --}}
                                {{-- <input type="checkbox" class="form-check-input" id="accountSwitch5" /> --}}
                                {{-- <label class="form-check-label" for="accountSwitch5">Weekly blog digest</label> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="col-12"> --}}
                                {{-- <button type="submit" class="btn btn-primary mt-2 me-1">Save changes</button> --}}
                                {{-- <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <!--/ notifications --> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ right content section -->
            </div>
        </section>
    </div>
@endsection
