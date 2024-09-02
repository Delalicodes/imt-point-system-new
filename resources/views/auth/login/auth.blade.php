<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Poco admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Poco admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Poco - Premium Admin Template</title>
    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/themify.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
</head>
<style>
    #notification-container {
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 1050;
        width: 300px;
        max-width: 100%;
    }

    .alert {
        padding: 0.5rem 1rem;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }
</style>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="typewriter">
            <h1>New Era Admin Loading..</h1>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <!-- login page start-->
            <div class="authentication-main">
                <div class="row">
                    <div class="col-md-12">
                        <div class="auth-innerright">
                            <div class="authentication-box">
                                <div class="card-body p-0">
                                    <div class="cont text-center">
                                        <div>
                                            <form class="theme-form" id="login-form">
                                                <h4>LOGIN</h4>
                                                <h6>Enter your Username and Password</h6>
                                                <div class="form-group">
                                                    <label class="col-form-label pt-0">Your Username</label>
                                                    <input class="form-control" type="text" name="username"
                                                        required="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label">Password</label>
                                                    <input class="form-control" type="password" name="password"
                                                        required="">
                                                </div>
                                                <div class="checkbox p-0">
                                                    <input id="checkbox1" type="checkbox">
                                                    <label for="checkbox1">Remember me</label>
                                                </div>
                                                <div class="form-group form-row mt-3 mb-0">
                                                    <button class="btn btn-primary btn-block"
                                                        type="submit">LOGIN</button>
                                                </div>
                                                <div class="login-divider"></div>
                                                <div class="social mt-3">
                                                    <div class="form-row btn-showcase">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="sub-cont">
                                            <div class="img">
                                                <div class="img__text m--up">
                                                    <h2>New here?</h2>
                                                    <p>Sign up and discover great amount of new opportunities!</p>
                                                </div>
                                                <div class="img__text m--in">
                                                    <h2>One of us?</h2>
                                                    <p>If you already has an account, just sign in. We've missed you!
                                                    </p>
                                                </div>
                                                <div class="img__btn"><span class="m--up">Sign up</span><span
                                                        class="m--in">Sign in</span></div>
                                            </div>
                                            <div>
                                                <form class="theme-form" id="signup-form">
                                                    <h4 class="text-center">NEW USER</h4>
                                                    <h6 class="text-center">Enter your Username and Password For Signup
                                                    </h6>
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text"
                                                                    name="first_name" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="last_name"
                                                                    type="text" placeholder="Last Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="username"
                                                            placeholder="User Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="password" name="password"
                                                            placeholder="Password">
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-sm-4">
                                                            <button class="btn btn-primary" type="submit">Sign
                                                                Up</button>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="text-left mt-2 m-l-20">Are you already
                                                                user?  <a class="btn-link text-capitalize"
                                                                    href="login.html">Login</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-divider"></div>
                                                    <div class="social mt-3">
                                                        <div class="form-row btn-showcase">

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login page end-->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Notifications</h5><span>Here are your validation error notifications.</span>
                            </div>
                            <div class="card-body">
                                <div id="notification-container">
                                    <!-- Validation errors will be inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/popper.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="../assets/js/sidebar-menu.js"></script>
    <script src="../assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/login.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script>
        $(document).ready(function() {
            // Signup form submission
            $('#signup-form').on('submit', function(e) {
                e.preventDefault();
                const data = $(this).serialize();
                $.ajax({
                    url: '{{ route('user.store') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        $('#response').html('<p>' + response.message + '</p>');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.status, xhr.statusText);
                        const errors = xhr.responseJSON.errors;
                        let notificationContainer = $('#notification-container');
                        notificationContainer.empty(); // Clear previous notifications

                        $.each(errors, function(key, message) {
                            const alert = $(`
                                <div class="alert alert-danger dark" role="alert">
                                    <p>${message[0]}</p>
                                </div>`);
                            notificationContainer.append(alert);

                            // Automatically hide after 1 second
                            setTimeout(function() {
                                alert.fadeOut('slow', function() {
                                    $(this).remove();
                                });
                            }, 1000);
                        });
                    }
                });
            });

            // Login form submission
            $('#login-form').on('submit', function(e) {
                e.preventDefault();
                const data = $(this).serialize();
                $.ajax({
                    url: '{{ route('login.post') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#response').html('<p>' + response.message + '</p>');
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.status, xhr.statusText);
                        const errors = xhr.responseJSON.errors;
                        let notificationContainer = $('#notification-container');
                        notificationContainer.empty(); // Clear previous notifications

                        $.each(errors, function(key, message) {
                            const alert = $(`
                                <div class="alert alert-danger" role="alert">
                                    <p>${message[0]}</p>
                                </div>`);
                            notificationContainer.append(alert);

                            // Automatically hide after 1 second
                            setTimeout(function() {
                                alert.fadeOut('slow', function() {
                                    $(this).remove();
                                });
                            }, 1000);
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
