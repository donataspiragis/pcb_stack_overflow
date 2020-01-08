# pcb_stack_overflow
B Group Stack Overflow project
           ----CB-B STACK OVERFLOW KILLER----
           
            --Functionality--

- search questions related to language;
- search questions related to topic;
- search questions related to topic and language;
- add your own topic;
- add your own examples to topic;
- edit others or your own topic;
- edit others or your own examples;
- check statistics of most viewed topics;
                
                 --Folder structue--

Main folder structure: 
- app (folder) - holds main models and controllers. (BaseController, ExamplesController, FrontPageController, MenuController, StatisticsController, TopicController. Models: App, Route)
- DataBase (folder) - holds files with database tables and imports to database.
- public (folder) - holds files of styling (css folder), javascript (js folder) and main php file which is starting app.
- src (folder) - holds files of styling (css folder), javascript (js folder), which are generated
to public folder later and templates of views which are given to browser.
- config files are in main directory of project.


                -- Starting project from zero -- 

Start Project with creating file newConfig.php in main directory of files structure.
Copy to newConfig all information from file config.php and change data by your created database and login data.

After in terminal enter step by step commands:
 - composer install
 - npm install
 - npm i bootstrap
 - npm i webpack
 - create folder:
    src ,inside create
    js inside create
        index.js
 - create file: webpack.config.js
 in file:
    const path = require('path');
        module.exports = {
        mode: 'development',
        entry: './src/js/index.js',
        output: {
            path: path.resolve(__dirname, 'public/js'),
            filename: 'main.js'
        },
  watch: true
        };
npx webpack --config webpack.config.js
npm init -y
failas package.json skiltis po devDependencies turi buti tokia:
  "devDependencies": {},
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "webpack": "webpack"
  },

- npm run webpack

                -- After all installations --
After that in browser window call file named: createall.php
After tables created in browser call file named: importall.php

You are ready to use our product!

                   
