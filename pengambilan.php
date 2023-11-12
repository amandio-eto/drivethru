<script>
	function format_angka(angka)
	{
		pembatas_desimal='.';
		pembatas_ribuan=',';
		hasil=Math.round(angka*Math.pow(10,2))/Math.pow(10,2);
		hasil += '';
		x = hasil.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? pembatas_desimal + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + pembatas_ribuan + '$2');
		}
		return x1 + x2;
	}

	function unformat_angka(angka)
	{
	  pembatas_desimal='.';	
	  if (pembatas_desimal==','){
			str1 = angka.replace (",", ".");
			str2 = str1.replace (new RegExp('.', 'g'), "");
		} else {
			str2 = angka.replace (new RegExp(',', 'g'),"");
		}
		return str2;
	}

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
		
	function bayar(){
		var bukti=$("#bukti").val();
		var stot=$("#sub_total").val();
		var ppn=$("#ppn").val();
		var tot=$("#total").val();
		$("#bukti2").val(bukti);
		$("#sub_total2").val(stot);
		$("#ppn2").val(ppn);
		$("#total2").val(tot);
		$("#discp2").val("");
	    $("#disc2").val("");
	    $("#jns_bayar").val("1");
	    $("#no_kartu").val("");
	    $("#voucher").val("");
		$("#ModalBayar").modal('show');
	}
	
	function simpan_bayar(){
		$("#form_bayar").submit();
	}
	
	function batal(){
		var bukti=$("#bukti").val();
		$("#bukti3").val(bukti);
		$("#ModalBatal").modal('show');
	}	

	function cek_voucher(){
		    var voucher=$("#voucher").val();
			var sub_total=parseFloat(unformat_angka($("#sub_total2").val()));
			var ppn=parseFloat(unformat_angka($("#ppn2").val()));
			$.ajax({
			url :"voucher_act.php?jns=cek",
				type:"get",
				data:{kode: voucher},
				dataType: "json",
				success:function(data){
				   if ((data[0].disc!='')&&(data[0].ndisc!='')){	
				      if(data[0].quota<=0){
						  alert("Quota Voucher sudah habis");
					  } else {
						   if (data[0].disc>0){ 
						   $("#discp2").val(data[0].disc);
							 var total=sub_total+ppn;
							 var ndisc=data[0].disc*total/100;
							 var total=sub_total+ppn-ndisc;
							 $("#disc2").val(format_angka(ndisc));
							 $("#total2").val(format_angka(total));
						   } else {
							 $("#discp2").val("");
							 var total=sub_total+ppn;
							 var ndisc=data[0].ndisc;
							 var total=sub_total+ppn-ndisc;
							 $("#disc2").val(format_angka(ndisc));
							 $("#total2").val(format_angka(total));
						   }
					  }
				   } else alert("Kode Voucher tidak ada");		
				},
				error:function(data){
					alert("Kode Voucher tidak ada");					
				}
			})
  }
	
	function refresh_page(){
		$.ajax({
			url :"load_pengambilan.php",
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
				   <div id="daftar_pengambilan">
				   
				   </div>
				</div>
			</div>
			
			<div class="col-md-6">
			    <div style="margin-top:1px;border:1px solid #ccc;padding:4px 7px;border-radius:6px;display:none" id="blok_detail">
					
				</div>   
			</div>
       </div>
	</div><!-- /.row -->
	
	<div id="ModalBayar" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-md">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Pembayaran</h4>
		  </div>
		  <div class="modal-body">
			<form role="form" class="form-horizontal" id="form_bayar" action="kasir_act.php?jns=bayar" method="post">
				<input type="hidden" name="bukti" id="bukti2" value="">
				<div class="form-group">
					<div class="col-sm-12">
						<table>
									<tr><td colspan="3" style="padding:3px" width="140px">Sub Total</td>
										<td style="padding:3px">
											<div class="input-group">
												  <span class="input-group-addon" id="basic-addon1">$</span>
												  <input id="sub_total2" type="text" size="5" class="text-right" readonly>
											</div>
										</td></tr>
									<tr><td style="padding:3px">
											<div class="input-group">
											  <input name="voucher" id="voucher" type="text" size="10" placeholder="Voucher" style="text-transform:uppercase" autocomplete="off">
											  <span class="input-group-btn">
												<button class="btn btn-primary btn-sm" type="button" onclick="cek_voucher()"><i class="fa fa-search"></i></button>
											  </span>
											</div>
									     </td>
									    <td><input id="discp2" name="discp" type="text" size="2" readonly></td><td>% </td>
									    <td style="padding:3px">
											<div class="input-group">
												<span class="input-group-addon" id="basic-addon1">$</span>
												<input id="disc2" name="disc" type="text" size="5" class="text-right" value="0" readonly>
											</div>	
										</td>
									</tr>
									<tr><td colspan="3" style="padding:3px">Tax</td>
									    <td style="padding:3px">
											<div class="input-group">
												  <span class="input-group-addon" id="basic-addon1">$</span>
												  <input id="ppn2" type="text" size="5" class="text-right" readonly>
											</div>
									    </td></tr>
									<tr><td colspan="3" style="padding:3px">Total</td>
										<td style="padding:3px">
											<div class="input-group">
												  <span class="input-group-addon" id="basic-addon1">$</span>
												  <input id="total2" name="total" type="text" size="5" class="text-right" readonly>
											</div>
										</td>
									</tr>
									<tr><td colspan="3"style="padding:3px">Payment Method</td><td style="padding:3px">
										<select name="jns_bayar" id="jns_bayar" style="width:100%" onchange="ubah_jenis_bayar()">
											<option value="1">Cash</option>
											<option value="2">Debit Card</option>
										</select>
									</td></tr>
									<tr><td style="padding:3px" colspan="4"><input id="no_kartu" name="no_kartu" type="text" size="26" maxlength="20" placeholder="Card Number" style="width:100%;visibility: hidden;"></td></tr>
								</table>
					</div>	
				</div>
		  </div>
		  <div class="modal-footer">
			 <button type="button" class="btn btn-primary" onclick="simpan_bayar()">Bayar</button>
		  </div>
		  </form>
	  </div>
	</div>	
  </div>		
	
	<div id="ModalBatal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Pembatalan</h4>
		  </div>
		  <div class="modal-body">
			<form role="form" class="form-horizontal" id="form_batal" action="kasir_act.php?jns=batal" method="post">
				<input type="hidden" name="bukti" id="bukti3" value="">
		    <div style="font-size:14px" style="padding:5px">Apakah Transaksi ini Akan Dibatalkan?</div>
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
   $('#ModalBayar').on('shown.bs.modal', function () {
		$('#voucher').focus();
	}) 
</script>