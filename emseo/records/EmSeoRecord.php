<?php
namespace Craft;

class EmSeoRecord extends BaseRecord {
	public function getTableName(){
		return 'emseo_field_groups';
	}

	protected function defineAttributes(){
		return array(
			'name' => AttributeType::String,
			'seo_group_id' => AttributeType::String,
 		);
	}
}
