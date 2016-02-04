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
            $description = '';
            $description .= '<p><strong>Толщина металла:</strong> '.$data[6].'</p>';
            $description .= '<p><strong>Наличие крепежа:</strong> '.$data[7].'</p>';
            $description .= '<p><strong>Время установки:</strong> '.$data[8].'</p>';
            $description .= '<p><strong>Размер:</strong> '.$data[9].'мм Х '.$data[10].'мм Х '.$data[11].'мм</p>';
            $description .= '<p><strong>Масса (кг):</strong> '.$data[12].'</p>';
            
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `make`, `model`, `year`, `article`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString($data[3], $mysqli)."',
                '".fupper($category_name)."',
                '".prepareString($data[1], $mysqli)."',
                '".prepareString($data[2], $mysqli)."',
                '".prepareString($data[4], $mysqli)."',
                '".prepareString($description, $mysqli)."',
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
            $description = '';
            $description .= '<p><strong>Глубокий штамп:</strong> '.$data[6].'</p>';
            $description .= '<p><strong>Толщина металла:</strong> '.$data[7].'</p>';
            $description .= '<p><strong>Наличие крепежа:</strong> '.$data[8].'</p>';
            $description .= '<p><strong>Время установки:</strong> '.$data[9].'</p>';
            $description .= '<p><strong>Замена масла и фильтра без снятия защиты:</strong> '.$data[10].'</p>';
            $description .= '<p><strong>Размер:</strong> '.$data[11].'мм Х '.$data[12].'мм Х '.$data[13].'мм</p>';
            $description .= '<p><strong>Масса (кг):</strong> '.$data[14].'</p>';
            
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `make`, `model`, `year`, `article`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString($data[3], $mysqli)."',
                '".prepareString($category_name, $mysqli)."',
                '".prepareString($data[1], $mysqli)."',
                '".prepareString($data[2], $mysqli)."',
                '".prepareString($data[4], $mysqli)."',
                '".prepareString($description, $mysqli)."',
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
            $description = '';
            $description .= '<p><strong>Время установки:</strong> '.$data[6].'</p>';
            $description .= '<p><strong>Размер:</strong> '.$data[7].'мм Х '.$data[8].'мм Х '.$data[9].'мм</p>';
            $description .= '<p><strong>Масса (кг):</strong> '.$data[10].'</p>';
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `make`, `model`, `year`, `article`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString($data[2], $mysqli)."',
                '".prepareString($category_name, $mysqli)."',
                '".prepareString($data[1], $mysqli)."',
                '".prepareString($data[3], $mysqli)."',
                '".prepareString($data[4], $mysqli)."',
                '".prepareString($description, $mysqli)."',
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
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `make`, `model`, `year`, `article`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString($data[3], $mysqli)."',
                '".prepareString($category_name, $mysqli)."',
                '".prepareString($data[1], $mysqli)."',
                '".prepareString($data[2], $mysqli)."',
                '".prepareString($data[4], $mysqli)."',
                '',
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
            $description = '';
            $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `make`, `model`, `year`, `article`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
            (
                '".prepareString('Порог-площадка + крепеж', $mysqli)."',
                '".prepareString($category_name, $mysqli)."',
                '".prepareString($data[1], $mysqli)."',
                '".prepareString($data[2], $mysqli)."',
                '".prepareString($data[4], $mysqli)."',
                '".prepareString($description, $mysqli)."',
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

    
    // load categories
    print("Loading menu06 data...");
    $dir = '/var/www/html/66.175.212.71/comcar/images/wcatalog/products_6/';
    if (is_dir($dir)){
        if ($dh = opendir($dir)){
            $categories = array();
            $cat_ordering = 1;
            while (($file = readdir($dh)) !== false){
                
                if($file != '.' && $file != '..') {
                    // insert category
                    $category_name_array = explode(' ', trim($file));
                    $category_name = strtoupper($category_name_array[0]);
                    $category = strtolower($category_name);
                    if(!isset($categories[$category])) {
                        $query = "
                            INSERT INTO `jmla_wcatalog_categories` (`title`, `parent_id`, `ordering`, `level`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                            ('".$category_name."', 6, ".$cat_ordering.", 2, 1, '2016-02-01 02:13:43', 948, '0000-00-00 00:00:00', 0);
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
                    $title = '6мм алюминиевая зашита';
                    $make_name = fupper($category_name);
                    $model_name = trim(str_replace($make_name, '', $file));
                    $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `make`, `model`, `year`, `article`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                    (
                        '".$title."',
                        '".prepareString($category_name, $mysqli)."',
                        '".prepareString($model_name, $mysqli)."',
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        '".$file."/JPEG/1.jpg',
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
            closedir($dh);
        }
    }
    print("Success!\n");    

    
    // load categories
    print("Loading menu07 data...");
    $file = fopen("menu07.csv","r");
    $categories = array();
    $cat_ordering = 1;
    while (($data = fgetcsv($file, 0, ',','"')) !== FALSE) 
    {
        // insert category
        if(empty(trim($data[1]))){
            $category_name = strtoupper(trim($data[0]));
            $category = strtolower($category_name);
            if(!isset($categories[$category])) {
                $query = "
                    INSERT INTO `jmla_wcatalog_categories` (`title`, `parent_id`, `ordering`, `level`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                    ('".$category_name."', 7, ".$cat_ordering.", 2, 1, '2016-02-01 02:13:43', 948, '0000-00-00 00:00:00', 0);
                ";
                $result = mysqli_query($mysqli, $query);
                if(!$result) {
                    print($query."\n\n".mysqli_error($mysqli)."\n");
                    die;
                }
                $categories[$category] = $mysqli->insert_id;
                $cat_ordering++;
            }
        }else {
            //insert product
            $article_arr = explode('.', $data[3]);
            if(!empty(trim($data[2])) || $article_arr[0] == '444') {
                $query = "INSERT INTO `comcar`.`jmla_wcatalog_products` (`title`, `make`, `model`, `year`, `article`, `description`, `price`, `image`, `category_id`, `published`, `created`, `created_by`, `modified`, `modified_by`) VALUES
                (
                    '".prepareString($data[0], $mysqli)."',
                    '".prepareString($category_name, $mysqli)."',
                    '".prepareString($data[1], $mysqli)."',
                    '".prepareString($data[2], $mysqli)."',
                    '".prepareString($data[3], $mysqli)."',
                    NULL,
                    ".prepareInt($data[7]).",
                    '".prepareString($data[3].'.jpg', $mysqli)."',
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
        
    }
    fclose($file);    
    print("Success!\n");
    
    function fupper($string) {
        $string = strtolower($string);
        $string = strtoupper(substr($string, 0, 1)).substr($string, 1);
        return $string;
    }
    
    function prepareString($string, $mysqli) {
        return $mysqli->real_escape_string(trim($string));
    }
    
    function prepareInt($string) {
        if(!empty(trim($string))) return $string;
        else return 'NULL';
    }
    