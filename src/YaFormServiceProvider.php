<?php namespace Mrself\YaF;

use Illuminate\Support\ServiceProvider;

class YaFormServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__.'/views', 'ya-form');
		$this->publishes([
		    __DIR__.'/views' => base_path('resources/views/vendor/ya-form'),
		]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('YaF', 'Mrself\YaF\Form\Form');
	}

}
