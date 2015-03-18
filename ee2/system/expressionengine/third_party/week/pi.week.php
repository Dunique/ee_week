<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Week {

	/*
	<ul>
		{exp:week limit="3" start_on="CURRENT" parse="inward"}
			<li>
				<h1>{week_nr} {start_date format='%Y-%m-%d'} - {end_date format='%Y-%m-%d'}</h1>
				<ul>
					{exp:channel:entries channel="test" dynamic="no" start_on="{start_date format='%Y-%m-%d'}" stop_before="{end_date format='%Y-%m-%d'}" show_future_entries="yes"}
						<li>{title}</li>
					{/exp:channel:entries}
				</ul>
			</li>
		{/exp:week}
	</ul>
	 */
    public function __construct()
    {
    	$variables = array();

    	//get the year
    	$year = ee()->TMPL->fetch_param('year', date('Y'));

    	//start on week
    	$start_on_week_nr = ee()->TMPL->fetch_param('start_on', 1);

    	//when start on is set to the current week
    	if(strtolower($start_on_week_nr) == 'current')
    	{
    		$start_on_week_nr = date('W');
    	} 

    	//set the limit
    	$limit = ee()->TMPL->fetch_param('limit');

    	//get all week numbers
    	$weeks = range($start_on_week_nr, 52);

    	//do we have a limit?
    	if($limit != '')
    	{
    		$weeks = array_slice($weeks, 0, $limit);
    	}

    	foreach($weeks as $week_nr)
    	{
    		$week_dates = $this->get_start_and_end_date($week_nr-1, $year);
    		$variables[] = array(
    			'week_nr' => $week_nr,
	    		'start_date' => $week_dates[0],
	    		'end_date' => $week_dates[1]
    		);
    	}

    	$this->return_data = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $variables);
    }

    public function get_start_and_end_date($week, $year)
	{
	    $time = strtotime("1 January $year", time());
	    $day = date('w', $time);
	    $time += ((7*$week)+1-$day)*24*3600;
	    $return[0] = $time;
	    $time += 6*24*3600;
	    $return[1] = $time;
	    return $return;
	}
}

/* End of file pi.plugin_name.php */
/* Location: ./system/expressionengine/third_party/plugin_name/pi.plugin_name.php */