<?php

     require_once('connection.php');

  
     function InsertRecord()
     {
        //   var_dump(1);
         //var_dump($_POST);
         
         
         
         global $con;
         $UserName = $_POST['UName'];
         $UserEmail = $_POST['UEmail'];
         
         
         $query = "insert into user_record (UserName, UserEmail) values('$UserName','$UserEmail')";
         $result = mysqli_query($con,$query);

         if($result)
         {
             echo 'Your Record Has Been Saved In The Database';
         }
         else
         {
             echo 'Please Check Your Query';
         }
     }

     function display_record()
     {
         
         global $con;
         $value = "";
         $value='<div class="container"><table class="table table-bordered">
                    <tr>
                        <td> User id </td>
                        <td> User User </td>
                        <td> User Email </td>
                        <td> Edit </td>
                        <td> Delete </td>                        
                    </tr>';
        $query = "select * from user_record";
        $result = mysqli_query($con,$query);

        while($row=mysqli_fetch_assoc($result))
        {
            $value.=  '<tr>
                            <td> '.$row['id'].' </td>
                            <td> '.$row['UserName'].' </td>
                            <td> '.$row['UserEmail'].' </td>
                            <td> <button class="btn btn-success" id="btn_edit" data-id='.$row['id'].'><span class="fa fa-edit"></span></button> </td>
                            <td> <button class="btn btn-danger" id="btn_Delete" data-id1='.$row['id'].'><span class="fa fa-trash"></span></button> </td>                        
                        </tr>';
        }

        $value.='</table></div>';
           echo $value;
        // echo json_encode(['status'=>'success','html'=>$value]);
     }

     function get_record()
     {
         global $con;
         $UserID = $_POST['UserID'];
         $query = "select * from user_record where id='$UserID'";
         $result = mysqli_query($con,$query);
         
         $User_data = array();
         while($row=mysqli_fetch_assoc($result))         
         {             
            $User_data[0]=$row['id'];
             $User_data[1]=$row['UserName'];
             $User_data[2]=$row['UserEmail'];          
         }
         echo json_encode($User_data);
          
     }

     function update_value()
     {
        global $con;
        $Update_ID = $_POST['U_ID'];
        $Update_User = $_POST['U_User'];
        $Update_Email = $_POST['U_Email'];

        $query = "update user_record set UserName='$Update_User', UserEmail='$Update_Email' where id=' $Update_ID'";
        $result = mysqli_query($con,$query);
        
        if($result)
        {
            echo 'Your Record Has Been Updated';
        }
        else
        {
            echo 'Check Your Query';
        }
     }

     function delete_record()
     {
        global $con;
        $Del_ID = $_POST['Del_ID'];
        $query = "delete from user_record where id = '$Del_ID'";
        $result = mysqli_query($con,$query);

        if($result)
        {
            echo 'Your Record Has Been Deleted';
        }
        else
        {
            echo 'Please Check Your Query';
        }
     }

?>