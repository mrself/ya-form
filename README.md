# Why do you need this package?

How do you create forms? Say you have articles resource and want to implements creating / editing articles. What do you do first? I can suppose that you have to create the full markup for form in `create` view and also the same form markup for `edit` view. And event if you have 5 fields it takes a lot of time to create this stuff. But I see a simplier way to do it. You define what fields do you need in array format, init package. And in when you need to show your fields you  write: `$form->render();`. That's all. You have all the fields that you need.

## How it works

Well, it is more interesting. The format of the needed data is a simple array of fields in such a format:
    
    [
        'name' => 'article_title',
        'type' => 'text',
        'label' => 'Title of the article'
    ]

And in the end you will have:

    <div class="form-group">
    	<label for="formName-article_title">
    		Title of the article
    	</label>
	    <input class="form-control" id="formName-article_title" type="text" name="article_title" value="">
	</div>

The key here is that you have template for each type of field (textarea, select). The package goes through the array of fields and render view for each field. In the result you have the html of such rows of fields. You can change view files for row and for field.

## How to install

Install via composer:

    composer require mrself/ya-form

Add `'Mrself\YaF\YaFormServiceProvider'` to your service providers in `config/app.php`.
If you want to rewrite the view files, run `php artisan vendor:publish --provider="Mrself\YaF\YaFormServiceProvider"`.

## How to use

First, create the instance:
    
        $form = \App::make('YaF');
        
And init:
    
        $form->init($seedData, $fields, $args);
        
`$seedData` is the array of values for form fields. The key is the name of field, and value of the array if the value of field.
`$fields` is the array of main fields data:
    
        [
            'name' => 'article_title',
            'type' => 'text',
            'label' => 'Title of the article'
        ]
        
`$args` is the array of arguments for fields. The key is the name of field and value is the args for fields.
    
And in you view you can simple write: `{!! $form->render() !!}` which output all the fields. Note that does not include form opening and closing tag.

