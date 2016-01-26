<?php
namespace Craft;

/**
 * The class name is the UTC timestamp in the format of mYYMMDD_HHMMSS_migrationName
 */
class m151212_021546_EmSeo extends BaseMigration
{
	/**
	 * Any migration code in here is wrapped inside of a transaction.
	 *
	 * @return bool
	 */
	public function safeUp()
	{
		$this->createTable('emseo_field_groups');
		return true;
	}
	public function safeDown()
    {
        $this->dropTable('emseo_field_groups');
    }
}
