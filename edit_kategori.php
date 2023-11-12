<?php
	$id=mysqli_escape_string($conn,$_GET['id']);
	$q = mysqli_query($conn,"select * from kategori where id='$id'");
	$row=mysqli_fetch_array($q);
	extract($row);
?>
</script>
	
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="index.php">Home</a>
			</li>
			<li>
				<a href="index.php?menu=kategori">Kategori</a>
			</li>
			<li class="active">Edit Kategori</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">			
		<div class="row">
			<div class="col-xs-12">					
				<form class="form-horizontal" role="form" action='kategori_act.php?jns=edit' method='post'  name='form1' id='form1' onsubmit='return validasi();' enctype="multipart/form-data">
					<input type="hidden" name="id" id="id"  value="<?php echo $id?>">
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Nama Kategori</label>
						<div class="col-sm-5">
							<input type="text" name="nama" id="nama"  value="<?php echo $nama?>" maxlength="50" class="form-control" autocomplete="off" required autofocus />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Gambar </label>
						<div class="col-sm-7">
							<div class="text-left">
							   <?php 
								   if ($gambar!='') $gbr="img/kategori/$gambar";
								   else $gbr="img/food_no_image.png";
								?>   
							   <img id='img-upload' src="<?php  echo $gbr ?>" width="300px"/>
							   <div style="font-size:11px;margin-bottom:10px">Format Gambar JPG (800 x 500)</div>
							</div>	
							<div class="input-group">
								<span class="input-group-btn">
									<span class="btn btn-default btn-file" style="border:2px">
										Browse… <input type="file" id="imgInp" name="photo" accept="image/jpeg" >
									</span>
								</span>
								<input type="text" class="form-control" readonly>
							</div>				
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Proses di Dapur </label>
						<?php 
							if ($proses_dapur=='Y'){
								$ck1="selected";
								$ck2="";								
							} else {
								$ck1="";
								$ck2="selected";
						    }
						?>
						
						<div class="col-sm-2">
							<select name="proses_dapur" id="aktif">
							    <option value="Y" <?php echo $ck1?>>Ya</option>
								<option value="N" <?php echo $ck2?>>Tidak</option>
							</select>
						</div>
					</div>
				    <div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Aktif </label>
						<?php 
							if ($aktif=='Y'){
								$ck1="selected";
								$ck2="";								
							} else {
								$ck1="";
								$ck2="selected";
						    }
						?>
						
						<div class="col-sm-2">
							<select name="aktif" id="aktif">
							    <option value="Y" <?php echo $ck1?>>Ya</option>
								<option value="N" <?php echo $ck2?>>Tidak</option>
							</select>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<div class="col-sm-6">
							<input type="submit" value="Simpan" class="btn btn-primary">&nbsp;
							<a type="button" class="btn btn-danger" href="?menu=kategori">Batal</a>
						</div>
					</div>
				</form>
			</div>		
		</div><!-- /.row -->
	</div><!-- /.page-content -->
	
	<script>
		$(document).ready( function() {
			$(document).on('change', '.btn-file :file', function() {
				var input = $(this),
					label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [label]);
			});

			$('.btn-file :file').on('fileselect', function(event, label) {
				
				var input = $(this).parents('.input-group').find(':text'),
					log = label;
				
				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}
			
			});
		
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		
		$("#imgInp").change(function(){
		    readURL(this);
		}); 
	});	
	</script>