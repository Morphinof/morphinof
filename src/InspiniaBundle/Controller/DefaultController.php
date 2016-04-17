<?php

namespace InspiniaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CoreBundle\Controller\AbstractController;
use InspiniaBundle\Services\Menu;

class DefaultController extends AbstractController
{
    /** @var  Menu $menu */
    protected $menu;

    protected $indexes = null;

    public function preExecute(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $this->menu = new Menu($em, $request, $request->get('_route'));
        $this->indexes = $this->menu->getIndexes();
    }

    /**
     * Get the menu instance
     *
     * @return Menu
     */
    protected function getMenu()
    {
        return $this->menu;
    }

    public function indexAction()
    {
        return $this->render('InspiniaBundle:Default:index.html.twig', array('indexes' => $this->indexes));
    }

    public function mdSkinAction()
    {
        return $this->render
        (
            'InspiniaBundle:Default:md-skin.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'mdSkin' => true
            )
        );
    }

    public function dashboard2Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-2.html.twig', array('indexes' => $this->indexes));
    }

    public function dashboard3Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-3.html.twig', array('indexes' => $this->indexes));
    }

    public function dashboard4Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-4.html.twig', array('indexes' => $this->indexes));
    }

    public function dashboard4_1Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-4-1.html.twig', array('indexes' => $this->indexes));
    }

    public function dashboard5Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-5.html.twig', array('indexes' => $this->indexes));
    }

    public function layoutsAction()
    {
        return $this->render('InspiniaBundle:Default:layouts.html.twig', array('indexes' => $this->indexes));
    }

    public function graphFlotAction()
    {
        return $this->render('InspiniaBundle:Default:graph-flot.html.twig', array('indexes' => $this->indexes));
    }

    public function graphMorrisAction()
    {
        return $this->render('InspiniaBundle:Default:graph-morris.html.twig', array('indexes' => $this->indexes));
    }

    public function graphRickshawAction()
    {
        return $this->render('InspiniaBundle:Default:graph-rickshaw.html.twig', array('indexes' => $this->indexes));
    }

    public function graphChartJsAction()
    {
        return $this->render('InspiniaBundle:Default:graph-chartjs.html.twig', array('indexes' => $this->indexes));
    }

    public function graphChartistAction()
    {
        return $this->render('InspiniaBundle:Default:graph-chartist.html.twig', array('indexes' => $this->indexes));
    }

    public function graphC3Action()
    {
        return $this->render('InspiniaBundle:Default:graph-c3.html.twig', array('indexes' => $this->indexes));
    }

    public function graphPeityAction()
    {
        return $this->render('InspiniaBundle:Default:graph-peity.html.twig', array('indexes' => $this->indexes));
    }

    public function graphSparklineAction()
    {
        return $this->render('InspiniaBundle:Default:graph-sparkline.html.twig', array('indexes' => $this->indexes));
    }

    public function mailboxAction()
    {
        return $this->render('InspiniaBundle:Default:mailbox.html.twig', array('indexes' => $this->indexes));
    }

    public function mailDetailAction()
    {
        return $this->render('InspiniaBundle:Default:mail-detail.html.twig', array('indexes' => $this->indexes));
    }

    public function mailComposeAction()
    {
        return $this->render('InspiniaBundle:Default:mail-compose.html.twig', array('indexes' => $this->indexes));
    }

    public function emailTemplatesAction()
    {
        return $this->render('InspiniaBundle:Default:email-templates.html.twig', array('indexes' => $this->indexes));
    }

    public function emailActionAction()
    {
        return $this->render('InspiniaBundle:Default:email-templates/action.html.twig', array('indexes' => $this->indexes));
    }

    public function emailAlertAction()
    {
        return $this->render('InspiniaBundle:Default:email-templates/alert.html.twig', array('indexes' => $this->indexes));
    }

    public function emailBillingAction()
    {
        return $this->render('InspiniaBundle:Default:email-templates/billing.html.twig', array('indexes' => $this->indexes));
    }

    public function metricsAction()
    {
        return $this->render('InspiniaBundle:Default:metrics.html.twig', array('indexes' => $this->indexes));
    }

    public function widgetsAction()
    {
        return $this->render('InspiniaBundle:Default:widgets.html.twig', array('indexes' => $this->indexes));
    }

    public function formBasicAction()
    {
        return $this->render('InspiniaBundle:Default:form-basic.html.twig', array('indexes' => $this->indexes));
    }

    public function formAdvancedAction()
    {
        return $this->render('InspiniaBundle:Default:form-advanced.html.twig', array('indexes' => $this->indexes));
    }
    public function formWizardAction()
    {
        return $this->render('InspiniaBundle:Default:form-wizard.html.twig', array('indexes' => $this->indexes));
    }

    public function formFileUploadAction()
    {
        return $this->render('InspiniaBundle:Default:form-file-upload.html.twig', array('indexes' => $this->indexes));
    }

    public function formEditorsAction()
    {
        return $this->render('InspiniaBundle:Default:form-editors.html.twig', array('indexes' => $this->indexes));
    }

    public function formMarkdownAction()
    {
        return $this->render('InspiniaBundle:Default:form-markdown.html.twig', array('indexes' => $this->indexes));
    }

    public function contactsAction()
    {
        return $this->render('InspiniaBundle:Default:contacts.html.twig', array('indexes' => $this->indexes));
    }

    public function profileAction()
    {
        return $this->render('InspiniaBundle:Default:profile.html.twig', array('indexes' => $this->indexes));
    }

    public function profile2Action()
    {
        return $this->render('InspiniaBundle:Default:profile-2.html.twig', array('indexes' => $this->indexes));
    }

    public function contacts2Action()
    {
        return $this->render('InspiniaBundle:Default:contacts-2.html.twig', array('indexes' => $this->indexes));
    }

    public function projectsAction()
    {
        return $this->render('InspiniaBundle:Default:projects.html.twig', array('indexes' => $this->indexes));
    }

    public function projectDetailAction()
    {
        return $this->render('InspiniaBundle:Default:project-detail.html.twig', array('indexes' => $this->indexes));
    }

    public function teamsBoardAction()
    {
        return $this->render('InspiniaBundle:Default:teams-board.html.twig', array('indexes' => $this->indexes));
    }

    public function socialFeedAction()
    {
        return $this->render('InspiniaBundle:Default:social-feed.html.twig', array('indexes' => $this->indexes));
    }

    public function clientsAction()
    {
        return $this->render('InspiniaBundle:Default:clients.html.twig', array('indexes' => $this->indexes));
    }

    public function fullHeightAction()
    {
        return $this->render('InspiniaBundle:Default:full-height.html.twig', array('indexes' => $this->indexes));
    }

    public function voteListAction()
    {
        return $this->render('InspiniaBundle:Default:vote-list.html.twig', array('indexes' => $this->indexes));
    }

    public function fileManagerAction()
    {
        return $this->render('InspiniaBundle:Default:file-manager.html.twig', array('indexes' => $this->indexes));
    }

    public function calendarAction()
    {
        return $this->render('InspiniaBundle:Default:calendar.html.twig', array('indexes' => $this->indexes));
    }

    public function issueTrackerAction()
    {
        return $this->render('InspiniaBundle:Default:issue-tracker.html.twig', array('indexes' => $this->indexes));
    }

    public function blogAction()
    {
        return $this->render('InspiniaBundle:Default:blog.html.twig', array('indexes' => $this->indexes));
    }

    public function articleAction()
    {
        return $this->render('InspiniaBundle:Default:article.html.twig', array('indexes' => $this->indexes));
    }

    public function faqAction()
    {
        return $this->render('InspiniaBundle:Default:faq.html.twig', array('indexes' => $this->indexes));
    }

    public function timelineAction()
    {
        return $this->render('InspiniaBundle:Default:timeline.html.twig', array('indexes' => $this->indexes));
    }

    public function pinBoardAction()
    {
        return $this->render('InspiniaBundle:Default:pin-board.html.twig', array('indexes' => $this->indexes));
    }

    public function searchResultsAction()
    {
        return $this->render('InspiniaBundle:Default:search-results.html.twig', array('indexes' => $this->indexes));
    }

    public function lockScreenAction()
    {
        return $this->render
        (
            'InspiniaBundle:Default:lock-screen.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'bodyBackground' => 'gray-bg'
            )
        );
    }

    public function invoiceAction()
    {
        return $this->render('InspiniaBundle:Default:invoice.html.twig', array('indexes' => $this->indexes));
    }

    public function invoicePrintAction()
    {
        return $this->render
        (
            'InspiniaBundle:Default:invoice-print.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'bodyBackground' => 'white-bg'
            )
        );
    }

    public function loginAction()
    {
        return $this->render
        (
            'InspiniaBundle:Default:login.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'bodyBackground' => 'gray-bg'
            )
        );
    }

    public function loginV2Action()
    {
        return $this->render
        (
            'InspiniaBundle:Default:login-v2.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'bodyBackground' => 'gray-bg'
            )
        );
    }

    public function forgotPasswordAction()
    {
        return $this->render
        (
            'InspiniaBundle:Default:forgot-password.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'bodyBackground' => 'gray-bg'
            )
        );
    }

    public function registerAction()
    {
        return $this->render
        (
            'InspiniaBundle:Default:register.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'bodyBackground' => 'gray-bg'
            )
        );
    }

    public function error404Action()
    {
        return $this->render
        (
            'InspiniaBundle:Default:404.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'bodyBackground' => 'gray-bg'
            )
        );
    }

    public function error500Action()
    {
        return $this->render
        (
            'InspiniaBundle:Default:500.html.twig',
            array
            (
                'indexes' => $this->indexes,
                'bodyBackground' => 'gray-bg'
            )
        );
    }

    public function emptyPageAction()
    {
        return $this->render('InspiniaBundle:Default:empty-page.html.twig', array('indexes' => $this->indexes));
    }

    public function toastrNotificationsAction()
    {
        return $this->render('InspiniaBundle:Default:toastr-notifications.html.twig', array('indexes' => $this->indexes));
    }

    public function nestableListAction()
    {
        return $this->render('InspiniaBundle:Default:nestable-list.html.twig', array('indexes' => $this->indexes));
    }

    public function agileBoardAction()
    {
        return $this->render('InspiniaBundle:Default:agile-board.html.twig', array('indexes' => $this->indexes));
    }

    public function timeline2Action()
    {
        return $this->render('InspiniaBundle:Default:timeline-2.html.twig', array('indexes' => $this->indexes));
    }

    public function diffAction()
    {
        return $this->render('InspiniaBundle:Default:diff.html.twig', array('indexes' => $this->indexes));
    }

    public function i18supportAction()
    {
        return $this->render('InspiniaBundle:Default:i18support.html.twig', array('indexes' => $this->indexes));
    }

    public function sweetAlertAction()
    {
        return $this->render('InspiniaBundle:Default:sweet-alert.html.twig', array('indexes' => $this->indexes));
    }

    public function idleTimerAction()
    {
        return $this->render('InspiniaBundle:Default:idle-timer.html.twig', array('indexes' => $this->indexes));
    }

    public function truncateAction()
    {
        return $this->render('InspiniaBundle:Default:truncate.html.twig', array('indexes' => $this->indexes));
    }

    public function spinnersAction()
    {
        return $this->render('InspiniaBundle:Default:spinners.html.twig', array('indexes' => $this->indexes));
    }

    public function tinyconAction()
    {
        return $this->render('InspiniaBundle:Default:tinycon.html.twig', array('indexes' => $this->indexes));
    }

    public function googleMapsAction()
    {
        return $this->render('InspiniaBundle:Default:google-maps.html.twig', array('indexes' => $this->indexes));
    }

    public function codeEditorAction()
    {
        return $this->render('InspiniaBundle:Default:code-editor.html.twig', array('indexes' => $this->indexes));
    }

    public function modalWindowAction()
    {
        return $this->render('InspiniaBundle:Default:modal-window.html.twig', array('indexes' => $this->indexes));
    }

    public function clipboardAction()
    {
        return $this->render('InspiniaBundle:Default:clipboard.html.twig', array('indexes' => $this->indexes));
    }

    public function forumMainAction()
    {
        return $this->render('InspiniaBundle:Default:forum-main.html.twig', array('indexes' => $this->indexes));
    }

    public function forumPostAction()
    {
        return $this->render('InspiniaBundle:Default:forum-post.html.twig', array('indexes' => $this->indexes));
    }

    public function validationAction()
    {
        return $this->render('InspiniaBundle:Default:validation.html.twig', array('indexes' => $this->indexes));
    }

    public function treeViewAction()
    {
        return $this->render('InspiniaBundle:Default:tree-view.html.twig', array('indexes' => $this->indexes));
    }

    public function loadingButtonsAction()
    {
        return $this->render('InspiniaBundle:Default:loading-buttons.html.twig', array('indexes' => $this->indexes));
    }

    public function chatViewAction()
    {
        return $this->render('InspiniaBundle:Default:chat-view.html.twig', array('indexes' => $this->indexes));
    }

    public function masonryAction()
    {
        return $this->render('InspiniaBundle:Default:masonry.html.twig', array('indexes' => $this->indexes));
    }

    public function tourAction()
    {
        return $this->render('InspiniaBundle:Default:tour.html.twig', array('indexes' => $this->indexes));
    }

    public function typographyAction()
    {
        return $this->render('InspiniaBundle:Default:typography.html.twig', array('indexes' => $this->indexes));
    }

    public function iconsAction()
    {
        return $this->render('InspiniaBundle:Default:icons.html.twig', array('indexes' => $this->indexes));
    }

    public function draggablePanelsAction()
    {
        return $this->render('InspiniaBundle:Default:draggable-panels.html.twig', array('indexes' => $this->indexes));
    }

    public function resizeablePanelsAction()
    {
        return $this->render('InspiniaBundle:Default:resizeable-panels.html.twig', array('indexes' => $this->indexes));
    }

    public function buttonsAction()
    {
        return $this->render('InspiniaBundle:Default:buttons.html.twig', array('indexes' => $this->indexes));
    }

    public function videoAction()
    {
        return $this->render('InspiniaBundle:Default:video.html.twig', array('indexes' => $this->indexes));
    }

    public function tabsPanelsAction()
    {
        return $this->render('InspiniaBundle:Default:tabs-panels.html.twig', array('indexes' => $this->indexes));
    }

    public function tabsAction()
    {
        return $this->render('InspiniaBundle:Default:tabs.html.twig', array('indexes' => $this->indexes));
    }

    public function notificationsAction()
    {
        return $this->render('InspiniaBundle:Default:notifications.html.twig', array('indexes' => $this->indexes));
    }

    public function badgesLabelsAction()
    {
        return $this->render('InspiniaBundle:Default:badges-labels.html.twig', array('indexes' => $this->indexes));
    }

    public function gridOptionsAction()
    {
        return $this->render('InspiniaBundle:Default:grid-options.html.twig', array('indexes' => $this->indexes));
    }

    public function tableBasicAction()
    {
        return $this->render('InspiniaBundle:Default:table-basic.html.twig', array('indexes' => $this->indexes));
    }

    public function tableDataTablesAction()
    {
        return $this->render('InspiniaBundle:Default:table-data-tables.html.twig', array('indexes' => $this->indexes));
    }

    public function tableFooTableAction()
    {
        return $this->render('InspiniaBundle:Default:table-foo-table.html.twig', array('indexes' => $this->indexes));
    }

    public function tableJqGridAction()
    {
        return $this->render('InspiniaBundle:Default:table-jq-grid.html.twig', array('indexes' => $this->indexes));
    }

    public function eCommerceProductsGridAction()
    {
        return $this->render('InspiniaBundle:Default:e-commerce-products-grid.html.twig', array('indexes' => $this->indexes));
    }

    public function eCommerceProductsListAction()
    {
        return $this->render('InspiniaBundle:Default:e-commerce-product-list.html.twig', array('indexes' => $this->indexes));
    }

    public function eCommerceProductAction()
    {
        return $this->render('InspiniaBundle:Default:e-commerce-product.html.twig', array('indexes' => $this->indexes));
    }

    public function eCommerceProductDetailAction()
    {
        return $this->render('InspiniaBundle:Default:e-commerce-product-detail.html.twig', array('indexes' => $this->indexes));
    }

    public function eCommerceCartAction()
    {
        return $this->render('InspiniaBundle:Default:e-commerce-cart.html.twig', array('indexes' => $this->indexes));
    }

    public function eCommerceOrdersAction()
    {
        return $this->render('InspiniaBundle:Default:e-commerce-orders.html.twig', array('indexes' => $this->indexes));
    }

    public function eCommercePaymentsAction()
    {
        return $this->render('InspiniaBundle:Default:e-commerce-payments.html.twig', array('indexes' => $this->indexes));
    }

    public function basicGalleryAction()
    {
        return $this->render('InspiniaBundle:Default:basic-gallery.html.twig', array('indexes' => $this->indexes));
    }

    public function slickCarouselAction()
    {
        return $this->render('InspiniaBundle:Default:slick-carousel.html.twig', array('indexes' => $this->indexes));
    }

    public function carouselAction()
    {
        return $this->render('InspiniaBundle:Default:carousel.html.twig', array('indexes' => $this->indexes));
    }

    public function cssAnimationAction()
    {
        return $this->render('InspiniaBundle:Default:css-animation.html.twig', array('indexes' => $this->indexes));
    }

    public function packageAction()
    {
        return $this->render('InspiniaBundle:Default:package.html.twig', array('indexes' => $this->indexes));
    }

    public function offCanvasMenuAction()
    {
        return $this->render('InspiniaBundle:Default:off-canvas-menu.html.twig', array('canvasMenu' => true));
    }
}
