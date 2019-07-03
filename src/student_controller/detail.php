<?php require_once('../../templates/header.php'); ?>
<?php require_once('../../templates/navbar.php'); ?>
<?php require_once('../../src/database/connection.php'); ?>
<?php

$id = $_GET['detail'];

   $data = $db_con->query("SELECT sub.name as curso, ssy.score as nota, sy.end_date as eva, y.year as ciclo
          from student s, subject sub, student_subject_year ssy, year y, subject_year sy
          where ssy.student_id = s.id
          and  ssy.subject_year_Id = sy.id
          and sy.subject_id = sub.id
          and sy.year_Id = y.id
          and s.id = $id;");
   $student = $db_con->query("SELECT s.codigo, s.fullname as nombre, ROUND(datediff(now(), s.birthdate)/365) as edad
             from student s
             where s.id = $id;");
 ?>

<div style="margin-top:3%" class="container">
  <?php $s = $student->fetch();?>
  <div class="columns">
    <div class="column">

      <?php echo $s['nombre'];?>
      <?php echo $s['codigo'];?>
      <p><?php echo $s['edad'];?> anios</p>
    </div>
    </div>
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Year</th>
                <th>State</th>
                <th>Score</th>
            </tr>
        </thead>
        <?php
            $i = 0;
            forEach($data as $row):  ?>
        <tr>
            <td><?php echo $i = $i + 1; ?></td>
            <td><?php echo $row['curso']; ?></td>
            <td><?php echo $row['ciclo']; ?></td>

        </tr>
        <?php endforeach; ?>
    </table>
  </div>
</div>
<?php require_once('../templates/footer.php'); ?>
