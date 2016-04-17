<?php

namespace InspiniaBundle\Services;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;

use CoreBundle\Services\AbstractService;

class Menu extends AbstractService
{
    /** @var string $route */
    protected $route = null;

    /** @var array $menu */
    protected $menu = array
    (
        # Dashboards
        'inspinia_homepage' => array(0, 0, 0),
        'inspinia_dashboard2' => array(0, 1, 0),
        'inspinia_dashboard3' => array(0, 2, 0),
        'inspinia_dashboard4' => array(0, 3, 0),
        'inspinia_dashboard4_1' => array(0, 4, 0),
        'inspinia_dashboard5' => array(0, 5, 0),

        # Layouts
        'inspinia_layouts' => array(1, 0, 0),

        # Graphs
        'inspinia_graph_flot' => array(2, 0, 0),
        'inspinia_graph_morris' => array(2, 1, 0),
        'inspinia_graph_rickshaw' => array(2, 2, 0),
        'inspinia_graph_chartjs' => array(2, 3, 0),
        'inspinia_graph_chartist' => array(2, 4, 0),
        'inspinia_graph_c3' => array(2, 5, 0),
        'inspinia_graph_peity' => array(2, 6, 0),
        'inspinia_graph_sparkline' => array(2, 7, 0),

        # Mailbox
        'inspinia_mailbox' => array(3, 0, 0),
        'inspinia_mail_detail' => array(3, 1, 0),
        'inspinia_mail_compose' => array(3, 2, 0),
        'inspinia_email_templates' => array(3, 3, 0),
        'inspinia_email_action' => array(3, 4, 0),
        'inspinia_email_alert' => array(3, 5, 0),
        'inspinia_email_billing' => array(3, 6, 0),

        # Metrics
        'inspinia_metrics' => array(4, 0, 0),

        # Widgets
        'inspinia_widgets' => array(5, 0, 0),

        # Forms
        'inspinia_form_basic' => array(6, 0, 0),
        'inspinia_form_advanced' => array(6, 1, 0),
        'inspinia_form_wizard' => array(6, 2, 0),
        'inspinia_form_file_upload' => array(6, 3, 0),
        'inspinia_form_editors' => array(6, 4, 0),
        'inspinia_form_markdown' => array(6, 5, 0),

        # App Views
        'inspinia_contacts' => array(7, 0, 0),
        'inspinia_profile' => array(7, 1, 0),
        'inspinia_profile_2' => array(7, 2, 0),
        'inspinia_contacts_2' => array(7, 3, 0),
        'inspinia_projects' => array(7, 4, 0),
        'inspinia_project_detail' => array(7, 5, 0),
        'inspinia_teams_board' => array(7, 6, 0),
        'inspinia_social_feed' => array(7, 7, 0),
        'inspinia_clients' => array(7, 8, 0),
        'inspinia_full_height' => array(7, 9, 0),
        'inspinia_vote_list' => array(7, 10, 0),
        'inspinia_file_manager' => array(7, 11, 0),
        'inspinia_calendar' => array(7, 12, 0),
        'inspinia_issue_tracker' => array(7, 13, 0),
        'inspinia_blog' => array(7, 14, 0),
        'inspinia_article' => array(7, 15, 0),
        'inspinia_faq' => array(7, 16, 0),
        'inspinia_timeline' => array(7, 17, 0),
        'inspinia_pin_board' => array(7, 18, 0),

        # Other Pages
        'inspinia_search_results' => array(8, 0, 0),
        'inspinia_lock_screen' => array(8, 1, 0),
        'inspinia_invoice' => array(8, 2, 0),
        'inspinia_login' => array(8, 3, 0),
        'inspinia_login_v2' => array(8, 4, 0),
        'inspinia_forgot_password' => array(8, 5, 0),
        'inspinia_register' => array(8, 6, 0),
        'inspinia_404' => array(8, 7, 0),
        'inspinia_500' => array(8, 8, 0),
        'inspinia_empty_page' => array(8, 9, 0),
        'inspinia_invoice_print' => array(-1, 0, 0),

        # Miscellaneous
        'inspinia_toastr_notifications' => array(9, 0, 0),
        'inspinia_nestable_list' => array(9, 1, 0),
        'inspinia_agile_board' => array(9, 2, 0),
        'inspinia_timeline_2' => array(9, 3, 0),
        'inspinia_diff' => array(9, 4, 0),
        'inspinia_i18support' => array(9, 5, 0),
        'inspinia_sweet_alert' => array(9, 6, 0),
        'inspinia_idle_timer' => array(9, 7, 0),
        'inspinia_truncate' => array(9, 8, 0),
        'inspinia_spinners' => array(9, 9, 0),
        'inspinia_tinycon' => array(9, 10, 0),
        'inspinia_google_maps' => array(9, 11, 0),
        'inspinia_code_editor' => array(9, 12, 0),
        'inspinia_modal_window' => array(9, 13, 0),
        'inspinia_clipboard' => array(9, 14, 0),
        'inspinia_forum_main' => array(9, 15, 0),
        'inspinia_validation' => array(9, 16, 0),
        'inspinia_tree_view' => array(9, 17, 0),
        'inspinia_loading_buttons' => array(9, 18, 0),
        'inspinia_chat_view' => array(9, 19, 0),
        'inspinia_masonry' => array(9, 20, 0),
        'inspinia_tour' => array(9, 21, 0),
        'inspinia_forum_post' => array(-1, 0, 0),

        # UI Elements
        'inspinia_typography' => array(10, 0, 0),
        'inspinia_icons' => array(10, 1, 0),
        'inspinia_draggable_panels' => array(10, 2, 0),
        'inspinia_resizeable_panels' => array(10, 3, 0),
        'inspinia_buttons' => array(10, 4, 0),
        'inspinia_video' => array(10, 5, 0),
        'inspinia_tabs_panels' => array(10, 6, 0),
        'inspinia_tabs' => array(10, 7, 0),
        'inspinia_notifications' => array(10, 8, 0),
        'inspinia_badges_labels' => array(10, 9, 0),

        # Grid options
        'inspinia_grid_options' => array(11, 0, 0),

        # Tables
        'inspinia_table_basic' => array(12, 0, 0),
        'inspinia_table_data_tables' => array(12, 1, 0),
        'inspinia_table_foo_table' => array(12, 2, 0),
        'inspinia_table_jq_grid' => array(12, 3, 0),

        # E-commerce
        'inspinia_e_commerce_products_grid' => array(13, 0, 0),
        'inspinia_e_commerce_products_list' => array(13, 1, 0),
        'inspinia_e_commerce_product' => array(13, 2, 0),
        'inspinia_e_commerce_product_detail' => array(13, 3, 0),
        'inspinia_e_commerce_cart' => array(13, 4, 0),
        'inspinia_e_commerce_orders' => array(13, 5, 0),
        'inspinia_e_commerce_payments' => array(13, 6, 0),

        # Gallery
        'inspinia_basic_gallery' => array(14, 0, 0),
        'inspinia_slick_carousel' => array(14, 1, 0),
        'inspinia_carousel' => array(14, 2, 0),

        # Css Animations
        'inspinia_css_animation' => array(16, 0, 0),

        # Package
        'inspinia_package' => array(17, 0, 0),

        # Others
        'inspinia_md_skin' => array(-1, 0, 0),
        'inspinia_off_canvas_menu' => array(-1, 0, 0),
        'inspinia_landing' => array(-1, 0, 0),
    );

    public function  __construct(EntityManager $em, Request $request, $route)
    {
        parent::__construct($em, $request);

        if (array_key_exists($route, $this->menu))
        {
            $this->route = $route;
        }
        else
        {
            throw new LogicException('Invalid menu route');
        }
    }

    public function getIndexes()
    {
        return $this->menu[$this->route];
    }
}