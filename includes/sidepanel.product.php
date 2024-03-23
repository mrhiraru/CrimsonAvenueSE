<nav id="sidebarMenu" class="col-md-auto m-0 p-0 pt-0 pt-md-5 d-md-block collapse bg-smoke">
    <div class="position-sticky pt-3 d-flex justify-content-md-end">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item border-0">
                <h2 class="accordion-header bg-smoke" id="flush-headingOne">
                    <button class="fs-6 bg-smoke border-0 px-2 py-1" disabled type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                        <p class="text-secondary fw-semibold m-0" aria-current="page">
                            Categories
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse show bg-smoke" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 ps-2 py-1 fs-7 text-secondary border-0">
                        <form action="./products.php" method="get" name="category_filter">
                            <input type="hidden" name="page" value="1">
                            <?php
                            if (isset($_GET['search'])) {
                            ?>
                                <input type="hidden" name="search" value="<?= $_GET['search'] ?>">
                            <?php
                            }
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" id="flexRadioDefault1" value="All" onchange="categoryFilter()" <?= isset($_GET['category']) && $_GET['category'] == "All" ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    All Categories
                                </label>
                            </div>
                            <?php
                            $counter = 1;
                            $category = new Category();
                            $categoryArray = $category->show();
                            foreach ($categoryArray as $item) {
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="flexRadioDefault2<?= $counter ?>" value="<?= $item['category_name'] ?>" onchange="categoryFilter()" <?= isset($_GET['category']) && $_GET['category'] == $item['category_name']  ? "checked" : "" ?>>
                                    <label class="form-check-label" for="flexRadioDefault2<?= $counter ?>">
                                        <?= $item['category_name'] ?>
                                    </label>
                                </div>
                            <?php
                                $counter++;
                            }
                            if (isset($_GET['sort'])) {
                            ?>
                                <input type="hidden" name="sort" value="<?= $_GET['sort'] ?>">
                            <?php
                            }
                            if (isset($_GET['exclusivity'])) {
                            ?>
                                <input type="hidden" name="exclusivity" value="<?= $_GET['exclusivity'] ?>">
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header bg-smoke" id="flush-headingTwo">
                    <button class="fs-6 bg-smoke border-0 px-2 py-1" disabled type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                        <p class="text-secondary fw-semibold m-0" aria-current="page">
                            Sorts
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse show bg-smoke" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 ps-2 py-1 fs-7 text-secondary border-0">
                        <form action="./products.php" method="get" name="sort_filter">
                            <input type="hidden" name="page" value="1">
                            <?php
                            if (isset($_GET['search'])) {
                            ?>
                                <input type="hidden" name="search" value="<?= $_GET['search'] ?>">
                            <?php
                            }
                            if (isset($_GET['category'])) {
                            ?>
                                <input type="hidden" name="category" value="<?= $_GET['category'] ?>">
                            <?php
                            }
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="flexRadioDefault3" value="Newest" onchange="sortFilter()" <?= isset($_GET['sort']) && $_GET['sort'] == "Newest"  ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Newest to Oldest
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="flexRadioDefault4" value="Oldest" onchange="sortFilter()" <?= isset($_GET['sort']) && $_GET['sort'] == "Oldest"  ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Oldest to Newest
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="flexRadioDefault6" value="Lowest" onchange="sortFilter()" <?= isset($_GET['sort']) && $_GET['sort'] == "Lowest"  ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault6">
                                    Price (Low to High)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="flexRadioDefault7" value="Highest" onchange="sortFilter()" <?= isset($_GET['sort']) && $_GET['sort'] == "Highest"  ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault7">
                                    Price (High to Low)
                                </label>
                            </div>
                            <?php
                            if (isset($_GET['exclusivity'])) {
                            ?>
                                <input type="hidden" name="exclusivity" value="<?= $_GET['exclusivity'] ?>">
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header bg-smoke" id="flush-headingThree">
                    <button class="fs-6 bg-smoke border-0 px-2 py-1" disabled type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="true" aria-controls="flush-collapseThree">
                        <p class="text-secondary fw-semibold m-0" aria-current="page">
                            Exclusivity
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse show bg-smoke" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 ps-2 py-1 fs-7 text-secondary border-0">
                        <form action="./products.php" method="get" name="exclusivity_filter">
                            <input type="hidden" name="page" value="1">
                            <?php
                            if (isset($_GET['search'])) {
                            ?>
                                <input type="hidden" name="search" value="<?= $_GET['search'] ?>">
                            <?php
                            }
                            if (isset($_GET['category'])) {
                            ?>
                                <input type="hidden" name="category" value="<?= $_GET['category'] ?>">
                            <?php
                            }
                            if (isset($_GET['sort'])) {
                            ?>
                                <input type="hidden" name="sort" value="<?= $_GET['sort'] ?>">
                            <?php
                            }
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exclusivity" id="flexRadioDefault81" value="All" onchange="exclusivityFilter()" <?= isset($_GET['exclusivity']) && $_GET['exclusivity'] == "All"  ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault81">
                                    All Exclusivity
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exclusivity" id="flexRadioDefault8" value="All Users" onchange="exclusivityFilter()" <?= isset($_GET['exclusivity']) && $_GET['exclusivity'] == "All Users"  ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault8">
                                    All Users
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exclusivity" id="flexRadioDefault9" value="WMSU Users" onchange="exclusivityFilter()" <?= isset($_GET['exclusivity']) && $_GET['exclusivity'] == "WMSU Users"  ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault9">
                                    WMSU Users
                                </label>
                            </div>
                            <?php if (isset($_SESSION['college_name'])) {
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exclusivity" id="flexRadioDefault10" value="<?= $_SESSION['college_name'] ?>" onchange="exclusivityFilter()" <?= isset($_GET['exclusivity']) && $_GET['exclusivity'] == $_SESSION['college_name'] ? "checked" : "" ?>>
                                    <label class="form-check-label" for="flexRadioDefault10">
                                        <?= $_SESSION['college_name'] ?>
                                    </label>
                                </div>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>