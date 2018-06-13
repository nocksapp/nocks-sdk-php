<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;

interface Transformer {

	public function transform(array $data);

	public function reverseTransform(Model $model);

}