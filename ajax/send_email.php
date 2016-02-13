<?php

    $to = "alexdancer86@yahoo.com";
    //$to = "victor.yurkin@gmail.com";
    $subject = "Заказ товара";
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    $article = $_POST['article'];
    $price = $_POST['price'];
    $url = $_POST['url'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    $message = '
        <html>
            <head>
                <title>Заказ товара</title>
            </head>
            <body>
                <p>Информация о заказе:</p>
                <table>
                    <tr>
                        <th align="right">Наименование: </th>
                        <td>'.$title.'</td>
                    </tr>
                    <tr>
                        <th align="right">Артикул: </th>
                        <td>'.$article.'</td>
                    </tr>
                    <tr>
                        <th align="right">Цена: </th>
                        <td>'.$price.'</td>
                    </tr>
                    <tr>
                        <th align="right">Ссылка на товар: </th>
                        <td><a href="http://66.175.212.71'.$url.'">http://66.175.212.71'.$url.'</a></td>
                    </tr>
                </table>
                <p>Информация о заказчике:</p>
                <table>
                    <tr>
                        <th align="right">Имя: </th>
                        <td>'.$full_name.'</td>
                    </tr>
                    <tr>
                        <th align="right">Телефон: </th>
                        <td>'.$phone.'</td>
                    </tr>
                    <tr>
                        <th align="right">Enail: </th>
                        <td>'.$email.'</td>
                    </tr>
                </table>
            </body>
        </html>
    ';
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: <order@comcar.by>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";
    
    mail($to,$subject,$message,$headers);
    
    echo 'Success!';