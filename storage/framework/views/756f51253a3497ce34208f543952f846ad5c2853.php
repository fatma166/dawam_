<!DOCTYPE html>
<html>
<head>
    <title>Laravel Yajra Datatables Export to Excel Button Example - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="<?php echo e(asset('/vendor/datatables/buttons.server-side.js')); ?>"></script>
</head>
<body>

    <?php 
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);

        
        $type= $uri_segments[3];

    ?>  
<div class="container">
    <h1><?php echo e(__('trans.Dialy')); ?><?php echo e($type); ?><?php echo e(__('trans.Employee')); ?></h1>
  
    <?php echo $dataTable->table(); ?>

</div>
     
</body>
     
<?php echo $dataTable->scripts(); ?>

  
</html><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/users.blade.php ENDPATH**/ ?>