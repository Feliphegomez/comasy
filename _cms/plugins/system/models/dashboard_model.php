<?php 

class Statistics extends BaseClass 
{
	public $sessions = array();
	public $sessions_last = array();
	
	function __construct()
		{
			$temp_sessions = new Sessions();
			$this->sessions = $temp_sessions->data;
			$this->capture_sessions();
		}
	
	function capture_sessions()
		{
			if(is_array($this->sessions))
				{
					foreach($this->sessions as $item)
						{
							$date_origin = new DateTime($item->last_accessed);
							$datetime1 = date_create($item->last_accessed);
							$datetime2 = date_create();
							$interval = date_diff($datetime1, $datetime2);
							#echo $interval->format('%R%a días');
							
							$day_int = (int) $interval->format('%a');
							$min_int = (int) $interval->format('%i');
							
							
							if($day_int < 32 ) // && $min_int < 3600
								{
									$day_int = (string) $day_int;
									$min_int = (string) $min_int;
									$day = (string) date_format($date_origin, 'Y-m-d');
									$hour = (string) date_format($date_origin, 'H');
									
									
									if(!isset($this->sessions_last[$day]))
										{
											$this->sessions_last[$day] = array();
										}
									
									if(!isset($this->sessions_last[$day][$hour]))
										{
											$this->sessions_last[$day][$hour] = array();
										}
									
									$this->sessions_last[$day][$hour][] = $item;
								}
									
							# $item->last_accessed
							# echo json_encode($item->last_accessed);
						}
				}
		}
}