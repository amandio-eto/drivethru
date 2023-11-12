<script>
	function load_detail(bukti){
		$.ajax({
			url :"load_detail3.php",
				type:"get",
				data:"bukti="+bukti,
				dataType: "html",
				success:function(data){
					$("#blok_detail").html(data);
					$("#blok_detail").show();
				},
				error:function(data){
					alert(data);					
				}
			})
	}
	
	function ubah_jenis_bayar(){
		var jns=$("#jns_bayar").val();
		if(jns=='1') $("#no_kartu").css('visibility', 'hidden');
		else  $("#no_kartu").css('visibility', 'visible');;
	}
		
	
	function diambil(){
		var bukti=$("#bukti").val();
		$("#bukti3").val(bukti);
		$("#ModalBayar").modal('show');
	}
	
    function refresh_page(){
		$.ajax({
			url :"load_pengambilan_cs.php",
				type:"get",
				dataType: "html",
				success:function(data){
					$("#daftar_pengambilan").html(data);
				},
				error:function(data){
					alert(data);					
				}
			})
	}	
	setInterval(function(){refresh_page()},1000); 
	
</script>	
	<div class="row" style="margin:4px">		
		   	<div class="col-md-6">
				<div style="height:510px;overflow:auto;border:1px solid #bbb;font-size:14px">
				   <div id="daftar_pengambilan"></div>
				</div>
			</div>
			
			<div class="col-md-6">
			    <div style="margin-top:1px;border:1px solid #ccc;padding:4px 7px;border-radius:6px;display:none" id="blok_detail">
					
				</div>   
			</div>
       </div>
	</div><!-- /.row -->
	
	<div id="ModalBayar" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Pengambilan</h4>
		  </div>
		  <div class="modal-body">
				<form role="form" class="form-horizontal" id="form_diambil" action="kasir_act.php?jns=diambil" method="post">
				<input type="hidden" name="bukti" id="bukti3" value="">
				<div style="font-size:14px" style="padding:5px">Apakah sudah diambil Customer ?</div>
		  </div>
		  <div class="modal-footer">
		    <button type="submit" class="btn btn-primary">Ya</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
		  </div>
		  </form>
	  </div>
	</div>	
  </div>		
<script>

</script>