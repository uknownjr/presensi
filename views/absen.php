<?php  
 //index.php  
 include '../model/crud2.php';  
 $object = new Crud();  
 ?>  
 <html>  
      <head>  
           <title>Daftar Hadir Kegiatan</title>  
 
  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <link href="../js/assets/jquery.signaturepad.css" rel="stylesheet"> 
          
           <style>  
                body  
                {  
                     margin:0;  
                     padding:0;  
                     background-color:#f1f1f1;  
                }  
                .box  
                {  
                     width:70%;  
                     padding:20px;  
                     background-color:#fff;  
                     border:1px solid #ccc;  
                     border-radius:5px;  
                     margin-top:50px;  
                }  
           </style>  
      </head>  
      <body>  
           <div class="container box">  
                <h3 align="center">Daftar Hadir Kegiatan</h3><br /> 
                <?php 
                $id = $_GET['id']; 
                $query = "SELECT * FROM tbkegiatan where id = $id";
                $data = $object->execute_query($query);
                $data = mysqli_fetch_object($data);
               //  print_r($data);
                ?>
                <div class="row">
                    <div class="col-sm-12">
                    <div class="card" style="width: 100%;">
                     <div class="card-body">
                     <h3 class="card-title">Absensi Kegiatan</h3>
                     <div class="row">
                         <div class="col-sm-3">
                           <p>Nama Kegiatan</p>
                         </div>
                         <div class="col-sm-6">
                               <?php echo $data->nama; ?> </div>
                         </div>
                         <div class="row">
                          <div class="col-sm-3">
                                    <p>Tanggal</p>
                              </div>
                              <div class="col-sm-6"><?php echo date('d-m-Y', strtotime($data->tanggal)); ?></div>
                         </div>
                         <div class="row">
                              <div class="col-sm-3">
                                   <p>Tempat Kegiatan</p>
                              </div>
                              <div class="col-sm-6">
                                   <?php echo $data->lokasi;?> </div>
                                   </div>
                <button type="button" name="add" class="btn btn-success" data-toggle="collapse" data-target="#user_collapse">Presensi</button>  
                <br /><br />  
                <div id="user_collapse" class="collapse">  
                     <form method="post" id="user_form">  
                          <label>Nama Peserta</label>  
                          <input type="text" name="nama" id="nama" class="form-control" />  
                          <br />  
                          <label>Peran</label>  
                          <select name="peran" class="form-control" id="peran">
                              <option value="1">Peserta</option>
                              <option value="2">Narasumber</option>
                          </select>  
                          <br />  
                          <label>Unit Kerja</label>  
                          <input type="text" name="unitkerja" id="unitkerja" class="form-control" />
                          <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>" />
                          <!-- <input type="file" name="user_image" id="user_image" />   -->
                          <br /> 
                            <div class="sigPad" id="smoothed" style="width:404px;">
                            <h3>Tanda Tangan Disini</h3>
                            <ul class="sigNav">
                            <li class="drawIt"><a href="#draw-it" >Draw It</a></li>
                            <li class="clearButton"><a href="#clear">Clear</a></li>
                            </ul>
                            <div class="sig sigWrapper" style="height:auto;">
                            <div class="typed"></div>
                            <canvas class="pad" width="400" height="250"></canvas>
                            <input type="hidden" name="output" id="output" class="output" >
                            </div>
                            </div>
                          <br />
                          <div align="center">  
                               <input type="hidden" name="action" id="action" />  
                               <input type="submit" name="button_action" id="button_action" class="btn btn-default" value="Insert" />  
                          </div>  
                     </form>  
                </div>
                <br /><br />    

                <div id="absen_table" class="table-responsive">  

               
                </div>  
                <input type="button" value="Print PDF" id="btPrint" onclick="createPDF()" />
           </div>  
      </body>  
 </html>  
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
         <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>   -->
         <!-- <script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script> -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/numeric/1.2.6/numeric.js"></script>
                   <script src="../js/assets/bezier.js"></script>
                   <script src="../js/jquery.signaturepad.js"></script>
        <script type="text/javascript">
           $(document).ready(function() {
               $('#smoothed').signaturePad({
                   drawOnly:true, 
                   drawBezierCurves:true, 
                   lineTop:200,
                   variableStrokeWidth:true
               });
           });
       </script>
 <script type="text/javascript">  
      $(document).ready(function(){  
          load_data();
          $('#action').val("Insert");  
          function load_data()  
          {  
              var action = "Load";
              var slug = "<?php echo $_GET["id"]; ?>"
              
              $.ajax({  
                  url:"action.php",  
                  method:"POST",  
                     data:{action:action,slug:slug},  
                     success:function(data)  
                     {   
                         //  console.log(data);
                          $('#absen_table').html(data);
                        }  
                    });  
           }
     
          //  function getSignaturePad() {
          //   var imageData = signaturePad.toDataURL();
          //   document.getElementsByName("output")[0].setAttribute("value", imageData);
          //   }

           $('#user_form').on('submit', function(event){  
               event.preventDefault();  
               var nama = $('#nama').val();  
               var peran = $('#peran').val();
               var unitkerja = $('#unitkerja').val();  
               var output = $('#output').val();
               var id = $('#id').val();
               // console.log(id);

                    if(nama != '' && peran != '' && unitkerja != '' && id!= '')  
                    {  
                        $.ajax({  
                            url:"action.php",  
                          method:"POST",  
                          data:new FormData(this),  
                          contentType:false,  
                          processData:false,  
                          success:function(data)  
                          {  
                               alert(data);  
                               $('#user_form')[0].reset();  
                               load_data();  
                            }  
                        })  
                    }  
                else  
                {  
                    alert("Semua data harus diisi!");  
                }  
            });  
            
        }); 
        
        
        // PDF

        function createPDF() {
        var sTable = document.getElementById('absen_table').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
 </script>  
      
       <script src="../js/assets/json2.min.js"></script> 
