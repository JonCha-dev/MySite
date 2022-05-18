const { MongoClient, ServerApiVersion } = require('mongodb');
const uri = "mongodb+srv://j3chang:Chelly_1@cluster0.57zft.mongodb.net/?retryWrites=true&w=majority";
const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true, serverApi: ServerApiVersion.v1 });
//const mongo = require('mongodb').MongoClient;
//const url = 'mongodb://localhost:27017';
const dbname = 'localdb';
const options = { "upsert" : true };

const fs = require('fs');
const fname = './db.json';

updatemongo();

fs.watchFile(fname, (curr, prev) => {
    updatemongo();
});

function updatemongo() {

    fs.readFile('./db.json','utf-8',function(err, data) {
        var jsonString = data;
        var jsonData = JSON.parse(jsonString);

        //mongo.connect(url, (err, client) => {
        client.connect(err => {
            if (err) throw err;
            var db = client.db(dbname);

            for (var i=0; i < jsonData.static.length; i++) {
                    var new_entry = jsonData.static[i];
                
                    db.collection('static').updateOne(new_entry, { $set: new_entry }, options);
            }

            for (var i=0; i < jsonData.performance.length; i++) {
                var new_entry = jsonData.performance[i];
            
                db.collection('performance').updateOne(new_entry, { $set: new_entry }, options);
            }

            for (var i=0; i < jsonData.activity.length; i++) {
                var new_entry = jsonData.activity[i];
            
                db.collection('activity').updateOne(new_entry, { $set: new_entry }, options);
            }
        });
    });
}