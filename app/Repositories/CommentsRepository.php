<?php
/**
 * Created by PhpStorm.
 * User: edemyakubov
 * Date: 01.08.2018
 * Time: 22:18
 */

namespace App\Repositories;

use App\Comment;
use Illuminate\Database\Eloquent\Model;


class CommentsRepository implements RepositoryInterface
{

    protected $model;

    /**
     * CommentsRepository constructor.
     * @param $model
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model::all();

    }

    public function create($data)
    {
        $this->model->forceFill($data)->save();
        return $this->model;
    }

    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function withReplies()
    {
        return $this->model::where('parent_id', NULL)->with('replies')->get();
    }

    public function getById($id){
        return $this->model->findOrFail($id);
    }

}
