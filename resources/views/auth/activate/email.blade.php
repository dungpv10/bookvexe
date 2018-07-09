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
    	    <h1>Activate</h1>

			<p>Please check your email to activate your account.</p>
        	<a href="{{ url('activate/send-token') }}">Request new Token</a>
        </div>
    </div>
</body>
</html>