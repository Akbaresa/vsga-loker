@extends('layouts.root')

@section('title')
    Login
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/notifier.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/uikit.css') }}" />
@endsection

@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v2">
            <div class="auth-sidecontent">
                <img src="{{ asset('assets/images/authentication/img-auth-sideimg.jpg') }}" alt="images" class="img-fluid img-auth-side" />
            </div>
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <h1 class="text-center">My Lowongan</h1>
                        <h4 class="text-center f-w-500 mb-3">Masuk dengan Email anda</h4>
                        <form id="login-form" action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address" />
                            </div>
                            <div class="mb-3 position-relative">
                                <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password" />
                                <span class="position-absolute bg-light border rounded-circle d-flex justify-content-center align-items-center"
                                        onclick="togglePassword()"
                                        style="top: 50%; right: 15px; transform: translateY(-50%); width: 35px; height: 35px; cursor: pointer;">
                                    <i class="fa fa-eye" id="toggleIcon"></i>
                                </span>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>
    <script>
  function togglePassword() {
    const passwordInput = document.getElementById("passwordInput");
    const icon = document.getElementById("toggleIcon");
    const type = passwordInput.getAttribute("type");

    if (type === "password") {
      passwordInput.setAttribute("type", "text");
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      passwordInput.setAttribute("type", "password");
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }
</script>

    <script>
        $(document).ready(function () {
            $('#login-form').on('submit', function (e) {
                e.preventDefault();

                $('#error-messages').empty();
                $('#error-alert').addClass('d-none');

                let formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,

                    success: function (response) {
                        if (response.redirect) {
                            window.location.replace(response.redirect);
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                            let errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan, silakan coba lagi.';
                            notifier.show(
                                'Autentikasi Gagal!',
                                errorMessage,
                                'danger',
                                '/assets/images/notification/high_priority-48.png',
                                3000
                            );

                        } else {
                            alert('Terjadi kesalahan, silakan coba lagi.');
                        }
                    },
                });
            });
        });
    </script>
@endsection
