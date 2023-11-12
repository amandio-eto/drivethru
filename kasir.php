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

	function load_makanan(kat){
		$.ajax({
			url :"load_makanan.php",
				type:"get",
				data:"kategori="+kat,
				dataType: "html",
				success:function(data){
					$("#blok_makanan").html(data);
				},
				error:function(data){
					alert(data);					
				}
			})
	}
	
	function cari(){
		var kat=$("#cari").val();
		$.ajax({
			url :"cari_makanan.php",
				type:"get",
				data:"kata="+kat,
				dataType: "html",
				success:function(data){
					$("#blok_makanan").html(data);
				},
				error:function(data){
					alert(data);					
				}
			})
	}
	
	function load_detail(){
		var bukti=$("#bukti").val();
		$.ajax({
			url :"load_detail.php",
				type:"get",
				data:"bukti="+bukti,
				dataType: "html",
				success:function(data){
					$("#blok_detail").html(data);
				},
				error:function(data){
					alert(data);					
				}
			})
	}
	
	function load_total() {
        var bukti = $("#bukti").val();
		var jns_trans= $("#jns_trans").val();
	    $.ajax({
            url: "load_total.php",
            type: "get",
            data: {
                "bukti": bukti,
                "jns_trans": jns_trans
            },
            dataType: "html",
            success: function(data) {
                $("#blok_total").html(data);
            },
            error: function(data) {
                alert(data);
            }
        })
    }
	
	function tambah_makanan(id){
		var bukti=$("#bukti").val();
		var catatan=$("#catatan").val();
		var tgl=$("#tgl").val();
		var cust=$("#cust").val();
		var telp=$("#telp").val();
		$.ajax({
			url :"kasir_act.php?jns=tbprod",
				type:"post",
				data:{produk: id, tgl:tgl, bukti: bukti, cust: cust, telp: telp,catatan:catatan},
				dataType: "html",
				success:function(data){
					load_detail();
					load_total();
				},
				error:function(data){
					alert(data);						
				}
			})
	}
	
	function scan_barcode(id){
		$.ajax({
			url :"cek_barcode.php",
				type:"get",
				data:{barcode: id},
				dataType: "html",
				success:function(data){
					if (data!=''){
						tambah_makanan(data);
						$("#barcode").val("");
					} else alert("barcode / sku tidak terdaftar");
				},
				error:function(data){
					alert(data);						
				}
			})
	}
	
	function ubah_qty(id,tanda){
		var bukti=$("#bukti").val();
		$.ajax({
			url :"kasir_act.php?jns=ubahqty",
				type:"post",
				data:{bukti: bukti,id: id,tanda: tanda},
				dataType: "html",
				success:function(data){
					load_detail(bukti);
					load_total(bukti);
				},
				error:function(data){
					alert(data);					
				}
			})
	}
	
	function tambah_catatan(){
		$("#ModalNote").modal('show');
	}
	
   function konfirmasi_set_kasir()
   {
	   tanya = confirm("Apakah anda bertindak sebagai kasir Outdoor ?");
	   if (tanya == true) return true;
	   else return false;
   }
   
    function next_order(){
		var bukti=$("#bukti").val();
		var kasir=$("#kasir").val();
		var catatan=$("#catatan").val();
		var tgl=$("#tgl").val();
		var cust=$("#cust").val();
		var telp=$("#telp").val();
		$.ajax({
			url :"kasir_act.php?jns=simpan",
				type:"post",
				data:{tgl:tgl, bukti: bukti, cust: cust, telp: telp,catatan:catatan},
				dataType: "html",
				success:function(data){
					window.location.replace("kasir_act.php?jns=next&bukti="+bukti+"&kasir="+kasir);
				},
				error:function(data){
					alert(data);						
				}
			})
	}
   
   function tampilkan_bayar(){
	   $("#bukti2").val($("#bukti").val());
	   var sub=$("#sub_total").val();
	   var ppn=$("#ppn").val();
	   var total=$("#total").val();
       sub=sub.substring(2,sub.length);    
	   ppn=ppn.substring(2,ppn.length);   
	   total=total.substring(2,total.length);   
	   $("#sub_total2").val(sub);
	   $("#ppn2").val(ppn);
	   $("#discp2").val("");
	   $("#disc2").val("");
	   $("#jns_bayar").val("1");
	   $("#no_kartu").val("");
	   $("#voucher").val("");
	   $("#total2").val(total);
	   $("#modalProceedPayment").modal('show');
   }
   
   function proses_bayar(){
		var bukti=$("#bukti").val();
		var catatan=$("#catatan").val();
		var tgl=$("#tgl").val();
		var cust=$("#cust").val();
		var telp=$("#telp").val();
		$.ajax({
			url :"kasir_act.php?jns=simpan",
				type:"post",
				data:{tgl:tgl, bukti: bukti, cust: cust, telp: telp,catatan:catatan},
				dataType: "html",
				success:function(data){
					tampilkan_bayar();
				},
				error:function(data){
					alert(data);						
				}
			})
	}
   
   function simpan_bayar(){
	  var bukti=$("#bukti").val();
	  window.open("slip.php?bukti="+bukti, '_blank');
      $("#form_bayar").submit();
   }
   
   function ubah_jenis_bayar(){
		var jns=$("#jns_bayar").val();
		if(jns=='1') $("#no_kartu").css('visibility', 'hidden');
		else  $("#no_kartu").css('visibility', 'visible');;
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
   
    
</script>	
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<div>
		    <div style="float:left;width:80px;padding:0 10px">Search</div>    
			<div style="float:left;width:300px"> 
				<input type="text" id="cari" style="padding:3px 5px;height:25px;width:100%" onkeyup="cari()">
			</div>
			<?php if($sebagai=='kasir'){?>
			<div style="margin-left:50px;float:left;width:100px"> 
				 <?php 
					$userid=AmbilData("select id from user where username='$username'");
				    $stat_kasir=AmbilData("select kasir from kasir_outdoor where kasir='$userid'");
					if($stat_kasir!='') $btn='success'; else $btn="secondary"
				 ?>
				<a href="kasir_act.php?jns=setks&kasir=<?php echo $userid?>" class="btn btn-<?php echo $btn?> btn-xs" style="font-size:14px" onclick="return konfirmasi_set_kasir()"> Kasir Outdoor </a>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php if(($sebagai=='kasir')&&($stat_kasir=='')){?> 
	<div style="padding:20px">
		<div class="alert alert-danger" role="alert">
			Klik Tombol <b>Kasir Outdoor</b> di atas untuk memulai Transaksi
		</div>
	</div>
	<?php } ?>
	<div style="<?php if(($sebagai=='kasir')&&($stat_kasir=='')){?> display:none <?php } ?>">		
	<table>
		<tr style="vertical-align:top">
		    <td width="74px">
				<div style="float:left;width:74px;background:#f4f4f4;height:470px;">
				<?php
					$q = mysqli_query($conn,"select * from kategori order by id");
					if (mysqli_num_rows($q)>0) 
					{
						$i=0; 
						while($row = mysqli_fetch_array($q)) {
							extract($row); 
						?>
						   <button type="button" onclick="load_makanan(<?php echo $id?>)" style="margin:2px 0;">
							   <div class="text-center" style="margin:5px 0;">
									<img src="img/kategori/<?php echo $gambar?>" width="60px">
									<div><?php echo $nama?></div>
							   </div>
						   </button>	 
				<?php	}
					}
				?>					
				</div>
  		    </td>
			<td width="1300px">
			  <div style="width:100%;overflow:auto;background:#fafafa" id="blok_makanan">
				  
              </div>				
			</td>
			<td width="300px" style="padding:5px 8px;border:1px solid #ddd">
				<div>
				    <?php 
					    $tb=date('ymd');
						$ksr=str_pad($userid,3,'0',STR_PAD_LEFT);
						$noakhir=AmbilData("select noakhir from nourut where tgl='$tb$ksr'");
						if($noakhir=='') {
							$nourut='001';
							$bukti=$tb.$ksr.$nourut; 
						} else {
							$noakhir++;
							$nourut=str_pad($noakhir,3,'0',STR_PAD_LEFT);
							$bukti=$tb.$ksr.$nourut;
						}
						
						if(AdaData("select kasir from kasir_outdoor where kasir='$userid'")){
						    $jns_trans='1';	
						} else $jns_trans='2';
					?>
					<div style="font-size:18px;width:140px;float:left">
					     No Order : <b>#<?php echo $nourut?></b> 
					</div>					
					<input id="tgl" name="tgl" value="<?php echo date('d-m-Y')?>" class="date-picker"  data-date-format="dd-mm-yyyy" style="width:85px;padding:2px 3px;float:right">
			  	    <input type="hidden" name="bukti" id="bukti" value="<?php echo $bukti?>">
					<input type="hidden" name="kasir" id="kasir" value="<?php echo $userid?>">
					<input type="hidden" name="jns_trans" id="jns_trans" value="<?php echo $jns_trans?>">
				</div>
				<input id="cust" name="cust" placeholder="Customer Name" style="width:100%;margin:2px">
				<input id="telp" name="telp" placeholder="Handphone" style="width:100%;margin:2px">
				<div><button class="btn btn-sm btn-primary" style="width:100%" onclick="tambah_catatan()">Note</button></div>
				<input id="barcode" name="barcode" placeholder="SKU / Barcode" style="width:100%;margin:2px">
				<div style="height:270px;overflow:auto;border:1px solid #bbb" id="blok_detail">
				   
				</div>
				<div style="font-size:16px;font-weight:700;border-top:2px solid #ccc;padding:6px" id="blok_total">
					
				</div>   
			</td>
         </tr>
       </table>		 
	   </div>
	</div><!-- /.row -->
	
	<div id="modalProceedPayment" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Pembayaran</h4>
				</div>
				<div class="modal-body" id="modal_form_bayar">
					<form role="form" class="form-horizontal" id="form_bayar" action="kasir_act.php?jns=bayar_cs" method="post">
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
	</div>
	
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

	$("#barcode").on('keyup', function (e) {
		if (e.key === 'Enter' || e.keyCode === 13) {
			var bar=$("#barcode").val();
			scan_barcode(bar);
		}
	});
	
	$('#modalProceedPayment').on('shown.bs.modal', function () {
		$('#voucher').focus();
	})  
</script>