<?php

use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

function invoke_proc( $proc, $mode, $subdir = null ) {
  $map = array(
    'run' => 'run_check',
    'try' => 'run'
  );
  $method = $map[ $mode ];

  return $proc->$method( $subdir );
}

$steps->When( '/^I (run|try) `([^`]+)`$/',
  function ( $world, $mode, $cmd ) {
    $cmd = $world->replace_variables( $cmd );
    $world->result = invoke_proc( $world->proc( $cmd ), $mode );
  }
);

$steps->When( "/^I (run|try) `([^`]+)` from '([^\s]+)'$/",
  function ( $world, $mode, $cmd, $subdir ) {
    $cmd = $world->replace_variables( $cmd );
    $world->result = invoke_proc( $world->proc( $cmd ), $mode, $subdir );
  }
);

$steps->When( '/^I (run|try) the previous command again$/',
  function ( $world, $mode ) {
    if ( !isset( $world->result ) )
      throw new \Exception( 'No previous command.' );

    $proc = Process::create( $world->result->command, $world->result->cwd, $world->result->env );
    $world->result = invoke_proc( $proc, $mode );
  }
);
