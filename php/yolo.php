<?php

define( 'YOLO', true );
define( 'YOLO_VERSION', '0.0-dev' );

include YOLO_ROOT . '/php/utils.php';

\YOLO\Utils\load_dependencies();

$strict = in_array('--strict', $_SERVER['argv']);
$arguments = new \cli\Arguments(compact('strict'));

$arguments->addFlag(array('verbose', 'v'), 'Turn on verbose output');
$arguments->addFlag('version', 'Display the version');
$arguments->addFlag(array('quiet', 'q'), 'Disable all output');
$arguments->addFlag(array('help', 'h'), 'Show this help screen');

$arguments->addOption(array('cache', 'C'), array(
  'default'     => getcwd(),
  'description' => 'Set the cache directory'));
$arguments->addOption(array('name', 'n'), array(
  'default'     => 'James',
  'description' => 'Set a name with a really long description and a default so we can see what line wrapping looks like which is probably a goo idea'));



$arguments->parse();
if ($arguments['help'] || count($arguments->getArguments()) == 0) {
  echo "PHP YOLO: because YOLO\n";
  echo $arguments->getHelpScreen();
  echo "\n\n";
}
