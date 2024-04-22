<?php 
require_once('../tools/functions.php');
require_once('../classes/store.class.php');
session_start();

$store = new Store();
$store_id = $store->fetch($_GET['store_id']);

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Store | Crimson Avenue";
$page_name = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto min-vh-100 ">
        <main>
            <div class="container shadow">
                <div class="row ">
                    <div class="col-lg-6 p-5 rounded ">
                        <div class="row bg-maroon py-3 ps-2 ">
                            <div class="col-lg-6">
                                <?php
                                require_once('../classes/store.class.php');

                                if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                    $store_id = $_GET['store_id'];
                                    $store = new Store();
                                    $store_data = $store->show_profile($store_id); 
                                    if ($store_data !== false) {
                                        // Data is available
                                        if (!empty($store_data['store_profile'])) {
                                            // Profile image path is available
                                            $profile_image_path = '../images/data/' . $store_data['store_profile'];
                                            //echo "Profile Image Path: " . $profile_image_path; // Debugging output - Commented out
                                            echo '<img src="' . $profile_image_path . '" class="rounded-circle ms-5" width="150px" height="150px" alt="Store Profile Image">';
                                        } else {
                                            // If store profile image is not available, display a default image
                                            echo '<img src="../images/main/no-profile.jpg" class="rounded-circle ms-5" width="150px" height="150px" alt="Default Profile Image">';
                                        }
                                    } else {
                                        // No data available for the provided store ID
                                        echo '<p class="fw-bold fs-5 text-secondary text-end">No data available for the provided store ID</p>';
                                    }
                                } else {
                                    echo "Store ID parameter is missing or null in the URL.";
                                }
                                
                                ?>
                                <p class=" pb-2 ms-5 mt-5 ps-3">Solds : 
                                    <?php
                                        require_once('../classes/order.class.php');
                                            if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                            $store_id = $_GET['store_id'];
                                            $orders = new Order();
                                            $num_orders = $orders->count_solds($store_id);
                                            
                                            if ($num_orders !== null) {
                                                echo '<strong class="ms-3">' . $num_orders . '</strong></p>';
                                            } else {
                                                echo "Failed to retrieve the total number of orders.";
                                            }
                                        } else {
                                            echo "Store ID parameter is missing or null in the URL.";
                                        }
                                        
                                    ?>
                                
                                </p>
                            </div>

                            <div class="col-lg-6">
                                <p class="h3 fw-bolder ">
                                <?php
                                    require_once('../classes/store.class.php');
                                    if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                        $store_id = $_GET['store_id'];
                                        $store = new Store();
                                        $store_data = $store->show_profile($store_id); 
                                        if ($store_data !== false) {
                                            // Store data is available
                                            if (isset($store_data['store_name'])) {
                                                // Display the store name
                                                echo '<p class="h3">' . $store_data['store_name'] . '</p>';
                                            } else {
                                                // Store name is not available
                                                echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No store name available</p>';
                                            }
                                        } else {
                                            // No data available for the provided store ID
                                            echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No data available for the provided store ID</p>';
                                        }
                                    } else {
                                        echo "Store ID parameter is missing or null in the URL.";
                                    }
                                ?>

                                </p>
                                <p class="h5">
                                <?php
                                    require_once('../classes/store.class.php');
                                    if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                        $store_id = $_GET['store_id'];
                                        $store = new Store();
                                        $store_data = $store->show_profile($store_id); 
                                        if ($store_data !== false) {
                                            // Store data is available
                                            if (isset($store_data['verification_status'])) {
                                                // Display the store name
                                                echo '<p class="h5 fw-lighter ">' . $store_data['verification_status'] . '</p>';
                                            } else {
                                                // Store name is not available
                                                echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No store name available</p>';
                                            }
                                        } else {
                                            // No data available for the provided store ID
                                            echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No data available for the provided store ID</p>';
                                        }
                                    } else {
                                        echo "Store ID parameter is missing or null in the URL.";
                                    }
                                ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-5">
                        <div class="row">
                            <div class="col-lg-12">
                            <p class=" pb-2 ">Email : 
                                <?php
                                    require_once('../classes/store.class.php');
                                    if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                        $store_id = $_GET['store_id'];
                                        $store = new Store();
                                        $store_data = $store->show_profile($store_id); 
                                        if ($store_data !== false) {
                                            // Store data is available
                                            if (isset($store_data['store_email'])) {
                                                // Display the store name
                                                echo  '<strong class="ms-3">' . $store_data['store_email'] . '</strong></p>';
                                            } else {
                                                // Store name is not available
                                                echo 'No data</p>';
                                            }
                                            
                                        }
                                    }
                                ?>
                            </p>
                            <p class=" pb-2">Contact:
                                <?php
                                    require_once('../classes/store.class.php');
                                    if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                        $store_id = $_GET['store_id'];
                                        $store = new Store();
                                        $store_data = $store->show_profile($store_id); 
                                        if ($store_data !== false) {
                                            // Store data is available
                                            if (isset($store_data['store_contact'])) {
                                                // Display the store name
                                                echo  '<strong class="ms-3">' . $store_data['store_contact'] . '</strong></p>';
                                            } else {
                                                // Store name is not available
                                                echo 'No data</p>';
                                            }
                                            
                                        }
                                    }
                                ?>
                            </p>
                            <p class=" pb-2">Location: 
                                <?php
                                    require_once('../classes/store.class.php');
                                    if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                        $store_id = $_GET['store_id'];
                                        $store = new Store();
                                        $store_data = $store->show_profile($store_id); 
                                        if ($store_data !== false) {
                                            // Store data is available
                                            if (isset($store_data['store_location'])) {
                                                // Display the store name
                                                echo  '<strong class="ms-3">' . $store_data['store_location'] . '</strong></p>';
                                            } else {
                                                // Store name is not available
                                                echo 'No data</p>';
                                            }
                                            
                                        }
                                    }
                                ?>
                            </p>
                            <p class=" pb-2">Business Time : 
                                <?php
                                    require_once('../classes/store.class.php');
                                    if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                        $store_id = $_GET['store_id'];
                                        $store = new Store();
                                        $store_data = $store->show_profile($store_id); 
                                        if ($store_data !== false) {
                                            // Store data is available
                                            if (isset($store_data['business_time'])) {
                                                // Display the store name
                                                echo  '<strong class="ms-3">' . $store_data['business_time'] . '</strong></p>';
                                            } else {
                                                // Store name is not available
                                                echo 'No data</p>';
                                            }
                                            
                                        }
                                    }
                                ?>
                            </p>
                            <p class=" pb-2">Total Product : 
                                <?php
                                    require_once('../classes/store.class.php');
                                    if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                        $store_id = $_GET['store_id'];
                                        $store = new Store();
                                        $num_products = $store->count_products_store($store_id);
                                        
                                        if ($num_products !== false) {
                                            echo '<strong class="ms-3">' . $num_products . '</strong></p>';
                                        } else {
                                            echo 'No data</p>';
                                        }
                                    }
                                ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 p-4">
                        <p class="h4">About us</p>
                        <p class="bg-backround p-3">
                        <?php
                            require_once('../classes/store.class.php');
                            if(isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                $store_id = $_GET['store_id'];
                                $store = new Store();
                                $store_data = $store->show_profile($store_id); 
                                if ($store_data !== false) {
                                    // Store data is available
                                    if (isset($store_data['store_bio'])) {
                                        // Display the store name
                                        echo '' . $store_data['store_bio'] . '</p>';
                                    } else {
                                        // Store name is not available
                                        echo 'No store bio </p>';
                                    }
                                } 
                            }

                        ?>
                        </p>
                    </div>
                </div>
            </div>
        </main>
        
        

        <section>
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>