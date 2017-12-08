<?php
return [
    'name_prefix' => date('Ymd'),
    'type_seat' => [
      '1' => 'Normal',
      '2' => 'VIP',
      '3' => 'Couple',
    ],
    'users' => [
        'path_upload' => 'images/user/'
    ],
    'films' => [
       'path_upload' => 'images/film/'
    ],
    'no_image' => [
          'path_no-image' => 'images/no-image.jpeg'
    ],
    'technologies' => [
      '2D' => 1,
      '3D' => 2,
      '4D' => 3,
      '5D' => 4,
    ],
];