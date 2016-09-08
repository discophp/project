<h1>Project Wrapper for the Disco PHP Framework</h1>

<p>This is the project structure for the Disco PHP Framework. It serves as the starting point for all Disco PHP
projects.</p>

<p>Check out the documentation</p>

<a href='http://discophp.com'>DiscoPHP.com</a>

<h2>Out Of The Box Features</h2>

<p>The base project structure comes preloaded with some awesome out of the box features which almost every project
implements:</p>
<ul>
    <li>
        Account/User:
        <ul>
            <li>Account creation</li>
            <li>Email based account verification</li>
            <li>Login, logout, and session management</li>
            <li>Securly stored passwords hashed with SHA512 and salted</li>
            <li>Permanent logins</li>
            <li>Password reset emails</li>
            <li>Account information editing</li>
        </ul>
    </li>
    <li>CSRF Tokens</li>
    <li>An amazing looking base theme/UI for you to extend using <a href='http://materializecss.com'>Materialize
    CSS</a></li>
    <li>A build system ([`Gruntfile.js`](Gruntfile.js)) implemented using <a href='http://gruntjs.com/'>Grunt</a> which supports:
        <ul>
            <li>SASS</li>
            <li>React JSX files</li>
            <li>CSS vendor based auto-prefixing (ie -moz -webkit)</li>
            <li>CSS & JS minification</li>
            <li>CSS & JS bundling</li>
        </ul>
    </li>
    <li>Version controlled third party libraries ([`bower.js`](bower.js) & [`.bowerrc`](.bowerrc)) via <a href='https://bower.io/'>Bower</a></li>
    <li>Default caching rules for resources (ie jpg,png,js,css etc) as defined in
    [`public/.htaccess`](public/.htacces)</li>
</ul>

<h3>Get Started</h3>

<b>Required:</b>
<ol>
    <li>Clone : `git clone https://github.com/discophp/project.git your-site`</li>
    <li>Install Dependencies : `composer install`</li>
</ol>

<b>Optional (but required if you want to use the DB & the built in user functionality):</b>
<ol>
    <li>Configure DB settings in [`app/config/config.php`](app/config/config.php)</li>
    <li>Create the user tables : `php public/index.php db-restore 'app/db' 'user.sql' from the SQL file
    [`app/db/user.sql`](app/db/user.sql)</li>
    <li>Configure your email settings in [`app/config/email.php`](app/config/email.php)</li>
</ol>

<b>Optional (but required if you want to use the build system)</b>
<ol>
    <li>Install nodejs dependencies : `npm install`</li>
    <li>Run the build system : `grunt`</li>
    <li>Watch the build for changes : `grunt watch`</li>
</ol>
