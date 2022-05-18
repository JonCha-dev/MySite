// app.js file
const { MongoClient, ServerApiVersion } = require('mongodb');
const uri = "mongodb+srv://j3chang:Chelly_1@cluster0.57zft.mongodb.net/?retryWrites=true&w=majority";
const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true, serverApi: ServerApiVersion.v1 });
//var MongoClient = require('mongodb').MongoClient;
var express = require('express');
var app = express();

//var url = 'mongodb://localhost:27017';

//MongoClient.connect(url, function(err, client) {
client.connect(err => {
    if (err) throw err;
    db = client.db('localdb');
});

app.get('/static', function(req, res) {
    db.collection('static').find({}).toArray(function(err, docs) {
        res.send(docs);
    });
})

app.get('/performance', function(req, res) {
    db.collection('performance').find({}).toArray(function(err, docs) {
        res.send(docs);
    });
})

app.get('/activity', function(req, res) {
    db.collection('activity').find({}).toArray(function(err, docs) {
        res.send(docs);
    });
})

app.listen(3000, () => {
    console.log(`app listening at port 3000`)
})

var jsonServer = require('json-server');

// Returns an Express server
var server = jsonServer.create();

// Set default middlewares (logger, static, cors and no-cache)
server.use(jsonServer.defaults());

// Add custom routes
// server.get('/custom', function (req, res) { res.json({ msg: 'hello' }) })

// Returns an Express router
var router = jsonServer.router('db.json');

server.use(router);

server.listen(3001);