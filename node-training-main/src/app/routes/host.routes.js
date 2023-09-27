module.exports = app => {
    const hosts = require("../controllers/hosts.controller.js");

    var router = require("express").Router();

    router.get("/", hosts.findAll);

    app.use('/host/users', router);
}