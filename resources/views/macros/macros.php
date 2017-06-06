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

Html::macro('phone_numbers', function($phone_numbers)
{
    $result = "";
    
    if($phone_numbers) {
        foreach($phone_numbers as $phone_number)
            $result .= "<span class='label label-info'>" . $phone_number . "</span> ";
    }
    else {
        $result = "<span class='label label-none'>Not Available</span>";
    }
    
    return $result;
});

Html::macro('favorite', function($favorite)
{
    if($favorite)
        return "<span class='label label-no-bg color-warning'><i class='fa fa-star'></i></span> ";

    return "";
});