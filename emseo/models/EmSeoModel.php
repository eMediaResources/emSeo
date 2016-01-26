<?php
namespace Craft;

class EmSeoModel extends BaseModel {

	protected function defineAttributes(){
		return array(
			'siteName' => AttributeType::String,
			'siteDescription' => AttributeType::String,
			'seo_group_id' => AttributeType::String,
		);
	}
}
