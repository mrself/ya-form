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
		$this->publishes([
		    __DIR__.'/config/ya-form.php' => config_path('ya-form.php'),
		]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
		    __DIR__.'/config/ya-form.php', 'ya-form'
		);
		$this->app->bind('Mrself\YaF\Form\Form', 'Mrself\YaF\Form\Form');
	}

}
