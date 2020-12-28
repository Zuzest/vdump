<?php

/**
 * [vdump_view_web]
 * @param  [type] $parse_backtrace [description]
 * @return [type]                  [description]
 */
function vdump_view_web($parse_backtrace, $htmlentities)
{

  echo "<div style='width:auto;font-size:10pt;background-color:#323B44;padding:.3em;'>";
  echo '<style>body{margin:0;padding:0;}</style>';
  echo "<div style='width: auto;min-width: 50em;max-width: 120em;margin: 0 auto;padding: 0 3em;'>";
  echo "<div style='border-bottom: 1px dotted #000;color:#efdc3a;font-size:0.9em;line-height:1em;text-align:start;'>";

  echo 'файл => ' . $parse_backtrace['file'] . '<br>';
  echo 'строка => ' . $parse_backtrace['line'] . '<br>';

  echo '</div>';

  foreach ($parse_backtrace['args'] as $v) {

    echo "<div style='border-bottom: 1px dotted #000;'>";

    echo "  <div style='display:inline-block;width:25%;vertical-align:top;background:#89e6b8;font-size:1.3em;font-weight:bold;text-align:right;line-height:1.5em;color:#000'>";
    echo htmlentities(trim($v['name'])) . ' => ';
    echo '  </div>';

    echo "  <div style='display:inline-block;width:70%;vertical-align:top;background: #d65b36;'>";
    echo "    <pre style='margin:0.2em;padding:.3em;overflow:auto;line-height:1.1em;color: #000;text-align:start;background:#d65b36'>";
    if ($htmlentities) {
      ob_start();
      var_dump($v['var']);
      $var_dump = ob_get_clean();
      echo htmlentities($var_dump);
    } else {
      var_dump($v['var']);
    }
    echo '    </pre>';
    echo '  </div>';

    echo '</div>';
  }
  echo '</div>';
  echo '</div>';
}
