<?php require_once('../templates/header.php'); ?>
<?php require_once('../templates/navbar.php'); ?>

<?php
$id = $_GET['detail'];
require_once('../src/database/connection.php');

    $curso = $db_con->query("SELECT s.name, t.fullname as profesor, sy.start_date, sy.end_date
                             from teacher t, subject s, subject_year sy, year y
                             where sy.teacher_id = t.id
                             and sy.subject_id = s.id
                             and sy.year_id = y.id
                             and y.year = year(now())
                             and s.id = $id");


     $stu = $db_con->query("SELECT s.codigo,  s.fullname
                            from student s, subject sub, subject_year sy, student_subject_year ssy
                            where sy.subject_id = sub.id
                            and ssy.student_id = s.id
                            and ssy.subject_year_id = sy.id
                            and sub.id = $id;");



?>

<div class="container" style="margin-top:3%">
 <?php $c = $curso->fetch(); ?>
    <div class="columns">
        <div class="column">
          <?php echo $c['name'];?> <br>
          <?php echo $c['profesor']; ?>
          <p><b>Inicio: </b><?php echo $c['start_date'];?></p>
          <p><b>Fin: </b><?php echo $c['end_date'];?></p>
        </div>
    </div>

    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
            </tr>
        </thead>
        <?php  $i = 0; ?>
        <?php foreach($stu as $row):  ?>

        <tr>

            <td><?php echo $i = $i + 1 ?></td>


            <td><?php echo $row['codigo']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
        </tr>
        <?php endForEach; ?>
    </table>
</div>

<?php require_once('../templates/footer.php'); ?>
