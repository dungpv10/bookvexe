<?php

namespace App\Services;

use App\Models\Route;
use Illuminate\Support\Facades\Schema;
use Yajra\Datatables\Datatables;

class RouteService
{
    /**
     * Service Model
     *
     * @var Model
     */
    public $model;

    /**
     * Pagination
     *
     * @var integer
     */
    public $pagination;
    public $datatable;

    /**
     * Service Constructor
     *
     * @param Route $route
     */
    public function __construct(Route $route, DataTables $datatable)
    {
        $this->model = $route;
        $this->pagination = 25;
        $this->datatable = $datatable;

    }

    /**
     * All Model Items
     *
     * @return array
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Paginated items
     *
     * @return LengthAwarePaginator
     */
    public function paginated()
    {
        return $this->model->paginate($this->pagination);
    }

    /**
     * Search the model
     *
     * @param  mixed $payload
     * @return LengthAwarePaginator
     */
    public function search($payload)
    {
        $query = $this->model->orderBy('created_at', 'desc');
        $query->where($this->model->primaryKey, 'LIKE', '%'.$payload.'%');

        $columns = Schema::getColumnListing('routes');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$payload.'%');
        };

        return $query->paginate($this->pagination)->appends([
            'search' => $payload
        ]);
    }

    /**
     * Create the model item
     *
     * @param  array $payload
     * @return Model
     */
    public function create($payload)
    {
        return $this->model->create($payload);
    }

    /**
     * Find Model by ID
     *
     * @param  integer $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Model update
     *
     * @param  integer $id
     * @param  array $payload
     * @return Model
     */
    public function update($id, $payload)
    {
        return $this->find($id)->update($payload);
    }

    /**
     * Destroy the model
     *
     * @param  integer $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function getAllRoute()
    {
        return $this->model->orderBy('route_name', 'ASC')->pluck('route_name','id');
    }

    public function getJSONData($busId = null, $search = "")
    {
        $builder = $this->model->with('bus')
            ->join('buses', 'buses.id', '=', 'routes.bus_id')
            ->select('routes.*');
        if (!empty($busId)) {
            $builder = $builder->where('buses.id', '=', $busId);
        }

        $user = auth()->user();
        if(!$user->hasRole('admin')){
            $busIds = $user->getBusIds();
            $builder->whereIn('bus_id', $busIds);
        }

        return $this->datatable->eloquent($builder)
            ->filter(function ($query) use ($search) {
                if(!empty($search))
                {
                    $search = strtolower(trim($search));
                    $query->whereRaw(
                        '(LOWER(`routes`.`route_name`) LIKE "%'
                        . $search . '%" OR LOWER(`routes`.`price`) LIKE "%'
                        . $search . '%" OR LOWER(`routes`.`from_place`) LIKE "%'
                        . $search . '%" OR LOWER(`routes`.`arrived_place`) LIKE "%'
                        . $search . '%" OR LOWER(`routes`.`start_time`) LIKE "%'
                        . $search . '%" OR LOWER(`routes`.`arrived_time`) LIKE "%'
                        . $search . '%" OR LOWER(`buses`.`bus_name`) LIKE "%'
                        . $search . '%")'
                );
                }
            })
            ->addColumn('busName', function (Route $route) {
                    return $route->bus->bus_name;
                })
            ->make(true);
    }
}
