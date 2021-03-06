<?php
use App\Http\Controllers\table_controller;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
        .table{
            padding-top:10px;
        }
        .table tr,th,td{
            border: 1px solid #000000;
            text-align: center;
        }
        .selectBox{
            padding-left: 10px;
        }
    </style>
</head>
<input type="date" name="from" id="from">
<input type="date" name="to" id="to">
<!--<input type="submit" name="submit" value="Filtrēt" onclick="filterByDate(document.getElementById('from').value,document.getElementById('to').value)" >-->
<select id="selectBox" class="selectBox">
    <option value="">Ecr_ID</option>
    <?php
    $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
    $query = "SELECT `ecr_id` FROM ecr_cheques_z GROUP BY ecr_id";
    $result = mysqli_query($db_conn,$query);
    while($row = mysqli_fetch_array($result)){
        echo "<option value=".$row['ecr_id'].">".$row['ecr_id']."</option>";
    }
    ?>
</select>
<!--<input type="submit" name="submit_ecr" value="Meklēt" onclick="getSelect();">-->
<input type="submit" name="submit" value="Filtrēt" onclick="filterByDate(document.getElementById('from').value,document.getElementById('to').value)" >

<table class="table">
    <tr>
        <th rowspan="3">datums</th>
        <th rowspan="3">nummurs</th>
        <th rowspan="3">GT atskaite</th>
        <th colspan="4">Energoneatkarīgā atm.</th>
        <th colspan="8">Dienas (z pārskata)</th>
        <th colspan="6">Sadalījums pa nodaļām</th>
        <th rowspan="3">Ieliktā maiņas nauda</th>
        <th colspan="3">Inkasētā nauda</th>
        <th colspan="2">Informācija par apkalpojošā dienesta izsaukšanu</th>
        <th rowspan="3">Paraksts un tā atšifrējums</th>
    <tr>
        <th rowspan="2">skaidrā nauda</th>
        <th rowspan="2">bezskaidrā nauda</th>
        <th rowspan="2">ar citiem norēķinu apliecinājumiem</th>
        <th rowspan="2">kopējā summa</th>
        <th rowspan="2">ar PVP neapl. </th>
        <th rowspan="2">ar PVN (1% likmi apliek. kopsumma </th>
        <th colspan="2">ar PVN 21% likmi apliekamie</th>
        <th colspan="2">ar PVN 12% likmi apliekamie</th>
        <th colspan="2">ar PVN 5% likmi apliekamie</th>
        <th rowspan="2">kopsumma</th>
        <th rowspan="2">PVN summa</th>
        <th rowspan="2">kopsumma</th>
        <th rowspan="2">PVN summa</th>
        <th rowspan="2">kopsumma</th>
        <th rowspan="2">iemaksātā summa</th>
        <th rowspan="2">iemaksātā summa</th>
        <th rowspan="2">neiemaksātā summa</th>
        <th rowspan="2">maiņas nauda</th>
        <th rowspan="2">datums</th>
        <th rowspan="2">laiks</th>
    <tr>
        <th>summa bez PVN</th>
        <th>PVP 21% summa</th>
        <th>summa bez PVN</th>
        <th>PVP 12% summa</th>
        <th>summa bez PVN</th>
        <th>PVP 5% summa</th>
    </tr>
    </tr>
    </tr>
    <tr>
        <?php
            for($i = 1; $i<31;$i++){
                if($i==26){
                    $i = 28;
                }
                echo "<th>$i</th>";
            }
        ?>
    </tr>
    <tr>
    <?php
        $table = new table_controller();
        $table->appendSum();
        ?>
    </tr>
</table>
<script type="text/javascript">
    function filterByDate(from,to) {
        var selectBox = document.getElementById("selectBox");
        var selectedVal = selectBox.options[selectBox.selectedIndex].value;
        var base = '{!! route('table') !!}';
        if(from!='' & to!='' & selectedVal!='') {
            var url = base + '?from=' + from + '&to=' + to +'&ecr_id=' + selectedVal;

            window.location.href = url;
        }
        if(from!='' & to!='' & selectedVal==''){
            var url = base + '?from=' + from + '&to=' + to;

            window.location.href = url;
        }
        if(from=='' & to=='' & selectedVal!=''){
            var url = base + '?ecr_id='+selectedVal;

            window.location.href = url;
        } if(from=='' & to=='' & selectedVal==''){
            from = "all";
            var url = base + '?from=' +from;

            window.location.href = url;
        }

    }
    function getSelect(){
        var selectBox = document.getElementById("selectBox");
        var selectedVal = selectBox.options[selectBox.selectedIndex].value;


        var base = '{!! route('table') !!}';
        var url = base + '?ecr_id=' + selectedVal;

        window.location.href = url;
    }
    </script>
</body>
</html>