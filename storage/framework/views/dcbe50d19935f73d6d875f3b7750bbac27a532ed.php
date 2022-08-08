<!DOCTYPE html>
<html>
<head>

    <?php 
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);

        
        $type= $uri_segments[3];

    ?> 
    <title><?php if($type=='monthlyPrint'): ?> <?php echo e(__('trans.monthly_report')); ?><?php elseif($type=='dialyPrint'): ?><?php echo e(__('trans.dialy_report')); ?><?php elseif($type=='visitPrint'): ?> <?php echo e(__('trans.visit_report')); ?><?php endif; ?></title>
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
        function get_string_between($string, $start, $end){
            $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
        }
        
        
        $get_array=$_GET;
        $date_from=$date_to=null;
        $month=Carbon\Carbon::now()->month;
        $today=Carbon\Carbon::today()->format('Y-m-d');
        $end_month=Carbon\Carbon::now()->daysInMonth;
        if (array_key_exists('date_from', $get_array) !== false) {
          
          
             
           $date_from=$get_array['date_from'];
        }    
        if (array_key_exists('date_to', $get_array) !== false) {
           
            $date_to=$get_array['date_to']==""?$today:$get_array['date_to'];
        }else{

           if(($type=='dialyPrint')&&((!array_key_exists('date_from', $get_array))||(!array_key_exists('date_from', $get_array)))){    
                $date_from=Carbon\Carbon::now();
                $date_to=Carbon\Carbon::now();
           }else{
               $date_from="1-".$month."-".Carbon\Carbon::now()->year;
               $date_to=$today;
           }
        }
        if (array_key_exists('from', $get_array) !== false) {

          
             
           $date_from=$get_array['from']==""?"1-".$month."-".Carbon\Carbon::now()->year:$get_array['from'];
        } else{
             $date_from="1-".$month."-".Carbon\Carbon::now()->year;
        }   
        if (array_key_exists('to', $get_array) !== false) {
             $date_to=$get_array['to']==""?$today:$get_array['to'];
        }else{
           $date_to=$today;  
        }
    ?>  
<div class="container">
    <h1><?php if($type=='monthlyPrint'): ?> <?php echo e(__('trans.monthly_report')); ?><?php elseif($type=='dialyPrint'): ?><?php echo e(__('trans.dialy_report')); ?><?php elseif($type=='visitPrint'): ?> <?php echo e(__('trans.visit_report')); ?><?php elseif($type=='visit_type'): ?> <?php echo e(__('trans.visitTypeReportPrint')); ?><?php endif; ?></h1>
    <?php if($type=='visit_type'): ?>
    <h2><span><?php echo e(__('trans.visit type')); ?>:</span> <?php echo e($get_array['visit_type']); ?></h2>
    <?php else: ?>
     <h2><span><?php echo e(__('trans.duration')); ?>:</span> <?php echo e(__('trans.from')); ?><?php echo e($date_from); ?>/<?php echo e(__('trans.to')); ?><?php echo e($date_to); ?></h2>
     <h2><span><?php echo e(__('trans.employee')); ?>:</span> <?php if(isset($get_array['user'])&&$get_array['user']!='null'): ?><?php echo e($get_array['user']); ?><?php else: ?> <?php echo e(__('trans.all')); ?><?php endif; ?>   </h2>
    <?php endif; ?>
    <?php echo $dataTable->table(); ?>

</div>
     
</body>
     
<?php echo $dataTable->scripts(); ?>

  
</html><?php /**PATH /home/dawam/public_html/manger/resources/views/users.blade.php ENDPATH**/ ?>