const fs = require('fs');

const to = process.argv[2];
const json = JSON.parse(fs.readFileSync(`${__dirname}/resources/lang/en.json`));

let x = Object.keys(json);
let translated = fs.readFileSync(`${__dirname}/resources/lang/${to}.txt`).toString();
translated = translated.split("\n");

let result = {};

for (let i = 0; i < x.length; i++) {
    result[x[i]] = translated[i];
}


fs.writeFileSync(`${__dirname}/resources/lang/${to}.json`, JSON.stringify(result));