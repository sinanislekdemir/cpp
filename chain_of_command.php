<?php
interface ICommand
{
  function onCommand( $name, $args );
}

class CommandChain
{
  private $_commands = array();

  public function addCommand( $cmd, $definition )
  {
    $command = array('command' => $cmd, 'definition' => $definition);
    $this->_commands []= $command;
  }

  public function runCommand( $name, $args )
  {
    foreach( $this->_commands as $cmd )
    {
      if ( !$cmd['command']->onCommand( $name, $args ) )
      {
        echo "Command {$cmd['definition']} failed\n";
        return;
      }
    }
  }
}

class TokenControl implements ICommand
{
  public function onCommand( $name, $args )
  {
    if ( $name != 'post' ) return true;
    if($args['token'] == '1')
    {
        return true;
    }else{
        return false;
    }
  }
}

class LoginControl implements ICommand
{
  public function onCommand( $name, $args )
  {
    if ( $name != 'post' ) return true;
    if($args['username'] == 'admin' && $args['password'] == 'password')
    {
        return true;
    }else{
        return false;
    }
  }
}

class PageControl implements ICommand
{
  public function onCommand( $name, $args )
  {
    echo "hello world\n";
    return true;
  }
}


$_POST = array(
    'token' => '1', 'username' => 'admin', 'password' => 'password'
);

$cc = new CommandChain();
$cc->addCommand( new TokenControl() , 'token control' );
$cc->addCommand( new LoginControl() , 'login control' );
$cc->addCommand( new PageControl() , 'page render' );
$cc->runCommand( 'post', $_POST );
