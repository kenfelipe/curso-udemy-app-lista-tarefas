<?php

  require_once '../app/todo.php';
  require_once '../app/todo.service.php';
  require_once '../app/connection.php';

  $action = $_GET['action'];

  if($action === 'register') {
    $todo = new Todo();
    $todo->__set('todo', $_POST['todo']);

    $service = new TodoService(Connection::connect());

    $service->setTodo($todo);
    $service->register();

    header('Location: ./nova_tarefa.php?success=1');
  }
  else if($action === 'done') {
    $service = new TodoService(Connection::connect());
    $service->done($_POST['id']);

    header("Location: ./{$_GET['page']}.php");
  }
  else if($action === 'delete') {
    $service = new TodoService(Connection::connect());
    $service->delete($_POST['id']);

    header("Location: ./{$_GET['page']}.php");
  }
  else if($action === 'edit') {
    $service = new TodoService(Connection::connect());
    $service->update($_POST['id'], $_POST['todo']);

    header("Location: ./{$_GET['page']}.php");
  }

?>