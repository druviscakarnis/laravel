<?php


namespace App\Http\Controllers;
use input;
use App\Models\User;

class table_controller extends Controller
{
   public function show()
   {
       $db_conn = mysqli_connect('127.0.0.1', 'root', '', 'laravel_db');
       $query = "SELECT t1.z_nr,t1.date,t1.gt,t2.sum,t3.type,t4.sum,t4.pvn_apliek_sum,t5.type,t6.mainas_nauda,t6.inkas_nauda 
        FROM ecr_cheques_z t1
        LEFT JOIN ecr_cheques_z_payment_values t2 ON t1.id = t2.cheque_id
        LEFT JOIN ecr_cheques_z_payment_types t3 ON t2.payment_type_id = t3.id
        LEFT JOIN ecr_cheques_z_vat_values t4 ON t2.cheque_id = t4.cheque_id
        LEFT JOIN ecr_cheques_z_vat_types t5 ON t4.vat_type_id = t5.id
        LEFT JOIN ecr_cheques_z_operations t6 ON t2.cheque_id = t6.cheque_id
        WHERE t1.id=98;";
       $result = mysqli_query($db_conn, $query);
       while ($row = mysqli_fetch_row($result)) {
           $string = implode(' | ', $row);
           echo $string;
           //print_r ($row);
           echo "<br>";
       }

       //return view('table');
   }
}
?>