<?php include './views/header.php' ?>

<?php 

    // include_once './config/database.php';
    // $query = 'SELECT * FROM employee';
    // $res = mysqli_query($conn, $query);
    // $employees = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $query = 'SELECT Employee.id, Employee.last_name, Employee.first_name, Employee.middle_name, Sex.gender, Employee.address, 
          Employee.rank_id, Ranking.position, Ranking.salary FROM Employee 
          INNER JOIN Ranking ON Ranking.rank_id = Employee.rank_id
          INNER JOIN Sex On Employee.sex_id = Sex.sex_id
          ORDER BY Employee.last_name, Employee.first_name, Employee.middle_name';
    $res = mysqli_query($conn, $query);
    $employees = mysqli_fetch_all($res, MYSQLI_ASSOC);


    $query = 'SELECT * FROM Ranking';
    $res = mysqli_query($conn, $query);
    $empPositions = mysqli_fetch_all($res, MYSQLI_ASSOC);

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
        $position = filter_input(INPUT_POST, 'employee-position', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "INSERT INTO employee (last_name, first_name, middle_name, sex_id, address, rank_id) VALUES ('$lname', '$fname', '$mname', '$sex', '$address', '$position')";

        if(mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

?>

<header>
    <!--Nav-->
    <nav aria-label="menu nav" class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

        <div class="flex flex-wrap items-center">
            <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                <a href="#" aria-label="Home">
                    <span class="text-xl pl-2"><i class="em em-grinning"></i></span>
                </a>
            </div>

            <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
                <span class="relative w-full">
                    <input aria-label="search" type="search" id="search" placeholder="Search" class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">
                    <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
                        <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>
                </span>
            </div>

            <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block py-2 px-4 text-white no-underline" href="#">Active</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-gray-400 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">link</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <div class="relative inline-block">
                            <button onclick="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2"> <span class="pr-2"><i class="em em-robot_face"></i></span> Hi, User <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg></button>
                            <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                                <input type="text" class="drop-search p-2 text-gray-600" placeholder="Search.." id="myInput" onkeyup="filterDD('myDropdown','myInput')">
                                <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Profile</a>
                                <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Settings</a>
                                <div class="border border-gray-800"></div>
                                <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
</header>


<main>

    <div class="flex flex-col md:flex-row">
        <?php include 'views/nav.php'?>
        <section class="w-3/4">
        <!--  -->
            <div id="main" class="main-content flex-2 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Employees</h1>
                    </div>
                </div>
                
                <!-- <div class="my-4 alert-update-success hidden p-2 mx-2 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    Record updated successfully!
                </div>
                <div class="my-4 alert-delete-success hidden p-2 mx-2 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    Record deleted successfully!
                </div> -->
                <button type="button" id="addRecordBtn" class="block mt-4 mx-4 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Add New Record</button>

                <div class="flex flex-wrap px-4">
                    

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

                <!-- <h1 class="text-center text-3xl font-semibold leading-loose text-gray-900 dark:text-white">List of Employees</h1> -->
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg pt-4 w-100">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead id="table-head" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6 hidden">
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
                                    Salary (₱)
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="table-data">
                            <?php if(count($employees) > 0): ?>
                                <?php foreach ($employees as $emp): ?>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="emp-id py-4 px-6 hidden">
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
                                        <td data-rank-id="<?=$emp['rank_id']?>" class="emp-position py-4 px-6">
                                            <?= $emp['position']?>
                                        </td>
                                        <td class="emp-salary py-4 px-6">
                                            <?php echo number_format($emp['salary'])?>
                                        </td>
                                        <td class="emp- w-1/4 py-4 px-6 sm:flex-col justify-between md:flex flex-row justify-between">
                                            <button onclick="openEditModal(event)" data-emp-id="<?=$emp['id']?>" class="editModalBtn font-medium text-blue-600 dark:text-blue-500 hover:underline" >Edit</button>
                                            <button onclick="openDeleteModal(event)" class="deleteModalBtn font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else :?>
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td colspan="9" class="py-4 px-6 text-center">
                                        No Data Available
                                    </td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>


                </div>
            </div>

            <!-- Add new record modal -->
            <?php include './views/modals/add_new_record.php' ?>

            <!-- Edit record modal -->
            <?php include './views/modals/edit_record.php' ?>

            <!-- Delete Record Modal -->
            <?php include './views/modals/delete_record.php' ?>
        </section>
    </div>
</main>

<?php include 'views/footer.php'; ?>