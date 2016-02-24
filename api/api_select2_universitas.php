<?php

include '../config/application.php';

$search=$_GET['q'];
$kondisi=" namauniversitas like '%$search%' or kodeUniversitas like '%$search%' ";
$query="select SQL_CALC_FOUND_ROWS namauniversitas,kodeUniversitas"
        . "          from universitas where $kondisi";
$rResult = $DB->query($query);

$total=$DB->num_rows($rResult);
// make sure there are some results else a null query will be returned
if($total!= 0) {
    while($row = $DB->fetch_array($rResult) ){
        $answer[] = array("id"=>$row['kodeUniversitas'],
                                            "text"=>$row['kodeUniversitas']." - ".$row['namauniversitas']);
        // the text I want to show is in the form of option id - option
    }
} else {
// 0 results send a message back to say so.
    $answer[] = array("id"=>"0","text"=>"No Results Found..");
}

// finally encode the answer to json and send back the result.
echo json_encode($answer);


?>