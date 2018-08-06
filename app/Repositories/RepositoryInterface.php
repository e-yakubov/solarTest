<?php
/**
 * Created by PhpStorm.
 * User: edemyakubov
 * Date: 01.08.2018
 * Time: 22:14
 */

namespace App\Repositories;


interface RepositoryInterface{

    public function all();

    public function create($data);

    public function update($id, $data);

    public function delete($id);

}
