<?php
namespace Craft;

class EmSeoPlugin extends BasePlugin{

	public function getName(){
		return Craft::t('e-Media SEO');
	}

	public function getDeveloper(){
		return 'e-Media Resources';
	}

	public function getVersion(){
		return '1.0.0';
	}

	public function getDeveloperUrl(){
		return 'http://e-mediaresources.com';
	}

	protected function defineSettings(){
		return array(
			'siteName' => AttributeType::String,
			'siteDescription' => AttributeType::String,
		);
	}

	public function getSettingsHtml(){
		return craft()->templates->render('emseo/_settings', array(
				'settings' => $this->getSettings(),
			)
		);
	}

	public function onAfterInstall(){
        craft()->emSeo->run();
	}

	public function onBeforeUninstall(){
		craft()->emSeo->destroy();
	}
}

