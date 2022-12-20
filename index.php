<?php include './views/header.php' ?>

<?php 

$query = 'SELECT * FROM employee';
$res = mysqli_query($conn, $query);
$employees = mysqli_fetch_all($res, MYSQLI_ASSOC);

$lname = $fname = $mname = $sex = $address = '';

// Form Submit

if(isset($_POST['addRecordForm'])) {
    $lname = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mname = filter_input(INPUT_POST, 'middle_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query = "INSERT INTO employee (last_name, first_name, middle_name, sex_id, address) VALUES ('$lname', '$fname', '$mname', '$sex', '$address')";

    if(mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}


?>

<h1 class="text-center text-3xl font-bold">List of Employees</h1>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp): ?>
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="py-4 px-6">
                        <?= $emp['id']?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $emp['last_name']?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $emp['first_name']?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $emp['middle_name']?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $emp['sex_id']?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $emp['address']?>
                    </td>
                    <td class="w-1/4 py-4 px-6 sm:flex-col justify-between md:flex flex-row justify-between">
                    <a href="#" data-modal-toggle="edit-record-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" >Edit</a>
                    <a href="#" data-modal-toggle="delete-record-modal" class="font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</a>
                </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modals -->

<!-- Add new record modal -->
<?php include './views/modals/add_new_record.php' ?>

<!-- Edit record modal -->
<?php include './views/modals/edit_record.php' ?>

<!-- Delete Record Modal -->
<?php include './views/modals/delete_record.php' ?>


<?php include './views/footer.php' ?>
