<?php
require "../conexion.php";

$id = $_POST['id'];
$assignTo = $_POST['assignTo'];


if ($assignTo == "EMPRESA") {
  $delete = mysqli_query($mysqli, "delete from curso_empresa where id_empresa='$id'");

  if (!$delete) {
    $res = array(
      "err" => !$delete,
      "statusText" => "error al validar cursos asignados"
    );

    echo json_encode($res);
  }

  $courses = json_decode($_POST['courses']);

  foreach ($courses as $el) {
    $insert = mysqli_query($mysqli, "insert into curso_empresa(id_curso, id_empresa) values ('$el','$id')");

    if (!$insert) {
      $res = array(
        "err" => !$insert,
        "statusText" => "error al asignar cursos"
      );

      echo json_encode($res);
      break;
    }
  }
}
if ($assignTo == "DEPTO") {
  $delete = mysqli_query($mysqli, "delete from curso_departamento where id_departamento='$id'");

  if (!$delete) {
    $res = array(
      "err" => !$delete,
      "statusText" => "error al validar cursos asignados"
    );

    echo json_encode($res);
  }

  $courses = json_decode($_POST['courses']);

  foreach ($courses as $el) {
    $insert = mysqli_query($mysqli, "insert into curso_departamento(id_curso, id_departamento) values ('$el','$id')");

    if (!$insert) {
      $res = array(
        "err" => !$insert,
        "statusText" => "error al asignar cursos"
      );

      echo json_encode($res);
      break;
    }
  }
}
if ($assignTo == "USER") {
  $delete = mysqli_query($mysqli, "delete from curso_usuario where id_estudiante='$id'");

  if (!$delete) {
    $res = array(
      "err" => !$delete,
      "statusText" => "error al validar cursos asignados"
    );

    echo json_encode($res);
  }

  $courses = json_decode($_POST['courses']);

  foreach ($courses as $el) {
    $insert = mysqli_query($mysqli, "insert into curso_usuario(id_curso, id_estudiante) values ('$el','$id')");

    if (!$insert) {
      $res = array(
        "err" => !$insert,
        "statusText" => "error al asignar cursos"
      );

      echo json_encode($res);
      break;
    }
  }
}


$res = array(
  "err" => false,
  "statusText" => "cursos asignados"
);

echo json_encode($res);