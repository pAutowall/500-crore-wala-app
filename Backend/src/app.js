const express = require("express");
const compression = require("compression");
const app = express();
const cors = require("cors");
const createError = require('http-errors');


const auth = require('./routes/auth');

app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cors());
app.use(compression());

app.use('/v1/api/auth', auth);

app.use(function(req, res, next) {
    res.status(404).send(createError(404, 'Not Found'));
});

app.listen(process.env.PORT || 4200, () => {
    console.log('Listening on Port', process.env.PORT || 4200)
});
