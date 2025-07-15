<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="js/form.core.js" type="module"></script>
<style>
    @layer utilities {
        .primary {
            color: #076AAE;
            /* Rojo */
        }
        .secondary {
            color: #0097D8;
            /* Azul */
        }
        .grey {
            color: #4d4d4d;
        }
    }
</style>
<?php
function route($path = '') {
  return PATH_PUBLIC . trim($path, '/');
}
session_start();
require_once '../core/launcher.php';
?>