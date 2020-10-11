<?php  
 //action.php  
 include '../model/crud2.php';  
 require_once '../ext/signature-to-image.php';
 $object = new Crud();  
 if(isset($_POST["action"]))  
 {  
      if($_POST["action"] == "Load")  
      {   
          $id = $_POST['slug'];
          
          echo $object->get_data_in_table2("SELECT * FROM tbabsen where  peran = 2 and idkegiatan = $id ORDER BY id DESC");  
          echo $object->get_data_in_table("SELECT * FROM tbabsen where  peran = 1 and idkegiatan = $id ORDER BY id DESC");  
      }  

      if($_POST["action"] == "Insert")  
      {  
          
          $nama = mysqli_real_escape_string($object->connect, $_POST["nama"]); 
          $peran = $_POST["peran"];  
          $tanggal = time(); 
          $unitkerja = $_POST["unitkerja"];
          $id = $_POST["id"];
          $filename = "../upload/" .$nama .$tanggal;
          $query = "  
          INSERT INTO tbabsen  
          (nama, peran, unitkerja, idkegiatan, namafile)   
          VALUES ('".$nama."', ".$peran.", '".$unitkerja."',".$id.", '".$filename."')  
          ";  
          $object->execute_query($query);  
        //   print_r($_POST);
        //   exit();
            $sig = $_POST['output'];
            $sig = filter_input(INPUT_POST, 'output', FILTER_UNSAFE_RAW);
            $json = $_POST['output'];
            
            $img = sigJsonToImage($json);
            imagepng($img, $filename. ".png");
            imagedestroy($img);

           echo 'Data Ditambahkan';  
      }  
 }  
 ?> 