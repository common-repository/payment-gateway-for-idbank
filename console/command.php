<?php


// Add 30 minute cron job
if (!function_exists('hkdigital_cronSchedulesForIDBank')) {

    /**
     * Remove the specified resource from storage.
     *
     * @param $schedules
     * @return array
     */
    function hkdigital_cronSchedulesForIDBank($schedules)
    {
        if (!isset($schedules["30min"])) {
            $schedules["30min"] = array(
                'interval' => 30 * 60,
                'display' => __('Once every 30 minutes'));
        }
        return $schedules;
    }
}
add_filter('cron_schedules', 'hkdigital_cronSchedulesForIDBank');

if (!function_exists('hkdigital_initHKDIDPlugin')) {
    function hkdigital_initHKDIDPlugin()
    {
        if (!wp_next_scheduled('cronCheckOrderIDBank')) {
            wp_schedule_event(time(), '30min', 'cronCheckOrderIDBank');
        }
        add_rewrite_endpoint('cards', EP_PERMALINK | EP_PAGES, 'cards');
        flush_rewrite_rules();
    }
}
add_action('init', 'hkdigital_initHKDIDPlugin');