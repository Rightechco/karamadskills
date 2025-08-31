<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/fontiran.css') }}" rel="stylesheet" type="text/css" />
        <title>@yield('title')</title>

        <style>
            *{
                padding: 0;
                margin: 0;
                overflow: hidden;
                font-family: IRANSans;
            }
            a {
                text-decoration: none;
                color: black;
            }
            section{
                width: 100%;
                height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .btn-div a{
                height: 35px;
                font-size: 14px;
                background: #fff;
                border: 2px solid #fff;
                border-radius: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all .5s ease-in-out;
            }
            .btn-div a:hover{
                background: #000;
                color: #fff;
                border: 2px solid #000;
            }
            .btn-div a:hover i{
                color: #10d1f4;
            }
            .btn-div .btn-home{
                width: 200px;
                position: absolute;
                top: 10px;
                right: 10px;
            }
            .btn-div .btn-panel{
                position: absolute;
                top: 10px;
                left: 10px;
                width: 160px;
            }
            .btn-div a i{
                font-size: 20px;
                color: #10d1f4;
                padding-left: 5px;
            }
            .error-bg{
                width: 100%;
                height: 100%;
                background: rgb(12,83,25);
                background: linear-gradient(90deg, rgba(16,209,244,1) 0%, rgba(206,232,225,1) 35%, rgba(16,209,244,1) 100%);
            }
            .icon-box{
                width: 80%;
                height: 100%;
                margin: auto;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .error-bg .icon-box i{
                font-size: 550px;
                opacity: .3;
                animation: icon 5s linear infinite;
            }
            .error-bg img{
                position: absolute;
                bottom: 0;
                right: 0;
                width: 30%;
            }
            @keyframes icon{
                0%, 100%{
                    transform: scale(1);
                }
                50%{
                    transform: scale(1.5);
                }
            }
            .error{
                font-size: 50px;
                position: absolute;
                top: 50px;
                bottom: 50px;
                right: 0;
                left: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .error * {
                text-align: center;
            }

            @media screen and (max-width: 768px){
                .error-bg .icon-box i{
                    font-size: 450px;
                }
                .error{
                    font-size: 35px;
                }
            }
            @media screen and (max-width: 576px){
                .error-bg .icon-box i{
                    font-size: 300px;
                }
                .error{
                    font-size:25px;
                }
                .error-bg img{
                    width: 50%;
                }
            }
            @media screen and (max-width: 400px){
                .error-bg .icon-box i{
                    font-size: 200px;
                }
                .error{
                    font-size:20px;
                }
                .error-bg img{
                    width: 50%;
                }
            }
        </style>
    </head>
<body>
    <section>
        <div class="btn-div">
            <a href="{{ route('panel') }}" class="btn-home"> بازگشت به پنل <i class='mdi mdi-arrow-left-bold'></i></a>
            <a href="{{ route('home') }}" class="btn-panel"> بازگشت به صفحه اصلی <i class='mdi mdi-home'></i></a>
        </div>
        <div class="error-bg">
            <div class="icon-box">
                <!-- <i class='bx bx-error-alt'></i> -->
                <i class='mdi mdi-information-outline'></i>
                <img src="{{ asset('assets/img/bot.png') }}" alt="">
            </div>
        </div>
        <div class="error">
            <h1>@yield('code')</h1>
            <h2>@yield('message')</h2>
            <p>@yield('message2')</p>
        </div>
    </section>
</body>
</html>
