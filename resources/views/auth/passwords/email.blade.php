<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow">

<title>Forget Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style type="text/css">
/* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
background-image: url("{{ asset('storage') . '/' . '094ed1732a8155657d6bf35229fb24b3.jpg' }}");
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 400px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
</style>
</head>
<body>
<html>
<head>
<!--Bootsrap 4 CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<!--Custom styles-->
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
<div class="d-flex justify-content-center h-100">
<div class="card">
@if (session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
@endif
<div class="card-header">
<h3>Forget password</h3>
</div>
<div class="card-body">
<form method="POST" action="{{ route('password.email') }}">
{{ csrf_field() }}
<div class="input-group form-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-user"></i></span>
</div>

<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
</div>
@if ($errors->has('email'))
<div class="alert alert-danger" role="alert">
<span class="help-block">
<strong>{{ $errors->first('email') }}</strong>
</span>
</div>
@endif

<div class="form-group">
<input type="submit" value="Login" class="btn float-right login_btn">
</div>
</form>
</div>
<div class="card-footer">
<a class="btn btn-link" href="{{ route('login') }}">
To login
</a>
</div>
</div>
</div>
</div>
</body>
</html>
</body>
</html>
