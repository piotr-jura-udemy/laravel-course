const fs = require('fs');

const to = process.argv[2];
const json = JSON.parse(fs.readFileSync(`${__dirname}/resources/lang/en.json`));

let x = Object.keys(json);
x = x.reduce((acc, curr) => {
    if (curr != '') {
        acc += curr + "\n";
    }
    
    return acc;
}, "");

fs.writeFileSync(`${__dirname}/resources/lang/${to}.txt`, x);