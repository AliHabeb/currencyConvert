#How To run the App

<h4>what you need</h4>

<ol>
    <li>PHP 7.x</li>
    <li>Composer ( php package manager )</li>
    <li>Mysql</li>
</ol>

<h4> How To Install </h4>

<ol>
    <li>donload the repository</li>
    <li>unzip it to a folder</li>
    <li>go to .env and set the database url</li>
    <li>open cmd(for windows) or termenal(for linux) on the folder and run this command <code>php composer.phar install</code></li>
    <li>to download data from source one ( ecb) run command <code>php bin/console app:getData ecb</code> and for (cbr) run <code>php bin/console app:getData cbr</code></li>
    <li>to change data source run command <code>php bin/console app:ChangeSource ecb</code> for ecb source and <code>php bin/console app:ChangeSource cbr</code> for cbr source</li>
</ol>

<h4>How to Use the API</h4>

<p>just make POST request on the apiUrl and the body must have 3 propertes (from,to,amount)</p>

