<?php


namespace App\Http\Controllers;
use DB;
use view;
use App\Models\User;

class table_controller extends Controller{

   public function show()
   {
       return view('table');
   }

       public function appendSum()
       {
           $from = request()->input('from', '');
           $to = request()->input('to', '');
           $ecr_id = request()->input('ecr_id','');

           if ($from!= '' & $to!='') {
               $query = "SELECT `id`,`z_nr`,`date`,`gt` FROM ecr_cheques_z WHERE `date` >= '$from' AND `date` <= '$to'";
           } elseif($from=="all"){
               $query = "SELECT `id`,`z_nr`,`date`,`gt` FROM ecr_cheques_z";
           }else{
               $query = "SELECT * FROM ecr_cheques_z WHERE id=0";
           }
            if($ecr_id!='' & $from!='' & $to!=''){
                $query = "SELECT `id`,`z_nr`,`date`,`gt` FROM ecr_cheques_z WHERE ecr_id='$ecr_id' AND `date` >= '$from' AND `date` <= '$to'";
            }
            if($ecr_id!='' &$from=='' & $to==''){
                $query = "SELECT `id`,`z_nr`,`date`,`gt` FROM ecr_cheques_z WHERE ecr_id='$ecr_id'";
            }
               $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
               $res = mysqli_query($db_conn, $query);
               while ($row = mysqli_fetch_array($res)) {
                   $id = $row['id'];
                   echo "<td>" . $row['date'] . "</td>";
                   echo "<td>" . $row['z_nr'] ."</td>";
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
               echo "<td>" . $row['sum'] . "</td>";
               $sum = $sum + $row['sum'];
           }
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
               echo "<td>" . $sumWOpvn . "</td>";
               echo "<td>" . $row['sum'] . "</td>";

           }
           $this->appendDepartamentDiv($id);
       }

       private function appendDepartamentDiv($id)
       {
           for ($i = 0; $i < 6; $i++) {
               echo "<td></td>";
           }
           $this->appendInkas($id);
       }

       private function appendInkas($id){
           $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
           $query = "SELECT `mainas_nauda`,`inkas_nauda` FROM ecr_cheques_z_operations WHERE cheque_id='$id'";
           $res = mysqli_query($db_conn, $query);
           while ($row = mysqli_fetch_array($res)) {
               echo "<td>" . $row['mainas_nauda'] . "</td>";
               echo "<td>" . $row['inkas_nauda'] . "</td>";
               echo "<td></td>";
               echo "<td>" . $row['mainas_nauda'] . "</td>";

           }
           echo "<tr></tr>";
       }

   }

