<?php  
 //action.php  
 include 'model/crud.php';  
 $object = new Crud();  
 if(isset($_POST["action"]))  
 {  
      if($_POST["action"] == "Load")  
      {  
           echo $object->get_data_in_table("SELECT * FROM tbkegiatan ORDER BY id DESC");  
      }  

      if($_POST["action"] == "Insert")  
      {  

           $nama = mysqli_real_escape_string($object->connect, $_POST["nama"]); 
           $tempat = $_POST["tempat"];  
           $tanggal = $_POST["tanggal"]; 
           $slug = strtolower(trim($nama));
           $slug = str_replace(' ', '-', $slug);
           $slug = "views/absen.php?slug=" . $slug;  
        //    $image = $object->upload_file($_FILES["user_image"]);  
           $query = "  
           INSERT INTO tbkegiatan  
           (nama, tanggal, lokasi, slug)   
           VALUES ('".$nama."', '".$tanggal."', '".$tempat."', '".$slug."')  
           ";  
           $object->execute_query($query);  
           echo 'Data Ditambahkan';  
      }  
 }  
 ?> 