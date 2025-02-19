<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{asset('assets/images/playstore.png')}}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
          integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous"/>
    <!-- Bootstrap CSS -->
    @if(app()->getLocale() == 'ar' )
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css"
              integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe"
              crossorigin="anonymous">

    @else
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
              integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
              crossorigin="anonymous">

    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
          integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Dukkan/css/style.css')}}">
    <link rel="stylesheet"
          href="{{asset('Hassan/style.css')}}">
        <link rel="stylesheet"
          href="{{asset('jawwalak/style.css')}}">

    @if(app()->getLocale() == 'ar' )
        <link rel="stylesheet"
              href="{{asset('Hassan/style-rtl.css')}}">
    @endif

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <title>{{config('app.name')}}</title>
    @livewireStyles

    <style>
        .page-link {
            color: var(--text-secondary);
        }

        .page-item.active .page-link {
            background-color: var(--text-secondary);
            border-color: var(--text-secondary);
        }

        .pagination .page-link.active, .pagination .page-link:hover {
            color: white;
        }

        .h-130p {
            height: 128px;
        }

        .card-img-top {
            object-fit: cover;
        }

        .w-120px {
            width: 120px;
        }

        .h-120px {
            height: 120px;
        }

        .cover {
            object-fit: cover;
        }

        .shopping1 {
            border-radius: 0 !important;
        }

        footer::before {
            display: none !important;
        }

        footer {
            background-color: #FFFFFF;
        }

        .modal-open .modal {
            background: #000000ad;
        }

        .contain {
            object-fit: contain;
        }

        .rounded-10 {
            border-radius: 10px;
        }

        .w-22 {
            width: 22px;
        }

        .h-22 {
            height: 22px;
        }

        .bg-input {
            background-color: #ECECEC;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .pad-top-3 {
            padding-top: 2px !important;
        }

        .pad-bottom-4 {
            padding-bottom: 4px !important;
        }

        input[type="number"]:focus-visible {
            border: 0 !important;
            outline: none;
        }

        .rounded-left {
            border-top-left-radius: 3px !important;
            border-bottom-left-radius: 3px !important;
        }

        .rounded-right {
            border-top-right-radius: 3px !important;
            border-bottom-right-radius: 3px !important;
        }

        .border-2 {
            border-top: 3px;
        }

        a {
            text-decoration: none !important;
        }

        .cursor {
            cursor: pointer;
        }

        .form-check-input1 {
            width: 20px !important;
            height: 20px !important;
        }

        .form-check-input1:checked {
            background-color: var(--text-secondary) !important;
            border-color: var(--text-secondary) !important;
        }

        input[name="flexRadioDefault"] {
            accent-color: var(--text-secondary);
        }

        @media (max-width: 768px) {
            .h-130p {
                height: 99px !important;
            }

        }
        :root {
            --text-danger:#dc3545 !important;
            --text-primary:#6c757d !important;
            --text-secondary:#bd2130 !important;
            --bg-danger:#dc3545 !important;
            --bg-primary:#6c757d !important;
            --bg-secondary:#bd2130 !important;
            --font-family:"main" , sans-serif !important;
        }
    </style>

</head>

<body
    class="@if (request()->route()->getName() == "login" or request()->route()->getName() == "register" or request()->route()->getName() == request()->is('reset-password*') or request()->route()->getName() == request()->is('update-password*')) vh-100 @endif">

<div id="loader-wrapper">
    <div id="loader"></div>
    <img class="position-absolute" width="100"
         src="{{ ($logo = \App\Models\Setting::where('name','logo')->first()) ? url("storage/".$logo->value) : url('storage/logos/7AV6lYMpjXT1EXQkgiuNzHmCAdYanDdcDqcAGd5w.png')}}"
         alt="">
</div>

@if(request()->route()->getName() != "home" and request()->route()->getName() != "login" and request()->route()->getName() != "register" and request()->route()->getName() != request()->is('reset-password*') and request()->route()->getName() != request()->is('update-password*') and request()->route()->getName() != request()->is('favorites*') and request()->route()->getName() != request()->is('profile*')  and request()->route()->getName() !=  "contacts" and request()->route()->getName() !=  request()->is('privacy-policy*'))
{{--    <div class="h-130p"></div>--}}
@endif

@if(request()->route()->getName() != "login" and request()->route()->getName() != "register" and request()->route()->getName() != request()->is('reset-password*') and request()->route()->getName() != request()->is('update-password*'))
    <!-- header -->
    @livewire('site.layouts.header')

@endif

@yield('content')

{{ isset($slot) ? $slot : null }}

@if(request()->route()->getName() != "login" and request()->route()->getName() != "register" and request()->route()->getName() != request()->is('reset-password*') and request()->route()->getName() != request()->is('update-password*'))
    <!-- footer -->
    @livewire('site.layouts.footer')

@endif

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{asset('Hassan/js/main.js')}}"></script>
<!-- Modal  serch-->

@livewireScripts
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
            confirmButtonText: '{{__("Cool")}}',
            timer: 1500
        })
    });

    window.livewire.on('alertError', (message) => {
        Swal.fire({
            title: '{{__("Error")}}!',
            text: message,
            icon: 'error',
            confirmButtonText: '{{__("Ok")}}'
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
        title: '{{__('Error')}}!',
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
            title: '{{__('Error')}}!',
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
        apiKey: "AIzaSyB93-aHdHe-A17Q4wNdaGwSGqnrvKKsHMY",
        authDomain: "dukkan-67c27.firebaseapp.com",
        projectId: "dukkan-67c27",
        storageBucket: "dukkan-67c27.appspot.com",
        messagingSenderId: "785390881553",
        appId: "1:785390881553:web:15cd6924255df9f837dab0",
        measurementId: "G-Q9JF6QLZXP"
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

