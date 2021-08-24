<?= $this->extend('layout/index') ?>

<?= $this->section('css') ?>
<style>
  .floatingButtonWrap {
    display: block;
    position: fixed;
    bottom: 45px;
    right: 45px;
    z-index: 999999999;
}

.floatingButtonInner {
    position: relative;
}

.floatingButton {
    display: block;
    width: 60px;
    height: 60px;
    text-align: center;
    background: -webkit-linear-gradient(45deg, #8769a9, #507cb3);
    background: -o-linear-gradient(45deg, #8769a9, #507cb3);
    background: linear-gradient(45deg, #8769a9, #507cb3);
    color: #fff;
    line-height: 50px;
    position: absolute;
    border-radius: 50% 50%;
    bottom: 0px;
    right: 0px;
    border: 5px solid #b2bedc;
    /* opacity: 0.3; */
    opacity: 1;
    transition: all 0.4s;
}

.floatingButton .fa {
    font-size: 15px !important;
}

.floatingButton.open,
.floatingButton:hover,
.floatingButton:focus,
.floatingButton:active {
    opacity: 1;
    color: #fff;
}


.floatingButton .fa {
    transform: rotate(0deg);
    transition: all 0.4s;
}

.floatingButton.open .fa {
    transform: rotate(270deg);
}

.floatingMenu {
    position: absolute;
    bottom: 60px;
    right: 0px;
    /* width: 200px; */
    display: none;
}

.floatingMenu li {
    width: 100%;
    float: right;
    list-style: none;
    text-align: right;
    margin-bottom: 5px;
}

.floatingMenu li a {
    padding: 8px 15px;
    display: inline-block;
    background: #ccd7f5;
    color: #6077b0;
    border-radius: 5px;
    overflow: hidden;
    white-space: nowrap;
    transition: all 0.4s;
    /* -webkit-box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22);
    box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22); */
    -webkit-box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
    box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
}

.floatingMenu li a:hover {
    margin-right: 10px;
    text-decoration: none;
}


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
    <div class="row d-flex align-items-stretch">
        <div class="col-lg-4">
            <div class="card text-muted">
                <div class="card-body p-4">
                    <div class="float-right">
                        <small class="text-muted"><?= date('d M Y H:i') ?></small>
                    </div>
                    <div class="info">
                        <h3>Information</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero quod illo ducimus hic officia totam expedita labore explicabo modi laudantium impedit ea adipisci, quaerat fugit?</p>
                        <a href="javascipt:void(0)">Owner Name</a>
                    </div>
                </div>
            </div>
            <div class="card text-muted">
                <div class="card-body p-4">
                    <h3>Payment</h3>
                    <p>Percentage Payment Progess Assigment</p>
                    <div class="progress mb-3 payment">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                </div>
            </div>
            <div class="card text-muted">
                <div class="card-body p-4">
                    <h3>Project</h3>
                    <p>Percentage Task Progress Assigment</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                </div>
            </div>
            <div class="card text-muted">
                <div class="card-body p-4">
                    <h3>Status Project</h3>
                    <p>If you click this button, Status be "<b>Close</b>"</p>
                    <div class="text-center status">
                        <button class="btn btn-lg btn-success btn-block"><h2>Open</h2</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card text-muted">
                <div class="card-body">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home">Task</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile">Payment</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages-1" role="tab" aria-controls="messages">Messages</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-1" role="tabpanel">
                                <h3>Taks</h3>
                                <p>
                                    This menu contains a list of tasks that must be completed immediately on the Project.

                                    <table class="table table-stripped" id="tabel_serverside">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" name="" id="checkAll"></th>
                                                <th>Tasks</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </p>

                                <div class="floatingButtonWrap">
                                    <div class="floatingButtonInner">
                                        <a href="javascript:void(0)" class="floatingButton">
                                            <i class="fa fa-plus icon-default"></i>
                                        </a>
                                        <ul class="floatingMenu">
                                            <li>
                                                <a href="#">Selected to Done</a>
                                            </li>
                                            <li>
                                                <a href="#">Selected To Doing</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="addTask()">Add Task</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile-1" role="tabpanel">
                                <h3>Payment</h3>
                                <p>
                                    This menu contains a list of tasks that must be completed immediately on the Project.

                                    <table class="table table-stripped" id="">
                                        <thead>
                                            <tr>
                                                <th>Timestamp</th>
                                                <th>Payment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </p>
                                <a href="javascript:void(0)" onclick="" class="float">
                                    <i class="fa fa-plus my-float"></i>
                                </a>
                            </div>
                            <div class="tab-pane" id="messages-1" role="tabpanel">3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>


  <!-- Modal -->
  <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            <form id="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id">
                <input type="hidden" name="assigment" value="<?= $id ?>"> 
                <div class="form-group">
                    <label" for="text-input" class="mb-2">Description your Task :</label><br>
                    <textarea name="task" class="form-control" placeholder="Task Description" id="" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-info btn-lg btn-block">Save</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            <form id="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id">
                <input type="hidden" name="assigment" value="<?= $id ?>"> 
                <div class="form-group">
                    <label" for="text-input" class="mb-2">Description your Task :</label><br>
                    <textarea name="task" class="form-control" placeholder="Task Description" id="" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-info btn-lg btn-block">Save</button>
            </div>
            </div>
        </div>
    </div>



    <!-- Jquery -->
    <script>
        var dataTable
        var saveMethod
        $(() => {
            dataTable = $('#tabel_serverside').DataTable({
                "processing" : true,
                columnDefs: [{
                    targets: [0],
                    orderable: false
                }],
                "order" :[], 
                "serverSide": true,
                "ajax":{
                    url :"<?php echo base_url("tasks/listdata/".$id); ?>", // json datasource
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
                    task: 'required'
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

        })

        var tableReload = () =>{
            dataTable.ajax.reload();
        }

        const addTask = () => {
            $('#taskModal .modal-title').text('Add Task')
            $('#taskModal').modal('show')
        }

        function store(){
            if(saveMethod == 'update')
            {
                url = "<?=base_url('tasks/update/')?>";
            }
            else{
                url = "<?= base_url('tasks/store') ?>";
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

                    $('#taskModal').modal('hide')
                  
                }
            })
        }
    </script>
<?= $this->endSection() ?>

<?= $this->section('js') ?>


<script>

    // Button
    $(document).ready(function(){
        $('.floatingButton').on('click',
            function(e){
                e.preventDefault();
                $(this).toggleClass('open');
                if($(this).children('.fa').hasClass('fa-plus'))
                {
                    $(this).children('.fa').removeClass('fa-plus');
                    $(this).children('.fa').addClass('fa-close');
                } 
                else if ($(this).children('.fa').hasClass('fa-close')) 
                {
                    $(this).children('.fa').removeClass('fa-close');
                    $(this).children('.fa').addClass('fa-plus');
                }
                $('.floatingMenu').stop().slideToggle();
            }
        );
        $(this).on('click', function(e) {
          
            var container = $(".floatingButton");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0) 
            {
                if(container.hasClass('open'))
                {
                    container.removeClass('open');
                }
                if (container.children('.fa').hasClass('fa-close')) 
                {
                    container.children('.fa').removeClass('fa-close');
                    container.children('.fa').addClass('fa-plus');
                }
                $('.floatingMenu').hide();
            }
          
            // if the target of the click isn't the container and a descendant of the menu
            if(!container.is(e.target) && ($('.floatingMenu').has(e.target).length > 0)) 
            {
                $('.floatingButton').removeClass('open');
                $('.floatingMenu').stop().slideToggle();
            } 
        });

        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });



    // End Button



    fetch('<?= base_url('assigment/detail?id='.$id) ?>')
    .then(response => response.json())
    .then(response => {
        const infoContent = document.querySelector('.info')
        const statusContent = document.querySelector('.status')
        const statusPayment = document.querySelector('.payment')

        infoContent.innerHTML = informationAssigment(response)
        statusContent.innerHTML = statusAssigment(response)
        statusPayment.innerHTML = paymentProgress(response)
    })

    const informationAssigment = data => {
        return `<h3>${data.assigment}</h3>
            <p>${data.description}</p>
            <p>${data.customer}</p>`
    }

    const paymentProgress = data => {
        
        result = (data.payment/data.pricing) * 100

        return `<div class="progress-bar bg-info" role="progressbar" style="width: ${result}%;" aria-valuenow="${result}" aria-valuemin="0" aria-valuemax="100">${result}%</div>`

    }

    const statusAssigment = data => {
        return ` <button class="btn btn-lg ${data.status == 'open' ? 'btn-success' : 'btn-danger'}  btn-block"><h2>${data.status == 'open' ? 'Open' : 'Close'}</h2</button>`
    }

    const getAllChecked = () => {
        
    }

</script>
<?= $this->endSection() ?>