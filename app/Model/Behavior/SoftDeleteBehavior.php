<?php
class SoftDeleteBehavior extends ModelBehavior
{

	public function beforeDelete(Model $model, $cascade = true)
	{
		$model->id = $model->id;
		$model->saveField('deleted', true);
		return false;
	}

	public function beforeFind(Model $model, $query)
	{
		if (!isset($query['conditions'])) {
			$query['conditions'] = array();
		}
		$query['conditions'][$model->alias . '.deleted'] = false;
		return $query;
	}
}
