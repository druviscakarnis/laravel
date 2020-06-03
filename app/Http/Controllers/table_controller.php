<?php


namespace App\Http\Controllers;
use DB;
use view;
use App\Models\User;

class table_controller extends Controller{

   public function show()
   {
       $returnVar = "";
       echo "<table border='2'><tr>";

       $this->appendSum($returnVar);

       echo "</tr></table>";
       echo "<br>";
       return view('table');
   }

       private function appendSum($returnVar){
           $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
           $query = "SELECT `id`,`z_nr`,`date`,`gt` FROM ecr_cheques_z";
           $res = mysqli_query($db_conn, $query);
           while ($row = mysqli_fetch_array($res)) {
               $id = $row['id'];
               // $returnVar = $returnVar."<td>".$row['date']."</td>";
               //$returnVar = $returnVar."<td>".$row['z_nr']."</td>";
               //$returnVar = $returnVar."<td>".$row['gt']."</td>";
               echo "<td>" . $row['date'] . "</td>";
               echo "<td>" . $row['z_nr'] . "</td>";
               echo "<td>" . $row['gt'] . "</td>";
               $this->appendMoney($id, $returnVar);
           }

       }

       private function appendMoney($id, $returnVar)
       {
           $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
           $query = "SELECT `cheque_id`,`sum` FROM ecr_cheques_z_payment_values WHERE cheque_id='$id'";
           $res = mysqli_query($db_conn, $query);
           $sum = 0;
           while ($row = mysqli_fetch_array($res)) {
               $id = $row['cheque_id'];
               //$returnVar = $returnVar."<td>".$row['sum']."</td>";
               echo "<td>" . $row['sum'] . "</td>";
               $sum = $sum + $row['sum'];
           }
           //$returnVar = $returnVar."<td>".$sum."</td>";
           //echo "<td>".$sum."</td>";
           $this->appendPVN($id, $returnVar);

       }

       private function appendPVN($id, $returnVar)
       {
           $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
           $query = "SELECT `cheque_id`,`sum`,`pvn_apliek_sum` FROM ecr_cheques_z_vat_values WHERE cheque_id='$id'";
           $res = mysqli_query($db_conn, $query);
           while ($row = mysqli_fetch_array($res)) {
               $id = $row['cheque_id'];
               $sumWOpvn = $row['pvn_apliek_sum'] - $row['sum'];
               //$returnVar = $returnVar."<td>".$sumWOpvn."</td>";
               //$returnVar = $returnVar."<td>".$row['sum']."</td>";
               echo "<td>" . $sumWOpvn . "</td>";
               echo "<td>" . $row['sum'] . "</td>";

           }
           $this->appendDepartamentDiv($id, $returnVar);
       }

       private function appendDepartamentDiv($id, $returnVar)
       {
           for ($i = 0; $i < 6; $i++) {
               //$returnVar = $returnVar."<td>_BLANK_</td>";
               echo "<td>_BLANK_</td>";
           }
           $this->appendInkas($id, $returnVar);
       }

       private function appendInkas($id, $returnVar){
           $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
           $query = "SELECT `mainas_nauda`,`inkas_nauda` FROM ecr_cheques_z_operations WHERE cheque_id='$id'";
           $res = mysqli_query($db_conn, $query);
           while ($row = mysqli_fetch_array($res)) {
               //$returnVar = $returnVar."<td>".$row['mainas_nauda']."</td>";
               // $returnVar = $returnVar."<td>".$row['inkas_nauda']."</td>";
               // $returnVar = $returnVar."<td>_BLANK_</td>";
               // $returnVar = $returnVar."<td>".$row['mainas_nauda']."</td>";
               echo "<td>" . $row['mainas_nauda'] . "</td>";
               echo "<td>" . $row['inkas_nauda'] . "</td>";
               echo "<td>_BLANK_</td>";
               echo "<td>" . $row['mainas_nauda'] . "</td>";

           }
           echo "<td>Next row " . $id . "</td>";
           //$returnVar = $returnVar."<tr></tr>";
           //echo $returnVar;
           echo "<tr></tr>";
       }

   }

