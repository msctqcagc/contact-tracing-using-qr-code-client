<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'app-name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('template/assets/images/favicon.ico') }}">

    <link href="{{ asset('template/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('template/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('template/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
</head>

<body>

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div class="accountbg"
        style="background: url('{{ asset('template/assets/images/bg.jpg') }}');background-size: cover;background-position: center;">
    </div>

    <div class="account-pages mt-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5 col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-3">
                                <h4 class="font-size-18 mt-2 text-center">Registration</h4>
                                <p class="text-muted text-center mb-4">Register to continue.</p>
                            </div>

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                        <strong>Error!</strong> {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endforeach
                            @endif

                            <form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ old('username') }}" placeholder="Enter username" required autofocus
                                        autocomplete="off">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required placeholder="Enter email"
                                        autocomplete="off">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required
                                        placeholder="Enter password">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        name="password_confirmation" required placeholder="Confirm password">
                                </div>

                                <hr>

                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name"
                                        value="{{ old('first_name') }}" placeholder="Enter First Name" required
                                        autofocus autocomplete="off">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="middleName">Middle Name</label>
                                    <input type="text" class="form-control" id="middleName" name="middle_name"
                                        value="{{ old('middle_name') }}" placeholder="Enter Middle Name" required
                                        autofocus autocomplete="off">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name"
                                        value="{{ old('last_name') }}" placeholder="Enter Last Name" required
                                        autofocus autocomplete="off">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="gender">Gender</label>
                                    <select class="form-select" id="gender" name="gender"
                                        aria-label="Default select example">
                                        <option value="0" selected="">Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="address">Date of Birth</label>
                                    <div class="input-group" id="datepicker2">
                                        <input type="text" class="form-control" name="date_of_birth"
                                            placeholder="MM/DD/YYYY" data-date-format="mm/dd/yyyy"
                                            data-date-container='#datepicker2' data-provide="datepicker"
                                            data-date-autoclose="true" data-date-end-date="0d" autocomplete="off">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="mobileNumber">Mobile Number</label>
                                    <input type="number" class="form-control" id="mobileNumber" name="contact_number"
                                        value="{{ old('mobile_number') }}" placeholder="e.g. 09123456789" required
                                        autofocus autocomplete="off">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="barangay">Barangay</label>
                                    <select class="form-select select2" id="barangay_id" name="barangay_id"
                                        aria-label="Default select example">
                                        <option value="" selected="">Barangay</option>
                                        @foreach ($barangays as $barangay)
                                            <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required
                                        placeholder="House No. / Block / Street / Purok"
                                        autocomplete="off">{{ old('address') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="psa">PSA</label>
                                    <input type="file"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        class="filestyle" name="psa" data-buttonname="btn-secondary">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="psa">Valid ID</label>
                                    <a href="javascript:void(0);" class="card-link" style="float: right" id="linkAcceptableID">Acceptable ID's</a>
                                    <input type="file"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        class="filestyle" name="valid_id" data-buttonname="btn-secondary">
                                </div>

                                <div class="col-md-12">
                                    <div class="text-first">
                                        <button type="submit"
                                            class="btn btn-primary w-100 waves-effect waves-light">Register</button>
                                    </div>
                                </div>

                                <div class="mb-0 row">
                                    <div class="col-12 mt-4">
                                        <p class=" text-muted mb-0">By registering you agree to the App Name <a
                                                href="javascript:void(0);">Terms of Use</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-center position-relative">
                        <p class="text-white">Already have an account ? <a href="{{ route('login') }}"
                                class="font-weight-bold text-primary"> Login </a> </p>
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © {{ config('app.name', 'app-name') }}. Crafted with <i
                            class="mdi mdi-heart text-danger"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sample modal content -->
    <div id="acepptableIDModal" class="modal fade" tabindex="-1" aria-labelledby="acepptableIDModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="acepptableIDModalLabel">Acceptable ID's</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="validIDList">
                    </ul>
                    <p>Note: Please ensure that the Name and Birthday you entered in the form matches the Name and Birthday reflected in the Valid ID that you will be uploading.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('template/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/axios/axios.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('template/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>

    <script src="{{ asset('template/assets/js/app.js') }}"></script>

    <script>
        $(function() {
            $('.select2').select2();

            $(document).on('select2:open', function() {
                document.querySelector('.select2-search__field').focus();
            });

            $('#mobileNumber').on('keydown', function(e) {
                let code = e.originalEvent.code;
                code = code.toLowerCase();
                if (code === 'arrowup' || code === 'arrowdown') {
                    e.preventDefault();
                }
            });

            $('#linkAcceptableID').on('click', function() {
                fetchValidIDs();
            });
        });

        function fetchValidIDs() {
            $('#validIDList').empty();

            axios.get(BASE_API_URL + '/valid-ids/active')
            .then(function (response) {
                let valid_ids = response.data.valid_ids;
                if (valid_ids.length === 0) {
                    return;
                }

                for(let i = 0; i < valid_ids.length; i++) {
                    const valid_id = valid_ids[i];
                    $("#validIDList").append(`<li>` + `(` + valid_id.abbr + `)` + ` ` + valid_id.name + `</li>`);
                }

                $('#acepptableIDModal').modal('show');
            })
            .catch(function (error) {
                console.log(error.response);
            });
        }
    </script>
</body>

</html>
