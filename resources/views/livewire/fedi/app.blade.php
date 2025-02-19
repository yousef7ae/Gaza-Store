<!doctype html>
<html dir="rtl" lang="ar">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- font awesome CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('fedi/img/favicon.png')}}" rel="icon">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('fedi/img/favicon.png')}}">

    <!-- Vendor CSS Files -->
    <title>{{config('app.name')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('fedi/assets/aos.css')}}">
    <link rel="stylesheet" href="{{asset('fedi/assets/jquery.fancybox.min.css')}}">


    <!-- google fonts Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
          integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
          integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!--  Bootstrap 5.2 css or font awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('fedi/assets/bootstrap.rtl.min.css')}}">
    <!-- custom style css  -->
    <link rel="stylesheet" href="{{asset('fedi/css/main.css?v=1.5')}}">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @livewireStyles

</head>

<body class="vh-100">
<div id="loader"></div>

@livewire('site.layouts.header')
<div class="h-230p"></div>
@yield('content')

{{ isset($slot) ? $slot : null }}

@if(request()->route()->getName() != "login" and request()->route()->getName() != "register" and request()->route()->getName() != request()->is('reset-password*') and request()->route()->getName() != request()->is('update-password*'))
    <!-- footer -->
    @livewire('site.layouts.footer')

@endif

<script src="{{asset('fedi/assets/aos.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--  Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('fedi/assets/jquery.fancybox.min.js')}}"></script>
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6239f97263052f0019790382&product=inline-share-buttons" async="async"></script>
<script src="{{asset('fedi/js/main.js?v=1.2')}}"></script>

<!-- Template Main JS File -->

@livewireScripts
@stack('js_code')
@yield('js_code')



</body>
</html>

<script>

    window.livewire.on('success', (message) => {
        $(".modal").modal("hide");

        Swal.fire({
            title: '{{__("Success")}}',
            text: message,
            icon: 'success',
            confirmButtonText: '{{__('Ok')}}',
            timer: 1500
        })
    });

    window.livewire.on('alertError', (message) => {
        Swal.fire({
            title: 'error!',
            text: message,
            icon: 'error',
            confirmButtonText: '{{__('Ok')}}'
        })

        // setTimeout(function(){
        //     window.location.href = "";
        // }, 1500);
    })

</script>


<script>

    @if(session()->has('success'))
    Swal.fire({
        title: '{{__("Success")}}',
        text: '{{session('success')}}',
        icon: 'success',
        confirmButtonText: '{{__('Ok')}}'
    })
    @endif

    @if(session()->has('danger'))
    Swal.fire({
        title: 'Error!',
        text: '{{session('danger')}}',
        icon: 'error',
        confirmButtonText: '{{__('Ok')}}'
    })
    @endif

    window.livewire.on('alertSuccess', (message) => {
        Swal.fire({
            title: '{{__("Success")}}',
            text: message,
            icon: 'success',
            confirmButtonText: '{{__('Ok')}}'
        })

        Livewire.emit("refreshModal");
        $(".modal").modal("hide");
    })

    window.livewire.on('alertDanger', (message) => {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error',
            confirmButtonText: '{{__('Ok')}}'
        })
    })

    window.addEventListener('close-modal', event => {
        $(".modal").modal("hide");
    })

    $('.modal').on('hide.bs.modal', function () {
        Livewire.emit('refreshModal')
    })

</script>
<script>
    function increment() {
        document.getElementById('demoInput').stepUp();
    }

    function decrement() {
        document.getElementById('demoInput').stepDown();
    }
</script>

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyDuuEKeEhmWz_OPCsCk1HPgHerQscb6aV0",
        authDomain: "dukkan-store.firebaseapp.com",
        projectId: "dukkan-store",
        storageBucket: "dukkan-store.appspot.com",
        messagingSenderId: "62621274937",
        appId: "1:62621274937:web:3c82fe1845bd2b486bcee8"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function (token) {

            $.post("/fcm-token", {
                _method: "PATCH",
                token
            }).then(({data}) => {
                console.log(data)
            }).catch(({response: {data}}) => {
                console.error(data)
            })

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();

    messaging.onMessage(function ({data: {body, title}}) {
        new Notification(title, {body});
    });
</script>

