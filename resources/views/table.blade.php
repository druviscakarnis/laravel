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
        .table tr,th,td{
            border: 1px solid #000000;
            text-align: center;
        }
    </style>
</head>
<input type="date" name="from" id="from">
<input type="date" name="to" id="to">
<input type="submit" name="submit" value="Filtrēt" onclick="filterByDate(document.getElementById('from').value,document.getElementById('to').value)">

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
        $table->appendSum('','');
        ?>
    </tr>
</table>
<script type="text/javascript">
    function filterByDate(from,to) {
        console.log(from);
        console.log(to);
    }
    </script>
</body>
</html>