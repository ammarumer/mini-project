<?php

declare(strict_types = 1);

// Your Code
$resource = fopen(FILES_PATH .'sample_1.csv','r');

while (fgetcsv($resource)!==false){
    $data[] = fgetcsv($resource);
}
$income = 0;
$expenses = 0;
foreach ($data as &$row){
    // String to be converted to DateTime
    $row[0] = date('M j,Y',strtotime($row[0]));
    $lastValue = (end($row));
    $lastValue = str_replace('$','',$lastValue);
    $lastValue = str_replace(',','',$lastValue);

    if($lastValue[0]=='-'){
        $lastValue = str_replace('-','',$lastValue);
        $expenses+= (float)$lastValue;
    }else{
        $income+=(float)$lastValue;
    }
    //$NetTotal+= end($row);
}
$total = $income - $expenses;

require_once VIEWS_PATH . 'transactions.php';
