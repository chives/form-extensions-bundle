<?php

namespace FSi\Bundle\FormExtensionsBundle\Form\TypeExtension;

use FSi\Bundle\FormExtensionsBundle\Form\EventListener\MultiUploadCollectionListener;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MultiUploadCollectionExtension extends AbstractTypeExtension
{
    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return 'collection';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'multi_upload_field' => null,
        ));

        $resolver->setAllowedTypes('multi_upload_field', array('null', 'string'));
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!empty($options['multi_upload_field'])) {
            $builder->addEventSubscriber(new MultiUploadCollectionListener($options['multi_upload_field']));
        }
    }
}
