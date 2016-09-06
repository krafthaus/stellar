<?php

namespace KraftHaus\Stellar\Contracts;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

interface RepositoryInterface
{

    public function all($columns = ['*']);
    public function paginate($perPage = 1, $columns = ['*']);
    public function create(array $data);
    public function save(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function find($id, $columns = ['*']);
    public function findBy($column, $value, $columns = ['*']);
    public function findAllBy($column, $value, $columns = ['*']);
    public function findWhere($column, $columns = ['*']);
}