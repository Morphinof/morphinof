<?php

namespace AdminBundle\Admin;

use Application\Sonata\ClassificationBundle\Entity\Collection;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\ClassificationBundle\Admin\CategoryAdmin;

class FixedCategoryAdmin extends CategoryAdmin
{
    protected $formOptions = array(
        #'cascade_validation' => true,
    );

    /**
     * {@inheritdoc}
     */
    public function configureRoutes(RouteCollection $routes)
    {
        $routes->add('tree', 'tree');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', array('class' => 'col-md-6'))
                ->add('name')
                ->add('description', 'textarea', array(
                    'required' => false,
                ))
        ;

        if ($this->hasSubject()) {
            if (!$this->getSubject() instanceof Collection) {
                if ($this->getSubject()->getParent() !== null || $this->getSubject()->getId() === null) { // root category cannot have a parent
                    $formMapper
                        ->add('parent', 'sonata_category_selector', array(
                            #'category' => $this->getSubject() ?: null,
                            'model_manager' => $this->getModelManager(),
                            'class' => $this->getClass(),
                            'required' => true,
                            #'context' => $this->getSubject()->getContext(),
                        ));
                }
            }
        }

        $formMapper
        ->end()
        ->with('Options', array('class' => 'col-md-6'))
        ->add('enabled', null, array(
            'required' => false,
        ));

        if (!$this->getSubject() instanceof Collection) {
            $position = $this->hasSubject() && !is_null($this->getSubject()->getPosition()) ? $this->getSubject()->getPosition() : 0;

            $formMapper
            ->add('position', 'integer', array(
                'required' => false,
                'data' => $position,
            ));
        }
        $formMapper->end()
        ;

        if (interface_exists('Sonata\MediaBundle\Model\MediaInterface')) {
            $formMapper
                ->with('General')
                    ->add('media', 'sonata_type_model_list',
                        array(
                            'required' => false,
                        ),
                        array(
                            'link_parameters' => array(
                                'provider' => 'sonata.media.provider.image',
                                'context' => 'sonata_category',
                            ),
                        )
                    )
                ->end();
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        parent::configureDatagridFilters($datagridMapper);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
    }
}
