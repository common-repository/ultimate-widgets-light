<?php
// Add latest news from the PlutonWP blog

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!class_exists('PlutonWPDashboardWidgetUWL')) {
    class PlutonWPDashboardWidgetUWL {

        public function __construct () {
            add_action('wp_dashboard_setup', array($this,'add_pluton_dashboard_uwl'));
        }
        
        public function add_pluton_dashboard_uwl() {
            global $wp_meta_boxes;
            add_meta_box('pluton_dashboard_widget_uwl', __( 'PlutonWP News' ), array($this,'pluton_dashboard_widget_uwl'), 'dashboard', 'side', 'high');
            if ( '1' == uwl_option( 'remove-news', '0' ) ) {
                unset( $wp_meta_boxes['dashboard']['side']['high']['pluton_dashboard_widget_uwl'] );
            }
        }
        
        public function pluton_dashboard_widget_uwl() {
            echo '<div class="rss-widget">';
                wp_widget_rss_output(
                    array(
                        'url'           => 'http://plutonwp.com/feed/',
                        'title'         => __( 'PlutonWP Blog' ),
                        'items'         => 4,
                        'show_summary'  => 0,
                        'show_author'   => 0,
                        'show_date'     => 1,
                    )
                );
            echo '</div>';
        }
    }
    
    new PlutonWPDashboardWidgetUWL();
}