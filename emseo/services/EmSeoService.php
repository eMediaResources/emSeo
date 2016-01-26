<?php
namespace Craft;

class EmSeoService extends BaseApplicationComponent{
	private $_name = 'SEO';

	public function getSeo(){
		$element = craft()->urlManager->getMatchedElement();
		$settings = craft()->plugins->getPlugin('emSeo')->getSettings();
		$data = [];
		$_title = "";
		$_description = "";
		$_siteName = "";
		$_html = "";


		if($element && $element->getElementType() == ElementType::Entry){
			//SEO Title
			if(!empty($element->seoTitle)){
				$_title = $element->seoTitle;
			} else {
				$_title = $element->title;
			}

			//Check for entry description
			if(!empty($element->seoDescription)){
				$_description = $element->seoDescription;
			} else {
				$_description = $settings->siteDescription;
			}

		}

		if($settings->siteName){
			$_siteName = ' | '.$settings->siteName;
		} else {
			$_siteName = ' | '.craft()->siteName;
		}


		$data['title'] = $_title . $_siteName;
		$data['description'] = $_description;

		//Template output on the frontend
		$oldPath = craft()->path->getTemplatesPath();
		$newPath = craft()->path->getPluginsPath().'emSeo/templates';
		craft()->path->setTemplatesPath($newPath);
		$_html = craft()->templates->render('output', $data);
		craft()->path->setTemplatesPath($oldPath);

		return $_html;
	}


	public function run(){
		// SEO field group
		Craft::log('Creating the SEO field group.');

		$group = new FieldGroupModel();
		$group->name = $this->_name;
		if (craft()->fields->saveGroup($group)) {
			$seoGroupId = new EmSeoRecord();
			$seoGroupId->setAttribute('name', strval($group->name));
			$seoGroupId->setAttribute('seo_group_id', strval($group->id));
			$seoGroupId->save();
			Craft::log('SEO field group created successfully.');
		} else {
			Craft::log('Could not save the SEO field group.', LogLevel::Warning);
		}

		// Title field

		Craft::log('Creating the Title field.');

		$titleField = new FieldModel();
		$titleField->groupId = $group->id;
		$titleField->name = 'SEO Title';
		$titleField->handle = 'seoTitle';
		$titleField->translatable = true;
		$titleField->type = 'PlainText';

		if (craft()->fields->saveField($titleField)) {
			Craft::log('Title field created successfully.');
		} else {
			Craft::log('Could not save the Title field.', LogLevel::Warning);
		}

		// Description field

		Craft::log('Creating the Description field.');

		$descField = new FieldModel();
		$descField->groupId = $group->id;
		$descField->name = 'SEO Description';
		$descField->handle = 'seoDesc';
		$descField->translatable = true;
		$descField->type = 'PlainText';
		$descField->settings = array(
			"multiline" => "1",
			'initialRows' => "4",
			'columnType' => ColumnType::Text,
		);

		if (craft()->fields->saveField($descField)) {
			Craft::log('Description field created successfully.');
		} else {
			Craft::log('Could not save the Description field.', LogLevel::Warning);
		}

	}

	public function destroy(){
		$seoModel = EmSeoRecord::Model()->find();
		$groupId = $seoModel->getAttribute('seo_group_id');
		if($groupId){
			craft()->fields->deleteGroupById(intval($groupId));
		} else {
			Craft::Log("Error Deleting the SEO Group. Please destroy manually");
		}
	}
}
