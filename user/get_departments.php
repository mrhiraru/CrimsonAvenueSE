<?php
require_once("../classes/department.class.php");

$department = new Department();
if (isset($_POST['college'])) {
    $departmentArray = $department->show_department_of($_POST['college']);
} else {
    $departmentArray = $department->show_department_of($_GET['id']);
}
if (count($departmentArray) != 0) {
?>
    <option value="">Select Department</option>
    <?php
    foreach ($departmentArray as $item) {
    ?>
        <option value="<?= $item['department_id'] ?>" <?php if ((isset($_POST['department']) && $_POST['department'] == $item['department_id'])) {
                                                            echo 'selected';
                                                        } ?>> <?= $item['department_name'] ?></option>
    <?php
    }
} else {
    if (isset($_GET['id']) || isset($_POST['college']) && count($departmentArray) == 0) {
    ?>
        <option value="">No Department</option>
    <?php
    } else {
    ?>
        <option value="">Select Department (College Required)</option>
<?php
    }
}
var_dump($_GET['id']);
?>