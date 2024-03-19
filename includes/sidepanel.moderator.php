<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white shadow collapse">
    <div class="position-sticky pt-3 min-vh-custom">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($admin_page)) {
                                                                        echo 'collapsed';
                                                                    } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="<?php if (isset($admin_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseOne">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $admin_page ?>" aria-current="page">
                            <i class="fa-solid fa-chart-line"></i>
                            Dashboard
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse <?php if (isset($admin_page)) {
                                                                                    echo 'show';
                                                                                } ?>" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $dashboard_page ?>" aria-current="page" href="../moderator/index.php">
                                    Main
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($product_page)) {
                                                                        echo 'collapsed';
                                                                    } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="<?php if (isset($product_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseTwo">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $product_page ?>" aria-current="page">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            Products
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse <?php if (isset($product_page)) {
                                                                                    echo 'show';
                                                                                } ?>" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $products_page ?>" aria-current="page" href="..moderator-products/index.php">
                                    Product List
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($stores_page)) {
                                                                        echo 'collapsed';
                                                                    }  ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="<?php if (isset($stores_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseThree">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $stores_page ?>">
                            <i class="fa-solid fa-store"></i>
                            Stores
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse <?php if (isset($stores_page)) {
                                                                                        echo 'show';
                                                                                    } ?>" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $store_page ?>" aria-current="page" href="../moderator-stores/index.php">
                                    Store List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $registration_page ?>" href="../moderator-stores/registrations.php">
                                    Registrations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $createstore_page ?>" href="../moderator-stores/create.php">
                                    Create Store
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($users_page)) {
                                                                        echo 'collapsed';
                                                                    }  ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="<?php if (isset($users_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseFour">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $users_page ?>">
                            <i class="fa-solid fa-address-book"></i>
                            Users
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse <?php if (isset($users_page)) {
                                                                                    echo 'show';
                                                                                } ?>" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $user_page ?>" aria-current="page" href="../moderator-users/index.php">
                                    User List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $create_page ?>" href="../moderator-users/create.php">
                                    Create Account
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button px-2 pt-3 pb-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $messages_page ?>" href="../moderator/message-inbox.php">
                            <i class="fa-solid fa-envelope"></i>
                            Messages
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $index_page ?>" aria-current="page" href="../moderator/index.php">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $products_page ?>" href="../moderator/product.php">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $stores_page ?>" href="../moderator/store.php">
                                    <i class="fa-solid fa-store"></i>
                                    Stores
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingSix">
                    <button class="accordion-button px-2 pt-3 pb-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $reports_page ?>" href="../moderator/report.php">
                            <i class="fa-solid fa-scroll"></i>
                            Reports
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $index_page ?>" aria-current="page" href="../moderator/index.php">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $products_page ?>" href="../moderator/product.php">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $stores_page ?>" href="../moderator/store.php">
                                    <i class="fa-solid fa-store"></i>
                                    Stores
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingSeven">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($settings_page)) {
                                                                        echo 'collapsed';
                                                                    }  ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="<?php if (isset($settings_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseSeven">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $settings_page ?>">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseSeven" class="accordion-collapse collapse <?php if (isset($settings_page)) {
                                                                                        echo 'show';
                                                                                    } ?>" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $semester_page ?>" aria-current="page" href="../moderator-settings/index.php">
                                    Main
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $college_page ?>" href="../moderator-settings/college.php">
                                    Colleges
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $department_page ?>" href="../moderator-settings/department.php">
                                    Departments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $moderator_page ?>" href="../moderator-settings/moderator.php">
                                    Moderators
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $category_page ?>" href="../moderator-settings/category.php">
                                    Categories
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>