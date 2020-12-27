
## PUPQC Alumni Portal 
### Version 1.0

Initial Setup Contains:
1. Database migration is complete, just run ```php artisan migrate:fresh```
2. Routing setup for front, admin, API is complete, just add your addtional custom routes.
3. Format for providing response from back-end to front-end is provided, see ```ResponseLib.php``` (The ResponseLib will also be used for API controllers)
4. run ```composer update``` before using/running the app. If you don't have composer, download and install it first.
5. Vue is already integrated in laravel (blade.php) See ```main.blade.php``` in view directory.
- To run vue in laravel, you must install first the node.js  ```https://nodejs.org/dist/v14.15.3/node-v14.15.3-x64.msi``` (64-bit installer)
- Go to project directory, and run ```npm install```
- After running ```npm install``` and the installation is finished, run ```npm install vue```
- After that, to test if the vue is working, try to create a component and integrate it to a blade, then run ```npm run dev``` (For 1 time compilation) or ```npm run watch``` for continuous compilation of assets (js, css, view files) for every changes.

#### NOTE: ```.env``` (local) is in the ```.env.example``` file, while the vhost used for xampp is in the ```sample vhost.txt```
