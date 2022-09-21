<?php

namespace Pikselin\LinkList\Elements;

use DNADesign\Elemental\Models\BaseElement;
use gorriecoe\Link\Models\Link;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * List of links.
 * - various types: internal, external, email, phone number, internal file
 * - sortable
 */
class LinkList extends BaseElement
{
    private static $singular_name = 'Link list';
    private static $plural_name = 'Links list';
    private static $description = 'List of links (internal and external)';
    private static $icon = 'font-icon-link';
    private static $table_name = 'ElementLinkList';
    private static $inline_editable = FALSE;

    private static $many_many = [
        'Links' => Link::class,
    ];

    private static $many_many_extraFields = [
        'Links' => [
            'Sort' => 'Int'
        ],
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Links');

        $linksConfig = GridFieldConfig_RelationEditor::create();
        // allow for drag and drop
        $linksConfig->addComponent(new GridFieldOrderableRows('Sort'));
        $linksGridField = GridField::create('Links', 'Links', $this->Links(), $linksConfig);
        $fields->addFieldToTab('Root.Main', $linksGridField);


        return $fields;
    }

    public function getType()
    {
        return 'Link list';
    }

    /**
     * Retrieve sorted links.
     *
     * @return mixed
     */
    public function LinkList()
    {
        return $this->Links()
            ->sort('Sort');
    }

    /**
     * Generate the summary by listing the number of links in this block.
     *
     * @return DBHTMLText
     */
    public function getSummary()
    {
        if ($this->Links()->count() == 1) {
            $label = ' link';
        } else {
            $label = ' links';
        }

        return DBField::create_field('HTMLText', $this->Links()->count() . $label)->Summary(20);
    }

    /**
     * Provides a summary to the gridfield.
     *
     * @return array
     * @throws \SilverStripe\ORM\ValidationException
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    /**
     * Link validation in RequiredFields doesn't work, so it must be specifically checked.
     *
     * @return \SilverStripe\ORM\ValidationResult
     */
    public function validate()
    {
        $result = parent::validate();
        // Make sure the object exists first otherwise the elemental form won't even open because the links are required.
        if ($this->ID && $this->Links()->Count() == 0) {
            $result->addError('At least one link is required');
        }
        return $result;
    }
}
