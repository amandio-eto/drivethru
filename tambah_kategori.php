<script>
  
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
				<a href="index.php?menu=kategori">Categoria</a>
			</li>
			<li class="active">Adiciona a Categoria</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">			
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" role="form" action='kategori_act.php?jns=baru' method='post'  name='form1' id='form1' onsubmit='' enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Nome de Categoria</label>
						<div class="col-sm-5">
							<input type="text" name="nama" id="nama"  value="" maxlength="50" class="form-control" autocomplete="off" required autofocus />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Imagem </label>
						<div class="col-sm-7">
							<div class="text-left">
							   <?php 
								   $gbr="img/food_no_image.png";
								?>   
							   <img id='img-upload' src="<?php  echo $gbr ?>" width="200px"/>
							   <div style="font-size:11px;margin-bottom:10px">Formato de Imagem</div>
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
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Processo na Cozinha </label>
						<div class="col-sm-2">
							<select name="proses_dapur" id="aktif">
							    <option value="Y">Sim</option>
								<option value="N">Não</option>
							</select>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<div class="col-sm-6">
							<input type="submit" value="Guarda" class="btn btn-primary">&nbsp;
							<a type="button" class="btn btn-danger" href="?menu=kategori">Cancela</a>
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