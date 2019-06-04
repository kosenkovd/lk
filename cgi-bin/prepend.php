<?php
if (preg_match('/^tideways/', $_SERVER['SERVER_NAME']) && !preg_match('/xhprof/', $_SERVER['REQUEST_URI'])) {
        tideways_enable(TIDEWAYS_FLAGS_CPU+TIDEWAYS_FLAGS_MEMORY);
}

