<nav aria-label="alternative nav">
    <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">
        <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
            <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                <li class="mr-3 flex-1">
                    <a href="index.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500 <?php echo $_SERVER['PHP_SELF'] == '/dict-final-proj/index.php' ? 'border-blue-600' : 'border-gray-800';?>">
                        <i class="fas fa-home pr-0 md:pr-3 <?php echo $_SERVER['PHP_SELF'] == '/dict-final-proj/index.php' ? 'text-blue-600' : '';?>"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Home</span>
                    </a>
                </li>
                <li class="mr-3 flex-1">
                    <a href="dashboard.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 <?php echo $_SERVER['PHP_SELF'] == '/dict-final-proj/dashboard.php' ? 'border-blue-600' : 'border-gray-800';?>">
                        <i class="fas fa-chart-area pr-0 md:pr-3 <?php echo $_SERVER['PHP_SELF'] == '/dict-final-proj/dashboard.php' ? 'text-blue-600' : '';?>"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Analytics</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>