<?php
Html::macro('age', function($birthday)
{

    return floor((time() - strtotime($birthday))/31556926);

});

