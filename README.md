# ee_week
```html
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
```