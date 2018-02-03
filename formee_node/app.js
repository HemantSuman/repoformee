//Server Global Data-------------
var redisServerUrl = '27.54.94.82';
var apiUrl = 'http://27.54.94.82/api/';
var authorizationToken = 'Basic Zm9ybWVlbW9iaWxlOmRmNmY2ODYyODU4YzkwY2ZmNjMwNGQ4ZjI1ZDhmM2U5';
//------------------------------


var express = require('express');
var app = express(); 

var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');
server.listen(8089,redisServerUrl);


var redisClient = redis.createClient();
var request = require("request");



//redisClient.select(2);

//var redis = require("redis-node");
//var client = redis.createClient();    // Create the client
//client.select(2); 


//redisClient.on('connect', function () {
//    console.log('connected To redis ...');    
//});


var client = redis.createClient('6379', '127.0.0.1');


redisClient.on("message", function (channel, data) {

    console.log(data);
    data = JSON.parse(data);
    //console.log(typeof data);

    console.log("mew message is send by  " + data.s_id + 'ch name ' + channel);

    //io.sockets.emit(channel, data);
    console.log(channel);
    io.sockets.in('user_' + data.r_id).emit(channel, data);

});

io.on('connection', function (socket) {

    console.log("client connected.............");
    //redisClient.set('framework', 'AngularJS');  
    redisClient.subscribe('message');


    socket.on('join', function (data) {


        if (typeof data === 'string') {
            data = JSON.parse(data);
        }

        console.log("Join is call.............");
        console.log(data);
        console.log(typeof data);
        console.log("u are joi " + data.id);

        socket.myJoinId = data.id;

        //client.set(data.id, data.id);
        client.set(data.id, data.id, redis.print);


        //redisClient.set('framework', 'AngularJS'); 

        //redisClient.set('2', '2');
        socket.join(data.id);
    });



    socket.on("message", function (data) {

        if (typeof data === 'string') {
            data = JSON.parse(data);
        }

        console.log(data);
        console.log('message send to--------------------------------------------- ' + data.r_id);


        io.sockets.in(data.s_id).emit('received', data);
        
        client.get(data.r_id, function (err, isExist) {
            if (isExist) {
                console.log(isExist, 'data found $$$$$$$$$$$$$$$$$$$$$###########');
                io.sockets.in(data.r_id).emit('message', data);
            } else {

                console.log(isExist, 'data not found.....call API-----------------------------');


                var options = {method: 'POST',
                    url: apiUrl + 'send_msg_apioffline',
                    headers:
                            {
                                authorization: authorizationToken,
                                'content-type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'},
                    form:
                            {classifiedid: data.classified_id,
                                classifieduser_id: data.r_id.replace('user_', ''),
                                user_id: data.s_id.replace('user_', ''),
                                massage: data.msg}};

                request(options, function (error, response, body) {
                    if (error)
                        throw new Error(error);

                    console.log(body);
                });

            }

        });


        //data = JSON.parse(data);
        //console.log(typeof data);
        //console.log("mew message is send by  " + data.s_id + 'ch name ' + channel);
        //io.sockets.emit(channel, data);
        //console.log(channel);




        var options = {method: 'POST',
            url: apiUrl + 'send_msg_api',
            headers:
                    {
                        authorization: authorizationToken,
                        'content-type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'},
            form:
                    {classifiedid: data.classified_id,
                        classifieduser_id: data.r_id.replace('user_', ''),
                        user_id: data.s_id.replace('user_', ''),
                        massage: data.msg}};

        request(options, function (error, response, body) {
            if (error)
                throw new Error(error);

            //console.log(body);
        });


    });



    socket.on('disconnect', function () {


        console.log('disconnect is call ...');
        console.log(socket.myJoinId);

        client.del(socket.myJoinId, function (err, reply) {
            console.log(reply);
        });

        //redisClient.quit();
    });

});





var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');

var index = require('./routes/index');
var users = require('./routes/users');

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', index);
app.use('/users', users);

// catch 404 and forward to error handler
app.use(function (req, res, next) {
    var err = new Error('Not Found');
    err.status = 404;
    next(err);
});

// error handler
app.use(function (err, req, res, next) {
    // set locals, only providing error in development
    res.locals.message = err.message;
    res.locals.error = req.app.get('env') === 'development' ? err : {};

    // render the error page
    res.status(err.status || 500);
    res.render('error');
});

module.exports = app;
