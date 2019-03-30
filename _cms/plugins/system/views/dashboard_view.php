<?php 
	global $statistics;
	
	#echo json_encode($statistics);
?>
<div class="main-page">
	<div class="col_3">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-users icon-rounded"></i>
				<div class="stats">
					<h5><strong>Últimas Sesiones</strong></h5>
					
					<?php 
						$total_count = 0;
						foreach($statistics->sessions_last as $date => $hours)
							{
								$total_count = $total_count + 1;
							}
					?>
					
					<span><?php echo ($total_count); ?> Día(s)</span>
				</div>
			</div>
		</div>
					
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<div class="col-md-6 top-content">
					<h5>Sesiones</h5>
					<?php 
						$total_count = 0;
						foreach($statistics->sessions_last as $date => $hours)
							{
								foreach($hours as $hour => $item2)
									{
										$total_count = $total_count + count($item2);
									}
							}
					?>
					<label><?php echo ($total_count); ?></label>
				</div>
				<div class="col-md-6 top-content">
					<h5>Hoy</h5>
					<?php 
						$total_count = 0;
						$date_current = new DateTime();
						$day_compare = (string) date_format($date_current, 'Y-m-d');
						foreach($statistics->sessions_last as $date => $hours)
							{
								if($day_compare == $date)
									{
										foreach($hours as $hour => $item2)
											{
												$total_count = $total_count + count($item2);
											}
									}
							}
					?>
					<label><?php echo ($total_count); ?></label>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<?php 
			$total_count = 0;
			foreach($statistics->sessions_last as $date => $hours)
				{
				?>
				<div class="col-md-3 widget widget1">
					<div class="r3_counter_box">
						<i class="pull-left fa fa-pie-chart user1 icon-rounded"></i>
						<div class="stats">
							<h5><strong><?php echo ($date); ?></strong></h5>
							<!-- <span><?php echo count($hours); ?> Hora(s)</span> -->
							<?php 
								foreach($hours as $hour => $item2)
									{
										$total_count = $total_count + count($item2);
									}
							?>
							<span><?php echo ($total_count); ?> Sesion(es)</span>
						</div>
					</div>
				</div>
				<?php 
				}
		?>
		<!-- //
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-laptop dollar1 icon-rounded"></i>
				<div class="stats">
					<h5><strong>$450</strong></h5>
					<span>Expenditure</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 widget">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-users dollar2 icon-rounded"></i>
				<div class="stats">
					<h5><strong>1450</strong></h5>
					<span>Total Users</span>
				</div>
			</div>
		</div>
		-->
		
		<div class="clearfix"> </div>
	</div>
	
	<div class="row-one widgettable">
		<div class="col-md-9 content-top-2 card">
			<div class="agileinfo-cdr">
				<div class="card-header">
					<h3>Sesiones</h3>
				</div>
	
				<div class="charts">

					<div class="col-md-12 ">
						<div id="chartdiv" style="overflow: visible; text-align: left;">
						   <div class="amcharts-main-div" style="position: relative; width: 100%; height: 100%;">
							  <div class="amChartsLegend amcharts-legend-div" style="overflow: hidden; position: relative; text-align: left; width: 583px; height: 76px; cursor: default;">
								 <svg version="1.1" style="position: absolute; width: 583px; height: 76px; top: 0.375px; left: -0.015625px;">
									<desc>JavaScript chart by amCharts 3.21.12</desc>
									<g transform="translate(81,10)">
									   <path cs="100,100" d="M0.5,0.5 L433.5,0.5 L433.5,65.5 L0.5,65.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-legend-bg"></path>
									   <g transform="translate(0,11)">
										  <g cursor="pointer" class="amcharts-legend-item-g3" aria-label="Actual Sales" transform="translate(0,0)">
											 <path cs="100,100" d="M-15.5,8.5 L16.5,8.5 L16.5,-7.5 L-15.5,-7.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" transform="translate(16,8)" class="amcharts-graph-column amcharts-graph-g3 amcharts-legend-marker"></path>
											 <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" class="amcharts-legend-label" transform="translate(37,7)">
												<tspan y="6" x="0">Actual Sales</tspan>
											 </text>
											 <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" class="amcharts-legend-value" transform="translate(186,7)"> </text>
											 <rect x="32" y="0" width="154.15625" height="18" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
										  </g>
										  <g cursor="pointer" class="amcharts-legend-item-g4" aria-label="Target Sales" transform="translate(201,0)">
											 <path cs="100,100" d="M-15.5,8.5 L16.5,8.5 L16.5,-7.5 L-15.5,-7.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" transform="translate(16,8)" class="amcharts-graph-column amcharts-graph-g4 amcharts-legend-marker"></path>
											 <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" class="amcharts-legend-label" transform="translate(37,7)">
												<tspan y="6" x="0">Target Sales</tspan>
											 </text>
											 <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" class="amcharts-legend-value" transform="translate(186,7)"> </text>
											 <rect x="32" y="0" width="154.15625" height="18" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
										  </g>
										  <g cursor="pointer" class="amcharts-legend-item-g1" aria-label="Market Days" transform="translate(0,28)">
											 <g class="amcharts-graph-smoothedLine amcharts-graph-g1 amcharts-legend-marker">
												<path cs="100,100" d="M0.5,8.5 L32.5,8.5" fill="none" stroke-width="2" stroke-opacity="0.9" stroke="#20acd4" class="amcharts-graph-stroke"></path>
												<circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" class="amcharts-graph-bullet" transform="translate(17,8)"></circle>
											 </g>
											 <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" class="amcharts-legend-label" transform="translate(37,7)">
												<tspan y="6" x="0">Market Days</tspan>
											 </text>
											 <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" class="amcharts-legend-value" transform="translate(186,7)"> </text>
											 <rect x="32" y="0" width="154.15625" height="18" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
										  </g>
										  <g cursor="pointer" class="amcharts-legend-item-g2" aria-label="Market Days ALL" transform="translate(201,28)">
											 <g class="amcharts-graph-smoothedLine amcharts-graph-g2 amcharts-legend-marker">
												<path cs="100,100" d="M0.5,8.5 L32.5,8.5" fill="none" stroke-width="2" stroke-dasharray="5" stroke-opacity="0.9" stroke="#e1ede9" class="amcharts-graph-stroke"></path>
												<circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" class="amcharts-graph-bullet" transform="translate(17,8)"></circle>
											 </g>
											 <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" class="amcharts-legend-label" transform="translate(37,7)">
												<tspan y="6" x="0">Market Days ALL</tspan>
											 </text>
											 <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" class="amcharts-legend-value" transform="translate(186,7)"> </text>
											 <rect x="32" y="0" width="154.15625" height="18" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
										  </g>
									   </g>
									</g>
								 </svg>
							  </div>
							  <div class="amcharts-chart-div" style="overflow: hidden; position: relative; text-align: left; width: 583px; height: 219px; padding: 0px; cursor: default; touch-action: auto;">
								 <svg version="1.1" style="position: absolute; width: 583px; height: 219px; top: 0.371094px; left: -0.015625px;">
									<desc>JavaScript chart by amCharts 3.21.12</desc>
									<g>
									   <path cs="100,100" d="M0.5,0.5 L582.5,0.5 L582.5,218.5 L0.5,218.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-bg"></path>
									   <path cs="100,100" d="M0.5,0.5 L433.5,0.5 L433.5,108.5 L0.5,108.5 L0.5,0.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-plot-area" transform="translate(81,20)"></path>
									</g>
									<g>
									   <g class="amcharts-value-axis value-axis-v2" transform="translate(81,0)" visibility="hidden"></g>
									   <g class="amcharts-category-axis" transform="translate(81,20)">
										  <g>
											 <path cs="100,100" d="M0.5,0.5 L0.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,108)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M0.5,108.5 L0.5,108.5 L0.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M29.5,108.5 L29.5,108.5 L29.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M58.5,108.5 L58.5,108.5 L58.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M87.5,0.5 L87.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,108)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M87.5,108.5 L87.5,108.5 L87.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M115.5,108.5 L115.5,108.5 L115.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M144.5,108.5 L144.5,108.5 L144.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M173.5,0.5 L173.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,108)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M173.5,108.5 L173.5,108.5 L173.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M202.5,108.5 L202.5,108.5 L202.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M231.5,108.5 L231.5,108.5 L231.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M260.5,0.5 L260.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,108)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M260.5,108.5 L260.5,108.5 L260.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M289.5,108.5 L289.5,108.5 L289.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M318.5,108.5 L318.5,108.5 L318.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M346.5,0.5 L346.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,108)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M346.5,108.5 L346.5,108.5 L346.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M375.5,108.5 L375.5,108.5 L375.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M404.5,108.5 L404.5,108.5 L404.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.07" stroke="#000000" class="amcharts-axis-grid amcharts-axis-grid-minor"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M433.5,0.5 L433.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,108)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M433.5,108.5 L433.5,108.5 L433.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
									   </g>
									   <g class="amcharts-value-axis value-axis-v1" transform="translate(81,20)" visibility="visible">
										  <g>
											 <path cs="100,100" d="M0.5,108.5 L6.5,108.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M0.5,108.5 L0.5,108.5 L433.5,108.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,86.5 L6.5,86.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M0.5,86.5 L0.5,86.5 L433.5,86.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,65.5 L6.5,65.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M0.5,65.5 L0.5,65.5 L433.5,65.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,43.5 L6.5,43.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M0.5,43.5 L0.5,43.5 L433.5,43.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,22.5 L6.5,22.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M0.5,22.5 L0.5,22.5 L433.5,22.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,0.5 L6.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)" class="amcharts-axis-tick"></path>
											 <path cs="100,100" d="M0.5,0.5 L0.5,0.5 L433.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
										  </g>
									   </g>
									   <g class="amcharts-value-axis value-axis-v2" transform="translate(81,20)" visibility="visible">
										  <g>
											 <path cs="100,100" d="M0.5,108.5 L6.5,108.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(433,0)" class="amcharts-axis-tick"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,86.5 L6.5,86.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(433,0)" class="amcharts-axis-tick"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,65.5 L6.5,65.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(433,0)" class="amcharts-axis-tick"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,43.5 L6.5,43.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(433,0)" class="amcharts-axis-tick"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,22.5 L6.5,22.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(433,0)" class="amcharts-axis-tick"></path>
										  </g>
										  <g>
											 <path cs="100,100" d="M0.5,0.5 L6.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(433,0)" class="amcharts-axis-tick"></path>
										  </g>
									   </g>
									</g>
									<g transform="translate(81,20)" clip-path="url(#AmChartsEl-20)">
									   <g visibility="hidden"></g>
									</g>
									<g></g>
									<g></g>
									<g></g>
									<g>
									   <g transform="translate(81,20)" class="amcharts-graph-column amcharts-graph-g3">
										  <g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(7,108)" aria-label="Actual Sales Jan 16, 2013 8.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-85.5 L14.5,-85.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(36,108)" aria-label="Actual Sales Jan 17, 2013 6.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-64.5 L14.5,-64.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(65,108)" aria-label="Actual Sales Jan 18, 2013 2.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-21.5 L14.5,-21.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(94,108)" aria-label="Actual Sales Jan 19, 2013 9.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-96.5 L14.5,-96.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(123,108)" aria-label="Actual Sales Jan 20, 2013 6.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-64.5 L14.5,-64.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(152,108)" aria-label="Actual Sales Jan 21, 2013 5.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-53.5 L14.5,-53.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(181,108)" aria-label="Actual Sales Jan 22, 2013 7.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-75.5 L14.5,-75.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(210,108)" aria-label="Actual Sales Jan 23, 2013 6.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-64.5 L14.5,-64.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(238,108)" aria-label="Actual Sales Jan 24, 2013 5.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-53.5 L14.5,-53.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(267,108)" aria-label="Actual Sales Jan 25, 2013 8.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-85.5 L14.5,-85.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(296,108)" aria-label="Actual Sales Jan 26, 2013 8.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-85.5 L14.5,-85.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(325,108)" aria-label="Actual Sales Jan 27, 2013 4.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-42.5 L14.5,-42.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(354,108)" aria-label="Actual Sales Jan 28, 2013 7.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-75.5 L14.5,-75.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(383,108)" aria-label="Actual Sales Jan 29, 2013 8.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-85.5 L14.5,-85.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g3" transform="translate(412,108)" aria-label="Actual Sales Jan 30, 2013 7.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-75.5 L14.5,-75.5 L14.5,0.5 L0.5,0.5 Z" fill="#e1ede9" stroke="#e1ede9" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
										  </g>
									   </g>
									   <g transform="translate(81,20)" class="amcharts-graph-column amcharts-graph-g4">
										  <g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(10,108)" aria-label="Target Sales Jan 16, 2013 5.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-53.5 L9.5,-53.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(39,108)" aria-label="Target Sales Jan 17, 2013 4.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-42.5 L9.5,-42.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(68,108)" aria-label="Target Sales Jan 18, 2013 5.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-53.5 L9.5,-53.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(97,108)" aria-label="Target Sales Jan 19, 2013 8.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-85.5 L9.5,-85.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(126,108)" aria-label="Target Sales Jan 20, 2013 9.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-96.5 L9.5,-96.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(155,108)" aria-label="Target Sales Jan 21, 2013 3.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-31.5 L9.5,-31.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(184,108)" aria-label="Target Sales Jan 22, 2013 5.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-53.5 L9.5,-53.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(213,108)" aria-label="Target Sales Jan 23, 2013 7.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-75.5 L9.5,-75.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(241,108)" aria-label="Target Sales Jan 24, 2013 9.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-96.5 L9.5,-96.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(270,108)" aria-label="Target Sales Jan 25, 2013 5.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-53.5 L9.5,-53.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(299,108)" aria-label="Target Sales Jan 26, 2013 4.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-42.5 L9.5,-42.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(328,108)" aria-label="Target Sales Jan 27, 2013 3.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-31.5 L9.5,-31.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(357,108)" aria-label="Target Sales Jan 28, 2013 5.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-53.5 L9.5,-53.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(386,108)" aria-label="Target Sales Jan 29, 2013 5.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-53.5 L9.5,-53.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
											 <g class="amcharts-graph-column amcharts-graph-g4" transform="translate(415,108)" aria-label="Target Sales Jan 30, 2013 4.00">
												<path cs="100,100" d="M0.5,0.5 L0.5,-42.5 L9.5,-42.5 L9.5,0.5 L0.5,0.5 Z" fill="#62cf73" stroke="#62cf73" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
											 </g>
										  </g>
									   </g>
									   <g transform="translate(81,20)" class="amcharts-graph-smoothedLine amcharts-graph-g1">
										  <g></g>
										  <g clip-path="url(#AmChartsEl-23)">
											 <path cs="100,100" d="M14,104 C21,103,29,92,43,91 C58,89,58,76,72,73 C87,71,87,44,101,43 C116,42,116,56,130,56 C145,57,145,53,159,52 C174,51,174,31,188,30 C203,30,203,43,217,43 C231,44,231,42,245,43 C259,44,260,65,274,65 C289,64,289,35,303,35 C318,34,318,47,332,48 C347,48,347,52,361,52 C376,52,376,47,390,48 C405,48,412,60,419,60 " fill="none" fill-opacity="0" stroke-width="2" stroke-opacity="0.9" stroke="#20acd4" class="amcharts-graph-stroke"></path>
										  </g>
										  <clipPath id="AmChartsEl-23">
											 <rect x="0" y="0" width="433" height="108" rx="0" ry="0" stroke-width="0"></rect>
										  </clipPath>
										  <g></g>
									   </g>
									   <g transform="translate(81,20)" class="amcharts-graph-smoothedLine amcharts-graph-g2">
										  <g></g>
										  <g clip-path="url(#AmChartsEl-24)">
											 <path cs="100,100" d="M14,86 C21,86,29,76,43,73 C58,71,58,33,72,30 C87,28,87,26,101,26 C116,26,116,25,130,26 C145,27,145,44,159,43 C174,43,174,14,188,13 C203,12,203,21,217,22 C231,22,231,16,245,17 C259,19,260,48,274,48 C289,47,289,14,303,13 C318,12,318,34,332,35 C347,35,347,30,361,30 C376,30,376,34,390,35 C405,35,412,43,419,43 " fill="none" fill-opacity="0" stroke-width="2" stroke-dasharray="5" stroke-opacity="0.9" stroke="#e1ede9" class="amcharts-graph-stroke"></path>
										  </g>
										  <clipPath id="AmChartsEl-24">
											 <rect x="0" y="0" width="433" height="108" rx="0" ry="0" stroke-width="0"></rect>
										  </clipPath>
										  <g></g>
									   </g>
									</g>
									<g></g>
									<g>
									   <path cs="100,100" d="M0.5,108.5 L433.5,108.5 L433.5,108.5" fill="none" stroke-width="1" stroke-opacity="0.2" stroke="#000000" transform="translate(81,20)" class="amcharts-axis-zero-grid-v1 amcharts-axis-zero-grid"></path>
									   <g>
										  <path cs="100,100" d="M0.5,0.5 L433.5,0.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(0,50)" class="amcharts-scrollbar-line"></path>
									   </g>
									   <g class="amcharts-value-axis value-axis-v2">
										  <path cs="100,100" d="M0.5,0.5 L0.5,50.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(81,0)" class="amcharts-axis-line" visibility="hidden"></path>
									   </g>
									   <g class="amcharts-category-axis">
										  <path cs="100,100" d="M0.5,0.5 L433.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(81,128)" class="amcharts-axis-line"></path>
									   </g>
									   <g class="amcharts-value-axis value-axis-v1">
										  <path cs="100,100" d="M0.5,0.5 L0.5,108.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(81,20)" class="amcharts-axis-line" visibility="visible"></path>
									   </g>
									   <g class="amcharts-value-axis value-axis-v2">
										  <path cs="100,100" d="M0.5,0.5 L0.5,108.5 L0.5,108.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(514,20)" class="amcharts-axis-line" visibility="visible"></path>
									   </g>
									</g>
									<g>
									   <g transform="translate(81,20)" clip-path="url(#AmChartsEl-21)" style="pointer-events: none;">
										  <path cs="100,100" d="M0.5,0.5 L0.5,0.5 L0.5,108.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" class="amcharts-cursor-line amcharts-cursor-line-vertical" visibility="hidden"></path>
										  <path cs="100,100" d="M0.5,0.5 L433.5,0.5 L433.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.2" stroke="#000000" class="amcharts-cursor-line amcharts-cursor-line-horizontal" visibility="hidden"></path>
									   </g>
									   <clipPath id="AmChartsEl-21">
										  <rect x="0" y="0" width="433" height="108" rx="0" ry="0" stroke-width="0"></rect>
									   </clipPath>
									</g>
									<g>
									   <g class="amcharts-scrollbar-horizontal" visibility="visible" transform="translate(81,159)" style="touch-action: none;">
										  <rect x="0.5" y="0.5" width="434" height="50" rx="0" ry="0" stroke-width="1" fill="#000000" stroke="#000000" fill-opacity="0" stroke-opacity="0" class="amcharts-scrollbar-bg"></rect>
										  <rect x="0.5" y="0.5" width="433" height="51" rx="0" ry="0" stroke-width="0" fill="#888888" stroke="#888888" fill-opacity="0.1" stroke-opacity="0.1" class="amcharts-scrollbar-bg-selected" transform="translate(0,0)"></rect>
										  <g transform="translate(0,0)" class="amcharts-graph-smoothedLine amcharts-graph-g1">
											 <g></g>
											 <g>
												<path cs="100,100" d="M14,48 C21,47,29,41,43,40 C58,39,58,31,72,30 C87,29,87,13,101,13 C116,12,116,20,130,20 C145,20,145,18,159,18 C174,17,174,5,188,5 C203,5,203,12,217,13 C231,13,231,12,245,13 C259,13,260,25,274,25 C289,25,289,8,303,8 C318,7,318,15,332,15 C347,16,347,18,361,18 C376,18,376,15,390,15 C405,15,412,22,419,23 " fill="none" fill-opacity="0" stroke-width="1" stroke-opacity="0.5" stroke="#BBBBBB" class="amcharts-scrollbar-graph-stroke"></path>
											 </g>
											 <g></g>
										  </g>
										  <g transform="translate(0,0)" class="amcharts-graph-smoothedLine amcharts-graph-g1" clip-path="url(#AmChartsEl-25)">
											 <g></g>
											 <g>
												<path cs="100,100" d="M14,48 C21,47,29,41,43,40 C58,39,58,31,72,30 C87,29,87,13,101,13 C116,12,116,20,130,20 C145,20,145,18,159,18 C174,17,174,5,188,5 C203,5,203,12,217,13 C231,13,231,12,245,13 C259,13,260,25,274,25 C289,25,289,8,303,8 C318,7,318,15,332,15 C347,16,347,18,361,18 C376,18,376,15,390,15 C405,15,412,22,419,23 " fill="none" fill-opacity="0" stroke-width="1" stroke-opacity="1" stroke="#888888" class="amcharts-scrollbar-graph-selected-stroke"></path>
											 </g>
											 <g></g>
										  </g>
										  <g transform="translate(0,0)">
											 <g>
												<path cs="100,100" d="M0.5,50.5 L0.5,50.5 L0.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.15" stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>
											 </g>
											 <g>
												<path cs="100,100" d="M87.5,50.5 L87.5,50.5 L87.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.15" stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>
											 </g>
											 <g>
												<path cs="100,100" d="M173.5,50.5 L173.5,50.5 L173.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.15" stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>
											 </g>
											 <g>
												<path cs="100,100" d="M260.5,50.5 L260.5,50.5 L260.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.15" stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>
											 </g>
											 <g>
												<path cs="100,100" d="M346.5,50.5 L346.5,50.5 L346.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.15" stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>
											 </g>
											 <g>
												<path cs="100,100" d="M433.5,50.5 L433.5,50.5 L433.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.15" stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>
											 </g>
										  </g>
										  <g transform="translate(0,0)" visibility="visible">
											 <text y="6" fill="#AAAAAA" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(3,38.5)" class="amcharts-scrollbar-label">
												<tspan y="6" x="0">Jan 16</tspan>
											 </text>
											 <text y="6" fill="#AAAAAA" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(90,38.5)" class="amcharts-scrollbar-label">
												<tspan y="6" x="0">Jan 19</tspan>
											 </text>
											 <text y="6" fill="#AAAAAA" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(176,38.5)" class="amcharts-scrollbar-label">
												<tspan y="6" x="0">Jan 22</tspan>
											 </text>
											 <text y="6" fill="#AAAAAA" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(263,38.5)" class="amcharts-scrollbar-label">
												<tspan y="6" x="0">Jan 25</tspan>
											 </text>
											 <text y="6" fill="#AAAAAA" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(349,38.5)" class="amcharts-scrollbar-label">
												<tspan y="6" x="0">Jan 28</tspan>
											 </text>
										  </g>
										  <rect x="0.5" y="0.5" width="434" height="50" rx="0" ry="0" stroke-width="0" fill="#000" stroke="#000" fill-opacity="0.005" stroke-opacity="0.005"></rect>
										  <rect x="0" y="0.5" width="433" height="50" rx="0" ry="0" stroke-width="0" fill="#000" stroke="#000" fill-opacity="0.005" stroke-opacity="0.005" aria-label="Zoom chart using cursor arrows" role="menuitem"></rect>
										  <g aria-label="Zoom chart using cursor arrows" role="menuitem" transform="translate(-17,8)">
											 <image x="0" y="0" width="35" height="35" xlink:href="https://demo.w3layouts.com/demos_new/template_demo/06-01-2018/glance_design_dashboard-demo_Free/215073379/web/js/images/dragIconRoundBig.svg" class="amcharts-scrollbar-grip-left"></image>
											 <rect x="0.5" y="0.5" width="25" height="50" rx="0" ry="0" stroke-width="0" fill="#000" stroke="#000" fill-opacity="0.005" stroke-opacity="0.005" transform="translate(5,-7)"></rect>
										  </g>
										  <g aria-label="Zoom chart using cursor arrows" role="menuitem" transform="translate(416,8)">
											 <image x="0" y="0" width="35" height="35" xlink:href="https://demo.w3layouts.com/demos_new/template_demo/06-01-2018/glance_design_dashboard-demo_Free/215073379/web/js/images/dragIconRoundBig.svg" class="amcharts-scrollbar-grip-right"></image>
											 <rect x="0.5" y="0.5" width="25" height="50" rx="0" ry="0" stroke-width="0" fill="#000" stroke="#000" fill-opacity="0.005" stroke-opacity="0.005" transform="translate(5,-7)"></rect>
										  </g>
										  <clipPath id="AmChartsEl-25">
											 <rect x="0" y="0" width="433" height="51" rx="0" ry="0" stroke-width="0"></rect>
										  </clipPath>
									   </g>
									</g>
									<g>
									   <g transform="translate(0,0)" class="amcharts-graph-smoothedLine amcharts-graph-g1"></g>
									   <g transform="translate(0,0)" class="amcharts-graph-smoothedLine amcharts-graph-g1"></g>
									   <g transform="translate(81,20)" class="amcharts-graph-column amcharts-graph-g3"></g>
									   <g transform="translate(81,20)" class="amcharts-graph-column amcharts-graph-g4"></g>
									   <g transform="translate(81,20)" class="amcharts-graph-smoothedLine amcharts-graph-g1">
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(14,104)" aria-label="Market Days Jan 16, 2013 71.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(43,91)" aria-label="Market Days Jan 17, 2013 74.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(72,73)" aria-label="Market Days Jan 18, 2013 78.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(101,43)" aria-label="Market Days Jan 19, 2013 85.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(130,56)" aria-label="Market Days Jan 20, 2013 82.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(159,52)" aria-label="Market Days Jan 21, 2013 83.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(188,30)" aria-label="Market Days Jan 22, 2013 88.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(217,43)" aria-label="Market Days Jan 23, 2013 85.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(245,43)" aria-label="Market Days Jan 24, 2013 85.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(274,65)" aria-label="Market Days Jan 25, 2013 80.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(303,35)" aria-label="Market Days Jan 26, 2013 87.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(332,48)" aria-label="Market Days Jan 27, 2013 84.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(361,52)" aria-label="Market Days Jan 28, 2013 83.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(390,48)" aria-label="Market Days Jan 29, 2013 84.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#20acd4" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(419,60)" aria-label="Market Days Jan 30, 2013 81.00" class="amcharts-graph-bullet"></circle>
									   </g>
									   <g transform="translate(81,20)" class="amcharts-graph-smoothedLine amcharts-graph-g2">
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(14,86)" aria-label="Market Days ALL Jan 16, 2013 75.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(43,73)" aria-label="Market Days ALL Jan 17, 2013 78.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(72,30)" aria-label="Market Days ALL Jan 18, 2013 88.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(101,26)" aria-label="Market Days ALL Jan 19, 2013 89.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(130,26)" aria-label="Market Days ALL Jan 20, 2013 89.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(159,43)" aria-label="Market Days ALL Jan 21, 2013 85.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(188,13)" aria-label="Market Days ALL Jan 22, 2013 92.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(217,22)" aria-label="Market Days ALL Jan 23, 2013 90.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(245,17)" aria-label="Market Days ALL Jan 24, 2013 91.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(274,48)" aria-label="Market Days ALL Jan 25, 2013 84.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(303,13)" aria-label="Market Days ALL Jan 26, 2013 92.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(332,35)" aria-label="Market Days ALL Jan 27, 2013 87.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(361,30)" aria-label="Market Days ALL Jan 28, 2013 88.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(390,35)" aria-label="Market Days ALL Jan 29, 2013 87.00" class="amcharts-graph-bullet"></circle>
										  <circle r="2.5" cx="0" cy="0" fill="#FFFFFF" stroke="#e1ede9" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(419,43)" aria-label="Market Days ALL Jan 30, 2013 85.00" class="amcharts-graph-bullet"></circle>
									   </g>
									</g>
									<g>
									   <g></g>
									</g>
									<g>
									   <g class="amcharts-value-axis value-axis-v2" transform="translate(81,0)" visibility="hidden"></g>
									   <g class="amcharts-category-axis" transform="translate(81,20)" visibility="visible">
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(3,120.5)" class="amcharts-axis-label">
											 <tspan y="6" x="0">Jan 16</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(90,120.5)" class="amcharts-axis-label">
											 <tspan y="6" x="0">Jan 19</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(176,120.5)" class="amcharts-axis-label">
											 <tspan y="6" x="0">Jan 22</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(263,120.5)" class="amcharts-axis-label">
											 <tspan y="6" x="0">Jan 25</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(349,120.5)" class="amcharts-axis-label">
											 <tspan y="6" x="0">Jan 28</tspan>
										  </text>
									   </g>
									   <g class="amcharts-value-axis value-axis-v1" transform="translate(81,20)" visibility="visible">
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,106.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">$0M</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,84.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">$2M</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,63.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">$4M</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,41.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">$6M</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,20.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">$8M</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,-1.375)" class="amcharts-axis-label">
											 <tspan y="6" x="0">$10M</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="12px" opacity="1" font-weight="bold" text-anchor="middle" class="amcharts-axis-title" transform="translate(-60,54) rotate(-90)">
											 <tspan y="6" x="0">Sales</tspan>
										  </text>
									   </g>
									   <g class="amcharts-value-axis value-axis-v2" transform="translate(81,20)" visibility="visible">
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(443,106.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">70</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(443,84.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">75</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(443,63.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">80</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(443,41.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">85</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(443,20.625)" class="amcharts-axis-label">
											 <tspan y="6" x="0">90</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(443,-1.375)" class="amcharts-axis-label">
											 <tspan y="6" x="0">95</tspan>
										  </text>
										  <text y="6" fill="#000000" font-family="Verdana" font-size="12px" opacity="1" font-weight="bold" text-anchor="middle" class="amcharts-axis-title" transform="translate(475,54) rotate(-90)">
											 <tspan y="6" x="0">Market Days</tspan>
										  </text>
									   </g>
									</g>
									<g></g>
									<g transform="translate(81,20)"></g>
									<g></g>
									<g></g>
									<clipPath id="AmChartsEl-20">
									   <rect x="-1" y="-1" width="435" height="110" rx="0" ry="0" stroke-width="0"></rect>
									</clipPath>
								 </svg>
								 <a href="http://www.amcharts.com" title="JavaScript charts" style="position: absolute; text-decoration: none; color: rgb(0, 0, 0); font-family: Verdana; font-size: 11px; opacity: 0.7; display: block; left: 86px; top: 25px;">JS chart by amCharts</a>
							  </div>
							  <div class="amcharts-export-menu amcharts-export-menu-top-right amExportButton">
								 <ul>
									<li class="export-main">
									   <a href="#"><span>menu.label.undefined</span></a>
									   <ul>
										  <li>
											 <a href="#"><span>Download as ...</span></a>
											 <ul>
												<li><a href="#"><span>PNG</span></a></li>
												<li><a href="#"><span>JPG</span></a></li>
												<li><a href="#"><span>SVG</span></a></li>
												<li><a href="#"><span>PDF</span></a></li>
											 </ul>
										  </li>
										  <li>
											 <a href="#"><span>Save as ...</span></a>
											 <ul>
												<li><a href="#"><span>CSV</span></a></li>
												<li><a href="#"><span>XLSX</span></a></li>
												<li><a href="#"><span>JSON</span></a></li>
											 </ul>
										  </li>
										  <li><a href="#"><span>Annotate ...</span></a></li>
										  <li><a href="#"><span>Print</span></a></li>
									   </ul>
									</li>
								 </ul>
							  </div>
						   </div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<div class="col-md-3 stat">
			<div class="content-top-1">
				<div class="col-md-12 top-content">
			
					<div class="panel-group">
					
						<?php 
							$i = 0;
							foreach($statistics->sessions_last as $date => $hours)
								{
									?>
									
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse<?php echo "{$i}"; ?>"><?php echo "{$date}"; ?></a>
											</h4>
										</div>
										<div id="collapse<?php echo "{$i}"; ?>" class="panel-collapse collapse panel-body">
											<ul class="list-group">
												<?php 
													foreach($hours as $hour => $item)
														{
															$label = "{$hour}:00";
															$text = count($item)." Sesion(es)";
															echo "<li class=\"list-group-item\">{$label} | {$text}</li>";
														}
												?>
											</ul>
										</div>
									</div>
									<?php 
									$i = $i+1;
								}
						?>
					
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
					
	
</div>
