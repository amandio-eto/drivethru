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
				<a href="index.php?menu=voucher">Voucher</a>
			</li>
			<li class="active">Tambah Voucher</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">			
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" role="form" action='voucher_act.php?jns=baru' method='post'  name='form1' id='form1' onsubmit='' enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Kode Voucher</label>
						<div class="col-sm-3">
							<input type="text" name="kode" id="kode"  value="" maxlength="20" style="text-transform:uppercase" class="form-control" autocomplete="off" required autofocus />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Discount</label>
						<div class="col-sm-2">
							<div class="input-group">
							  <input type="text" name="disc" id="disc"  value="" maxlength="5" class="form-control" autocomplete="off"/>
							  <span class="input-group-addon"> % </span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Discount Nilai</label>
						<div class="col-sm-2">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"> $ </span>
							    <input type="text" name="ndisc" id="ndisc"  value="" maxlength="10" class="form-control" autocomplete="off" />
							</div>	
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Quota</label>
						<div class="col-sm-2">
							<input type="number" name="quota" id="quota"  value="" maxlength="10" class="form-control" autocomplete="off" />
						</div>
					</div>
					<hr>
					<div class="form-group">
						<div class="col-sm-6">
							<input type="submit" value="Simpan" class="btn btn-primary">&nbsp;
							<a type="button" class="btn btn-danger" href="?menu=voucher">Batal</a>
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