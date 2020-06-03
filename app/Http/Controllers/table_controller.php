<?php


namespace App\Http\Controllers;
use DB;
use view;
use App\Models\User;

class table_controller extends Controller{

   public function show()
   {
       $returnVar = "";
       //echo "<table border='2'><tr>";

       //$this->appendSum();

       //echo "</tr></table>";
       //echo "<br>";
       return view('table');
   }
   public function getDate(Request $request){
       $from = $request->input('from');
       $to = $request->input('to');
       dump($from);
   }

       public function appendSum($from,$to){
            if($from!=NULL & $to!=NULL){
                $query = "SELECT `id`,`z_nr`,`date`,`gt` FROM ecr_cheques_z WHERE `date` >= '$from' AND `date` <= '$to'";
           }else{
                $query = "SELECT `id`,`z_nr`,`date`,`gt` FROM ecr_cheques_z";
            }
           $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
           $res = mysqli_query($db_conn, $query);
           while ($row = mysqli_fetch_array($res)) {
               $id = $row['id'];
               //$returnVar = $returnVar."<td>".$row['date']."</td>";
               //$returnVar = $returnVar."<td>".$row['z_nr']."</td>";
               //$returnVar = $returnVar."<td>".$row['gt']."</td>";
               echo "<td>" . $row['date'] . "</td>";
               echo "<td>" . $row['z_nr'] . "</td>";
               echo "<td>" . $row['gt'] . "</td>";
               $this->appendMoney($id);
           }

       }

       private function appendMoney($id)
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
           echo "<td>".$sum."</td>";
           $this->appendPVN($id);

       }

       private function appendPVN($id)
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
           $this->appendDepartamentDiv($id);
       }

       private function appendDepartamentDiv($id)
       {
           for ($i = 0; $i < 6; $i++) {
               //$returnVar = $returnVar."<td>_BLANK_</td>";
               echo "<td></td>";
           }
           $this->appendInkas($id);
       }

       private function appendInkas($id){
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
               echo "<td></td>";
               echo "<td>" . $row['mainas_nauda'] . "</td>";

           }
           //echo "<td>Next row " . $id . "</td>";
           //$returnVar = $returnVar."<tr></tr>";
           //echo $returnVar;
           echo "<tr></tr>";
       }

   }

