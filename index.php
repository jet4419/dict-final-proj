<?php include './views/header.php' ?>

<?php 

$query = 'SELECT Employee.id, Employee.last_name, Employee.first_name, Employee.middle_name, Sex.gender, Employee.address, 
          Ranking.position, Ranking.salary FROM Employee 
          INNER JOIN Ranking ON Ranking.rank_id = Employee.rank_id
          INNER JOIN Sex On Employee.sex_id = Sex.sex_id';
$res = mysqli_query($conn, $query);
$employees = mysqli_fetch_all($res, MYSQLI_ASSOC);

$query = 'SELECT rank_id, position FROM Ranking';
$res = mysqli_query($conn, $query);
$position = mysqli_fetch_all($res, MYSQLI_ASSOC);

// echo 'employees';
// var_dump($employees);

$lname = $fname = $mname = $sex = $address = '';

// Form Submit

if(isset($_POST['addRecordForm'])) {
    $lname = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mname = filter_input(INPUT_POST, 'middle_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query = "INSERT INTO employee (last_name, first_name, middle_name, sex_id, address, rank_id) VALUES ('$lname', '$fname', '$mname', '$sex', '$address', '$position')";

    if(mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}


?>

<div class="container mx-auto px-4">

    <div class="alert-update-success hidden p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        Record updated successfully!
    </div>
    <div class="alert-delete-success hidden p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        Record deleted successfully!
    </div>

    <!-- <div id="alert-3" class="alert-update-success hidden flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
            Record updated successfully!
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div> -->

    <h1 class="text-center text-3xl font-semibold leading-loose text-gray-900 dark:text-white">List of Employees</h1>
    <button type="button" id="addRecordBtn" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Add New Record</button>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg pt-8 w-100">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        ID
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Last Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        First Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Middle Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Sex
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Address
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Position
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Salary
                    </th>
                </tr>
            </thead>
            <tbody id="table-data">
                <?php foreach ($employees as $emp): ?>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="emp-id py-4 px-6">
                            <?= $emp['id']?>
                        </td>
                        <td class="emp-lastname py-4 px-6">
                            <?= $emp['last_name']?>
                        </td>
                        <td class="emp-firstname py-4 px-6">
                            <?= $emp['first_name']?>
                        </td>
                        <td class="emp-middlename py-4 px-6">
                            <?= $emp['middle_name']?>
                        </td>
                        <td class="emp-sexid py-4 px-6">
                            <?= $emp['gender']?>
                        </td>
                        <td class="emp-address py-4 px-6">
                            <?= $emp['address']?>
                        </td>
                        <td class="emp-address py-4 px-6">
                            <?= $emp['position']?>
                        </td>
                        <td class="emp-address py-4 px-6">
                             <?php echo "₱ " . $emp['salary']?>
                        </td>
                        <td class="emp- w-1/4 py-4 px-6 sm:flex-col justify-between md:flex flex-row justify-between">
                            <button data-emp-id="<?=$emp['id']?>" class="editModalBtn font-medium text-blue-600 dark:text-blue-500 hover:underline" >Edit</button>
                            <button class="deleteModalBtn font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>

<!-- Modals -->

<!-- Add new record modal -->
<?php include './views/modals/add_new_record.php' ?>

<!-- Edit record modal -->
<?php include './views/modals/edit_record.php' ?>

<!-- Delete Record Modal -->
<?php include './views/modals/delete_record.php' ?>


<?php include './views/footer.php' ?>
