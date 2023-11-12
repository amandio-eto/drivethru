<script>
	function load_detail(){
		$.ajax({
			url :"load_detail4.php",
				type:"get",
				dataType: "html",
				success:function(data){
					$("#blok_detail").html(data);
				},
				error:function(data){
					alert(data);					
				}
			})
	}

	function load_detail_cs(){
		$.ajax({
			url :"load_detail5.php",
				type:"get",
				dataType: "html",
				success:function(data){
					$("#blok_detail_cs").html(data);
				},
				error:function(data){
					alert(data);					
				}
			})
	}
	
	function refresh_page(){
		load_detail();
		load_detail_cs();
	}
	
	setInterval(function(){refresh_page()},1000);   
</script>	
	<h3>&nbsp;&nbsp;&nbsp;Pesanan Drive-thru</h3>
	<div class="row" style="margin:4px">		
		   	<div class="col-md-12">
				<div style="height:520px;overflow:auto;border:1px solid #bbb" id="blok_detail">
				   
				</div>
			</div>
	   </div>
	</div><!-- /.row -->
	<h3>&nbsp;&nbsp;&nbsp;Pesanan Minimarket</h3>
	<div class="row" style="margin:4px">		
		   	<div class="col-md-12">
				<div style="height:520px;overflow:auto;border:1px solid #bbb" id="blok_detail_cs">
				   
				</div>
			</div>
	   </div>
	</div><!-- /.row -->

<script>
    var bukti=$("#bukti").val(); 
	load_makanan(1);
	load_detail(bukti);
	load_total(bukti);
</script>