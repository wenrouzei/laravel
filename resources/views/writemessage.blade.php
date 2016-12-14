<!DOCTYPE html>
<html>
<head>
    <title></title>
     <meta name="csrf-token" content="{{ csrf_token() }}" />
     <style type="text/css">
        #messages{
            background-color: #000;
            width: 1000px;
            height: 500px;
            color:#FFF;
        }
     </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2" >
          <div id="messages" ></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Send message</div>
                <form>
                    {{ csrf_field() }}
                    <input type="text" name="message" >
                    <input type="submit" value="send">
                </form>
            </div>
        </div>
    </div>
</div>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("form").submit(function(){
        var message = $("input[name='message']").val();
        var data = {message: message};
        $.post('{{ url("sendmessage") }}', data).success(function(msg){
            console.log(msg);
            $("input[name='message']").val('');
        });
        return false;
    });

    var socket = io.connect('http://192.168.16.228:8890');
    socket.on('message', function (data) {
        var returndata = JSON.parse(data);
        $( "#messages" ).append( "<p>"+returndata.username+"："+returndata.msg+"</p>" );
      });
</script>
</body>
</html>