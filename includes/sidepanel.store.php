<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white shadow collapse">
    <div class="position-sticky pt-3 min-vh-custom">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($store_page)) {
                                                                        echo 'collapsed';
                                                                    } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="<?php if (isset($store_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseOne">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $store_page ?>" aria-current="page">
                            <i class="fa-solid fa-chart-line"></i>
                            Dashboard
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse <?php if (isset($store_page)) {
                                                                                    echo 'show';
                                                                                } ?>" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $dashboard_page ?>" aria-current="page" href="../store/index.php?store_id=<?= $record['store_id'] ?>">
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
                                <a class="nav-link text-secondary fw-semibold <?= $products_page ?>" aria-current="page" href="../store-product/index.php?store_id=<?= $record['store_id'] ?>">
                                    Product List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $addproduct_page ?>" href="../store-product/create.php?store_id=<?= $record['store_id'] ?>">
                                    Add Product
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $invent_page ?>" aria-current="page" href="../store-product/inventory.php?store_id=<?= $record['store_id'] ?>">
                                    Inventory
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($orders_page)) {
                                                                        echo 'collapsed';
                                                                    }  ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="<?php if (isset($orders_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseThree">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $orders_page ?>" href="../admin/store.php">
                            <i class="fa-solid fa-list-check"></i>
                            Orders
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse <?php if (isset($orders_page)) {
                                                                                        echo 'show';
                                                                                    } ?>" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $pending_page ?>" aria-current="page" href="../store-orders/index.php?store_id=<?= $record['store_id'] ?>">
                                    Pending
                                </a>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $processing_page ?>" aria-current="page" href="../store-orders/processing.php?store_id=<?= $record['store_id'] ?>">
                                    Processing
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $ready_pickup_page ?>" aria-current="page" href="../store-orders/ready-pickup.php?store_id=<?= $record['store_id'] ?>">
                                    For Pickup
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $ready_deliver_page ?>" aria-current="page" href="../store-orders/ready-deliver.php?store_id=<?= $record['store_id'] ?>">
                                    For Delivery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $completed_page ?>" aria-current="page" href="../store-orders/completed.php?store_id=<?= $record['store_id'] ?>">
                                    Completed
                                </a>
                            </li>
                            <li class="nav-item d-none">
                                <a class="nav-link text-secondary fw-semibold <?= $new_order_page ?>" href="../store-orders/create-order.php?store_id=<?= $record['store_id'] ?>">
                                    New Order
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingtwenty">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($fulfill_page)) {
                                                                        echo 'collapsed';
                                                                    }  ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsetwenty" aria-expanded="<?php if (isset($fulfill_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseThree">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $fulfill_page ?>" href="../admin/store.php">
                            <i class="fa-solid fa-dolly"></i>
                            Fulfillment
                        </p>
                    </button>
                </h2>
                <div id="flush-collapsetwenty" class="accordion-collapse collapse <?php if (isset($fulfill_page)) {
                                                                                        echo 'show';
                                                                                    } ?>" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $pickup_page ?>" aria-current="page" href="../store-orders/index.php?store_id=<?= $record['store_id'] ?>">
                                    Pickup
                                </a>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $pickup_page ?>" aria-current="page" href="../store-orders/processing.php?store_id=<?= $record['store_id'] ?>">
                                    Deliver
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button px-2 pt-3 pb-2 <?php if (!isset($sales_page)) {
                                                                        echo 'collapsed';
                                                                    }  ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="<?php if (isset($sales_page)) {
                                                                                                                                                                            echo 'true';
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'false';
                                                                                                                                                                        } ?>" aria-controls="flush-collapseFour">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $sales_page ?>">
                            <i class="fa-solid fa-chart-column"></i>
                            Sales
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse <?php if (isset($sales_page)) {
                                                                                    echo 'show';
                                                                                } ?>" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $daily_page ?>" aria-current="page" href="../store-sales/index.php?store_id=<?= $record['store_id'] ?>">
                                    Daily
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $monthly_page ?>" href="../store-sales/monthly.php?store_id=<?= $record['store_id'] ?>">
                                    Monthly
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $yearly_page ?>" href="../store-sales/yearly.php?store_id=<?= $record['store_id'] ?>">
                                    Yearly
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0 d-none">
                <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button px-2 pt-3 pb-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        <p class="nav-link text-secondary fw-semibold m-0 <?= $messages_page ?>" href="../admin/message-inbox.php">
                            <i class="fa-solid fa-envelope"></i>
                            Messages
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 pt-1 py-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $index_page ?>" aria-current="page" href="../admin/index.php">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $products_page ?>" href="../admin/product.php">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $stores_page ?>" href="../admin/store.php=">
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
                                <a class="nav-link text-secondary fw-semibold <?= $settingsindex_page ?>" aria-current="page" href="../store-settings/index.php?store_id=<?= $record['store_id'] ?>">
                                    Main
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-semibold <?= $staff_page ?>" aria-current="page" href="../store-settings/staff.php?store_id=<?= $record['store_id'] ?>">
                                    Staff
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>