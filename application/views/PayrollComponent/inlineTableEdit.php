<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>


<div class="main-content main-content1">
    <section class="section">
        <div class="section-header card-primary" style="border-top: 2px solid #891635">
            <h1>-</h1>
        </div>
        <div class="section-body">
            <div class=" justify-content-center">
                <div class="">
                    <div class="card">
                        <div class="card-body col-md-6">
                            <div class="list-group">

                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between ">

                                        <div class="col-md-9" contenteditable="true">
                                            <p class="mb-1">
                                                <i class="fas fa-angle-double-right text-success"></i>
                                                Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                        <small class="text-muted"><b>12 June</b>
                                            <button class="btn btn-link btn-sm">
                                                <i class="fa fa-comment text-black-50"></i></button>

                                            <button class="btn btn-link btn-sm" id="dropdownMenuButton"  data-toggle="dropdown">
                                                <i class="fa fa-fa fa-ellipsis-v text-info"  ></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <li class="dropdown-item  text-info text-small" ><i class="fa fa-calendar" > </i> Attach To Activity</li>
                                                <li class="dropdown-item  text-danger text-small" ><i class="fa fa-trash" ></i> Delete</li>
                                                <li class="dropdown-item  text-primary text-small" ><i class="fa fa-eye"></i> View</li>
                                                <li class="dropdown-item  text-success text-small" ><i class="fa fa-check"></i> Complete</li>
                                            </div>
                                        </small>
                                        </div>

                                    </div>
                                    <small class="text-muted"></small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between ">

                                        <div class="col-md-9" contenteditable="true">
                                            <p class="mb-1">
                                                <i class="fas fa-angle-double-right text-danger"></i>
                                                Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted"><b>4pm-6pm</b>
                                                <button class="btn btn-link btn-sm">
                                                    <i class="fa fa-comment text-black-50"></i></button>

                                                <button class="btn btn-link btn-sm" id="dropdownMenuButton"  data-toggle="dropdown">
                                                    <i class="fa fa-fa fa-ellipsis-v text-info"  ></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <li class="dropdown-item  text-info text-small" ><i class="fa fa-calendar" > </i> Attach With Focus View</li>
                                                    <li class="dropdown-item  text-danger text-small" ><i class="fa fa-trash" ></i> Delete</li>
                                                    <li class="dropdown-item  text-primary text-small" ><i class="fa fa-eye"></i> View</li>
                                                    <li class="dropdown-item  text-success text-small" ><i class="fa fa-check"></i> Complete</li>
                                                </div>
                                            </small>
                                        </div>

                                    </div>
                                    <small class="text-muted"></small>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


<?php $this->load->view('_partials/footer'); ?>

