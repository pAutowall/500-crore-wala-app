const { body, validationResult } = require('express-validator');
const asyncHandler = require('express-async-handler');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const db = require("../connections/db");
const dotenv = require("dotenv");
dotenv.config();

exports.register = [
    body("name")
        .trim()
        .escape()
        .notEmpty()
        .withMessage("Name must be specified.")
        .isAlphanumeric()
        .withMessage("Name has non-alphanumeric characters."),
    body("email")
        .trim()
        .escape()
        .notEmpty()
        .withMessage("Email must be specified.")
        .isEmail()
        .withMessage("Invalid email."),
    body("password")
        .trim()
        .escape()
        .notEmpty()
        .withMessage("Password must be specified."),
    asyncHandler(async (req, res) => {
        const errors = validationResult(req);
        if (!errors.isEmpty()) {
            res.status(400).send({ status: 400, message: errors.array() });
            return;
        }
        try {
            const hashedPassword = await bcrypt.hash(req.body.password, 10);
            const user = {
                name: req.body.name,
                email: req.body.email,
                password: hashedPassword
            };
            const query = 'INSERT INTO users SET ?';
            db.query(query, user, (error, result) => {
                if (error) {
                    if (error.code === 'ER_DUP_ENTRY') {
                        res.status(400).send({ status: 400, message: 'User already exists with this email' });
                        return;
                    }
                    res.status(500).send({ status: 500, message: 'Internal Server Error' });
                    return;
                }
                jwt.sign({ name: user.name, email: user.email }, process.env.SECRET_KEY, (err, token) => {
                    if (err) {
                        res.status(500).send({ status: 500, message: 'Internal Server Error' });
                        return;
                    }
                    res.status(201).send({ status: 201, message: 'User Registered Successfully', token: token, user: { name: user.name, email: user.email } });
                });
            });
        } catch (error) {
            console.log(error);
            res.status(500).send({ status: 500, message: 'Internal Server Error' });
        }
    }),
]

exports.login = [
    body("email")
        .trim()
        .escape()
        .notEmpty()
        .withMessage("Email must be specified.")
        .isEmail()
        .withMessage("Invalid email."),
    body("password")
        .trim()
        .escape()
        .notEmpty()
        .withMessage("Password must be specified."),
    asyncHandler(async (req, res) => {
        const errors = validationResult(req);
        if (!errors.isEmpty()) {
            res.status(400).send({ status: false, message: errors.array() });
            return;
        }
        try {
            const { email, password } = req.body;
            const query = 'SELECT * FROM users WHERE email = ?';
            db.query(query, [email], async (error, results) => {
                if (error) {
                    res.status(500).send({ status: 500, message: 'Internal Server Error' });
                    return;
                }
                if (results.length === 0) {
                    res.status(400).send({ status: 400, message: 'User not found with this email' });
                    return;
                }
                const user = results[0];
                const isMatch = await bcrypt.compare(password, user.password);
                if (!isMatch) {
                    res.status(400).send({ status: 400, message: 'Invalid Password' });
                    return;
                }
                jwt.sign({ name: user.name, email: user.email }, process.env.SECRET_KEY, (err, token) => {
                    if (err) {
                        res.status(500).send({ status: 500, message: 'Internal Server Error' });
                        return;
                    }
                    res.status(200).send({ status: 200, message: 'User Logged In Successfully', token: token, user: { name: user.name, email: user.email } });
                });
            });
        } catch (error) {
            console.log(error);
            res.status(500).send({ status: 500, message: 'Internal Server Error' });
        }
    }),
];