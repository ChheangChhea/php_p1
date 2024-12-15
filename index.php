<?php
$cn = new mysqli("localhost", "root", "", "php25");
$cn->set_charset("utf8");
$id = 1;
$sql = "SELECT id FROM tbl_test ORDER BY id desc LIMIT 0 , 1 ";
$rs = $cn->query($sql);
if ($rs->num_rows > 0) {
    $row = $rs->fetch_array();
    $id = $row[0] + 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <link rel="stylesheet" href="style/style.css">
    <script src="style/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>

<body>
    <form class="upl">
        <div class="frm">
            <input type="text" name="txt-edit-id" id="txt-edit-id" class="frm-control" value='0'>
            <label for="">ID</label>
            <input type="text" name="txt-id" id="txt-id"
                value="<?php echo $id; ?>" class="frm-control">
            <label for="">Name</label>
            <input type="text" name="txt-name" id="txt-name" class="frm-control">
            <label for="">Price</label>
            <input type="text" name="txt-price" id="txt-price" class="frm-control">
            <label for="">Photo</label>
            <div class="img-box">
                <input type="file" name="txt-file" id="txt-file"
                    class="txt-file">
                <input type="text" name="txt-img" id="txt-img"
                    class="txt-img">
            </div>

            <div class='btnSave'>
                Save
            </div>
    </form>

    </div>
    <h1></h1>
    <table class="table" id="tblData">
        <tr>
            <th width="100">ID</th>
            <th>Name</th>
            <th width="100">Price</th>
            <th width="100">photo</th>
            <th width="100">Action</th>
        </tr>
        <?php
        $sql = "SELECT *FROM tbl_test order by id desc";
        $rs = $cn->query($sql);
        while ($row = $rs->fetch_array()) {
        ?>
            <tr>
                <td><?php echo $row[0]; ?> </td>
                <td><?php echo $row[1]; ?> </td>
                <td><?php echo $row[2]; ?> </td>
                <td> <img src="img/<?php echo $row[4]; ?>" alt="<?php echo $row[4]; ?>"></td>
                <td> <i class="fas fa-edit btnEdit"></i> </td>
                <!-- <td> <input type="button" value="Edit" class="btnEdit"></td> -->

            </tr>
        <?php
        }
        // if($rs->num_rows >0){

        // }
        ?>

    </table>
</body>
<script>
<<<<<<< HEAD
    $(document).ready(function(){
        var tbl= $('#tblData');
        var btnEdit ='<i class="fas fa-edit btnEdit"></i>';
        var loading= "<div class='img-loading'></div>";
        var ind=0;
=======
    $(document).ready(function() {
        var tbl = $('#tblData');
        var btnEdit = '<i class="fas fa-edit btnEdit"></i>';
        var loading = "<div class='img-loading'></div>";
>>>>>>> 1414907625e3aff7c96472813bb8d360374c17fd
        // Upload img
        $('.txt-file').change(function() {
            var eThis = $(this);
            var imgBox = $('.img-box');
            var frm = eThis.closest('form.upl');
            var frm_data = new FormData(frm[0]);
            $.ajax({
                url: 'upl.php',
                type: 'POST',
                data: frm_data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    imgBox.append(loading);
                },
                success: function(data) {
                    imgBox.css({
                        "background-image": "url(img/" + data['imgName'] + ")"
                    });
                    imgBox.find('.img-loading').remove();
                    imgBox.find('.txt-img').val(data['imgName']);
                }
            });
        });
<<<<<<< HEAD
        });
        $('.btnSave').click(function(){
        var eThis = $(this);
        var id= $('#txt-id');
        var name= $('#txt-name');
        var price= $('#txt-price');
        var imgName= $('#txt-img');
        var imgBox = $('.img-box');
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
    }else if(data['edit']== true){
       tbl.find('tr:eq('+ind+') td:eq(1)').text(name.val());
       tbl.find('tr:eq('+ind+') td:eq(2)').text(price.val());
       tbl.find('tr:eq('+ind+') td:eq(3) img').attr("src","img/"+imgName.val()+"");
       tbl.find('tr:eq('+ind+') td:eq(3) img').attr("alt",""+imgName.val()+"");
    }else{
        var tr = `
=======
        $('.btnSave').click(function() {
            var eThis = $(this);
            var id = $('#txt-id');
            var name = $('#txt-name');
            var price = $('#txt-price');
            var imgName = $('#txt-img');
            var imgBox = $('.img-box');
            if (name.val() == '') {
                alert("please input name");
                name.focus();
                return;
            } else if (price.val() == '') {
                alert("please input price");
                return;
            }
            var frm = eThis.closest('form.upl');
            var frm_data = new FormData(frm[0]);
            $.ajax({
                url: 'save.php',
                type: 'POST',
                data: frm_data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    eThis.html("waiting...")
                },
                success: function(data) {
                    if (data['dpl'] == true) {
                        alert("Duplicate name");
                    } else if (data['edit'] == truse) {
                        alert("Data is update ")
                    }

                    {
                        var tr = `
>>>>>>> 1414907625e3aff7c96472813bb8d360374c17fd
           <tr>
                <td>${id.val()}</td>
                <td>${name.val()}</td>
                <td>${price.val()}</td>
                <td> <img src='img/${imgName.val()}'alt="${imgName.val()}"</td>
                <td>${btnEdit}</td>
           </tr>
           `;
                        tbl.find('tr:eq(0)').after(tr);
                        //    tbl.prepend(tr);
                        name.val("");
                        price.val("");
                        imgBox.css({
                            "background-image": "url(style/photo.png)"
                        });
                        imgBox.find("input").val('');
                        name.focus();
                        id.val(data['id'] + 1);
                    }
                    eThis.html("Save");
                }
            });
        });
        //get edit data
<<<<<<< HEAD
        tbl.on('click',"tr td .btnEdit",function(){
          var Parent =$(this).parents('tr');
          var id = Parent.find('td:eq(0)').text();
          var name = Parent.find('td:eq(1)').text();
          var price = Parent.find('td:eq(2)').text();
          var img = Parent.find('td:eq(3) img').attr("alt");
          ind=Parent.index();
          $('#txt-id').val(id);
          $('#txt-name').val(name);
          $('#txt-price').val(price);
          $('#txt-img').val(img);
          $('.img-box').css({"background-image":"url(img/"+img+")"});
          $("#txt-edit-id").val(id);
=======
        tbl.on('click', "tr td .btnEdit", function() {
            var Parent = $(this).parents('tr');
            var id = Parent.find('td:eq(0)').text();
            var name = Parent.find('td:eq(1)').text();
            var price = Parent.find('td:eq(2)').text();
            var img = Parent.find('td:eq(3) img').attr("alt");
            $('#txt-id').val(id);
            $('#txt-name').val(name);
            $('#txt-price').val(price);
            $('#txt-img').val(img);
            $('.img-box').css({
                "background-image": "url(img/" + img + ")"
            });
            $("#txt-edit-id").val(id);
>>>>>>> 1414907625e3aff7c96472813bb8d360374c17fd
        });

    });
</script>

</html>