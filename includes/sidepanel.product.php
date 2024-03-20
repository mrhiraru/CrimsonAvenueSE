<nav id="sidebarMenu" class="col-md-auto pt-0 pt-md-5 d-md-block collapse bg-smoke">
    <div class="position-sticky pt-3">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item border-0">
                <h2 class="accordion-header bg-smoke" id="flush-headingOne">
                    <button class="fs-6 bg-smoke border-0 px-2 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                        <p class="nav-link text-secondary fw-semibold m-0" aria-current="page">
                            Categories
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse show bg-smoke" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 ps-2 py-1 fs-7 text-secondary border-0">
                        <form action="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    All Categories
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Others
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header bg-smoke" id="flush-headingTwo">
                    <button class="fs-6 bg-smoke border-0 px-2 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                        <p class="nav-link text-secondary fw-semibold m-0" aria-current="page">
                            Filters
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse show bg-smoke" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 ps-2 py-1 fs-7 text-secondary border-0">
                        <form action="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" checked>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Recently Added
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Bestselling
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
                                <label class="form-check-label" for="flexRadioDefault5">
                                    Recently Added
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6">
                                <label class="form-check-label" for="flexRadioDefault6">
                                    Price (Low to High)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7">
                                <label class="form-check-label" for="flexRadioDefault7">
                                    Price (High to Low)
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0">
                <h2 class="accordion-header bg-smoke" id="flush-headingThree">
                    <button class="fs-6 bg-smoke border-0 px-2 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="true" aria-controls="flush-collapseThree">
                        <p class="nav-link text-secondary fw-semibold m-0" aria-current="page">
                            Exclusivity
                        </p>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse show bg-smoke" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0 ps-2 py-1 fs-7 text-secondary border-0">
                        <form action="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8" checked>
                                <label class="form-check-label" for="flexRadioDefault8">
                                    All Users
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault9">
                                <label class="form-check-label" for="flexRadioDefault9">
                                    WMSU Users
                                </label>
                            </div>
                            <?php if (isset($_SESSION['college_name'])) {
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault10">
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