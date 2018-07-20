<!DOCTYPE html>
<html>

<head>
    <title>Login | BOXVEXE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row text-center">
    	    <h1>Kích Hoạt</h1>

			<p>Bạn hãy check email để kích hoạt tài khoản!</p>
        	Hoặc click vào  <a href="{{ url('activate/send-token') }}"> ĐÂY </a> để lấy token mới
        </div>
    </div>
</body>
</html>