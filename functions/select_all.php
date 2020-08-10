<?php

function selectField2($table, $field, $where, $id)
{
    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
    } catch (Exception $e) {
        // if unable to connect to the database
        echo "Could not connect to the database";
        exit;
    }
    try {
        $result = $db->prepare("SELECT {$field} FROM {$table} WHERE {$where} = ?");
        $result->bindParam(1, $id);
        $result->execute();
    } catch (Exception $e) {
        echo "could not retrive data, something went wrong ($table) ";
        exit;
    }
    //pass the query into the product variable
    $return = $result->fetch(PDO::FETCH_ASSOC);

    $reply = $return[$field];
    return $reply;
}


function delete_all($table)
{
    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
    } catch (Exception $e) {
        // if unable to connect to the database
        echo "Could not connect to the database";
        exit;
    }
    try {
        $result = $db->prepare("DELETE FROM {$table}");

        $result->execute();
    } catch (Exception $e) {
        echo "could not retrive data, something went wrong ($table) ";
        exit;
    }
}

// Select all values from the database DESC
function select_all($table)
{
    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
    } catch (Exception $e) {
        // if unable to connect to the database
        echo "Could not connect to the database";
        exit;
    }
    try {
        $result = $db->query("SELECT * FROM {$table} ORDER BY id DESC");
    } catch (Exception $e) {
        echo "could not retrive data, something went wrong ($table) ";
        exit;
    }
    //pass the query into the product variable
    $return = $result->fetchAll(PDO::FETCH_ASSOC);

    return $return;
}

// To fetch existing user
function selectExistUser($table, $field, $params)
{
    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
    } catch (Exception $e) {
        // if unable to connect to the database
        echo "Could not connect to the database";
        exit;
    }
    try {
        $result = $db->prepare("SELECT * FROM {$table} WHERE {$field} = ? ");
        $result->bindParam(1, $params);
        $result->execute();
    } catch (Exception $e) {
        echo "could not select data, something went wrong ($table) ";
        exit;
    }
    $return = $result->rowCount();

    return $return;
}

function selectValueCount($table, $field, $params)
{
    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
    } catch (Exception $e) {
        // if unable to connect to the database
        echo "Could not connect to the database";
        exit;
    }
    try {
        $result = $db->prepare("SELECT * FROM {$table} WHERE {$field} = ? ");
        $result->bindParam(1, $params);
        $result->execute();
    } catch (Exception $e) {
        echo "could not count available data, something went wrong ($table) ";
        exit;
    }
    $return = $result->rowCount();

    return $return;
}

function checkIfMovieExist($table, $field1, $params1, $field2, $params2)
{
    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
    } catch (Exception $e) {
        // if unable to connect to the database
        echo "Could not connect to the database";
        exit;
    }
    try {
        $result = $db->prepare("SELECT * FROM {$table} WHERE {$field1} = ? AND {$field2} = ? ");
        $result->bindParam(1, $params1);
        $result->bindParam(2, $params2);
        $result->execute();
    } catch (Exception $e) {
        echo "could not find existing movie in Cart, something went wrong ($table) ";
        exit;
    }
    $return = $result->rowCount();

    return $return;
}

function select_all_value($table, $field, $where, $params)
{
    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
    } catch (Exception $e) {
        // if unable to connect to the database
        echo "Could not connect to the database";
        exit;
    }
    try {
        $result = $db->prepare("SELECT {$field} FROM {$table} WHERE {$where} = ?");
        $result->bindParam(1, $params);
        $result->execute();
    } catch (Exception $e) {
        echo "could not retrive data, something went wrong ($table) ";
        exit;
    }
    //pass the query into the product variable
    $return = $result->fetchAll(PDO::FETCH_ASSOC);

    return $return;
}

function select_sum($table, $column, $field, $params)
{
    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
    } catch (Exception $e) {
        // if unable to connect to the database
        echo "Could not connect to the database";
        exit;
    }
    try {
        $result = $db->prepare("SELECT SUM(`{$column}`) as total FROM {$table} WHERE {$field} = ?");
        $result->bindParam(1, $params);
        $result->execute();
    } catch (Exception $e) {
        echo "could not retrive data, something went wrong ($table) ";
        exit;
    }
    //pass the query into the product variable
    $return = $result->fetch(PDO::FETCH_ASSOC);

    return $return;
}
