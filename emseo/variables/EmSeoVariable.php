<?php
namespace Craft;

class EmSeoVariable {

	//output SEO Tags
	public function seo(){
		return craft()->emSeo->getSeo();
	}
}
