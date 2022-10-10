<?php
//method response json
function responseJson($status, $msg, $data){
    $response = [
        'status' => $status,
        'msg' => $msg,
        'data' => $data
    ];
    return request()->json($response);
}
?>
