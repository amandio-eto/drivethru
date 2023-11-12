<script>
	function load_detail(){
		var bukti=$("#bukti").val();
		$.ajax({
			url :"load_detail2.php",
				type:"get",
				data:"bukti="+bukti,
				dataType: "html",
				success:function(data){
					$("#blok_detail").html(data);
					var element = document.getElementById("blok_detail");
					element.scrollTo(0, element.scrollHeight);
				},
				error:function(data){
					alert(data);					
				}
			})
	}
	
	function load_total(){
		var bukti=$("#bukti").val();
		$.ajax({
			url :"load_total2.php",
				type:"get",
				data:"bukti="+bukti,
				dataType: "html",
				success:function(data){
					$("#blok_total").html(data);
				},
				error:function(data){
					alert(data);					
				}
			})
	}
	
	function cek_transaksi(){
		var bukti1=$("#bukti").val();
		$.ajax({
			url :"cek_transaksi.php",
				type:"get",
				dataType: "html",
				success:function(data){
				   $("#bukti").val(data);
				},
				error:function(data){
				}
			})
	}	
	
	function refresh_page(){
		cek_transaksi()
		load_detail();
		load_total();
	}
	
	setInterval(function(){refresh_page()},1000);   
</script>	
	<div class="row" style="margin:4px">		
		   	<div class="col-md-7">
				<input type="hidden" name="bukti" id="bukti" value="">
				<div style="height:520px;overflow:auto;border:1px solid #bbb;border-radius:8px" id="blok_detail">
				   
				</div>
			</div>
			<div class="col-md-5">
				<div style="" id="blok_total">
					
				</div>   
			</div>
       </div>
	</div><!-- /.row -->
	
	<div id="ModalNote" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-md">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Note</h4>
		  </div>
		  <div class="modal-body">
			<form role="form" class="form-horizontal" id="form_jurnal" action="transaksi_detail.php">
				<input type="hidden" name="id" id="id" value="">
				<div class="form-group">
					<div class="col-sm-12">
						<textarea style="width:100%" id="catatan" name="catatan" rows="3"></textarea>
					</div>	
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
		  </div>
	  </div>
	</div>	

<script>
    var bukti=$("#bukti").val(); 
	load_makanan(1);
	load_detail(bukti);
	load_total(bukti);
</script>