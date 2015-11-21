# ya-form
Create html form in laravel 5 easy.

## Basic usage

    $form = \App::make('YaF');
    // name of your form to use it when makin id for field
    $form->setName('example');
    
    // name of form to use for making bem classes.
    // this name will be as block name
    // the name of field class will be 'my-form__fieldName'
    $form->setDName('my-form');
    $form->init($formValuesArray, $fieldsData, $fieldsArguments);
    
    // in view
    $form->render(); // this output only fields, not opening and closing form tag

