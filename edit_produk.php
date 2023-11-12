<?php
	$id=mysqli_escape_string($conn,$_GET['id']);
	$q = mysqli_query($conn,"select * from produk where id='$id'");
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
				<a href="index.php?menu=produk">Produto</a>
			</li>
			<li class="active">Editar Produto</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">			
		<div class="row">
			<div class="col-md-9">					
				<form class="form-horizontal" role="form" action='produk_act.php?jns=edit' method='post'  name='form1' id='form1' onsubmit='return validasi();' enctype="multipart/form-data">
					<input type="hidden" name="id" id="id"  value="<?php echo $id?>">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Nome de Produto</label>
						<div class="col-sm-5">
							<input type="text" name="nama" id="nama"  value="<?php echo $nama?>" maxlength="50" class="form-control" autocomplete="off" required autofocus />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Categoria</label>
						<div class="col-sm-5">
							<select name="kategori" id="kategori" class="form-control chosen-select"  style="width:300px"; data-placeholder="- Pilih Kategori -" required>
							<option value="" selected></option>
								<?php 
								$q = mysqli_query($conn,"select id,nama from kategori where aktif='Y' order by nama");
								if (mysqli_num_rows($q)>0) 
								{
									$i=0; 
									while($row = mysqli_fetch_array($q)) {
									
										?>
										<option value="<?php echo  $row['id']?>" <?php if($kategori==$row['id']) echo "selected"?>><?php echo $row['nama'].' - '.$row['nama']?></option>
							   <?php	}	
								}
							 ?> 
							</select> 
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Preço</label>
						<div class="col-sm-3">
							<input type="text" name="harga" id="harga"  value="<?php echo FormatAngka($harga)?>" maxlength="50" class="form-control" autocomplete="off" required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Imagem </label>
						<div class="col-sm-7">
							<div class="text-left">
								   <?php 
									   if ($gambar!='') $gbr="img/produk/$gambar";
									   else $gbr="img/food_no_image.png";
									?>   
								   <img id='img-upload' src="<?php  echo $gbr ?>" width="300px"/>
								   <div style="font-size:11px;margin-bottom:10px">Formato de Imagem JPG (800 x 500)</div>
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
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> SKU </label>
						<div class="col-sm-3">
							<input type="text" name="sku" id="sku"  value="<?php echo $sku?>" maxlength="30" class="form-control" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Barcode </label>
						<div class="col-sm-4">
							<input type="text" name="barcode" id="barcode"  value="<?php echo $barcode?>" maxlength="50" class="form-control" autocomplete="off" onchange="makeCode()"/>
						</div>
					</div>
				    <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Ativo </label>
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
							    <option value="Y" <?php echo $ck1?>>Sim</option>
								<option value="N" <?php echo $ck2?>>Não</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3">				
					<div id="qrcode" style="margin-top:10px;padding:10px;border:4px solid #444;width:fit-content"></div>
                </div>	
				<div class="col-md-12">					
					<hr>
					<input type="submit" value="Guarda" class="btn btn-primary">&nbsp;
					<a type="button" class="btn btn-danger" href="?menu=produk">Cancela</a>
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
	
	var qrcode = new QRCode(document.getElementById("qrcode"), {
		width : 200,
		height : 200
	});

	function makeCode () {		
		var barcode=document.getElementById("barcode").value; 
		qrcode.makeCode(barcode);
	}
	
	makeCode () ;
	</script>