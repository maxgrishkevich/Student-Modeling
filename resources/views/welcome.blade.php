<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Studel</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/welcome/logo.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://mdbootstrap.com/api/snippets/static/download/MDB5-Free_6.2.0/css/mdb.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

    <link rel="stylesheet" href="{{ asset('css/welcome/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome/intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome/info.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('css/welcome/boot.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}


    <script src="https://capp.nicepage.com/0f399d8d77c1f9d0012fc8858caffe18bebb5172/main-libs.js"></script>
    <script src="https://capp.nicepage.com/f862f25d105a95958148db2e2b0afcc3967f9b5b/nicepage.js"></script>

</head>
<body>
    @include('inc.welcome.header')

    @include('inc.welcome.intro')
    @include('inc.welcome.info')
    @include('inc.welcome.about')

    @include('inc.welcome.footer')
</body>
</html>

