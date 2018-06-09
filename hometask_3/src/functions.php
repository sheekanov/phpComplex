<?php

function task1($filename)
{
    //считываем xml файл
    $xml = simplexml_load_file($filename);

    //выводим Номер заказа и его дату, отформатированную в привычном формате
    echo '<b style="font-size: 1.5rem;">Purchase Order Number: </b>' . $xml->attributes()->PurchaseOrderNumber . '<br>';
    echo '<b>OrderDate: </b>' . date('d M Y', strtotime($xml->attributes()->OrderDate)). '<br><br>';

    //выводим разные типы адресов каждый в своем блоке
    foreach ($xml->Address as $addressItem) {
        echo '<div style="display: inline-block; border: 1px solid; margin-right: 50px;">';
        echo '<table>';
        echo '<thead><tr>';
        echo '<td style="font-weight: bold;">Address Type:</td><td>' . $addressItem->attributes()->Type . '</td>';
        echo '</tr></thead>';
        echo '<tbody>';
        echo "<tr><td>Name:</td><td>$addressItem->Name</td>";
        echo "<tr><td>Street:</td><td>$addressItem->Street</td>";
        echo "<tr><td>City:</td><td>$addressItem->City</td>";
        echo "<tr><td>Zip:</td><td>$addressItem->Zip</td>";
        echo "<tr><td>Country: </td><td>$addressItem->Name</td>";
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }

    //выводим заметки для доставки
    echo '<br><br>';
    echo '<b>Delivery Notes: </b>' . $xml->DeliveryNotes . '<br><br>';

    //выводим таблицу с заказанными товарами
    echo '<table  style="border: 1px solid;">';
    echo '<caption>Order Positions</caption>';
    echo '<thead ><tr>';
    echo '<td>Part Number</td>';
    echo '<td>Product Name</td>';
    echo '<td>Quantity</td>';
    echo '<td>Price</td>';
    echo '<td>Shipment Date</td>';
    echo'<td>Comments</td>';
    echo '</tr></thead>';
    echo '<tbody style="text-align: center;">';
    foreach ($xml->Items->Item as $shipItem) {
        echo '<tr>';
        echo '<td>' . $shipItem->attributes()->PartNumber . '</td>';
        echo '<td>' . $shipItem->ProductName . '</td>';
        echo '<td>' . $shipItem->Quantity . '</td>';
        echo '<td>' . $shipItem->USPrice . ' $</td>';

        //выводим дату в привычном формате
        if (empty($shipItem->ShipDate)) {
            echo '<td></td>';
        } else {
            echo '<td>' . date('d M Y', strtotime($shipItem->ShipDate)) . '</td>';
        }

        echo '<td>' . $shipItem->Comment . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
};

function task2()
{
    //создаем массив
    $order=[];
    $order['number']='0001';
    $order['date']='09.06.2018';
    $order['positions'] = [];
    $order['positions'][] = array('prodArtikul' => 'ccc', 'prodName' => 'Phone', 'Qty' => 1, 'Price' => 1000);
    $order['positions'][] = array('prodArtikul' => 'bbb', 'prodName' => 'Tablet', 'Qty' => 2, 'Price' => 999);

    //кодируем массив в JSON и записываем в файл output.json

    $encoded = json_encode($order, JSON_PRETTY_PRINT);
    $file = fopen('output.json', 'w');
    fwrite($file, $encoded);
    fclose($file);

    //читаем файл output.JSON и декодируем его в массив
    $read = file_get_contents('output.json');
    $decoded = json_decode($read, true);

    //случайным образом выбираем, вносить ли изменения в массив
    $rand = rand(0, 1);

    if ($rand) {
        $decoded['number'] = 'feel the difference';
        $decoded['newKey'] = [2, 1, array('key1' => 'value1', 'key2' => 'value2')];
        echo 'Изменения проведены:  <br>';
    } else {
        echo 'Изменения не проведены <br>';
    }

    //кодируем массив в JSON и записываем в файл output2.json
    $encoded = json_encode($decoded, JSON_PRETTY_PRINT);
    $file = fopen('output2.json', 'w');
    fwrite($file, $encoded);
    fclose($file);

    //переходим к сравнению файлов. Сначала считываем файлы output.json и output2.json и декодируем их в массивы
    $readOutput = file_get_contents('output.json');
    $decodedOutput = json_decode($readOutput, true);
    $readOutput2 = file_get_contents('output2.json');
    $decodedOutput2 = json_decode($readOutput2, true);

    //сравниваем первый массив со вторым, затем второй с первым
    $diff1 = array_diff_assoc($decodedOutput, $decodedOutput2);
    $diff2 = array_diff_assoc($decodedOutput2, $decodedOutput);

    //создаем рекурсивную функцию для вывода в браузер массива любой вложенности
    function arrayDisplay(array $array)
    {
        $recurs = 0;
        foreach ($array as $key => $value) {
            echo '<div style="margin-left: 30px;">' . "[$key] => ";
            if (is_array($value)) {
                $recurs++;
                $margin = $recurs * 60;
                echo 'Array <div style="margin-left:' . $margin . 'px;">';
                echo '[';
                arrayDisplay($value);
                echo ']';
                echo '</div></div>';
            } else {
                echo $value . '</div>';
            }
        }
    }

    //выводим результаты сравнения на экран
    if (!empty($diff1)) {
        echo 'В файле output.json имеются элементы, отсутствующие в файле output2.json: <br><br>';
        arrayDisplay($diff1);
        echo '<br>';
    }

    if (!empty($diff2)) {
        echo 'В файле output2.json имеются элементы, отсутствующие в файле output.json: <br><br>';
        arrayDisplay($diff2);
        echo '<br>';
    }

}


function task3()
{
    //создаем массив из 50 случайных чисел от 1 до 100
    $numbers=[];
    for ($i = 0; $i <50; $i++) {
        $numbers[$i] = rand(1, 100);
    }

    //записываем массив в файл numbers.csv
    $file = fopen('numbers.csv', 'w');
    fputcsv($file, $numbers, ';');
    fclose($file);

    //считываем данные из файла numbers.csv в массив
    $file = fopen('numbers.csv', 'r');
    $array= fgetcsv($file, 10000, ';');
    fclose($file);

    //создаем callback функцию для отбора из массива только четных чисел
    $even = function ($var) {
        return (!($var & 1)); //пользуемся тем, что у нечетного числа младший бит всегда = 1
    };

    //отбираем из массива четные числа и суммируем их
    $evenArray = array_filter($array, $even);
    $sum = array_sum($evenArray);

    return $sum;
}

function task4()
{
    //считываем json данные из URL в переменную $content
    $url ='https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';
    $stream = fopen($url, 'rb');
    $content = stream_get_contents($stream);

    //декодируем json данные в массив
    $decodedContent = json_decode($content, true);

    //выводим в массив значения pageid, title и возвращаем массив
    $res=[];
    $res['pageid'] = $decodedContent['query']['pages']['15580374']['pageid'];
    $res['title'] = $decodedContent['query']['pages']['15580374']['title'];

    return $res;
}
