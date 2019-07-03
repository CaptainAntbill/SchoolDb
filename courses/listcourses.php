<?php require_once('../templates/header.php'); ?>
<?php require_once('../templates/navbar.php'); ?>
<?php require_once('../src/database/connection.php'); ?>

<?php
$result = $db_con->query("SELECT s.id, s.name, t.fullname as profesor, sy.end_date as stat
                         from teacher t, subject s, subject_year sy, year y
                         where sy.teacher_id = t.id
                         and sy.subject_id = s.id
                         and sy.year_id = y.id
                         and y.year = year(now())");

?>

<div class="container" style="margin-top:3%">
  <a href="newCourse.php" class="button is-primary is-pulled-right">New</a>
  <h1 class="title">Cursos</h1>
  <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Teacher</th>
                <th>State</th>
                <th>Detail</th>
            </tr>
        </thead>
        <?php
            $i = 0;
            forEach($result as $row):  ?>
        <tr>
            <td><?php echo $i = $i + 1; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['profesor']; ?></td>
            <td>
            <?php  if ($row['stat']): ?>
                Proceso

           <?php else:  ?>
                Terminado
            <?php endif; ?>
            </td>
         <td>
            <a href="detailcourses.php?detail=<?php echo $row['id']; ?>" class="button is-warning">Detail</a>
        </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
