<?php
if ( isset($r['error']) ) echo '<h4 class="message error">' . $r['error'] . '</h4>';
if ( isset($r['success']) ) echo '<h4 class="message success">' . $r['success'] . '</h4>';