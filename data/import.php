<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once('connect_mysql.php');

    // remove all tables
    print("\n");
    print("Removing tables...");
    require_once('remove_tables.php');
    print("Success!\n");

    // create all tables
    print("Creating tables...");
    require_once('create_tables.php');
    print("Success!\n");
    
    // load categories
    print("Loading categories - level 1...");
    mysqli_query($mysqli, "
        INSERT INTO `jmla_wcatalog_categories` (`id`, `title`, `description`, `parent_id`, `ordering`, `level`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
        (1, 'Стальные защиты', '', 0, 1, 1, 1, '2016-02-01 02:13:43', 948, '0000-00-00 00:00:00', 0),
        (2, 'Алюминиевые защиты', '', 0, 2, 1, 1, '2016-02-01 02:14:03', 948, '0000-00-00 00:00:00', 0),
        (3, 'Амортизаторы капота', '', 0, 3, 1, 1, '2016-02-01 02:14:16', 948, '0000-00-00 00:00:00', 0),
        (4, 'Навесное оборудование', '', 0, 4, 1, 1, '2016-02-01 02:14:29', 948, '0000-00-00 00:00:00', 0),
        (5, 'Порог-площадки', '', 0, 5, 1, 1, '2016-02-01 02:14:42', 948, '0000-00-00 00:00:00', 0),
        (6, 'Эксклюзив! 6мм алюминиевая зашита', '', 0, 6, 1, 1, '2016-02-01 02:14:55', 948, '0000-00-00 00:00:00', 0),
        (7, 'Аксессуары для квадрациклов', '', 0, 7, 1, 1, '2016-02-01 02:15:06', 948, '0000-00-00 00:00:00', 0);
    ");
    print("Success!\n");
    
    // load categories
    print("Loading menu01 data...");
    $file = fopen("menu01.csv","r");
    $categories = array();
    $cat_ordering = 1;
    while (($data = fgetcsv($file, 0, ',','"')) !== FALSE) 
    {
        // insert category
        $category_name = strtoupper(trim($data[0]));
        $category = strtolower($category_name);
        if(!isset($categories[$category])) {
            $query = "
                INSERT INTO `jmla_wcatalog_categories` (`title`, `parent_id`, `ordering`, `level`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                ('".$category_name."', 1, ".$cat_ordering.", 2, 1, '2016-02-01 02:13:43', 948, '0000-00-00 00:00:00', 0);
            ";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
            $categories[$category] = $mysqli->insert_id;
            $cat_ordering++;
        }
        
        //insert product
        if(!empty(trim($data[3]))) {
            $title = $mysqli->real_escape_string(trim($data[3]));
            $desc = $mysqli->real_escape_string(trim($data[1]));
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString($data[3], $mysqli)."',
                '".prepareString($data[1], $mysqli)."',
                ".prepareInt($data[13]).",
                '".prepareString($data[5], $mysqli)."',
                ".$categories[$category].",
                1,
                '2016-02-01 00:00:00',
                948,
                '0000-00-00 00:00:00',
                0
            );";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
        }
    }
    fclose($file);    
    print("Success!\n");
    
    
    // load categories
    print("Loading menu02 data...");
    $file = fopen("menu02.csv","r");
    $categories = array();
    $cat_ordering = 1;
    while (($data = fgetcsv($file, 0, ',','"')) !== FALSE) 
    {
        // insert category
        $category_name = strtoupper(trim($data[0]));
        $category = strtolower($category_name);
        if(!isset($categories[$category])) {
            $query = "
                INSERT INTO `jmla_wcatalog_categories` (`title`, `parent_id`, `ordering`, `level`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                ('".$category_name."', 2, ".$cat_ordering.", 2, 1, '2016-02-01 02:13:43', 948, '0000-00-00 00:00:00', 0);
            ";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
            $categories[$category] = $mysqli->insert_id;
            $cat_ordering++;
        }
        
        //insert product
        if(!empty(trim($data[3]))) {
            $title = $mysqli->real_escape_string(trim($data[3]));
            $desc = $mysqli->real_escape_string(trim($data[1]));
            
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString($data[3], $mysqli)."',
                '".prepareString($data[1], $mysqli)."',
                ".prepareInt($data[15]).",
                '".prepareString($data[5], $mysqli)."',
                ".$categories[$category].",
                1,
                '2016-02-01 00:00:00',
                948,
                '0000-00-00 00:00:00',
                0
            );";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
        }
    }
    fclose($file);    
    print("Success!\n");
    
    
    // load categories
    print("Loading menu03 data...");
    $file = fopen("menu03.csv","r");
    $categories = array();
    $cat_ordering = 1;
    while (($data = fgetcsv($file, 0, ',','"')) !== FALSE) 
    {
        // insert category
        $category_name = strtoupper(trim($data[0]));
        $category = strtolower($category_name);
        if(!isset($categories[$category])) {
            $query = "
                INSERT INTO `jmla_wcatalog_categories` (`title`, `parent_id`, `ordering`, `level`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                ('".$category_name."', 3, ".$cat_ordering.", 2, 1, '2016-02-01 02:13:43', 948, '0000-00-00 00:00:00', 0);
            ";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
            $categories[$category] = $mysqli->insert_id;
            $cat_ordering++;
        }
        
        //insert product
        if(!empty(trim($data[3]))) {
            $title = $mysqli->real_escape_string(trim($data[3]));
            $desc = $mysqli->real_escape_string(trim($data[1]));
            
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString($data[2], $mysqli)."',
                '".prepareString($data[0].' '.$data[1].' '.$data[3], $mysqli)."',
                ".prepareInt($data[11]).",
                '".prepareString($data[4], $mysqli).'.jpg'."',
                ".$categories[$category].",
                1,
                '2016-02-01 00:00:00',
                948,
                '0000-00-00 00:00:00',
                0
            );";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
        }
    }
    fclose($file);    
    print("Success!\n");    
    
    
    // load categories
    print("Loading menu04 data...");
    $file = fopen("menu04.csv","r");
    $categories = array();
    $cat_ordering = 1;
    while (($data = fgetcsv($file, 0, ',','"')) !== FALSE) 
    {
        // insert category
        $category_name = strtoupper(trim($data[0]));
        $category = strtolower($category_name);
        if(!isset($categories[$category])) {
            $query = "
                INSERT INTO `jmla_wcatalog_categories` (`title`, `parent_id`, `ordering`, `level`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                ('".$category_name."', 4, ".$cat_ordering.", 2, 1, '2016-02-01 02:13:43', 948, '0000-00-00 00:00:00', 0);
            ";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
            $categories[$category] = $mysqli->insert_id;
            $cat_ordering++;
        }
        
        //insert product
        if(!empty(trim($data[3]))) {
            $title = $mysqli->real_escape_string(trim($data[3]));
            $desc = $mysqli->real_escape_string(trim($data[1]));
            
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString($data[3], $mysqli)."',
                '".prepareString($data[0].' '.$data[1].' '.$data[2], $mysqli)."',
                ".prepareInt($data[6]).",
                '".prepareString($data[5], $mysqli)."',
                ".$categories[$category].",
                1,
                '2016-02-01 00:00:00',
                948,
                '0000-00-00 00:00:00',
                0
            );";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
        }
    }
    fclose($file);    
    print("Success!\n");
    
    
    // load categories
    print("Loading menu05 data...");
    $file = fopen("menu05.csv","r");
    $categories = array();
    $cat_ordering = 1;
    while (($data = fgetcsv($file, 0, ',','"')) !== FALSE) 
    {
        // insert category
        $category_name = strtoupper(trim($data[0]));
        $category = strtolower($category_name);
        if(!isset($categories[$category])) {
            $query = "
                INSERT INTO `jmla_wcatalog_categories` (`title`, `parent_id`, `ordering`, `level`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                ('".$category_name."', 5, ".$cat_ordering.", 2, 1, '2016-02-01 02:13:43', 948, '0000-00-00 00:00:00', 0);
            ";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
            $categories[$category] = $mysqli->insert_id;
            $cat_ordering++;
        }
        
        //insert product
        if(!empty(trim($data[3]))) {
            $title = $mysqli->real_escape_string(trim($data[3]));
            $desc = $mysqli->real_escape_string(trim($data[1]));
            
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString('Порог-площадка + крепеж', $mysqli)."',
                '".prepareString($data[0].' '.$data[1].' '.$data[2], $mysqli)."',
                ".prepareInt($data[6]).",
                '".prepareString($data[4].'.jpg', $mysqli)."',
                ".$categories[$category].",
                1,
                '2016-02-01 00:00:00',
                948,
                '0000-00-00 00:00:00',
                0
            );";
            $result = mysqli_query($mysqli, $query);
            if(!$result) {
                print($query."\n\n".mysqli_error($mysqli)."\n");
                die;
            }
        }
    }
    fclose($file);    
    print("Success!\n");    
    
    
    function prepareString($string, $mysqli) {
        return $mysqli->real_escape_string(trim($string));
    }
    
    function prepareInt($string) {
        if(!empty(trim($string))) return $string;
        else return 'NULL';
    }
    