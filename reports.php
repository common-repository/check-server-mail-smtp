
<?php 
if (!defined('ABSPATH')){
    exit;
}

function csms_test_mail_reports() 
    {
	
     global $wpdb;
     $table_name = $wpdb->prefix . 'reports';
     $table_name_user = $wpdb->prefix . 'users';
     $res = $wpdb->get_results("
     SELECT email,id,COUNT(email) as finalCount, created_date FROM $table_name
     GROUP BY email;  ");
	

	 ?>
	 <div class="wrap">

      <style>
        .myTable{
          width: 100%;
          text-align: center;
        }
        .myTable th{
          text-align: center !important;
        }
        .myTable,.myTable tr ,.myTable td,.myTable th{
          border: 1px solid black;
        }
      </style>

      <script>
        jQuery(document).ready(function(){
          jQuery('.myTable').DataTable();
        });
      </script>

      <table class="myTable">
        <thead>
          <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Test-Count</th>
            <th>Tested Date</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($res as $key => $value) {?>

          <tr>
            <td><?php echo $value->id;?></td>
            <td><?php echo $value->email;?></td>
            <td><?php echo $value->finalCount;?></td>
			<td><?php echo $value->created_date;?></td>
			</tr>

      <?php  }?>
        </tbody>
      </table>
	    <?php		
	 }
	 csms_test_mail_reports();
	?>