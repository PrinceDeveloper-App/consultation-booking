<?php include_once(VIEWPATH . "common/resourceHeader.php") ?>

<body id="body">
    <section class="signin-page account">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="block text-center">
                        <a href="<?php echo base_url(); ?>">
                            <!-- replace logo here -->
                            <svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-size="40"
                                    font-family="AustinBold, Austin" font-weight="bold">
                                    <g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
                                        <text id="AVIATO">
                                            <tspan x="115.94" y="325">IKIC</tspan>
                                        </text>
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <h2 class="text-center">Administrator Login</h2>
                        <?php include_once("forms/loginform.php") ?>

                        <!-- <p class="mt-20">New in this site ?<a href="signin.html"> Create New Account</a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once(VIEWPATH . "scripts/mainScript.php") ?>
    <?php include_once("scripts/loginScript.php") ?>
</body>

</html>