<?= $this->extend('layout/index') ?>

<?= $this->section('css')  ?>
<style>
    .float{
        position:fixed;
        width:60px;
        height:60px;
        bottom:80px;
        right:40px;
        background-color:#df4759;
        color:#FFFFFF;
        border-radius:50px;
        text-align:center;
        /* box-shadow: 2px 2px 3px #fff; */
    }

    .my-float{
        margin-top:22px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid" id="app">
    <div class="card text-muted">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h1 class="text-muted">CUSTOMERS</h1>
                    <div class="table-responsive">
                        <table id="tabel_serverside" style="height:100%;" cellspacing="0" class="table display">
                            <thead>
                                <tr>
                                    <th>TIMESTAMP</th>
                                    <th>NAME</th>
                                    <th>E-MAIL</th>
                                    <th>PHONE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:void(0)" onclick="addCustomer()" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            <form class="form-horizontal" id="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Name</label>
                    <div class="col-md-9">
                    <input class="form-control" id="text-input" type="text" name="name" placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">E-mail</label>
                    <div class="col-md-9">
                    <input class="form-control" id="text-input" type="email" name="email" placeholder="E-mail">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Phone</label>
                    <div class="col-md-9">
                    <input class="form-control" id="text-input" type="text" name="phone" placeholder="Phone">
                    </div>
                </div>

                <button type="submit" class="btn btn-info btn-lg btn-block">Save</button>
            </div>
            </div>
        </div>
    </div>

    <script>
        var dataTable;
        var saveMethod;
        $(document).ready(function() {
            dataTable = $('#tabel_serverside').DataTable({
                "processing" : true,
                columnDefs: [{
                    targets: '_all',
                    orderable: true,
                    searchable: false
                }],
                "ordering": true,
                "order" :[[0, "desc"]], 
                "info": true,
                "serverSide": true,
                "stateSave" : true,
                "ajax":{
                    url :"<?php echo base_url("customers/listdata"); ?>", // json datasource
                    type: "post",  // method  , by default get
                    error: function(){  // error handling
                        $(".tabel_serverside-error").html("");
                        $("#tabel_serverside").append('<tbody class="tabel_serverside-error"><tr><th colspan="3">Data Tidak Ditemukan di Server</th></tr></tbody>');
                        $("#tabel_serverside_processing").css("display","none");
            
                    }
                }
            });

            // Validation'
            $.validator.setDefaults({
                submitHandler: function submitHandler() {
                    // eslint-disable-next-line no-alert
                    store();
                    tableReload();
                    $('#form')[0].reset();
                    $("input,textarea,select").removeClass("is-valid");
                }
            });

            $('#form').validate({
                rules:{
                    name: 'required',
                    email: 'required',
                    phone: 'required'
                },
                errorElement: 'em',
                errorPlacement: function errorPlacement(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.prop('type') === 'checkbox') {
                        error.insertAfter(element.parent('label'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                // eslint-disable-next-line object-shorthand
                highlight: function highlight(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                // eslint-disable-next-line object-shorthand
                unhighlight: function unhighlight(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });

        });

        var tableReload = () =>{
            dataTable.ajax.reload();
        }

        const addCustomer = () => {
            $('.modal-title').text('Add Cutomer')
            $('#customerModal').modal('show')
        }

        function store(){
            if(saveMethod == 'update')
            {
                url = "<?=base_url('customers/update/')?>";
            }
            else{
                url = "<?= base_url('customers/store') ?>";
            }

            $.ajax({
                url:url,
                type:"POST",
                data:$('#form').serialize(),
                dataType:"JSON",
                success:function(res)
                {
                    if(res.success == false)
                    {
                        toastr.error(res.message);
                    }
                    else{
                        toastr.success(res.message);
                    }

                    $('#customerModal').modal('hide')
                  
                }
            })
        }

       var destroy = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    url:"<?= base_url('customers/destroy') ?>",
                    type:"POST",
                    data:{id:id},
                    dataType:"JSON",
                    success:resp =>
                    {
                        if(resp.success == true)
                        {
                            tableReload();
                            toastr.success(resp.message);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            toastr.error("Status: " + textStatus); 
                            toastr.error("Error: " + errorThrown); 
                    }       
                })
                }
            })
        }

       var edit = (id) => {
           $.ajax({
               url:"<?= base_url('customers/edit') ?>",
               type:"POST",
               data:{id:id},
               dataType:"JSON",
               success: resp =>
               {
                   saveMethod = "update";
                   $('[name="id"]').val(resp.kamarApps.results.id);
                   $('[name="name"]').val(resp.kamarApps.results.name);
                   $('[name="email"]').val(resp.kamarApps.results.email);
                   $('[name="phone"]').val(resp.kamarApps.results.phone);
                   $('.modal-title').text('Edit Cutomer')
                   $('#customerModal').modal('show')
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    toastr.error("Status: " + textStatus); 
                    toastr.error("Error: " + errorThrown); 
                }
           })
       }
    </script>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>