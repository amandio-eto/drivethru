<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
    $bukti = mysqli_escape_string($conn,$_GET['bukti']);
	$kasir = mysqli_escape_string($conn,$_GET['kasir']);
    $query = mysqli_query($conn, "SELECT * FROM transaksi WHERE bukti = $bukti");
    while ($row = mysqli_fetch_array($query)) {
        $sub_total = $row['sub_total'];
        $ppn = $row['ppn'];
        $total = $row['total'];
    }
    echo '<form role="form" class="form-horizontal" id="form_bayar" action="kasir_act.php?jns=bayar_cs" method="post">
    <input type="hidden" name="bukti" id="bukti2" value="'.$bukti.'">
    <input type="hidden" name="kasir" id="kasir" value="'.$kasir.'">
    <div class="form-group">
        <div class="col-sm-12">
            <table>
                <tr>
                    <td style="padding:3px" width="140px">Sub Total</td>
                    <td style="padding:3px"><input id="sub_total2" type="text" size="10" class="text-right" value="'.$sub_total.'" readonly></td>
                </tr>
                <tr>
                    <td style="padding:3px">Tax</td>
                    <td style="padding:3px"><input id="ppn2" type="text" size="10" class="text-right" value="'.$ppn.'" readonly></td>
                </tr>
                <tr>
                    <td style="padding:3px"><input name="voucher" type="text" size="12" placeholder="Voucher"></td>
                    <td style="padding:3px"><input id="" name="disc" type="text" size="10" class="text-right" value="0" readonly></td>
                </tr>
                <tr>
                    <td style="padding:3px">Total</td>
                    <td style="padding:3px"><input id="total2" type="text" size="10" class="text-right" value="'.$total.'" readonly></td>
                </tr>
                <tr>
                    <td style="padding:3px">Payment Method</td>
                    <td style="padding:3px">
                        <select name="jns_bayar" id="jns_bayar" style="width:100%" onchange="ubah_jenis_bayar()">
                            <option value="1">Cash</option>
                            <option value="2">Debit Card</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="padding:3px" colspan="2"><input id="no_kartu" name="no_kartu" type="text" size="26" maxlength="20" placeholder="Card Number" style="width:100%;visibility: hidden;"></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Bayar</button>
    </div>
</form>';             
            
?>			