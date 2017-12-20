<?php
namespace TC\FormFinisher\JsonStore\Finishers;

/*
 * This file is part of the TC.FormFinisher.JsonStore package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Form\Core\Model\AbstractFinisher;
use Neos\Form\Core\Model\FormElementInterface;
use Neos\Form\Core\Model\Page;
use Ttree\JsonStore\Service\StoreService;

/**
 * This finisher redirects to another Controller or a specific URI.
 */
class JsonStoreFinisher extends AbstractFinisher
{
    /**
     * @var StoreService
     * @Flow\Inject
     */
    protected $store;

    private function getElementsValues() {

    }

    /**
     * Executes this finisher
     * @see AbstractFinisher::execute()
     *
     * @return void
     * @throws \Neos\Form\Exception\FinisherException
     */
    public function executeInternal()
    {
        $formRuntime = $this->finisherContext->getFormRuntime();
        $formState = $formRuntime->getFormState();
        $formValues = $formRuntime->getFormState()->getFormValues();

        $valuesToSave = [];
        /** @var Page $page */
        foreach ($formRuntime->getPages() as $page) {
            $currentPage = $page->getIdentifier();

            $currentSection = 'main';
            /** @var FormElementInterface $element */
            foreach ($page->getElementsRecursively() as $element) {
                if ($element->getType() === 'Neos.Form:Section') {
                    $currentSection = $element->getIdentifier();
                    continue;
                }

                // @TODO: Translate form value (if translation is in file the is option value)
                $valuesToSave[$currentPage][$currentSection][$element->getIdentifier()] = $formState->getFormValue($element->getIdentifier());
            }
        }

        $label = $this->parseOption('storeLabel');
        $type = $this->parseOption('storeType');

        $this->store->add($label, $type, $valuesToSave);
    }
}
