
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title }} </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset ('assets')}}/./images/favicon.png">
    <link href="{{asset ('assets')}}/./css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    @include('sweetalert::alert')

    <div class="authincation h-100">
        <div class="container h-100 d-flex justify-content-center align-items-center">
            <div class="authincation-content card" style="max-width: 800px; width: 100%; box-shadow: 10px 10px 8px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <div class="row no-gutters">
                    <!-- Bagian Gambar Full -->
                    <div class="col-md-6">
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/images/Kedai.png') }}" alt="Login Image" class="img-fluid" style="max-height: 100%; width: 100%; object-fit: cover; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                        </div>
                    </div>
                    <!-- Bagian Form dan Judul -->
                    <div class="col-md-6">
                        <div class="p-4">
                            <h4 class="text-center mt-5 mb-4">Login</h4>
                            <form class="needs-validation" novalidate action="/login" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label><strong>Email</strong></label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label><strong>Password</strong></label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" name="password" id="password">
                                        <span class="position-absolute eye-icon" id="toggle-password">
                                            <i class="fa fa-eye" id="eye-icon"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row d-flex justify-content-between mt-4 mb-2">

                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
   <!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>
    /* Styling untuk ikon mata */
    .eye-icon {
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 16px; /* Ukuran kecil */
        color: #888; /* Warna netral */
    }

    .position-relative {
        position: relative; /* Agar ikon bisa ditempatkan di dalam input */
    }

    .eye-icon:hover {
        color: #000; /* Warna berubah saat hover */
    }
</style>

<script>
    // Fungsi untuk toggle password visibility
    document.getElementById('toggle-password').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var eyeIcon = document.getElementById('eye-icon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text'; // Menampilkan password
            eyeIcon.classList.remove('fa-eye'); // Ganti ikon menjadi mata terbuka
            eyeIcon.classList.add('fa-eye-slash'); // Ganti ikon menjadi mata tertutup
        } else {
            passwordField.type = 'password'; // Menyembunyikan password
            eyeIcon.classList.remove('fa-eye-slash'); // Ganti ikon menjadi mata terbuka
            eyeIcon.classList.add('fa-eye'); // Ganti ikon menjadi mata tertutup
        }
    });
</script>
</body>


</html>
