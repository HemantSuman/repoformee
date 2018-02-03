<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="http://js.pusher.com/4.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('5ec22bd5d75c400eeb67', {
      cluster: 'ap2',
      encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('u_10', function(data) {
      alert(data.message);
    });
  </script>
</head>