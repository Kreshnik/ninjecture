<?php

namespace App\Generics;


/**
 * Class GenericRepository
 * @package App\Modules\Repository
 */
abstract class GenericRepository
{

	public $model;
	public $columns = ["*"];

	/**
	 * @param string $columns
	 * @return mixed
	 */
	public function getAll( $columns = '*' )
	{
		return $this->model->select($columns)->get();
	}

	/**
	 * @param $id
	 * @param string $columns
	 * @return mixed
	 */
	public function getById( $id, $columns = '*' )
	{
		return $this->model->select($columns)->where('id', $id)->first();
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete( $id )
	{
		return $this->model->where('id', $id)->delete();
	}

	/**
	 * @param $attributes
	 * @return mixed
	 */
	public function create( $attributes )
	{
		return $this->model->insert($attributes);
	}

	/**
	 * @param $attributes
	 * @return mixed
	 */
	public function insert( $attributes )
	{
		return $this->model->insertGetId($attributes);
	}

	/**
	 * @param $attributes
	 * @return mixed
	 */
	public function update( $attributes )
	{
		return $this->model->update($attributes);
	}
}
