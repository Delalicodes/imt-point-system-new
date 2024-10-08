<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Widget Design</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.css" rel="stylesheet">
    <style>
        /* CSS from the previous section */
    </style>
</head>
<body>
    <div class="container-fluid general-widget">
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-primary o-hidden">
                    <div class="b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="database"></i></div>
                            <div class="media-body"><span class="m-0 text-white">Earnings</span>
                                <h4 class="mb-0 counter">6659</h4><i class="icon-bg" data-feather="database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-secondary o-hidden">
                    <div class="b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body"><span class="m-0 text-white">Products</span>
                                <h4 class="mb-0 counter">9856</h4><i class="icon-bg" data-feather="shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-warning o-hidden">
                    <div class="b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                            <div class="media-body"><span class="m-0 text-white">Messages</span>
                                <h4 class="mb-0 counter text-white">893</h4><i class="icon-bg" data-feather="message-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-info o-hidden">
                    <div class="b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                            <div class="media-body"><span class="m-0 text-white">New User</span>
                                <h4 class="mb-0 counter text-white">45631</h4><i class="icon-bg" data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>
