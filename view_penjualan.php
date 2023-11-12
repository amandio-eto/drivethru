<?php
$tgl1 = mysqli_escape_string($conn, $_POST['tgl1']);
$tgl2 = mysqli_escape_string($conn, $_POST['tgl2']);
?>
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
    try {
        ace.settings.check('breadcrumbs', 'fixed')
    } catch (e) {}
    </script>

    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="index.php">Home</a>
        </li>
        <li class="active">Visualizar relatório de vendas</li>
    </ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div>
                <a href="pdf_lap_penjualan.php?tgl1=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>"
                    class="btn btn-default" target="_blank">
                    <i class="fa fa-print"></i> Impiri </a>
            </div>
            <div class="table-responsive">
                <table width="100%" style="font-size:12px;text">
                    <tr height="50px">
                        <td colspan="4">
                            <h4>
                                <center>Relatorio Vendas
                        </td>
                    </tr>
                    <tr>
                        <td><b>Ano :
                                <?php echo $thn ?>
                            </b></td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped table-hover table-heading">
                    <thead>
                        <tr>
                            <th width="400px">Nome Conta</th>
                            <th width="150px">Code</th>
                            <th width="150px" class="text-right">
                                <?php echo $thn ?>
                            </th>
                            <th width="150px" class="text-right">
                                <?php echo $thn - 1 ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$thn_ini = 0;
						$thn_kemarin = 0; ?>
                        <tr>
                            <td><b>FLUXOS DE CAIXA DAS ATIVIDADES DE INVESTIMENTO</b></td>
                            </td>
                        <tr>
                            <td>Recibo de juros</td>
                            <td></td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_ini) ?>
                            </td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_kemarin) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Recebimento de Dividendos</td>
                            <td></td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_ini) ?>
                            </td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_kemarin) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Desinvestimento</td>
                            <td></td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_ini) ?>
                            </td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_kemarin) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Cultivo de Investimento</td>
                            <td></td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_ini) ?>
                            </td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_kemarin) ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan='2'><b>TOTAL </b></td>
                            <td align='right'>
                                <?php echo FormatAngka($tot1) ?>
                            </td>
                            <td align='right'>
                                <?php echo FormatAngka($tot2) ?>
                            </td>

                        <tr>
                            <td><b>Fluxo de caixa das atividades operacionais</b></td>
                            </td>
                        <tr>
                            <td>Pagamento de Despesas Operacionais</td>
                            <td></td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_ini) ?>
                            </td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_kemarin) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pendapatan (beban) lain</td>
                            <td></td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_ini) ?>
                            </td>
                            <td class="text-right">
                                <?php if ($header != 'Y')
									echo FormatAngka($thn_kemarin) ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'><b>TOTAL </b></td>
                            <td align='right'>
                                <?php echo FormatAngka($tot1) ?>
                            </td>
                            <td align='right'>
                                <?php echo FormatAngka($tot2) ?>
                            </td>
                    </tbody>
                </table>
            </div>
            </table>
        </div>
    </div>
</div><!-- /.row -->
</div><!-- /.page-content -->