<?php

namespace Plugin_Name\App\Controllers\Cron;

use Plugin_Name\Core\Controller;

class My_Hourly_Event_Controller extends Controller
{

	protected function __construct()
	{
		$this->register_hook_callbacks();
	}

	protected function register_hook_callbacks()
	{
		add_action('my_hourly_event', [$this, 'hourly_event_callback']);
	}

	public function hourly_event_callback()
	{
		error_log('RUNNING HOURLY CRON ' . date('dmY - H:i:s') . "\n", 3, WP_CONTENT_DIR . '/cron-log.log');
	}
}
