<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="js/form.core.js" type="module"></script>
<script src="js/searchCustomers.js"></script>

<style>
    @layer utilities {

        :root {
            --primary-color: #076AAE;
            --secondary-color: #0097D8;
            --grey-color: #4d4d4d;
        }
    }
</style>
<?php

session_start();
require_once '../core/launcher.php';
?>