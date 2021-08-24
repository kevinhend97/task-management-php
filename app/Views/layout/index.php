<!DOCTYPE html>
<!--
* CoreUI Pro based Bootstrap Admin Template
* @version v3.2.0
* @link https://coreui.io/pro/
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* License (https://coreui.io/pro/license)
-->
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>KamarAdmin - <?= $pages ?></title>
    <!-- Main styles for this application-->
    <link href="<?= base_url('include/coreui') ?>/css/style.css" rel="stylesheet">

     <!-- Toasts css -->
     <link href="<?= base_url('include/plugins') ?>/toastr.min.css" rel="stylesheet">
    <!-- Font Core UI -->
    <link href="<?= base_url('include/coreui') ?>/vendors/@coreui/icons/css/free.min.css" rel="stylesheet">

    <link href="<?= base_url('include/coreui') ?>/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css"/>
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <!-- Select2 -->
       <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <?= $this->renderSection('css') ?>
  </head>
  <body class="c-app c-secondary-theme">

    <!-- Jquery -->
    <script src="<?= base_url('include/plugins') ?>/jquery.js"></script>
    <!-- Datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>
    <!-- Toastr JS -->
    <script src="<?= base_url('include/plugins') ?>/toastr.min.js"></script>
    <!-- Swal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Lodash -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js"></script>
    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.1.1/dist/echarts.min.js" integrity="sha256-Yhe8c0oOs2dPYVQKLAi1aBB9uhr7yMmh67ukoWBqDuU=" crossorigin="anonymous"></script>


    <?= $this->renderSection('js') ?>
    <?= $this->include('layout/sidebar') ?>
    <div class="c-wrapper">
        <?= $this->include('layout/navbar') ?>
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
            <?= $this->renderSection('content') ?>
            </div>
          </div>
        </main>
      </div>
      <?= $this->include('layout/footer') ?>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="<?= base_url('include/coreui') ?>/vendors/@coreui/coreui-pro/js/coreui.bundle.min.js"></script>
    <!--[if IE]><!-->
    <script src="<?= base_url('include/coreui') ?>/vendors/@coreui/icons/js/svgxuse.min.js"></script>
    <!--<![endif]-->
    <!-- Plugins and scripts required by this view-->
    <script src="<?= base_url('include/coreui') ?>/vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js"></script>
    <script src="<?= base_url('include/coreui') ?>/vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="<?= base_url('include/coreui') ?>/js/main.js"></script>

    <script src="<?= base_url('include/coreui') ?>/vendors/jquery-validation/js/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
  </body>
</html>