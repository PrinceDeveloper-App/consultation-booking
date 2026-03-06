<section class="user-dashboard page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include_once(VIEWPATH . "admin/common/dashboardMenu.php") ?>
                <div class="dashboard-wrapper user-dashboard">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SI NO.</th>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Notes</th>
                                    <th>Country</th>
                                    <th>Program</th>
                                    <th>Appointment Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <!-- <th></th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 0;
                                if (isset($appointments)) {
                                    foreach ($appointments as $app) {
                                        $i++;
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $app['client_first_name'] ?>&nbsp;<?php echo $app['client_last_name'] ?></td>
                                            <td><?php echo $app['client_email'] ?></td>
                                            <td><?php echo $app['client_phone'] ?></td>
                                            <td><?php echo $app['additional_notes'] ?></td>
                                            <td><?php echo $app['country_of_residence'] ?></td>
                                            <td><?php echo $app['program_of_interest'] ?></td>
                                            <td><?php echo $app['appointment_date'] ?></td>
                                            <td><?php echo $app['appointment_time'] ?></td>
                                            <!-- <td><span class="label label-primary">Processing</span></td> -->
                                            <!-- <td><a href="order.html" class="btn btn-default">View</a></td> -->
                                            <td><select id="mySelect" class="styled-select status" data-id="<?php echo $app['appointment_id']; ?>">
                                                    <option value="0">Change Status</option>
                                                    <option value="active" <?= $app['appointment_status']=='active'?'selected':''; ?>>Active</option>
                                                    <option value="Completed" <?= $app['appointment_status']=='Completed'?'selected':''; ?>>Completed</option>
                                                    <option value="Canceled" <?= $app['appointment_status']=='Canceled'?'selected':''; ?>>Canceled</option>
                                                </select></td>
                                        </tr>
                                <?php }
                                } ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>