<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'config.inc';
    include 'function.php';

    if(isset($_POST['sql'])){
        $result_array = array();
        $header_row = array();

        $query = $_POST['sql'];
        $query = $mysql->real_escape_string($query);
        $result = $mysql->query($query);

        for ($i=0; $row = $result->fetch_array(); $i++){
            $result_array[$i] = $row;
        }

        for ($i=0; $v = $result->fetch_field(); $i++){
            $header_row[$i] = $v->name;
        }

        writeExelFile('data_report.xls',$result_array, $header_row);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        tr:hover{
            background: #c6d6ff;
        }
        th{
            border: 1px solid #000000;
            background: #7cffcf;
        }
        td{
            border: 1px solid #000000;
        }
    </style>
</head>
<body>
<form method="post">
    <input type="text" name="sql" id="sql" placeholder="enter sql" required/><br/>
    <? if(isset($_POST['sql'])): ?>
        <table>
            <thead>
                <tr>
                    <? for($i = 0; $header_row[$i]; $i++): ?>
                        <th><?=$header_row[$i]; ?></th>
                    <? endfor; ?>
                </tr>
            </thead>
            <tbody>
                <? for($i = 0; $result_array[$i]; $i++): ?>
                    <tr>
                        <? for($j = 0; $j < count($result_array[$j])/2; $j++): ?>
                            <td><?=$result_array[$i][$j];?></td>
                        <? endfor; ?>
                    </tr>
                <? endfor; ?>
            </tbody>
        </table>
    <? endif; ?>
</form>
</body>
</html>




