<?php  
 //index.php  
 include 'model/crud.php';  
 $object = new Crud();  
 ?>  
 <html>  
      <head>  
           <title>Daftar Hadir Kegiatan</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> 
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
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
                <button type="button" name="add" class="btn btn-success" data-toggle="collapse" data-target="#user_collapse">Tambah</button>  
                <br /><br />  
                <div id="user_collapse" class="collapse">  
                     <form method="post" id="user_form">  
                          <label>Tambahkan Nama Kegiatan</label>  
                          <input type="text" name="nama" id="nama" class="form-control" />  
                          <br />  
                          <label>Tambahkan Tanggal</label>  
                          <input type="text" placeholder="pilih tanggal" name="tanggal" id="tanggal" class="form-control datepicker" />  
                          <br />  
                          <label>Tambahkan Tempat</label>  
                          <input type="tempat" name="tempat" id="tempat" class="form-control" />
                          <!-- <input type="file" name="user_image" id="user_image" />   -->
                          <br />  
                          <div align="center">  
                               <input type="hidden" name="action" id="action" />  
                               <input type="submit" name="button_action" id="button_action" class="btn btn-default" value="Insert" />  
                          </div>  
                     </form>  
                </div>  
                <br /><br />    
                <div id="user_table" class="table-responsive">  
                </div>  
           </div>  
      </body>  
 </html>  
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
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
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{action:action},  
                     success:function(data)  
                     {  
                          $('#user_table').html(data);  
                     }  
                });  
           }
           $('#user_form').on('submit', function(event){  
                event.preventDefault();  
                var nama = $('#nama').val();  
                var tanggal = $('#tanggal').val();
                var tempat = $('#tempat').val();  
                // var extension = $('#user_image').val().split('.').pop().toLowerCase();  
                // if(extension != '')  
                // {  
                //      if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                //      {  
                //           alert("Invalid Image File");  
                //           $('#user_image').val('');  
                //           return false;  
                //      }  
                // }  
                if(nama != '' && tanggal != '' && tempat != '')  
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
 </script>  