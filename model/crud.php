<?php  
 class Crud  
 {  
      //crud class  
      public $connect;  
      private $host = "localhost";  
      private $username = 'root';  
      private $password = 'pusbinjfa2018';  
      private $database = 'dbabsensikeg';  
      function __construct()  
      {  
           $this->database_connect();  
      }  
      public function database_connect()  
      {  
           $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);  
      }  
      public function execute_query($query)  
      {  
           return mysqli_query($this->connect, $query);  
      }  
      public function get_data_in_table($query)  
      {  
        $no =1;
           $output = '';  
           $result = $this->execute_query($query);  
           $output .= '  
           <table class="table table-bordered table-striped">  
                <tr>  
                     <th width="5%">No</th>  
                     <th width="35%">Nama Kegiatan</th>  
                     <th width="20%">Tanggal</th>  
                     <th width="30%">Tempat</th>  
                     <th width="10%">Tindakan</th>  
                </tr>  
           ';  
           while($row = mysqli_fetch_object($result))  
           {  
                $output .= '  
                <tr>
                <td>'. $no++ . '</td>         
                <td>'.$row->nama.'</td>  
                <td>'.$row->tanggal.'</td>
                <td>'.$row->lokasi.'</td>  
                <td><a type="button" name="update" href="'.$row->slug.'&id='.$row->id.'" id="'.$row->id.'" class="btn btn-success btn-xs update">Presensi</a></td>  
                </tr>  
                ';  
           }  
           $output .= '</table>';  
           return $output;  
      }   
      
      function upload_file($file)  
      {  
           if(isset($file))  
           {  
                $extension = explode('.', $file["name"]);  
                $new_name = rand() . '.' . $extension[1];  
                $destination = './upload/' . $new_name;  
                move_uploaded_file($file['tmp_name'], $destination);  
                return $new_name;  
           }  
      }  
 }  
 ?>