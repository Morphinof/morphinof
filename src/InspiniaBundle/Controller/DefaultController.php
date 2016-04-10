<?php

namespace InspiniaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('InspiniaBundle:Default:index.html.twig');
    }

    public function dashboard2Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-2.html.twig');
    }

    public function dashboard3Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-3.html.twig');
    }

    public function dashboard4Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-4.html.twig');
    }

    public function dashboard4_1Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-4-1.html.twig');
    }

    public function dashboard5Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-5.html.twig');
    }

    public function layoutsAction()
    {
        return $this->render('InspiniaBundle:Default:layouts.html.twig');
    }

    public function graphFlotAction()
    {
        return $this->render('InspiniaBundle:Default:graph-flot.html.twig');
    }

    public function graphMorrisAction()
    {
        return $this->render('InspiniaBundle:Default:graph-morris.html.twig');
    }

    public function graphRickshawAction()
    {
        return $this->render('InspiniaBundle:Default:graph-rickshaw.html.twig');
    }

    public function graphChartJsAction()
    {
        return $this->render('InspiniaBundle:Default:graph-chartjs.html.twig');
    }

    public function graphChartistAction()
    {
        return $this->render('InspiniaBundle:Default:graph-chartist.html.twig');
    }

    public function graphC3Action()
    {
        return $this->render('InspiniaBundle:Default:graph-c3.html.twig');
    }

    public function graphPeityAction()
    {
        return $this->render('InspiniaBundle:Default:graph-peity.html.twig');
    }

    public function graphSparklineAction()
    {
        return $this->render('InspiniaBundle:Default:graph-sparkline.html.twig');
    }

    public function mailboxAction()
    {
        return $this->render('InspiniaBundle:Default:mailbox.html.twig');
    }

    public function mailDetailAction()
    {
        return $this->render('InspiniaBundle:Default:mail-detail.html.twig');
    }

    public function mailComposeAction()
    {
        return $this->render('InspiniaBundle:Default:mail-compose.html.twig');
    }

    public function emailTemplatesAction()
    {
        return $this->render('InspiniaBundle:Default:email-templates.html.twig');
    }

    public function emailActionAction()
    {
        return $this->render('InspiniaBundle:Default:email-templates/action.html.twig');
    }

    public function emailAlertAction()
    {
        return $this->render('InspiniaBundle:Default:email-templates/alert.html.twig');
    }

    public function emailBillingAction()
    {
        return $this->render('InspiniaBundle:Default:email-templates/billing.html.twig');
    }

    public function metricsAction()
    {
        return $this->render('InspiniaBundle:Default:metrics.html.twig');
    }

    public function widgetsAction()
    {
        return $this->render('InspiniaBundle:Default:widgets.html.twig');
    }

    public function formBasicAction()
    {
        return $this->render('InspiniaBundle:Default:form-basic.html.twig');
    }

    public function formAdvancedAction()
    {
        return $this->render('InspiniaBundle:Default:form-advanced.html.twig');
    }
    public function formWizardAction()
    {
        return $this->render('InspiniaBundle:Default:form-wizard.html.twig');
    }

    public function formFileUploadAction()
    {
        return $this->render('InspiniaBundle:Default:form-file-upload.html.twig');
    }

    public function formEditorsAction()
    {
        return $this->render('InspiniaBundle:Default:form-editors.html.twig');
    }

    public function formMarkdownAction()
    {
        return $this->render('InspiniaBundle:Default:form-markdown.html.twig');
    }

    public function contactsAction()
    {
        return $this->render('InspiniaBundle:Default:contacts.html.twig');
    }

    public function profileAction()
    {
        return $this->render('InspiniaBundle:Default:profile.html.twig');
    }

    public function profile2Action()
    {
        return $this->render('InspiniaBundle:Default:profile-2.html.twig');
    }

    public function contacts2Action()
    {
        return $this->render('InspiniaBundle:Default:contacts-2.html.twig');
    }

    public function projectsAction()
    {
        return $this->render('InspiniaBundle:Default:projects.html.twig');
    }

    public function projectDetailAction()
    {
        return $this->render('InspiniaBundle:Default:project-detail.html.twig');
    }

    public function teamsBoardAction()
    {
        return $this->render('InspiniaBundle:Default:teams-board.html.twig');
    }

    public function socialFeedAction()
    {
        return $this->render('InspiniaBundle:Default:social-feed.html.twig');
    }

    public function clientsAction()
    {
        return $this->render('InspiniaBundle:Default:clients.html.twig');
    }

    public function fullHeightAction()
    {
        return $this->render('InspiniaBundle:Default:full-height.html.twig');
    }

    public function voteListAction()
    {
        return $this->render('InspiniaBundle:Default:vote-list.html.twig');
    }

    public function fileManagerAction()
    {
        return $this->render('InspiniaBundle:Default:file-manager.html.twig');
    }

    public function calendarAction()
    {
        return $this->render('InspiniaBundle:Default:calendar.html.twig');
    }

    public function issueTrackerAction()
    {
        return $this->render('InspiniaBundle:Default:issue-tracker.html.twig');
    }

    public function blogAction()
    {
        return $this->render('InspiniaBundle:Default:blog.html.twig');
    }

    public function articleAction()
    {
        return $this->render('InspiniaBundle:Default:article.html.twig');
    }

    public function faqAction()
    {
        return $this->render('InspiniaBundle:Default:faq.html.twig');
    }

    public function timelineAction()
    {
        return $this->render('InspiniaBundle:Default:timeline.html.twig');
    }

    public function pinBoardAction()
    {
        return $this->render('InspiniaBundle:Default:pin-board.html.twig');
    }
}
