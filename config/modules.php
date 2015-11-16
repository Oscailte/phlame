<?php

/**
 * Register application modules
 */
$application->registerModules(array(
    'core' => array(
        'className' => 'Phlame\Core\Module',
        'path' => __DIR__ . '/../apps/core/Module.php'
    ),
   //'frontend' => array(
   //     'className' => 'Phlame\Frontend\Module',
   //     'path' => __DIR__ . '/../apps/frontend/Module.php'
   // )
   'front' => array(
        'className' => 'Phlame\Front\Module',
        'path' => __DIR__ . '/../apps/front/Module.php'
    )
));
