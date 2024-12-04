<?php
$cn= new mysqli("localhost","root","","php25");
$cn->set_charset("utf8");
$id=1;
$sql="SELECT id FROM tbl_test ORDER BY id desc LIMIT 0 , 1 ";
$rs = $cn->query($sql);
if($rs->num_rows > 0){
    $row= $rs->fetch_array();
    $id=$row[0]+1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    
    <link rel="stylesheet" href="style/style.css">
    <script src="style/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    </head>
<body>
    <form class="upl">
    <div class="frm">
   <label for="">ID</label>
   <input type="text" name="txt-id" id="txt-id"
    value="<?php echo $id; ?>"class="frm-control">
   <label for="">Name</label>
   <input type="text" name="txt-name" id="txt-name"class="frm-control">
   <label for="">Price</label>
   <input type="text" name="txt-price" id="txt-price"class="frm-control">
   <label for="">Photo</label>
        
   <div class="img-box">
       <input type="file" name="txt-file" id="txt-file" 
        class="txt-file">
   </div>
    <div class='btnSave'>
      Save
      <!-- <img src="img/k8.jpg" alt=""> -->
    </div>
    </form>
   
</div>
<h1></h1>
<table class="table" id="tblData" >
    <tr>
        <th width="100">ID</th>
        <th>Name</th>
        <th width="100">Price</th>
        </tr>
        <?php
        
        $sql = "SELECT *FROM tbl_test order by id desc";
        $rs = $cn->query($sql);
        while($row = $rs->fetch_array() ){
            ?>
            <tr>
            <td><?php echo $row[0]; ?> </td>
            <td><?php echo $row[1]; ?> </td>
            <td><?php echo $row[2]; ?> </td>
            </tr>
            <?php
        }
        // if($rs->num_rows >0){
            
        // }
        ?>
    
</table>
</body>
<script>
    $(document).ready(function(){
        var tbl= $('#tblData');
        // Upload img
        $('.txt-file').change(function(){
            var eThis = $(this);
            var imgBox =$('.img-box');
            var frm = eThis.closest('form.upl');
            var frm_data = new FormData(frm[0]);
        $.ajax({
            url:'upl.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                
            },
            success:function(data){   
            imgBox.css({"background-image":"url(img/"+data['imgName']+")"});
           }				 
        });
        });
        $('.btnSave').click(function(){
        var eThis = $(this);
        var id= $('#txt-id');
        var name= $('#txt-name');
        var price= $('#txt-price');
        if(name.val()==''){
            alert("please input name");
            name.focus();
            return;
        }else if(price.val()==''){
            alert("please input price");           
            return;
        }
        var frm = eThis.closest('form.upl');
       var frm_data = new FormData(frm[0]);
$.ajax({
	url:'save.php',
	type:'POST',
	data:frm_data,
	contentType:false,
	cache:false,
	processData:false,
	dataType:"json",
	beforeSend:function(){
           eThis.html("waiting...")
	},
	success:function(data){   
    if(data['dpl'] == true){
        alert("Duplicate name");
    }else{
        var tr = `
           <tr>
                <td>${id.val()}</td>
                <td>${name.val()}</td>
                <td>${price.val()}</td>
           </tr>
           `;
           tbl.find('tr:eq(0)').after(tr);
        //    tbl.prepend(tr);
           
           name.val("");
           price.val("");
           name.focus();
           id.val(data['id'] + 1);
    }
    eThis.html("Save");
	}				
   }); 
        });
    });
</script>
</html>