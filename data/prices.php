<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('connect_mysql.php');
    
    // update prices
    print("Updating prices...");
    $file = fopen("prices.csv","r");
    while (($data = fgetcsv($file, 0, ',','"')) !== FALSE) 
    {
            $query = "
                UPDATE `jmla_wcatalog_products` SET description = '".implode('---', $data)."' WHERE id = 1870;
            ";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
            die;
    }