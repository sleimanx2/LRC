<?php namespace LRC\Providers;

use Illuminate\Html\HtmlServiceProvider;

class ExtendedHtmlServiceProvider extends HtmlServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
    {
        parent::register();

        require base_path().'/resources/views/macros/macros.php';
    }

}
