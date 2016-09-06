<?php

namespace KraftHaus\Stellar\Database\Eloquent;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use KraftHaus\Stellar\Contracts\CriteriaInterface;
use KraftHaus\Stellar\Contracts\RepositoryInterface;
use KraftHaus\Stellar\Exceptions\RepositoryException;

abstract class Repository implements RepositoryInterface, CriteriaInterface
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Model
     */
    protected $repoModel;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * Specify the model class name.
     *
     * @return mixed
     */
    abstract public function model();

    /**
     * @param  Application  $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->criteria = collect();

        $this->resetScope();
        $this->makeModel();
    }

    /**
     * Reset the current model scopes.
     *
     * @return $this
     */
    public function resetScope()
    {
        $this->skipCriteria(false);

        return $this;
    }

    /**
     * Create the model instance.
     *
     * @return Model
     */
    public function makeModel()
    {
        return $this->setModel($this->model());
    }

    /**
     * Set the new model instance.
     *
     * @param  string  $model
     *
     * @return Model
     */
    public function setModel($model)
    {
        $this->repoModel = $this->app->make($model);

        if (!$this->repoModel instanceof Model) {
            throw new RepositoryException(sprintf('Class %s must be an instance of %s', $this->repoModel, Model::class));
        }

        return $this->model = $this->repoModel;
    }

    /**
     * @param  bool $status
     *
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param  Criteria  $criteria
     *
     * @return $this
     */
    public function getByCriteria(Criteria $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);

        return $this;
    }

    /**
     * @param  Criteria  $criteria
     *
     * @return $this
     */
    public function pushCriteria(Criteria $criteria)
    {
        $this->criteria->push($criteria);

        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            return $this;
        }

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria) {
                $this->model = $criteria->apply($this->model, $this);
            }
        }

        return $this;
    }

    public function all($columns = ['*'])
    {
        $this->applyCriteria();

        return $this->model->get($columns);
    }

    public function paginate($perPage = 1, $columns = ['*'])
    {
        $this->applyCriteria();

        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function save(array $data)
    {
        foreach ($data as $key => $value) {
            $this->model->$key = $value;
        }

        return $this->model->save();
    }

    public function update($id, array $data)
    {
        $key = $this->model->getKeyName();

        return $this->model->where($key, '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = ['*'])
    {
        $this->applyCriteria();

        return $this->model->find($id, $columns);
    }

    public function findBy($column, $value, $columns = ['*'])
    {
        $this->applyCriteria();

        return $this->model->where($column, '=', $value)->first($columns);
    }

    public function findAllBy($column, $value, $columns = ['*'])
    {
        $this->applyCriteria();

        return $this->model->where($column, '=', $value)->get($columns);
    }

    public function findWhere($column, $columns = ['*'], $or = false)
    {
        $this->applyCriteria();

        $model = $this->model;

        foreach ($column as $field => $value) {
            if ($value instanceof \Closure) {
                $model = (!$or) ? $model->where($value) : $model->orWhere($value);
            } elseif (is_array($value)) {
                if (count($value) === 3) {
                    list($field, $operator, $search) = $value;

                    $model = (!$or)
                        ? $model->where($field, $operator, $search)
                        : $model->orWhere($field, $operator, $search);
                } elseif (count($value) === 2) {
                    list($field, $search) = $value;

                    $model = (!$or)
                        ? $model->where($field, '=', $search)
                        : $model->orWhere($field, '=', $search);
                }
            } else {
                $model = (!$or)
                    ? $model->where($field, '=', $value)
                    : $model->orWhere($field, '=', $value);
            }
        }

        return $this->get($columns);
    }
}