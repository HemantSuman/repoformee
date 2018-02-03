var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function (req, res, next) {
    res.render('index', {title: 'Express'});
});

router.get('/api', function (req, res, next) {
    var request = require("request");

    var options = {method: 'POST',
        url: 'http://192.168.100.242/avinesh/formeenew/api/send_msg_api',
        headers:
                {
                    authorization: 'Basic Zm9ybWVlbW9iaWxlOmRmNmY2ODYyODU4YzkwY2ZmNjMwNGQ4ZjI1ZDhmM2U5',
                    'content-type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'},
        form:
                {classifiedid: '1',
                    classifieduser_id: '2',
                    user_id: '5',
                    massage: '2'}};

    request(options, function (error, response, body) {
        if (error)
            throw new Error(error);

        console.log(body);
        res.send(body);
    });

});

module.exports = router;
