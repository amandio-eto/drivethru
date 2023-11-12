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
	        <li class="active">Dashboard</li>
	    </ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
	    <div class="col-xs-12">
	        <!-- PAGE CONTENT BEGINS -->
	        <div class="row">
	            <div></div>
	            <h4>Benvindu Mai ChickETO, <?php echo ucwords($_SESSION['user'])?>, </h4>
	        </div><!-- /.row -->
	        <?php  
			    $tgl=date('Y-m-d');
				//$tgl='2023-09-04';
				$jual=AmbilData("select sum(total) from transaksi where tgl='$tgl' and status='2'");
				$jual_cash=AmbilData("select sum(total) from transaksi where tgl='$tgl' and jns_bayar=1 and status='2'");
				$jual_debit=AmbilData("select sum(total) from transaksi where tgl='$tgl' and jns_bayar=2 and status='2'");
				$batal=AmbilData("select sum(total) from transaksi where tgl='$tgl' and status='3'");
				$jml_produk=AmbilData("select sum(qty) from transaksi_detail d 
				      left outer join transaksi t on(t.bukti=d.bukti) where t.tgl='$tgl' and t.status='2'");
				if($jual=='') $jual=0;
				if($jual_cash=='') $jual_cash=0;
				if($jual_debit=='') $jual_debit=0;
				if($batal=='') $batal=0;
				if($jml_produk=='') $jml_produk=0;
				//pie
				$q = mysqli_query($conn,"SELECT p.nama,SUM(qty) AS qty FROM transaksi_detail d 
					LEFT OUTER JOIN transaksi t ON(t.bukti=d.bukti) 
					LEFT OUTER JOIN produk p ON(p.id=d.produk) 
					WHERE t.tgl='$tgl' AND t.status='2' GROUP BY p.nama order by sum(qty) desc");
				$pie_produk='';	
				$i=0;$jml=0;
				$warna=array("#68BC31","#2091CF", "#AF4E96", "#EB2332", "#DA5430", "#FEE074","#00007B");
				while($row = mysqli_fetch_array($q)) {
					extract($row);
					$i++;
					if ($i<8){
						$jml=$jml+$qty;
						if($pie_produk!='') $pie_produk=$pie_produk.',';
						$pie_produk=$pie_produk.'{ label: "'.$nama.'  ('.$qty.')",  data: '.$qty.', color: "'.$warna[$i-1].'"}';	
					}					
				}	
                if($jml<$jml_produk){
					$selisih=$jml_produk-$jml;
					$pie_produk=$pie_produk.',{ label: "Other ('.$selisih.')",  data: '.$selisih.', color: "#A6A6A6"}';
				}	
				
			    //grafik	
				$bulan=date('m');
				$tahun=date('Y');
				$akhir_bulan=date('t');
				$grafik='';
				
				for($i=1;$i<=$akhir_bulan;$i++){
					$jual_harian=round(AmbilData("select sum(total) from transaksi where tgl='$tahun-$bulan-$i' and status='2'"),0);
					if($jual_harian=='') $jual_harian=0;
					if($grafik!='') $grafik=$grafik.',';
					$grafik=$grafik."[$i, $jual_harian]";
				}
				?>

	        <div style="margin-top:20px">
	            <div style="padding-left:6px;padding-bottom:5px;font-weight:700;">Penjualan Hari Ini</div>
	            <div class="infobox infobox-blue">
	                <div class="infobox-icon">
	                    <i class="ace-icon fa fa-shopping-cart"></i>
	                </div>

	                <div class="infobox-data">
	                    <span class="infobox-data-number">$ <?php echo FormatAngka($jual)?></span>
	                    <div class="infobox-content">Total Penjualan</div>
	                </div>
	            </div>

	            <div class="infobox infobox-pink">
	                <div class="infobox-icon">
	                    <i class="ace-icon fa fa-money"></i>
	                </div>
	                <div class="infobox-data">
	                    <span class="infobox-data-number">$ <?php echo FormatAngka($jual_cash)?></span>
	                    <div class="infobox-content">Penjualan Cash</div>
	                </div>
	            </div>

	            <div class="infobox infobox-green">
	                <div class="infobox-icon">
	                    <i class="ace-icon fa fa-credit-card"></i>
	                </div>
	                <div class="infobox-data">
	                    <span class="infobox-data-number">$ <?php echo FormatAngka($jual_debit)?></span>
	                    <div class="infobox-content">Penjualan Debit</div>
	                </div>
	            </div>

	            <div class="infobox infobox-red">
	                <div class="infobox-icon">
	                    <i class="ace-icon fa fa-window-close"></i>
	                </div>
	                <div class="infobox-data">
	                    <span class="infobox-data-number">$ <?php echo FormatAngka($batal)?></span>
	                    <div class="infobox-content">Penjualan Batal</div>
	                </div>
	            </div>

	            <div class="infobox infobox-orange">
	                <div class="infobox-icon">
	                    <i class="ace-icon fa fa-cube"></i>
	                </div>
	                <div class="infobox-data">
	                    <span class="infobox-data-number"> <?php echo FormatAngka($jml_produk)?></span>
	                    <div class="infobox-content">Produk Terjual</div>
	                </div>
	            </div>
	        </div>
	        <div class="row" style="margin-top:10px">
	            <div class="col-md-6">
	                <div style="border:1px solid #ddd">
	                    <div style="padding:6px 12px;font-weight:700">Produk Terjual</div>
	                    <div class="widget-body">
	                        <div class="widget-main">
	                            <div id="piechart-placeholder"></div>
	                        </div><!-- /.widget-main -->
	                    </div><!-- /.widget-body -->
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div style="border:1px solid #ddd">
	                    <div style="padding:6px 12px;font-weight:700">Penjualan Bulan Ini</div>
	                    <div class="widget-body">
	                        <div class="widget-main padding-4">
	                            <div id="sales-charts"></div>
	                        </div><!-- /.widget-main -->
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- PAGE CONTENT ENDS -->
	    </div><!-- /.col -->
	</div><!-- /.row -->

	<script type="text/javascript">
jQuery(function($) {
    $('.easy-pie-chart.percentage').each(function() {
        var $box = $(this).closest('.infobox');
        var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') :
            'rgba(255,255,255,0.95)');
        var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
        var size = parseInt($(this).data('size')) || 50;
        $(this).easyPieChart({
            barColor: barColor,
            trackColor: trackColor,
            scaleColor: false,
            lineCap: 'butt',
            lineWidth: parseInt(size / 10),
            animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
            size: size
        });
    })

    $('.sparkline').each(function() {
        var $box = $(this).closest('.infobox');
        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
        $(this).sparkline('html', {
            tagValuesAttribute: 'data-values',
            type: 'bar',
            barColor: barColor,
            chartRangeMin: $(this).data('min') || 0
        });
    });


    //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
    //but sometimes it brings up errors with normal resize event handlers
    $.resize.throttleWindow = false;

    var placeholder = $('#piechart-placeholder').css({
        'width': '90%',
        'min-height': '220px'
    });
    var data = [<?php echo $pie_produk?>]

    function drawPieChart(placeholder, data, position) {
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    tilt: 0.9,
                    highlight: {
                        opacity: 0.25
                    },
                    stroke: {
                        color: '#fff',
                        width: 2
                    },
                    startAngle: 2
                }
            },
            legend: {
                show: true,
                position: position || "ne",
                labelBoxBorderColor: null,
                margin: [-30, 15]
            },
            grid: {
                hoverable: true,
                clickable: true
            }
        })
    }
    drawPieChart(placeholder, data);

    /**
    we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
    so that's not needed actually.
    */
    placeholder.data('chart', data);
    placeholder.data('draw', drawPieChart);


    //pie chart tooltip example
    var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo(
        'body');
    var previousPoint = null;

    placeholder.on('plothover', function(event, pos, item) {
        if (item) {
            if (previousPoint != item.seriesIndex) {
                previousPoint = item.seriesIndex;
                var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                $tooltip.show().children(0).text(tip);
            }
            $tooltip.css({
                top: pos.pageY + 10,
                left: pos.pageX + 10
            });
        } else {
            $tooltip.hide();
            previousPoint = null;
        }

    });

    /////////////////////////////////////
    $(document).one('ajaxloadstart.page', function(e) {
        $tooltip.remove();
    });




    var d1 = [<?php echo $grafik?>];


    var sales_charts = $('#sales-charts').css({
        'width': '100%',
        'height': '240px'
    });
    $.plot("#sales-charts", [{
        label: "Total Penjualan ($)",
        data: d1
    }], {
        hoverable: true,
        shadowSize: 0,
        series: {
            lines: {
                show: true
            },
            points: {
                show: true
            }
        },
        xaxis: {
            tickLength: 0
        },
        yaxis: {
            ticks: 10,
            min: 0,
            max: 1000,
            tickDecimals: 0
        },
        grid: {
            backgroundColor: {
                colors: ["#fff", "#fff"]
            },
            borderWidth: 1,
            borderColor: '#555'
        }
    });


    $('#recent-box [data-rel="tooltip"]').tooltip({
        placement: tooltip_placement
    });

    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('.tab-content')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
        return 'left';
    }


    $('.dialogs,.comments').ace_scroll({
        size: 300
    });


    //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
    //so disable dragging when clicking on label
    var agent = navigator.userAgent.toLowerCase();
    if ("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
        $('#tasks').on('touchstart', function(e) {
            var li = $(e.target).closest('#tasks li');
            if (li.length == 0) return;
            var label = li.find('label.inline').get(0);
            if (label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation();
        });

    $('#tasks').sortable({
        opacity: 0.8,
        revert: true,
        forceHelperSize: true,
        placeholder: 'draggable-placeholder',
        forcePlaceholderSize: true,
        tolerance: 'pointer',
        stop: function(event, ui) {
            //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
            $(ui.item).css('z-index', 'auto');
        }
    });
    $('#tasks').disableSelection();
    $('#tasks input:checkbox').removeAttr('checked').on('click', function() {
        if (this.checked) $(this).closest('li').addClass('selected');
        else $(this).closest('li').removeClass('selected');
    });


    //show the dropdowns on top or bottom depending on window height and menu position
    $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
        var offset = $(this).offset();

        var $w = $(window)
        if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
            $(this).addClass('dropup');
        else $(this).removeClass('dropup');
    });

})
	</script>