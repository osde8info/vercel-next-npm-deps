// Require node-oauth package: npm install oauth
// Copyright 2019 Oath Inc. Licensed under the terms of the zLib license see https://opensource.org/licenses/Zlib for terms.

require('dotenv').config();

var OAuth = require('oauth');

var request = new OAuth.OAuth(
    null,
    null,
    process.env.MY_YAHOO_API_KEY,
    process.env.MY_YAHOO_API_SECRET,
    '1.0',
    null,
    'HMAC-SHA1',
    null,
    {
        "X-Yahoo-App-Id": process.env.MY_YAHOO_API_APP_ID
    }
);

request.get(
    'https://weather-ydn-yql.media.yahoo.com/forecastrss?location=brighton,uk&format=json',
    null,
    null,
    function (err, data, result) {
        if (err) {
            console.log(err);
        } else {
            console.log(data)
        }
    }
);

