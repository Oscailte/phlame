<?php

/**
 * Register application modules
 */
$application->registerModules(array(
    'core' => array(
        'className' => 'Phlame\Core\Module',
        'path' => __DIR__ . '/../apps/core/Module.php'
    )
));
