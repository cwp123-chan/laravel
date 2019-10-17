<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Flat Registration Form Template</title>
    {{--        加入 防止 xsrf 不匹配--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ URL::asset('css/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/css/form-elements.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css/style.css') }}" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">


    <style>
        #adminName,#adminPwd,#adminRepwd{
            border: 1px solid !important;
        }
        .inner-bg{
            padding-top: 0px !important;
        }
        .form-bottom{
            position:relative;
            left:300px;
            z-index: 1000;
        }
        .form-control{
            height:50px !important;
        }
        .form-group{
            display: flex;
            justify-content: center;
        }
        .btn{
            margin-top: 15px!important;
        }
    </style>
</head>

<body>

<!-- Top menu -->
<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Bootstrap Flat Registration Form Template</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="top-navbar-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
							<span class="li-text">
								Put some text or
							</span>
                    <a href="#"><strong>links</strong></a>
                    <span class="li-text">
								here, or some icons:
							</span>
                    <span class="li-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>
								<a href="#"><i class="fa fa-skype"></i></a>
							</span>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Top content -->
<div class="top-content">
    <div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Sign up now</h3>
                            <p>Fill in the form below to get instant access:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil"></i>
                        </div>
                        <div class="form-top-divider"></div>
                    </div>
                    <div class="form-bottom">
                        <div class="form-group">
                            <h2>登录</h2>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-first-name">管理员用户名</label>
                            <input type="text" id="adminName" name="form-first-name" placeholder="管理员用户名" class="form-first-name form-control">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">密码</label>
                            <input type="password" id="adminPwd" name="form-last-name" placeholder="密码" class="form-last-name form-control">
                        </div>
                        <button type="submit" class="btn" onclick="login()">登录</button>
                        <button type="submit" class="btn" onclick="reg()">注册</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>

<![endif]-->

</body>

<script>
    function login(){
        var admin = document.getElementById('adminName').value;
        var pwd = document.getElementById('adminPwd').value;
        var list = {
            'admin' : admin,
            'pwd' : pwd
        }
        console.log(admin,pwd);
        $.ajax({
            //请求方式
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type : "post",
            //请求地址
            url : "/tologin",
            //数据，json字符串
            dataType:'json',
            data : list,
            //请求成功
            success : function(result) {
                console.log(result);
                if(result === true){
                    alert('登陆成功');
                    var domain = window.location.host;
                    window.location.href = 'http://'+domain+'/index';
                    // console.log(domain);
                }
            },
            //请求失败，包含具体的错误信息
            error : function(e){
                // console.log(e);
                // console.log(e.responseText);

            }
        })
    }

    function reg(){
        var domain = window.location.host;
        var url = domain.split('/')[0];
        console.log(url);
        window.location.href = 'http://'+domain+'/reg'
    }

</script>

</html>
