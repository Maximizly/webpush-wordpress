<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.maximizly.app
 * @since      1.0.0
 *
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
$maximizlyOptions = get_option( 'maximizly_webpush_options' );
if($maximizlyOptions['enabled'] && !empty($maximizlyOptions['domain'])) {
?>

<script>
    let maximizly = []; maximizly['webpush_domain'] = '<?= $maximizlyOptions['domain'] ?>';
</script>
<script src="https://maximizly.s3.eu-central-1.amazonaws.com/sources/webpush/production/js/maximizly-push.js"></script>
<?php } ?>