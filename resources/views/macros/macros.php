<?php
Html::macro('age', function($birthday)
{

    return floor((time() - strtotime($birthday))/31556926);

});


Html::macro('gender', function($gender)
{
    switch($gender){

        case 'male':
            return '<span class="badge badge-male"><i class="fa fa-male"></i></span>';
            break;
        case 'female':
            return '<span class="badge badge-female"><i class="fa fa-female"></i></span>';
            break;
        default:
            return '';
    }

});


Html::macro('distance', function($distance)
{

    return '~'.round($distance).'KM';

});

