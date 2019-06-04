<?php
if (preg_match('/^tideways/', $_SERVER['SERVER_NAME']) && !preg_match('/xhprof/', $_SERVER['REQUEST_URI'])) {
    $data = tideways_disable();
        $profile_path = '/home/w/wdenkosw/perfect-crm.ru/public_html/xhprof-0.9.4';
        include_once $profile_path . '/xhprof_lib/utils/xhprof_lib.php';
        include_once $profile_path . '/xhprof_lib/utils/xhprof_runs.php';
        $xhprof_runs = new XHProfRuns_Default();
        $run_id = $xhprof_runs->save_run($data, '_beget');
} ?>
