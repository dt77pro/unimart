<!DOCTYPE html>
<html> 
    <head> 
        <title>UNIMART</title>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta name="csrf-token" content="{{ csrf_token() }}" />

       <!-- CSS only -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
       <link href="{{asset('/css/user/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
       <link href="{{asset('/css/user/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
       <link href="{{asset('/css/user/reset.css')}}" rel="stylesheet" type="text/css"/>
       <link href="{{asset('/css/user/css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
       <link href="{{asset('/css/user/css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css"/>
       <link href="{{asset('/css/user/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
       <link href="{{asset('/css/user/style.css')}}" rel="stylesheet" type="text/css"/>
       <link href="{{asset('/css/user/responsive.css')}}" rel="stylesheet" type="text/css"/>

       <script src="{{asset('/js/user/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
       <script src="{{asset('/js/user/js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
       <script src="{{asset('/js/user/js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
       <script src="{{asset('/js/user/js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
       <script src="{{asset('/js/user/js/main.js')}}" type="text/javascript"></script>
       <!-- JavaScript Bundle with Popper -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

       <script>
            $(document).ready(function() {
                $("div.alert").delay(3000).slideToggle("3000");
                $(".message").delay(3000).fadeToggle("3000");
            });
        </script>
       <!-- JavaScript -->
       <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
       <!-- CSS -->
       <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
       <!-- Default theme -->
       <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
       <!-- Semantic UI theme -->
       <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
       <!-- Bootstrap theme -->
       <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
</head>
<style>
    .form-login {
            margin-top: 50px;
            background-color: #dff0d8;
            padding: 15px 15px;
            max-height: 600px;
        }
        .header-form {
            color: #1c1e21;
            font-family: SFProDisplay-Bold, Helvetica, Arial, sans-serif;
            font-size: 32px;
            line-height: 38px;
            margin-bottom: 0;
            text-align: left;
        }
        button.register {
            background: none;
            background-color: #00a400;
            border: none;
            border-radius: 6px;
            box-shadow: none;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            height: 36px;
            overflow: hidden;
            padding: 0 30px;
            text-shadow: none;
        }

        button.login {
            background: none;
            background-color: #1877f2;
            border: none;
            border-radius: 6px;
            box-shadow: none;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            height: 36px;
            overflow: hidden;
            padding: 0 100px;
            text-shadow: none;
            
        }
        button.login:hover {
            color: #fff;
        }
    
        button.register:hover {
            color: #fff;

        }
    }
</style>
<body>
    <div class="col-md-3" style="margin: 0px auto; text-align: center">
        <div class="form-login">
            <form action="" method="POST">
                @csrf
                <div class="header-form">
                    <h3>????ng nh???p</h3>
                </div>
                <hr>

                <div class="form-group my-4">
                  <input style="padding: 15px 10px;" type="email" class="form-control" placeholder="Email" name="email">
                </div>
                @error('email')
                    <small class="alert alert-danger message">{{$message}}</small>
                @enderror

                <div class="form-group my-4">
                  <input  style="padding: 15px 10px;" type="password" class="form-control" placeholder="M???t kh???u" name="password">
                </div>
                @error('password')
                    <small class="alert alert-danger message">{{$message}}</small>
                @enderror
                <div class="form-group form-check" style="text-align: left">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Ghi nh??? ????ng nh???p
                  </label>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" value="????ng nh???p" class="btn login" >????ng nh???p</button>
                    <div class="mt-1">
                        <a href="" style="color: #1877f2; ">Qu??n m???t kh???u?</a>
                    </div>
                </div>
                <hr>

                <div>
                    <button type="submit" value="????ng k??" class="btn register my-4">T???o t??i kho???n m???i</button>
                </div>

              </form>
        </div>
    </div>
 
</body>
</html>


