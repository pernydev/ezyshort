<!-- !! DELETE THIS FILE AFTER SETUP !! -->

<!--
    MIT License

    Copyright (c) 2022 pernydev

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
-->

<?php
    if (!extension_loaded('sqlite3')) {
        echo "SQLite3 extension not loaded. Please enable it before continuing. We would do this for you, but dl() is deprecated.";
    }

    if (!file_exists('database.db')) {
        touch('database.db');
    } else {
        echo 'Database already exists. Please delete database.db before continuing. This is a security measure.';
        return;
    }

    $query_string = $_SERVER['QUERY_STRING'];
    parse_str($query_string, $query_params);

    if (!isset($query_params['token'])) {
        echo '
        <h1>Setup</h1>
        <h2>Welcome to EzyShort! The setup is a bit too easy! Just enter a token to this ugly installer and you\'re good to go!</h2>
        <form action="setup.php" method="get">
            <input type="text" name="token" placeholder="Token">
            <button type="submit">Set token</button>
        </form>
        ';
        return;
    }
    $token = $query_params['token'];

    $db = new SQLite3('database.db');
    $sql = file_get_contents('table.sql');
    $db->exec($sql);

    // insert token
    $query = $db->prepare('INSERT INTO tokens (token) VALUES (:token)');
    $query->bindValue(':token', $token);
    $query->execute();

    echo 'Setup complete. Please delete setup.php.';
?>

