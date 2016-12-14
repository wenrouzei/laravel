<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div id="content">
	3333
</div>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
<script type="text/javascript">
	var socket = io('http://localhost:6001');
	socket.on('connection', function (data) {
	    console.log(data);
	});
	socket.on('test-channel:App\\Events\\SomeEvent', function(message){
	    console.log(message);
	});
	console.log(socket);
</script>
</body>
</html>