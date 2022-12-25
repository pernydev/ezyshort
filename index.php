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
    if (file_exists('setup.php')) {
        echo 'Please delete setup.php before continuing. The file can be used to wipe the database.';
        return;
    }
    
    $db = new SQLite3('database.db');

    $query_string = $_SERVER['QUERY_STRING'];
    parse_str($query_string, $query_params);
    
    if (isset($query_params['l'])) {
        $name = $query_params['l'];
        $query = $db->prepare('SELECT url FROM links WHERE name = :name');
        $query->bindValue(':name', $name);
        $result = $query->execute();
        $row = $result->fetchArray();
        if ($row) {
            header('Location: ' . $row['link']);
        } else {
            echo 'Link not found.';
        }
    } else {
        echo 'No link specified.';
    }
?>



