var express = require('express');
var expressValidator = require('express-validator')
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var expressLayouts = require('express-ejs-layouts');
var passport = require('passport');
var routes = require('./routes/index');
var users = require('./routes/users');
var classes = require('./routes/class');
var farm = require('./routes/farm');
var message = require('./routes/message');
var admin = require('./routes/admin');
var group = require('./routes/group');
var session = require('express-session')
var MySQLStore = require('express-mysql-session')(session);
var FacebookStrategy = require('passport-facebook').Strategy;
var GoogleStrategy = require('passport-google-oauth').OAuth2Strategy;
var flash = require('express-flash');
var app = express();
require('./config/passport')(passport);
var modelNoty = require('./model/Notification');
var modelAds = require('./model/Ads');
var userModel = require('./model/User');
var grpModel = require('./model/Group');
var async = require('async');
var ss = require('socket.io-stream');
var path = require('path');
var fs = require("fs");

var Sequelize = require('sequelize');
var sequelize = require('./config/db');

var msgModel = sequelize.define('messages', {
    sender_id: Sequelize.STRING,
    group_id: Sequelize.STRING,
    rec_id: Sequelize.STRING,
    msg: Sequelize.STRING,
    read: Sequelize.STRING,
    is_file: Sequelize.STRING,
    file_name: Sequelize.STRING
});


// Use For socket setup

var server = require('http').Server(app);
var io = require('socket.io')(server);
server.listen(8082, "192.168.100.161");



io.of('/user').on('connection', function (socket) {
    console.log('file uploading');
    ss(socket).on('profile-image', function (stream, data) {

        console.log(data);

        var filename = path.basename(data.name);
        var filetype = path.extname(data.name);

        var new_filename = Math.floor(Date.now() / 1000) + filetype;
        console.log(filename);
        stream.pipe(fs.createWriteStream('public/uploads/chat/' + new_filename));

        stream.on('finish', function () {
            console.log('upload is done');


            var saveData = {};
            saveData['msg'] = '/uploads/chat/' + new_filename;
            saveData['is_file'] = 1;
            saveData['file_name'] = filename;

            saveData['sender_id'] = data.sender_id;
            saveData['rec_id'] = data.rec_id;
            saveData['group_id'] = data.group_id;
            console.log(saveData);


            msgModel.create(saveData).then(function (result) {
                console.log(data.sender_id + '.........');
                userModel.getUserForChat(data.sender_id, function (senderData) {
                    data['user_image'] = senderData.image_url;
                    data['user_name'] = senderData.name;
                    data['file_name'] = filename;
                    data['file_url'] = '/uploads/chat/' + new_filename;
                    io.sockets.in('group_' + data.group_id).emit('downloadFile', data);


                    var isRec = '';
                    if (data.chat_type == 'group_') {
                        isRec = from;
                    }
                    if (data.chat_type == 'user_') {
                        isRec = data.rec_id;
                        io.sockets.in(data.chat_type + data.sender_id).emit('downloadFile', data);
                    }
                    console.log(data.chat_type + isRec);

                    io.sockets.in(data.chat_type + isRec).emit('downloadFile', data);


                });
            });




        });

        console.log('bye.........................');


        //io.sockets.in('group_' + data.send_to).emit('msgRecive', data);

    });
});





io.on('connection', function (socket) {
    console.log('socket is working...');


    socket.on('join', function (data) {

        socket.join('user_' + data.id);
        console.log('user_' + data.id);
        grpModel.getMyGroupsIds(data, function (groups) {
            async.forEach(groups, function (rows, callback) {
                socket.join('group_' + rows.group_id);
                console.log('join ' + rows.group_id);
            });
        });
        //var clients = io.sockets.adapter.rooms[data.id];
        //console.log(clients);
        //socket.broadcast.to('16').send('im here');
        console.log('is joing we are chk :- ' + data.id);

    });




    socket.on('send', function (from, data) {
        console.log(data);
        //data.sender_id = req.user.id;
        console.log(data);
        msgModel.create(data).then(function (data2) {
            console.log('data save is done');
            console.log(from);
            userModel.getUserForChat(data.sender_id, function (senderData) {

                data['user_image'] = senderData.image_url;
                data['user_name'] = senderData.name;
                console.log(data);

                var isRec = '';
                if (data.chat_type == 'group_') {
                    isRec = from;
                }
                if (data.chat_type == 'user_') {
                    isRec = data.rec_id;
                }
                console.log(data.chat_type + isRec);

                io.sockets.in(data.chat_type + isRec).emit('msgRecive', data);
            });
        });
    });

});




// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');
app.set('layout', 'front/layout/homeLayout');
app.set("layout extractScripts", true);


var user = require('./model/User');
var env = require('./config/env');

app.use(expressLayouts);

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
//app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));
app.use(expressValidator());


var sessionStore = new MySQLStore(env.db);
app.use(session({
    secret: 'acadoniasession',
    store: sessionStore,
    resave: true,
    saveUninitialized: true
}));

app.use(passport.initialize());
app.use(passport.session());

var passView = function (req, res, next) {


    var arr = req.originalUrl.split('/');
    var modl, act;
    if (arr.length >= 1) {
        modl = arr[1]
    }

    if (arr.length == 2) {
        act = arr[2]
    }

    app.locals.site = {
        logoName: "Acadonia",
        logoUrl: "/front/assets/img/logo.png",
        siteTitle: "Acadonia",
        pageTitle: "Acadonia",
        author: "Acadonia",
        description: "Acadonia",
        page: 10,
        theme: 'skin-blue sidebar-mini',
        logo: '',
        copyRight: '© 2016 Acadonia. All rights reserved.',
        version: '1.0',
        curUrl: req.originalUrl,
        isModel: modl,
        isAction: act
    }

    modelAds.getAll(req, function (adsData) {
        app.locals.adsData = adsData;
    });


    if (typeof req.user !== 'undefined' && req.user) {
        app.locals.loginUser = req.user;

        if (app.locals.site.isModel == 'notification') {

            modelNoty.setRead(req, function (notyData) {
                modelNoty.count(req, function (notyData) {
                    app.locals.notyData = notyData;
                    next();
                });
            });


        } else {
            modelNoty.count(req, function (notyData) {
                app.locals.notyData = notyData;
                next();
            });
        }



    } else {
        app.locals.loginUser = {};
        next();
    }




};

app.use(passView);


app.use(flash());




passport.use(new FacebookStrategy({
    clientID: env.facebook.clientID,
    clientSecret: env.facebook.clientSecret,
    callbackURL: env.facebook.callbackURL,
    profileFields: ['id', 'displayName', 'photos', 'email']
}, function (accessToken, refreshToken, profile, done) {
    user.socialLogin(profile, function (userData) {
        done('', userData);
    });
}
));



app.get('/auth/facebook', passport.authenticate('facebook', {scope: 'email'}));

app.get('/auth/facebook/callback',
        passport.authenticate('facebook', {successRedirect: env.facebook.successRedirect,
            failureRedirect: env.facebook.failureRedirect
        }));




passport.use(new GoogleStrategy({
    clientID: env.google.clientID,
    clientSecret: env.google.clientSecret,
    callbackURL: env.google.callbackURL
},
function (accessToken, refreshToken, profile, done) {
    user.socialLogin(profile, function (userData) {
        done('', userData);
    });
}
));



app.get('/auth/google',
        passport.authenticate('google', {scope: ['https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/userinfo.email']}));
app.get('/auth/google/callback',
        passport.authenticate('google', {failureRedirect: env.google.failureRedirect}),
        function (req, res) {
            res.redirect(env.google.successRedirect);
        });




app.use('/', routes);
app.use('/users', users);
app.use('/class', classes);
app.use('/farm', farm);
app.use('/message', message);
app.use('/admin', admin);
app.use('/group', group);

// catch 404 and forward to error handler
app.use(function (req, res, next) {
    var err = new Error('Not Found');
    err.status = 404;
    next(err);
});


/*
 *Custom validator
 *Used to match password on sign up page
 */
app.use(expressValidator({
    customValidators: {
        password_match: function (pass1, pass2) {
            return pass1 == pass2;
        },
        validPrice: function (pass1) {
            var regex = /^[1-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/;
            if (regex.test(pass1)) {
                return true;
            } else {
                return false;
            }
        },
		checkAdsImage: function (image, file){
			console.log(file.length);
			if(file.length < 1 || file.length == undefined){
				return false;
            } else {
                return true;
            }
		}

    }}));



// error handlers

// development error handler
// will print stacktrace
if (app.get('env') === 'development') {
    app.use(function (err, req, res, next) {
        res.status(err.status || 500);
        res.render('error', {
            message: err.message,
            error: err,
            layout: false
        });
    });
}

// production error handler
// no stacktraces leaked to user
app.use(function (err, req, res, next) {
    res.status(err.status || 500);
    res.render('error', {
        message: err.message,
        error: {}
    });
});





module.exports = app;
